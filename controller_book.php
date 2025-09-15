<?php
require_once "model_book.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
function my_connectDB(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "book";

    $conn = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed: " . mysqli_connect_error());
    return $conn;
}

function my_closeDB($conn){
    mysqli_close($conn);
}

// CREATE
function createbook(){
    $conn = my_connectDB();

    $title = $_POST['inputtitle'];
    $genre = $_POST['inputgenre'];
    $publish_year = $_POST['inputpublishyear'];
    $desc = $_POST['inputdesc'];

    $sql = "INSERT INTO book (title, genre, publish_year, `desc`) 
            VALUES ('$title', '$genre', '$publish_year', '$desc')";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

// READ SMUA
function getallbooks(){
    $conn = my_connectDB();
    $allData = [];

    $sql = "SELECT * FROM book";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $book = new model_book();
            $book->book_id = $row['book_id']; 
            $book->title = $row['title'];
            $book->genre = $row['genre'];
            $book->publish_year = $row['publish_year'];
            $book->desc = $row['desc'];

            $allData[] = $book;
        }
    }

    my_closeDB($conn);
    return $allData;
}

// READ SATU
// function getbookwithid($id){
//     $conn = my_connectDB();

//     $sql = "SELECT * FROM book WHERE book_id = $id";
//     $result = mysqli_query($conn, $sql);
//     $book = mysqli_fetch_assoc($result);

//     my_closeDB($conn);
//     return $book;
// }

function getbookwithid($id){
    $conn = my_connectDB();

    $sql = "SELECT * FROM book WHERE book_id = $id";
    $result = mysqli_query($conn, $sql);
    $book = null;

    if ($row = mysqli_fetch_assoc($result)) {
        $book = new model_book();
        $book->book_id = $row['book_id'];
        $book->title = $row['title'];
        $book->genre = $row['genre'];
        $book->publish_year = $row['publish_year'];
        $book->desc = $row['desc'];
    }

    my_closeDB($conn);
    return $book;
}

// UPDATE
function updatebook($id){
    $conn = my_connectDB();

    $title = $_POST['inputtitle'];
    $genre = $_POST['inputgenre'];
    $publish_year = $_POST['inputpublishyear'];
    $desc = $_POST['inputdesc'];

    $sql = "UPDATE book SET 
            title = '$title',
            genre = '$genre',
            publish_year = '$publish_year',
            `desc` = '$desc'
            WHERE book_id = $id";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

// DELETE
function deletebook($id){
    $conn = my_connectDB();
    $sql = "DELETE FROM book WHERE book_id = $id";
    mysqli_query($conn, $sql);
    my_closeDB($conn);
}

// when buttons pressed
if(isset($_POST['button_submission'])){
    createbook();
    header("Location:view_book.php");
    exit;
}

if(isset($_GET['deleteid'])){
    deletebook($_GET['deleteid']);
    header("Location:view_book.php");
    exit;
}

if(isset($_POST['button_update'])){
    updatebook($_POST['input_id']);
    header("Location:view_book.php");
    exit;
}

?>


