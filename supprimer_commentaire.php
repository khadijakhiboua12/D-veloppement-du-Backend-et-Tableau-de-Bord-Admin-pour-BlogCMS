<?php
require_once 'include/db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
     $article_id = $_GET['article_id'];
    $delete = $db->prepare('DELETE FROM commentaire WHERE idc = ?');
    $delete->execute([$id]);
   header("Location: Afficher_Article.php?article_id=".$article_id);
exit;

  
}
?>
