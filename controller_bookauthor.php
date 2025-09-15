<?php
require_once ("model_bookauthor.php");
require_once ("model_book.php");
require_once ("model_author.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!function_exists('my_connectDB')) {
    function my_connectDB(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "book";

        $conn = mysqli_connect($host, $user, $pass, $db) 
            or die("Connection Failed: " . mysqli_connect_error());
        return $conn;
    }
}

if (!function_exists('my_closeDB')) {
    function my_closeDB($conn){
        mysqli_close($conn);
    }
}

function authortobook($book_id, $author_id){
    $conn = my_connectDB();
    $sql = "UPDATE book SET author_id = $author_id WHERE book_id = $book_id";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

function getpairs(){
    $conn = my_connectDB();
    $allData = [];

    $sql = "SELECT b.book_id, b.title, a.author_id, a.name_author 
            FROM book b
            LEFT JOIN author a ON b.author_id = a.author_id";
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

// ngeset book’s author to NULL, relationshipnya yg di delete
function deletebookauthor($book_id){
    $conn = my_connectDB();
    $sql = "UPDATE book SET author_id = NULL WHERE book_id = $book_id";
    mysqli_query($conn, $sql);
    my_closeDB($conn);
}


if(isset($_POST['button_save'])){
    authortobook($_POST['book_id'], $_POST['author_id']);
    header("Location:view_bookauthor.php");
    exit;
}

if(isset($_GET['deleteid'])){
    deleteBookAuthor($_GET['deleteid']);
    header("Location:view_bookauthor.php");
    exit;
}
?>
