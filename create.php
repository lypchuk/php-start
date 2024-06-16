<?php global $dbh; ?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include $_SERVER["DOCUMENT_ROOT"]."/connection_database.php";

    $name = $_POST["name"];
    $image = $_POST["image"];
    $imageload = $_POST["imageload"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

//    // Перевірка та обробка завантаженого файлу
//    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
//        $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/uploads/';
//        // Переконайтеся, що директорія існує
//        if (!is_dir($uploadDir)) {
//            mkdir($uploadDir, 0777, true);
//        }
//
//        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
//
//        // Переміщення файлу до директорії завантажень
//        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
//            $image = '/images/' . basename($_FILES['image']['name']);
//        } else {
//            echo "Помилка при переміщенні файлу.";
//        }
//    } else {
//        echo "Помилка завантаження файлу: " . $_FILES['image']['error'];
//    }
//
//
//if (!empty($image)) {
    $stmt = $dbh->prepare("INSERT INTO users (name, image, imageload, email, phone) VALUES (:name, :image,:imageload, :email, :phone)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':imageload', $imageload);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);

    $stmt->execute();

    header("Location: /");
    exit();
//} else {
//    echo "Файл не був завантажений, шлях до зображення пустий.";
//}
}
?>


<?php
//$img = 'C:/Users/Borys/Desktop/Screenshot_2.png';
//header('Content-Type: image/jpg');
//readfile($img);
//?>

<?php
//$files = glob("C:/Users/Borys/Desktop/*.*");
//for ($i=1; $i<count($files); $i++)
//{
//    $num = $files[$i];
//    echo '<img src="'.$num.'" alt="random image">'."&nbsp;&nbsp;";
//}
//?>

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
        Create user
    </h1>



    <div class="row">
        <form class="col-md-6 offset-md-3" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">ПІБ</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Фото URL</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Пошта</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <div class="row d-flex align-items-center">
                    <div class="col-md-3">
                        <label for="imageload" class="form-label">
                            <img src="/images/no-photo.png" alt="фото" width="100%">
                        </label>
                    </div>
                    <div class="mb-3 col-md-9">
                        <input type="file" class="form-control" id="imageload" name="imageload" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>



<!--            <div class="mb-3 d-flex align-items-center" >-->
<!--                <div class="w-25">-->
<!--                <img src='images/1.jpg'  class="rounded float-start" alt="..." width="100" height="100">-->
<!--                </div>-->
<!---->
<!--                <div class="input-group w-75" >-->
<!--                 <label class="input-group-text" for="inputGroupFile01" >Upload</label>-->
<!--                 <input type="file" class="form-control" id="inputGroupFile01">-->
<!--                </div>-->
<!---->
<!--                <div class="input-group w-75">-->
<!--                    <label for="formFile" class="form-label">Default file input example</label>-->
<!--                    <input class="form-control" type="file" id="formFile">-->
<!--                </div>-->
<!--            </div>-->

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-2">Додати</button>
                <a href="/" class="btn btn-light">Скасувати</a>
            </div>



        </form>
    </div>

<!--</div>-->
<!---->
<!--<h2>Upload Image</h2>-->
<!---->
<!---->
<!--<form action="upload.php" method="post" enctype="multipart/form-data">-->
<!--    <input type="file" name="image" id="image">-->
<!--    <button type="submit" name="submit">Upload Image</button>-->
<!--</form>-->
<!---->
<!--<h2>Uploaded Image</h2>-->
<!--<div>-->
<!--    --><?php
//    // Check if file is uploaded
//    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//        // Get temporary file name
//        $tmpName = $_FILES['image']['tmp_name'];
//
//        // Get file extension
//        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
//
//        // Validate file extension
//        if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
//            // Output image
//            echo '<img src="data:image/' . $extension . ';base64,' . base64_encode(file_get_contents($tmpName)) . '" alt="Uploaded Image">';
//        } else {
//            echo 'Invalid file format. Please upload a JPG, JPEG, PNG, or GIF file.';
//        }
//    }
//    ?>
<!--</div>-->

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

