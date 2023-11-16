<?php
require_once 'DbConnection.php';

class Post
{
    protected $db;

    public function __construct()
    {
        $this->db = new DbConnection('localhost', 'root', '', 'Blog');
    }

    public function getPosts($limit, $offset)
    {
        $conn = $this->db->getConn();
        $query = "SELECT * FROM posts ORDER BY created_on DESC LIMIT $limit OFFSET $offset";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPostById($postId)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare(
            "SELECT posts.id, posts.title, posts.description, posts.content, users.username, posts.user_id 
            FROM posts 
            INNER JOIN users ON posts.user_id = users.id 
            WHERE posts.id = ?"
        );
        
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getTotalPosts()
    {
        $conn = $this->db->getConn();
        $query = "SELECT COUNT(*) as total FROM posts";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function addPost($title, $description, $content, $userId)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("INSERT INTO posts (title, description, content, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $description, $content, $userId);
        $stmt->execute();
        return $stmt->insert_id;
    }
    

    public function updatePost($id, $title, $description, $content)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("UPDATE posts SET title = ?, description = ?, content = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $content, $id);
        return $stmt->execute();
    }

    public function deletePost($id)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>