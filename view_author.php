<?php require("controller_author.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Author</title>
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
                        <a class="nav-link active" href="view_author.php">Author</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <h1 class="mb-4">Author</h1>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $allauthor = getallauthor();
                        if (!empty($allauthor)) {
                            foreach ($allauthor as $author) {
                        ?>
                                <tr>
                                    <td><?= $author->author_id; ?></td>
                                    <td><?= $author->name_author; ?></td>
                                    <td><?= $author->email; ?></td>
                                    <td><?= $author->phone_number; ?></td>
                                    <td>
                                        <a href="view_updateauthor.php?updateid=<?= $author->author_id; ?>" class="btn btn-warning btn-sm">Update</a>
                                        <a href="controller_author.php?deleteid=<?= $author->author_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No author found</td></tr>"; //MAKSUD
                        }
                        ?>
                    </tbody>
                </table>

                <!-- add author aku tambah sini jg semauku -->
                <hr class="my-5">
                <h2 class="mb-4 text-center">Add New author</h2>

                <form method="POST" action="controller_author.php" class="row g-3 w-75 mx-auto">
                    <div class="col-12">
                        <label for="inputname" class="form-label">name</label>
                        <input type="text" class="form-control" name="inputname" required>
                    </div>

                    <div class="col-md-6">
                        <label for="inputemail" class="form-label">email</label>
                        <input type="text" class="form-control" name="inputemail" required>
                    </div>

                    <div class="col-md-6">
                        <label for="inputphone" class="form-label">Phone number</label>
                        <input type="number" class="form-control" name="inputphone" min="1000" required>
                    </div>

                    <div class="col-12 text-center">
                        <button name="button_submit" type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>