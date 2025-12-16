<?php
require_once 'include/db.php';
 if(isset($_GET['delete'])){
     $id=$_GET['delete'];
     $delete=$db->prepare('delete from article where id=?');
     $delete->execute([$id]);
     header("location :Afficher_Article.php");
 }
?>