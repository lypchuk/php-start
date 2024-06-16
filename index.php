<?php global $dbh; ?>
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
<main>

    <div class="container">
        <h1 class="text-center">
            List users
        </h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">ПІБ</th>
                <th scope="col">Фото url</th>
                <th scope="col">Фото завантажене</th>
                <th scope="col">Пошта</th>
                <th scope="col">Телефон</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = 'SELECT * FROM users';
            foreach ($dbh->query($sql) as $row) {
                $id = $row["id"];
                $name = $row["name"];
                $image = $row["image"];
                $imageload = $row["imageload"];
                $email = $row["email"];
                $phone = $row["phone"];

                echo "
            <tr>
                <th scope='row'>$id</th>
                <td>$name</td>
                <td>
                    <img src='$image'
                         alt='$name' width='150'>
                </td>
                                <td>
                    <img src='images/$imageload'
                         alt='$name' width='150'>
                </td>
                <td>$email</td>
                <td>$phone</td>
                <td>
                    <a class='nav-link' href='/update.php?id=$id'>
                    <button class='btn btn-primary' data-update='${id}'  >Update</button>               
                    </a>
                </td>
                <td>
                    <button class='btn btn-danger' data-delete='${id}'>Видалити</button>
                </td>
            </tr>
                ";
            }
            ?>

            </tbody>
        </table>
    </div>
</main>


<div class="modal" id="dialogDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Підтвердіть операцію</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ви дійсно бажаєте видалити елемент?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Скасувати</button>
                <button type="button" class="btn btn-danger" id="dialogDeleteYes">Видалити</button>
            </div>
        </div>
    </div>
</div>



<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/axios.min.js"></script>

<!--<script>-->
<!--    const updateButtons = document.querySelectorAll('[data-update]');-->
<!---->
<!--    updateButtons.forEach(button => {-->
<!--        button.addEventListener('click', function(event) {-->
<!--            // Get the value of the data-delete attribute-->
<!--            const updateValue = event.target.getAttribute('data-update');-->
<!--            console.log(`Update item with ID: ${updateValue}`);-->
<!---->
<!--            axios.post("/update.php", {-->
<!--                idup: updateValue-->
<!--            })-->
<!--                .then(resp => {-->
<!--                    console.log("Update is good");-->
<!--                    //window.location.reload();-->
<!--                });-->
<!---->
<!--        });-->
<!--    });-->
<!---->
<!--</script>-->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dialogDelete = new bootstrap.Modal("#dialogDelete");
        const dialogDeleteYes = document.getElementById("dialogDeleteYes");
        let deleteId=0;
        dialogDeleteYes.addEventListener("click", function () {
            //console.log("Підтвердили видалення елемента", deleteId);
            const headers = {
                'Content-Type': 'multipart/form-data', // This header is set automatically by Axios when using FormData
            };
            axios.post("/delete.php", {
                id: deleteId
            }, { headers })
                .then(resp => {
                    console.log("Delete is good");
                    window.location.reload(); // якщо запит успішний перегружаємо сторінку і запис зникне із таблиці
                });
            //dialogDelete.hide();
        });

        // Select all elements with the data-delete attribute
        const deleteButtons = document.querySelectorAll('[data-delete]');


        // Attach a click event listener to each button
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                // Get the value of the data-delete attribute
                const deleteValue = event.target.getAttribute('data-delete');
                console.log(`Delete item with ID: ${deleteValue}`);
                deleteId = deleteValue;
                dialogDelete.show();
                // Add your delete logic here
            });
        });
    });
</script>
</body>
</html>