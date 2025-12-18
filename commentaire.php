<?php
session_start();
require_once 'include/db.php';
$art_id = $_GET['id'];
if (!$art_id) {
    header("Location: Article.php"); 
    exit;
}


$stmt = $db->prepare("SELECT * FROM article WHERE id = ?");
$stmt->execute([$art_id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter'])) {
    $contenu = trim($_POST['content']);
    $idU = $_SESSION['id'] ;
    $art_id = $_POST['art_id'];
    $status = 'pending'; 

    if (!empty($contenu) && !empty($idU) && !empty($art_id)) {

        $insert = $db->prepare("
            INSERT INTO commentaire (content, idU, art_id, status)
            VALUES (?, ?, ?, ?)
        ");

        $insert->execute([$contenu, $idU, $art_id, $status]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>
   

 <style>
/* Focus orange exist déjà */
.form-control:focus {
    border-color: #ff8800;
    box-shadow: 0 0 0 0.2rem rgba(255, 136, 0, 0.25);
}

/* Bouton hover orange */
.btn-orange:hover {
    background-color: #e67600; 
    border-color: #e67600;
}

/* FORMS ET INPUTS CLAIRS */
input.form-control,
textarea.form-control,
select.form-control {
    background-color: #fff !important;  /* Fond blanc */
    color: #000 !important;             /* Texte noir */
}
</style>


 <body class="d-flex flex-column vh-100">

    <!-- ✅ NAVBAR PROPRE W FULL WIDTH -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm w-100">
        <div class="container-fluid">
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Liste Articels</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liste Categorie</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Commentaire</a></li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-success">Search</button>
                </form>
            </div>
        </div>
    </nav>
   <!-- FORM CENTER -->
<div class="d-flex justify-content-center align-items-center flex-grow-1">
    <section id="contact" class="w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- Titre -->
<h2 class="text-center mb-4" style="color: #fff;">Ajouter commentaire</h2>
<form class="bg-dark shadow p-4 rounded" method="post" style="border: 2px solid #fff; border-radius: 10px;">
      <input type="hidden" name="art_id" value="<?php echo $article['id']; ?>">
    <div class="mb-3">

        <label style="color: #fff;">Content</label>
        <textarea name="content" class="form-control" rows="6" required></textarea>
    </div>
    <div class="mb-3">
        <label style="color: #fff;">Status</label>
    <select name="status" class="form-control" required>
        <option value="pending">pending</option>
        <option value="approved">approved</option>
        <option value="rejected">rejected</option>
        <option value="spam">spam</option>
    </select>

    </div>
     <button type="submit" name="ajouter" class="btn btn-success">Ajouter  commentaire</button>
     <?php  if( $_SESSION['role']== 'admin') { ?>
    <a href="Afficher_commentaire.php" class="btn btn-primary rounded-pill px-4">Voir commentaire</a>
   <?php } ?>

</form>



                </div>
            </div>
        </div>
    </section>
</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>