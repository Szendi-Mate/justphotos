<?php
include "./database.php";
$conn = new kapcsolat();
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>JustPhotos</title>
    <script src="https://kit.fontawesome.com/3e43b66dcd.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <div class="logo">
        <a href="./"><h3><img src="./imgs/camera-retro-solid.svg"> JustPhotos</h3></a>
      </div>

      <?php
        if(isset($_SESSION['email'])){
          echo '<div class="right-btn"><a class=""  data-bs-toggle="modal" data-bs-target="#uploadModal"><img src="./imgs/plus.svg"></a><a class="btn btn-danger ms-2" href="./logout.php">Logout</a></div>';
        }else{
          echo '<div class="right-btn"><a class="btn btn-primary" href="./login.php">Login</a></div>';
        }
      ?>
      
    </header>
    <main>
      <div class="gallery">
        <?php
        
        if(isset($_GET['loggedOut'])) echo '<div class="alert alert-success" role="alert">
        Goodbye
      </div>';
        ?>
      
      <div class="tags p-2">
      Tags:
      <?php
      print('<a class="ms-1"  href="./"><span class="badge rounded-pill bg-primary">All</span></a>');
            $result = $conn->getAllTag();
            foreach($result as $tag){
              print('<a class="ms-1"  href="./?tag='.$tag['name'].'"><span class="badge rounded-pill bg-'.$tag['color'].'">'.$tag['name'].'</span></a>');
            }
          
          ?>
      </div>
      <hr>
        <div class="row g-2">
          <?php
          $result = null;
          if(isset($_GET['tag'])){
            $result = $conn->getPhotosByTag($_REQUEST['tag']);
          }else{
            
            $result = $conn->getAllPhoto();
          }

          foreach($result as $img){
              print('<div class="col-3 thumbnail">');
              print('<a href="./view.php?v='.$img['filename'].'"><img src="./uploads/'.$img['filename'].'"></a>');
              print('</div>');

            }
            
          
          ?>
        </div>
      </div>
<!-- Modal -->
      <div class="modal fade" id="uploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="form-control border-0 text-center" method="post" action="./upload.php" id="uploadform" enctype="multipart/form-data">
                <input class="form-control mb-3" type="text" name="title" placeholder="Title" required>
                <textarea class="form-control mb-3" name="desc" rows="5" cols="50"  placeholder="Description" required></textarea>
                <input class="form-control mb-3" type="file" name="image" id="file" accept="image/*" required>
                <div>
                  <h6>Tags:</h6>
                  <div class="form-check p-0 mb-4">
                    <?php

                    $result = $conn->getAllTag();
                    foreach($result as $tag){
                      print('<span class="tagInput">');
                      print('<input onchange="refresh();" class="form-check-input d-none" type="checkbox" name="tag_'.$tag['id'].'" id="tag_'.$tag['id'].'" hidden>');
                      print('<label class="form-check-label badge bg-danger unselectable ms-1" for="tag_'.$tag['id'].'">');
                      print($tag['name']);
                      print('</label></span>');
                    }
                    
                    ?>

                  </div>
                </div>
                <input class="form-control btn btn-primary w-25" type="submit" name="uploadImg" value="Upload">
              </form>
            </div>
          </div>
        </div>
      </div>
      <script src="./tag.js"></script>
    </main>
    <footer>
      <small>Copyright 2023</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>