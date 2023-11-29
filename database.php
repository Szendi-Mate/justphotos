<?php

class kapcsolat{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $mysqli;

    public function __construct(){
        $this->conn();
    }

    public function conn(){
        $this->host='localhost';
        $this->user='php';
        $this->pass='IlovePhp';
        $this->db='justphotos';

        $this->mysqli= new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $this->mysqli;
    }

    public function getAllPhoto(){
        $sql = "SELECT filename FROM photos";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function uploadPhoto($title, $desc, $filename){
        $sql="INSERT INTO photos (title, description, filename, uploaded) VALUES ('".$title."', '".$desc."', '".$filename."', '".date("Y-m-d")."')";
        $this->mysqli->query($sql);
        $last_id = $this->mysqli->insert_id;
        return $last_id;
    }

    public function getImageByFileName($filename){
        $sql = "SELECT * FROM photos WHERE filename LIKE '". $filename. "' LIMIT 1";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function getImageById($id){
        $sql = "SELECT * FROM photos WHERE id LIKE '". $id. "' LIMIT 1";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function getRandomPhoto(){
        $sql = "SELECT * FROM photos
        ORDER BY RAND()
        LIMIT 1";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function getAllTag(){
        $sql = "SELECT * FROM tags";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function getTagsByPhoto($p_id){
        $sql = "SELECT *
        FROM tags
        JOIN photo_tag
          ON tags.id = photo_tag.t_id
        JOIN photos
          ON photos.id = photo_tag.p_id WHERE photo_tag.p_id = ".$p_id.";";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function getPhotosByTag($tag){
        $sql = "SELECT *
        FROM photos
        JOIN photo_tag
          ON photos.id = photo_tag.p_id
        JOIN tags
          ON tags.id = photo_tag.t_id WHERE tags.name LIKE '".$tag."';";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function addTagToPhoto($tag, $last_id){
        $sql="INSERT INTO photo_tag (p_id, t_id) VALUES (".$last_id.", ".$tag['id'].")";
        $this->mysqli->query($sql);

    }

    public function login($email, $pass){

        $sql="SELECT * FROM users WHERE email LIKE  '".$email."' AND password LIKE '".md5($pass)."'";
        $res = $this->mysqli->query($sql);
        if($res->num_rows == 1){
            
            
            session_start();
            $_SESSION["email"] = $email;
            foreach($res as $user){
            $_SESSION["username"] = $user['username'];      
            $_SESSION["id"] = $user['id'];
            }
            return true;
        } else{
            echo "LOGIN ERROR";
            return false;
        }   

    }

    public function reg($username, $pass, $email){
        $checkUserSQL = "SELECT * FROM users WHERE email LIKE '".$email."'";
        $res = $this->mysqli->query($checkUserSQL);
        if($res->num_rows > 0){
            echo "Email ERROR";
        }else{
            $sql="INSERT INTO users (username, password, email) VALUES ('".$username."', '".md5($pass)."', '".$email."')";
            $this->mysqli->query($sql);
        }
    }

    // 1 == LIKE ; 0 == DISLIKE
    public function addLike($user_id, $photo_id){
        $isLiked = $this->userIsLiked($photo_id, $_SESSION['id']);
        $isDisliked = $this->userIsDisliked($photo_id, $_SESSION['id']);

        if($isDisliked){
            $sql="DELETE FROM users_likes WHERE photo_id LIKE '".$photo_id."' AND user_id LIKE '".$user_id."' AND type LIKE '0'";
            $this->mysqli->query($sql);
        }
        if(!$isLiked){
            $sql="INSERT INTO users_likes (user_id, photo_id, type) VALUES (".$user_id.", ".$photo_id.", 1)";
            $this->mysqli->query($sql);
        }
    }


    public function addDislike($user_id, $photo_id){
        $isLiked = $this->userIsLiked($photo_id, $_SESSION['id']);
        $isDisliked = $this->userIsDisliked($photo_id, $_SESSION['id']);

        if($isLiked){
            $sql="DELETE FROM users_likes WHERE photo_id LIKE '".$photo_id."' AND user_id LIKE '".$user_id."' AND type LIKE '1'";
            $this->mysqli->query($sql);
        }
        if(!$isDisliked){
            $sql="INSERT INTO users_likes (user_id, photo_id, type) VALUES (".$user_id.", ".$photo_id.", 0)";
            $this->mysqli->query($sql);
        }
    }

    public function getLikes($photo_id){
        $sql="SELECT * FROM users_likes WHERE photo_id LIKE '".$photo_id."' AND type LIKE '1'";
        $res = $this->mysqli->query($sql);
        $c = $res->num_rows;
        return $c;
    }

    public function getDislikes($photo_id){
        $sql="SELECT * FROM users_likes WHERE photo_id LIKE '".$photo_id."' AND type LiKE '0'";
        $res = $this->mysqli->query($sql);
        $c = $res->num_rows;
        return $c;
    }

    public function userIsLiked($photo_id, $user_id){
        $sql="SELECT * FROM users_likes WHERE photo_id LIKE '".$photo_id."' AND user_id LIKE '".$user_id."' AND type LIKE '1'";
        $res = $this->mysqli->query($sql);
        return ($res !== false && $res->num_rows > 0);
    }
    
    public function userIsDisliked($photo_id, $user_id){
        $sql="SELECT * FROM users_likes WHERE photo_id LIKE '".$photo_id."' AND user_id LIKE '".$user_id."' AND type LIKE '0'";
        $res = $this->mysqli->query($sql);
        return ($res !== false && $res->num_rows > 0);
    }
}

?>