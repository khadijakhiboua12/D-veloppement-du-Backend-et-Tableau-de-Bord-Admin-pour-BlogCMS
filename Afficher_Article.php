<?php
  session_start();
  require_once 'include/db.php';
$id = $_GET['article_id'] ?? null; 
if(!$id){
    die("Article non trouvé");
}


$stmt = $db->prepare("SELECT a.id AS article_id, a.title, a.content, a.created_at, a.image_url, a.status, c.name AS categorie
                      FROM article a
                      JOIN categorie c ON a.category_id = c.id
                      WHERE a.id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$article){
    die("Article non trouvé");
}


$stmt2 = $db->prepare("SELECT c.idc, u.username, c.content, c.status
                       FROM commentaire c
                       JOIN utilisateur u ON c.idU = u.id
                       WHERE c.art_id = ?
                       ORDER BY c.idc DESC"); 
$stmt2->execute([$id]);
$commentaire = $stmt2->fetchAll(PDO::FETCH_ASSOC); 

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
    .card-img-top {
      height: 300px; /* hauteur fixe pour images */
      object-fit: cover; /* image couvre toute la zone */
    }
    .card-body {
      display: flex;
      flex-direction: column;
    }
    .card-footer {
      background-c
      color: #f8f9fa;
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
                    <li class="nav-item"><a class="nav-link active" href="Afficher_Article.php"> Articels</a></li>
                    <li class="nav-item"><a class="nav-link" href="Afficher_categorie.php"> Categorie</a></li>
                    <li class="nav-item"><a class="nav-link" href="Afficher_commentaire.php">Commentaire</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Deconnecte</a></li>
                </ul>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-success">Search</button>
                </form>
            </div>
        </div>
    </nav>
  <div class="container my-5">

  <!-- Card Article -->
  <div class="card mb-4">
    <img src="<?= $article['image_url'] ?>" class="card-img-top" style="height:250px; object-fit:cover;">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Titre : <?= $article['title'] ?></h5>
      <p class="card-text"><?= $article['content'] ?></p>
      <p class="text-muted">Categorie : <?= $article['categorie'] ?></p>
      <p class="text-muted">Date creation : <?= $article['created_at'] ?></p>
    </div>
    <div class="card-footer text-muted">
      Statut : <?= $article['status'] ?>
      <a class="btn btn-success btn-sm float-end" href="commentaire.php?id=<?= $article['article_id'] ?>">Ajouter commentaire</a>
    </div>
  </div>
              <div class="table-responsive bg-white p-3 rounded shadow">
  <table class="table table-bordered table-hover align-middle mb-0 text-dark">
    <thead class="table-light">
      <tr>
        <th>Username</th>
        <th>Contenu</th>
       
      
      </tr>
    </thead>
    <tbody class="table-white">
      <?php foreach($commentaire as $elm): ?>
        <tr>
          <td><?php echo($elm['username']); ?></td>
          <td><?php echo($elm['content']); ?></td>
          
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>



  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>