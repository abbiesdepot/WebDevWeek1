<?php
require ("model_author.php");
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

function createauthor(){
    $conn = my_connectDB();

    $name_author = $_POST['inputname'];
    $email = $_POST['inputemail'];
    $phone_number = $_POST['inputphone'];

    $sql = "INSERT INTO author (name_author, email, no_hp) 
            VALUES ('$name_author', '$email', '$phone_number')";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}


//FOR AUTHORS
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

    $sql = "SELECT * FROM author WHERE author_id = $id";
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

    $name_author = $_POST['inputname'];
    $email = $_POST['inputemail'];
    $phone = $_POST['inputphone'];

    $sql = "UPDATE author SET 
            name_author = '$name_author',
            email = '$email',
            no_hp = '$phone'
            WHERE author_id = $id";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    my_closeDB($conn);
}

function deleteauthor($id){
    $conn = my_connectDB();
    $sql = "DELETE FROM author WHERE author_id = $id";
    mysqli_query($conn, $sql);
    my_closeDB($conn);
}

if(isset($_POST['button_submit'])){
    createauthor();
    header("Location:view_author.php");
    exit;
}

if(isset($_GET['deleteid'])){
    deleteauthor($_GET['deleteid']);
    header("Location:view_author.php");
    exit;
}

if(isset($_POST['button_updateauthor'])){
    updateauthor($_POST['input_id']);
    header("Location:view_author.php");
    exit;
}

?>