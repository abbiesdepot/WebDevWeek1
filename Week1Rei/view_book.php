<?php require("controller.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Book List</title>
</head>

<body>
    <div class="container p-3">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="view_book.php">Book List</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view_author.php">Author</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <h1 class="mb-4">Book List</h1>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Publish Year</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $allbooks = getallbooks();
                        if (!empty($allbooks)) {
                            foreach ($allbooks as $book) {
                        ?>
                                <tr>
                                    <td><?= $book->book_id; ?></td>
                                    <td><?= $book->title; ?></td>
                                    <td><?= $book->genre; ?></td>
                                    <td><?= $book->publish_year; ?></td>
                                    <td><?= $book->desc; ?></td>
                                    <td>
                                        <a href="view_updatebook.php?updateid=<?= $book->book_id; ?>" class="btn btn-warning btn-sm">Update</a>
                                        <a href="controller.php?deleteid_book=<?= $book->book_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No books found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- addbook aku tambah sini biar navbarnya lbh bagus idk semauku sih -->
                <hr class="my-5">
                <h2 class="mb-4 text-center">Add New Book</h2>

                <form method="POST" action="controller.php" class="row g-3 w-75 mx-auto">
                    <div class="col-12">
                        <label for="inputtitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="inputtitle" required>
                    </div>

                    <div class="col-md-6">
                        <label for="inputgenre" class="form-label">Genre</label>
                        <input type="text" class="form-control" name="inputgenre" required>
                    </div>

                    <div class="col-md-6">
                        <label for="inputpublishyear" class="form-label">Publish Year</label>
                        <input type="number" class="form-control" name="inputpublishyear" min="1000" required>
                    </div>

                    <div class="col-12">
                        <label for="inputdesc" class="form-label">Description</label>
                        <textarea class="form-control" name="inputdesc" rows="3"></textarea>
                    </div>

                    <div class="col-12 text-center">
                        <button name="button_submission" type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>