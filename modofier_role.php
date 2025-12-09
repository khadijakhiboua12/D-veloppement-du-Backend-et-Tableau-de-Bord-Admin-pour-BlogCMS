<?php
require_once 'connection.php';

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $newRole = 'auteur'; 
    $stmt = $pdo->prepare("UPDATE utilisateur SET role = ? WHERE id = ?");
    $stmt->execute([$newRole, $id]);
   header("Location: espaceAdmin.php"); // refresh page bach yban update
    exit;
}
?>