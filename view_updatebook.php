<?php 
require("controller_book.php");

if(isset($_GET['updateid'])){
    $book_id = $_GET['updateid'];
    $book = getbookwithid($book_id); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Update Book</title>
</head>
<body>
    <div class="container p-3">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="view_book.php">Book List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_addbook.php">Author</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <h1 class="mb-4 text-center">Update Book</h1>
                <form method="POST" action="controller_book.php" class="row g-3 w-75 mx-auto">
                    <div class="col-12">
                        <label for="inputtitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="inputtitle" value="<?= $book->title ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="inputgenre" class="form-label">Genre</label>
                        <input type="text" class="form-control" name="inputgenre" value="<?= $book->genre ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="inputpublishyear" class="form-label">Publish Year</label>
                        <input type="text" class="form-control" name="inputpublishyear" value="<?= $book->publish_year ?>">
                    </div>

                    <div class="col-12">
                        <label for="inputdesc" class="form-label">Description</label>
                        <input type="text" class="form-control" name="inputdesc" value="<?= $book->desc ?>">
                    </div>

                    <input type="hidden" name="input_id" value="<?= $book->book_id ?>">
                    
                    <div class="col-12 text-center">
                        <button name="button_update" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
