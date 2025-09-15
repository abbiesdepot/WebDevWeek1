<?php
require_once("model_author.php");
require_once("model_book.php");
require_once("model_bookauthor.php");

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

//author 

function createauthor(){
    $conn = my_connectDB();
    $name_author = mysqli_real_escape_string($conn, $_POST['inputname']);
    $email = mysqli_real_escape_string($conn, $_POST['inputemail']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['inputphone']);

    $sql = "INSERT INTO author (name_author, email, no_hp) VALUES ('$name_author', '$email', '$phone_number')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

function getallauthor(){
    $conn = my_connectDB();
    $allData = [];
    $sql = "SELECT * FROM author";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $author = new model_author();
            $author->author_id = $row['author_id']; 
            $author->name_author = $row['name_author'];
            $author->email = $row['email'];
            $author->phone_number = $row['no_hp'];
            $allData[] = $author;
        }
    }
    my_closeDB($conn);
    return $allData;
}

function getauthorwithid($id){
    $conn = my_connectDB();
    $sql = "SELECT * FROM author WHERE author_id = " . intval($id);
    $result = mysqli_query($conn, $sql);
    $author = null;

    if ($row = mysqli_fetch_assoc($result)) {
        $author = new model_author();
        $author->author_id = $row['author_id'];
        $author->name_author = $row['name_author'];
        $author->email = $row['email'];
        $author->phone_number = $row['no_hp'];
    }
    my_closeDB($conn);
    return $author;
}

function updateauthor($id){
    $conn = my_connectDB();
    $name_author = mysqli_real_escape_string($conn, $_POST['inputname']);
    $email = mysqli_real_escape_string($conn, $_POST['inputemail']);
    $phone = mysqli_real_escape_string($conn, $_POST['inputphone']);

    $sql = "UPDATE author SET name_author = '$name_author', email = '$email', no_hp = '$phone' WHERE author_id = " . intval($id);
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

function deleteauthor($id){
    $conn = my_connectDB();
    $sql = "DELETE FROM author WHERE author_id = " . intval($id);
    mysqli_query($conn, $sql);
    my_closeDB($conn);
}

//book

function createbook(){
    $conn = my_connectDB();
    $title = mysqli_real_escape_string($conn, $_POST['inputtitle']);
    $genre = mysqli_real_escape_string($conn, $_POST['inputgenre']);
    $publish_year = mysqli_real_escape_string($conn, $_POST['inputpublishyear']);
    $desc = mysqli_real_escape_string($conn, $_POST['inputdesc']);

    $sql = "INSERT INTO book (title, genre, publish_year, `desc`) VALUES ('$title', '$genre', '$publish_year', '$desc')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

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

function getbookwithid($id){
    $conn = my_connectDB();
    $sql = "SELECT * FROM book WHERE book_id = " . intval($id);
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

function updatebook($id){
    $conn = my_connectDB();
    $title = mysqli_real_escape_string($conn, $_POST['inputtitle']);
    $genre = mysqli_real_escape_string($conn, $_POST['inputgenre']);
    $publish_year = mysqli_real_escape_string($conn, $_POST['inputpublishyear']);
    $desc = mysqli_real_escape_string($conn, $_POST['inputdesc']);

    $sql = "UPDATE book SET title = '$title', genre = '$genre', publish_year = '$publish_year', `desc` = '$desc' WHERE book_id = " . intval($id);
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

function deletebook($id){
    $conn = my_connectDB();
    $sql = "DELETE FROM book WHERE book_id = " . intval($id);
    mysqli_query($conn, $sql);
    my_closeDB($conn);
}

//others

function authortobook($book_id, $author_id){
    $conn = my_connectDB();
    $book_id = intval($book_id);
    $author_id = intval($author_id);
    $sql = "UPDATE book SET author_id = $author_id WHERE book_id = $book_id";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

function getpairs(){
    $conn = my_connectDB();
    $allData = [];
    $sql = "SELECT b.book_id, b.title, a.author_id, a.name_author FROM book b LEFT JOIN author a ON b.author_id = a.author_id";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $ba = new model_bookauthor();
            $ba->book_id = $row['book_id'];
            $ba->title = $row['title'];
            $ba->author_id = $row['author_id'];
            $ba->author_name = $row['name_author'];
            $allData[] = $ba;
        }
    }
    my_closeDB($conn);
    return $allData;
}

function deletebookauthor($book_id){
    $conn = my_connectDB();
    $sql = "UPDATE book SET title = NULL WHERE book_id = " . intval($book_id);
    mysqli_query($conn, $sql);
    my_closeDB($conn);
    $conn = my_connectDB();
    $sql = "UPDATE book SET author_id = NULL WHERE book_id = " . intval($book_id);
    mysqli_query($conn, $sql);
    my_closeDB($conn);    
}

if (isset($_POST['button_submit'])) {
    createauthor();
    header("Location:view_author.php");
    exit;
} elseif (isset($_POST['button_updateauthor'])) {
    updateauthor($_POST['input_id']);
    header("Location:view_author.php");
    exit;
} elseif (isset($_GET['deleteid_author'])) {
    deleteauthor($_GET['deleteid_author']);
    header("Location:view_author.php");
    exit;
} elseif (isset($_POST['button_submission'])) {
    createbook();
    header("Location:view_book.php");
    exit;
} elseif (isset($_POST['button_update'])) {
    updatebook($_POST['input_id']);
    header("Location:view_book.php");
    exit;
} elseif (isset($_GET['deleteid_book'])) {
    deletebook($_GET['deleteid_book']);
    header("Location:view_book.php");
    exit;
} elseif (isset($_POST['button_save'])) {
    authortobook($_POST['book_id'], $_POST['author_id']);
    header("Location:view_bookauthor.php");
    exit;
} elseif (isset($_GET['deleteid_bookauthor'])) {
    deletebookauthor($_GET['deleteid_bookauthor']);
    header("Location:view_bookauthor.php");
    exit;
}
?>