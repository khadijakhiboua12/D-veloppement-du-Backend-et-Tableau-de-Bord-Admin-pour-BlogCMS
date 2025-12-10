<?php
require_once 'include/db.php';

 
  
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $newRole = 'auteur'; 
    $stmt = $db->prepare("UPDATE utilisateur SET role = ? WHERE id = ?");
    $stmt->execute([$newRole, $id]);
   header("Location: espaceAdmin.php"); 
   
}

?>