<?php
require_once 'include/db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $db->prepare("SELECT role FROM utilisateur WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        if($user['role'] != 'admin'){
            
            $stm = $db->prepare("DELETE FROM utilisateur WHERE id = ?");
            $stm->execute([$id]);
            header("Location: espaceAdmin.php");
            exit;
        } else {
            echo "Impossible de supprimer l'administrateur !";
            exit;
        }
    } else {
        echo "Utilisateur non trouvé !";
        exit;
    }
}
?>
