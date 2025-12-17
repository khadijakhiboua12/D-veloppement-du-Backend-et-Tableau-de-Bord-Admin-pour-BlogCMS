<?php
require_once 'include/db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = $db->prepare('DELETE FROM commentaire WHERE idc = ?');
    $delete->execute([$id]);
    header("Location: Afficher_commentaire.php");
  
}
?>
