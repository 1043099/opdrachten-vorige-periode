<?php
require_once 'DbConnection.php';

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = new DbConnection('localhost', 'root', '', 'Blog');
    }

    public function getUsers()
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    

    public function addUser($username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $passwordHash);
        $stmt->execute();
        return $stmt->insert_id;
    }
    public function getUserByUsername($username)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function isAuthor($username, $postId) 
    {
        // Fetch the user details
        $user = $this->getUserByUsername($username);
    
        // Check if the user exists
        if (!$user) {
            return false;
        }
    
        // Fetch the post details
        $postInstance = new Post();
        $post = $postInstance->getPostById($postId);
    
        // Check if the post exists and if the user is the author of the post
        if ($post && $post['user_id'] == $user['id']) {
            return true;
        }
    
        return false;
    }
    
    

    public function updateUser($id, $username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $passwordHash, $id);
        return $stmt->execute();
    }
    
    public function login($username, $password)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
    
    public function deleteUser($id)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>