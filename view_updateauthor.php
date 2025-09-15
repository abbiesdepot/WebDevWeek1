<?php 
require("controller_author.php");

if (isset($_GET['updateid'])) {
    $author_id = $_GET['updateid'];
    $author = getauthorwithid($author_id); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Update Author</title>
</head>
<body>
    <div class="container p-3">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="view_author.php">Book List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_author.php">Author</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <h1 class="mb-4 text-center">Update Author</h1>

                    <form method="POST" action="controller_author.php" class="row g-3 w-75 mx-auto">
                        <div class="col-12">
                            <label for="inputname" class="form-label">Name</label>
                            <input type="text" class="form-control" name="inputname" value="<?= $author->name_author?>">
                        </div>

                        <div class="col-md-6">
                            <label for="inputemail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="inputemail" value="<?= $author->email?>">
                        </div>

                        <div class="col-md-6">
                            <label for="inputphone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="inputphone" 
                                   value="<?= $author->phone_number?>">
                        </div>

                        <input type="hidden" name="input_id" value="<?= $author->author_id?>">
                        
                        <div class="col-12 text-center">
                            <button name="button_updateauthor" type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</body>
</html>
