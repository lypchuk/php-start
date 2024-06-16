<?php
if (isset($_POST['submit'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Define upload directory
        $uploadDir = 'images';

        // Get file name
        $fileName = $_FILES['image']['name'];

        // Move uploaded file to desired directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
            echo 'File uploaded successfully.';
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'Error uploading file.';
    }
}
?>