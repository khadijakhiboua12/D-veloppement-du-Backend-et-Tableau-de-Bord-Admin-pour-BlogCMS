<?php
require_once 'include/db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = $db->prepare('DELETE FROM article WHERE id = ?');
    $delete->execute([$id]);
    header("Location: Home.php");
  
}
?>


