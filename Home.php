<?php
  session_start();
  require_once 'include/db.php';
  $article=$db->query('SELECT a.id AS article_id , a.title, a.content , a.created_at, a.image_url, a.status, c.name AS categorie
               FROM article a
               JOIN categorie c ON a.category_id = c.id'
  )->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Creative - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">BlogCMS</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                      <ul class="navbar-nav me-auto">
    <ul class="navbar-nav me-auto">
    <li class="nav-item"><a class="nav-link" href="Home.php">Accueil</a></li>

    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'auteur')): ?>
        <li class="nav-item"><a class="nav-link" href="Article.php">Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Déconnecter</a></li>

    <?php endif; ?>

    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <li class="nav-item"><a class="nav-link" href="Categorie.php">Catégorie</a></li>
        <li class="nav-item"><a class="nav-link" href="espaceAdmin.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Déconnecter</a></li>
    <?php endif; ?>

    <?php if(!isset($_SESSION['role'])): ?>
        <li class="nav-item"><a class="nav-link" href="signin.php">Connexion</a></li>
        <li class="nav-item"><a class="nav-link" href="signup.php">S’inscrire</a></li>
    <?php endif; ?>
</ul>



                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">BlogCMS</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Explorez des articles classés par catégories, lisez leur contenu détaillé et partagez vos avis grâce aux commentaires.
</p>
                       
                    </div>
                </div>
            </div>
        </header>
        
        
     <div id="portfolio">
  <div class="container my-5">
    <div class="row">
      
      <?php foreach($article as $art): ?>
        <div class="col-md-6 col-lg-6 mb-4">
          
          <div class="card h-100">
            
            <img 
              src="<?php echo $art['image_url']; ?>" 
              class="card-img-top"
              style="height:200px; object-fit:cover;"
            >

            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Titre : <?php echo $art['title']; ?></h5>
              <p class="card-text">contenu : <?php echo $art['content']; ?></p>
              <p class="text-muted">categorie : <?php echo $art['categorie']; ?></p>
              <p class="text-muted">date creation : <?php echo $art['created_at']; ?></p>

              <div class="mt-auto">
    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'auteur' || $_SESSION['role'] == 'admin')): ?>
        <a href="modifier_article.php?edit=<?= $art['article_id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
        <a href="supprimer_article.php?delete=<?= $art['article_id']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('supprimer cet article ?')">
           Supprimer
        </a>
    <?php endif; ?>

    <a class="btn btn-success btn-sm"
       href="Afficher_Article.php?article_id=<?= $art['article_id']; ?>">
       Lire Plus
    </a>
    
</div>
    </div>

            <div class="card-footer text-muted">
              Statut : <?php echo $art['status']; ?>
            </div>

          </div>
        </div>

      <?php endforeach; ?>

    </div>
  </div>
</div>

        <!-- Call to action-->
        
        <!-- Contact-->
        
                        >
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - Company Name</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
