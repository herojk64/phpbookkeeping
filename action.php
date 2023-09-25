<?php
session_start();
include_once("./functions.php");

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Replace * with your server domain
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}


//for controling post requests 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            return json_encode(array("success" => false, "message" => "Fields cannot be empty"));
        }
        $user = new User();
        $result = $user->login($username, $password);
        echo $result;
        exit();
    }

    //this is to take the signup request
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phno = $_POST['phno'];

        if (empty($name) || empty($email) || empty($username) || empty($password) || empty($phno)) {
            return json_encode(array("success" => false, "message" => "Fields cannot be empty"));
        }

        $users = new User();
        $result = $users->signup($name, $email, $username, $password, $phno);
        echo $result;
        exit();
    }

    if (isset($_POST['addBooks'])) {
        $name = $_POST["name"];
        $writter = $_POST["writter"];
        $description = $_POST["description"];
        $avatar_file = isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : null;
        $book_file = isset($_FILES['book']) ? $_FILES['book']['name'] : null;


        //uploading files 
        if ($avatar_file) {
            $avatarFileType = strtolower(pathinfo($avatar_file, PATHINFO_EXTENSION));
            if ($avatarFileType != "jpg" && $avatarFileType != "jpeg" && $avatarFileType != "png") {
                echo json_encode(array('success' => false, 'message' => "File type not supported"));
                exit();
            } else {
                if (!file_exists("./assets/" . $avatar_file)) {
                    $tempName = $_FILES['avatar']['tmp_name'];
                    if (!move_uploaded_file($tempName, "./assets/" . basename($avatar_file))) {
                        echo json_encode(array('success' => false, 'message' => 'Error uploading avatar file'));
                        exit();
                    }
                }
            }
        }

        if ($book_file) {
            $bookFileType = strtolower(pathinfo($book_file, PATHINFO_EXTENSION));
            if ($bookFileType != "pdf") {
                echo json_encode(array('success' => false, 'message' => "File type not supported"));
                exit();
            } else {
                if (!file_exists("./assets/" . $book_file)) {
                    $tempName = $_FILES['book']['tmp_name'];
                    if (!move_uploaded_file($tempName, "./assets/" . basename($book_file))) {
                        echo json_encode(array('success' => false, 'message' => 'Error uploading avatar file'));
                        exit();
                    }
                }
            }
        }

        $book = new Books();

        $result = $book->addBooks($name, $writter, $description, $avatar_file, $book_file);

        echo $result;
        exit();
    }


    if (isset($_POST['updateBookData'])) {
        $bookId = $_POST["id"]; 
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $writter = isset($_POST["writter"]) ? $_POST["writter"] : null;
        $description = isset($_POST["description"]) ? $_POST["description"] : null;
        $avatar_file = isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : null;
        $book_file = isset($_FILES['book']) ? $_FILES['book']['name'] : null;


        if ($avatar_file) {
            $avatarFileType = strtolower(pathinfo($avatar_file, PATHINFO_EXTENSION));
            if ($avatarFileType != "jpg" && $avatarFileType != "jpeg" && $avatarFileType != "png") {
                echo json_encode(array('success' => false, 'message' => "Avatar file type not supported"));
                exit();
            } else {
                $tempName = $_FILES['avatar']['tmp_name'];
                if (!move_uploaded_file($tempName, "./assets/" . basename($avatar_file))) {
                    echo json_encode(array('success' => false, 'message' => 'Error uploading avatar file'));
                    exit();
                }
            }
        }
    
        // Handle book file upload
        if ($book_file) {
            $bookFileType = strtolower(pathinfo($book_file, PATHINFO_EXTENSION));
            if ($bookFileType != "pdf") {
                echo json_encode(array('success' => false, 'message' => "Book file type not supported"));
                exit();
            } else {
                $tempName = $_FILES['book']['tmp_name'];
                if (!move_uploaded_file($tempName, "./assets/" . basename($book_file))) {
                    echo json_encode(array('success' => false, 'message' => 'Error uploading book file'));
                    exit();
                }
            }
        }

        $books = new Books();

        $response = $books->updateBook($bookId,$name,$writter,$description,$avatar_file,$book_file);

        echo $response;
        exit();
    }
}


//for controlling get requests
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['checkUsernameExists'])) {
        $username = $_GET['checkUsernameExists'];
        $user = new User();
        $result = $user->checkUsernameExists($username);
        echo $result;
        exit();
    }

    //get all book data
    if (isset($_GET['getAllBooksData'])) {
        $book = new Books();
        $result = $book->getAllBookData();
        echo $result;
        exit();
    }

    if (isset($_GET["bookSearchByName"])) {
        $search = $_GET["bookSearchByName"];
        $books = new Books();
        $response = $books->searchBooks($search);
        echo $response;
        exit();
    }

    if (isset($_GET['deleteBook'])) {
        $id = $_GET["deleteBook"];
        $books = new Books();
        $response = $books->deleteBook($id);
        echo $response;
        exit();
    }

    if (isset($_GET['getBookById'])) {
        $id = $_GET['getBookById'];
        $books = new Books();
        $response = $books->getBookById($id);
        echo json_encode($response);
        exit();
    }
}
