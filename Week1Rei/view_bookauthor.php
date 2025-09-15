<?php 
require_once("controller.php");

$allBooks = getallbooks();
$allAuthors = getallauthor();
$pairs = getpairs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book-Author</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container p-3">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link" href="view_book.php">Books</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_author.php">Authors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="view_bookauthor.php">Book and Author</a>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <h1 class="mb-4">Book and Author Pairing</h1>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Book</th>
            <th>Author</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($pairs)){
            foreach($pairs as $p){ ?>
              <tr>
                <td><?= $p->title ?? "—" ?></td>
                <td><?= $p->author_name ?? "—" ?></td>
                <td>
                  <a href="controller.php?deleteid_bookauthor=<?= $p->book_id ?> &deleteid=<?= $p->title ?>" class="btn btn-danger btn-sm">Remove</a>
              </tr>
          <?php }} else { echo "<tr><td colspan='3' class='text-center'>No data</td></tr>"; } ?>
        </tbody>
      </table>

      <hr class="my-5">
      <h2 class="mb-4 text-center">Assign Author to Book</h2>

      <form method="POST" action="controller.php" class="row g-3 w-75 mx-auto">
        <div class="col-md-6">
          <label for="book_id" class="form-label">Book</label>
          <select class="form-select" name="book_id" required>
            <?php foreach($allBooks as $book){ ?>
              <option value="<?= $book->book_id ?>"><?= $book->title ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="author_id" class="form-label">Author</label>
          <select class="form-select" name="author_id" required>
            <?php foreach($allAuthors as $author){ ?>
              <option value="<?= $author->author_id ?>"><?= $author->name_author ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="col-12 text-center">
          <button name="button_save" type="submit" class="btn btn-primary">SAVE</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
