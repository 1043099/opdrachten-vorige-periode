<?php
require_once 'DbConnection.php';

class Comment
{
    protected $db;

    public function __construct()
    {
        $this->db = new DbConnection('localhost', 'root', '', 'Blog');
    }

    public function getComments($postId)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_on DESC");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addComment($postId, $name, $message)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("INSERT INTO comments (post_id, name, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $postId, $name, $message);
        $stmt->execute();
        return $stmt->insert_id;
    }
    public function getCommentsByPostId($postId)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_on ASC");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateComment($id, $name, $message)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("UPDATE comments SET name = ?, message = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $message, $id);
        return $stmt->execute();
    }

    public function deleteComment($id)
    {
        $conn = $this->db->getConn();
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>