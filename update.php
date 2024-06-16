<?php global $dbh; ?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include $_SERVER["DOCUMENT_ROOT"]."/connection_database.php";
    $id = $_GET['id'];
    $name = $_POST["name"];
    $image = $_POST["image"];
    $imageload = $_POST["imageload"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $stmt = $dbh->prepare("UPDATE users SET name= :name , image= :image , imageload= :imageload , email= :email , phone= :phone WHERE id= :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':imageload', $imageload);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    header("Location: /");
    exit();
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/site.css">
</head>
<body>

<?php include $_SERVER["DOCUMENT_ROOT"]."/_header.php"; ?>
<?php include $_SERVER["DOCUMENT_ROOT"]."/connection_database.php"; ?>


<div class="container">
    <h1 class="text-center">
        Update user
    </h1>


    <?php
    //$id = $_POST["id"];
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
    }
//    echo "
//    <h2>IDup '$id'</h2>
//    ";



    //$sql = 'SELECT * FROM users WHERE id = 4';

//    $stmt = $dbh->prepare('SELECT * FROM users WHERE id = :id');
//    $stmt->bindParam(':id', $id);
//    $sql = $stmt->execute();

    $poster_records = $dbh->prepare("SELECT * FROM users WHERE id = {$id}");
    $poster_records->execute();
    $poster_results = $poster_records->fetchall();

    foreach ($poster_results as $row) {
        $id = $row["id"];
        $name = $row["name"];
        $image = $row["image"];
        $imageload = $row["imageload"];
        $email = $row["email"];
        $phone = $row["phone"];

        echo "
       
    
            <div class='row'>
        <form class='col-md-6 offset-md-3' method='post'>
            
            <div class='mb-3'>
                <label for='name' class='form-label'>ПІБ</label>
                <input type='text' class='form-control' id='name' name='name' value='$name'>
            </div>

            <div class='mb-3'>
                <label for='image' class='form-label'>Фото URL</label>
                <input type='text' class='form-control' id='image' name='image' value='$image'>
            </div>

            <div class='mb-3'>
                <label for='email' class='form-label'>Пошта</label>
                <input type='text' class='form-control' id='email' name='email' value='$email'>
            </div>

            <div class='mb-3'>
                <label for='phone' class='form-label'>Телефон</label>
                <input type='text' class='form-control' id='phone' name='phone' value='$phone'>
            </div>

            <div class='mb-3'>
                <div class='row d-flex align-items-center'>
                    <div class='col-md-3'>
                        <label for='imageload' class='form-label'>
                            <img src='/images/$imageload' alt='фото' width='100%'>
                        </label>
                    </div>
                    <div class='mb-3 col-md-9'>
                        <input type='file' class='form-control' id='imageload' name='imageload' aria-describedby='emailHelp' value='$imageload'>
                    </div>
                </div>
            </div>




            <div class='d-flex justify-content-center'>
                <button type='submit' class='btn btn-primary me-2'>Update</button>
                <a href='/' class='btn btn-light'>Скасувати</a>
            </div>



        </form>
    </div>
                ";
    }
    ?>






    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

