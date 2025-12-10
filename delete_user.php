<?php
   require_once 'include/db.php';
   if(isset($_GET['delete'])){
      $id=$_GET['delete'];
      $stm=$db->prepare("delete from utilisateur where id=?");
      $stm->execute([$id]);
      header("location:espaceAdmin.php");
   
   }



?>