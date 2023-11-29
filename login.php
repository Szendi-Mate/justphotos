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
      
    </header>
    <main class="p-5 text-center">
        <form method="POST" class="form form-control mt-5">
            <h3>Login:</h3>
            <input class="form-control mb-2" type="email" name="email" placeholder="Email">
            <input class="form-control mb-2" type="password" name="password" placeholder="Password">
            <input class="form-control mb-2" type="submit" value="Login" name="logForm">
        </form>
    </main>
    <footer>
      <small>Copyright 2023</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
if(isset($_POST["logForm"])){
    $check = $conn->login($_REQUEST['email'], $_REQUEST['password']);
}

if(isset($_SESSION['email'])){
  header("Location: ./");
}

?>