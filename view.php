<!doctype html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3e43b66dcd.js" crossorigin="anonymous"></script>
    <title>JustPhotos</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <a href="./"><h3><img src="./imgs/camera-retro-solid.svg"> JustPhotos</h3></a>
      </div>
    </header>
    <main>
      <div class="view row">      

        <?php 
          include "./database.php";
          session_start();
          $result = null;

          if(isset($_REQUEST["v"])){
          $conn = new kapcsolat();
          $result = $conn->getImageByFileName($_REQUEST['v']);
          
          }else{
            $conn = new kapcsolat();
            $result = $conn->getRandomPhoto();
          }
          foreach($result as $img){
            print('<div class="col-12 col-md-4">');
            print("<h4>".$img['title']."</h4>");

            print("<p class='mb-5'>".$img['description']."</p>");

            $isLiked = false;
            $isDisliked = false;
            
            if(isset($_SESSION['id'])){
            $isLiked = $conn->userIsLiked($img['id'], $_SESSION['id']);
            $isDisliked = $conn->userIsDisliked($img['id'], $_SESSION['id']);
            }
            $likeCount = $conn->getLikes($img['id']);
            $dislikeCount = $conn->getDislikes($img['id']);


            

            if($isLiked)
              print("<p><button class='btn btn-success me-2'>Tetszik (".$likeCount.")</button>");
            else
              print("<p><button onClick='addLike(".$img['id'].");' class='btn btn-outline-success me-2'>Tetszik (".$likeCount.")</button>");

            if($isDisliked)
              print("<button class='btn btn-danger'>Nem tetszik (".$dislikeCount.")</button></p>");
            else 
              print("<button onClick='addDislike(".$img['id'].");' class='btn btn-outline-danger'>Nem tetszik (".$dislikeCount.")</button></p>");

            
            
            
            $tags = $conn->getTagsByPhoto($img['id']);
            if(mysqli_num_rows($tags) > 0){
            print("<div>Tags: ");
            
            foreach($tags as $tag){
              print('<a class="ms-1"  href="./?tag='.$tag['name'].'"><span class="badge rounded-pill bg-'.$tag['color'].'">'.$tag['name'].'</span></a>');
            }
            
            
            print("</div>");}

            print('<a href="./view.php" class="btn btn-primary mt-5">Random Photo</a></div>');
            print('<div class="col-12 col-md-8 text-center">');
            print('<img src="./uploads/'.$img['filename'].'">');
            print('</div>');
          }
        ?>
        <script src="./like.js"></script>
    </main>
    <footer>
      <small>Copyright 2023</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>