<?php
include_once("./session_start.php");
include_once("./db.php");

class User extends Database
{
    function __construct()
    {
        parent::connect();
    }

    public function login($username, $password)
    {
        try {
            $sql = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
            $stmt = $this->prepare($sql);
            $stmt->bind_param("ss",$username,$username);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($dat = $result->fetch_assoc()) {
                    if (password_verify($password, $dat["password"])) {
                        $_SESSION['id'] = $dat['id'];
                        $_SESSION['name'] = $dat['name'];
                        $_SESSION['email'] = $dat['email'];
                        $_SESSION['username'] = $dat['username'];
                        $_SESSION['phno'] = $dat['phno'];
                        $_SESSION['admin'] = $dat['admin'];

                        return json_encode(array("success" => true));
                    } else {
                        return json_encode(array("success" => false, "messsage" => "Invalid Password"));
                    }
                }
            } else {
                return json_encode(array("success" => false, "messsage" => "Query execution failed"));
            }
        } catch (Exception $e) {
            return json_encode(array("success" => false, "messsage" => $e));
        }
    }

    public function signup($name, $email, $username, $password, $phno)
    {
        try {
            $sql = "INSERT INTO `users`	(`name`,`email`,`username`,`password`,`phno`) VALUES (?,?,?,?,?)";
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->prepare($sql);
            $stmt->bind_param("sssss", $name, $email, $username, $passwordHash, $phno);
            if ($stmt->execute()) {
                return json_encode(array("success" => true, "messsage" => "User created successful"));
            } else {
                return json_encode(array("success" => false, "messsage" => "Query execution failed"));
            }
        } catch (Exception $e) {
            return json_encode(array("success" => false, "messsage" => $e));
        }
    }

    public function checkUsernameExists($username)
    {
        $sql = "SELECT * FROM `users` WHERE `username`=?";
        $stmt = $this->prepare($sql);
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            
            $result = $stmt->get_result();
            
            if ($result->num_rows == 0) {
                return json_encode(array("success" => false,"exists" => false, "messsage" => "Username doesn't exist."));
            } else {
                return json_encode(array("success" => true, "exists" => true, "messsage" => "Username doesn't exist."));
            }
        } else {
            return json_encode(array("success" => false, "exists" => false, "messsage" => "Query execution failed."));
        }
    }
}


class Books extends Database{

    function __construct()
    {
        parent::connect();
    }

    public function addBooks($name,$writter,$description,$avatar,$book){
        $sql = "insert into `books`(`name`,`writer`,`description`,`avatar`,`filename`) values (?,?,?,?,?)";
        $stmt = $this->prepare($sql);
        $stmt->bind_param("sssss",$name,$writter,$description,$avatar,$book);
        if($stmt->execute()){
            return json_encode(array("success" => true, "message" => "Book added to the list."));
        }else{
            return json_encode(array("success" => false, "message" => "Query execution failed."));
        }
    }

    public function updateBook($id, $name, $writter, $description, $avatar, $book)
    {
        $sql = "UPDATE `books` SET ";
        $params = array();
        $types = "";
        
        if (!empty($name)) {
            $sql .= "`name`=?, ";
            $params[] = $name;
            $types .= "s";
        }
        
        if (!empty($writter)) {
            $sql .= "`writer`=?, ";
            $params[] = $writter;
            $types .= "s";
        }
        
        if (!empty($description)) {
            $sql .= "`description`=?, ";
            $params[] = $description;
            $types .= "s";
        }
        
        if (!empty($avatar)) {
            $sql .= "`avatar`=?, ";
            $params[] = $avatar;
            $types .= "s";
        }
        
        if (!empty($book)) {
            $sql .= "`filename`=?, ";
            $params[] = $book;
            $types .= "s";
        }
        
        // Remove the trailing comma and space
        $sql = rtrim($sql, ", ");
        
        $sql .= " WHERE `id`=?";
        $types .= "i";
        $params[] = $id;
        
        $stmt = $this->prepare($sql);
        $stmt->bind_param($types, ...$params);
        
        if ($stmt->execute()) {
            return json_encode(array("success" => true, "message" => "Book updated successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Query execution failed."));
        }
    }
    

    public function getAllBookData(){
        $sql = "SELECT * FROM `books` ORDER BY `id` DESC";
        $stmt = $this->prepare($sql);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $response = array();
            while($data = $result->fetch_assoc()){
                array_push($response,$data);
            }
            return json_encode($response);
        }else{
            return json_encode(array("success" => false, "message" => "Query execution failed."));
        }
    }

    public function searchBooks($search) {
        $searchTerm = "%" . $search . "%"; // Add '%' to search for partial matches
    
        $sql = "SELECT * FROM `books` WHERE `name` LIKE ? OR `writer` LIKE ?";
        $stmt = $this->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("ss", $searchTerm, $searchTerm); // "ss" indicates two string parameters
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $response = array();
                while ($data = $result->fetch_assoc()) {
                    array_push($response, $data);
                }
                return json_encode($response);
            } else {
                return json_encode(array("success" => false, "message" => "Query execution failed."));
            }
        } else {
            return json_encode(array("success" => false, "message" => "Statement preparation failed."));
        }
    }

    public function deleteBook($id){
        $sql = "DELETE FROM `books` WHERE `id` = ?";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i',$id);
        if($stmt->execute()){
            return json_encode(array("success" => true, "message" => "Book delete successfull."));
        }else{
            return json_encode(array("success" => false, "message" => "Statement preparation failed."));
        }
    }

    public function getBookById($id){
        $sql = "SELECT * FROM `books` WHERE `id` = ?";
        $stmt= $this->prepare($sql);
        $stmt->bind_param("i",$id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            return $result->fetch_assoc();
        }else{
            return json_encode(array("success" => false, "message" => "Statement preparation failed."));
        }
    } 
}