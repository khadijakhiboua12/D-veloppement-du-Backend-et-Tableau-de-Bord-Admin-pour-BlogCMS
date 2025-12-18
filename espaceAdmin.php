<?php
  session_start();
  require_once 'include/db.php';
  //Nombre d'utilisateur
    $totalUtilisateur=$db->query('select count(*) from utilisateur')->fetchColumn();
    $user=$db->query('select * from utilisateur')->fetchAll(PDO::FETCH_ASSOC);
    //Nombre d'commentaire
    $commentaire=$db->query('select count(*) from commentaire')->fetchColumn();
    //Nombre categorie
    $categorie=$db->query('select count(*) from categorie')->fetchColumn();
    //Nombre d'article
    $article=$db->query('select count(*) from article')->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome & Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries CSS -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Bootstrap & Custom CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        
        <!-- Spinner -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>BlogCMS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Admin</h6>
                        <span></span>
                    </div>
                </div>
    <div class="navbar-nav w-100 d-flex flex-column gap-2">
         <a href="Home.php" class="nav-item nav-link active">
      <i class="fa fa-users me-3"></i> Acceuil

    </a>
    <a href="Afficher_Article.php" class="nav-item nav-link active">
         <i class="fa fa-newspaper me-3"></i> Articlesr
    </a>
    <a href="Afficher_categorie.php" class="nav-item nav-link active">
         <i class="fa fa-list me-3"></i> Catégories
    </a>
    
   
</div>

            </nav>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->

            <!-- Statistiques -->
  <div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <!-- Card 1 -->
         <h1> Statistiques </h1>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Utilisateurs</p>
                    <h6 class="mb-0"><?php echo $totalUtilisateur ?></h6>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-comment fa-3x text-primary"></i>

                <div class="ms-3">
                    <p class="mb-2">Total Commentaires</p>
                    <h6 class="mb-0"><?php $commentaire ?></h6>
                </div>
            </div>
        </div>
     
      <!-- Card 3 -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-newspaper fa-3x text-primary"></i>

                <div class="ms-3">
                    <p class="mb-2">Total Articles</p>
                    <h6 class="mb-0"><?php  $article ?></h6>
                </div>
            </div>
        </div>
           


         <!-- Card 4 -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
               <i class="fa fa-list fa-3x text-primary"></i>

                <div class="ms-3">
                    <p class="mb-2">Total categories</p>
                    <h6 class="mb-0"><?php echo $categorie ?></h6>
                </div>
            </div>
        </div>


    </div>
</div>



            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h3 class="mb-4">Gestion des utilisateurs</h3>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php         
            foreach($user as $elem):
?>
    <tr>
              <td><?php echo($elem['id']); ?></td>
              <td><?php echo($elem['username']); ?></td>
              <td><?php echo($elem['email']) ;?></td>
              <td><?php echo($elem['role']);?></td>
              <td>
                <a class="btn btn-sm btn-primary" href="modofier_role.php?edit=<?php echo $elem['id'];?>">Rendre role
</a>
   
             <a class="btn btn-sm btn-primary" href="delete_user.php?delete=<?php echo $elem['id'];?>"
             onclick="return 
             confirm('supprimer cet utilisateur ?')">
             supprimer
            </a>
            </td>
              </tr>
                   <?php 
                   endforeach;
                   ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           <!-- Footer -->
<footer class="bg-secondary text-white p-4 fixed-bottom w-100">
    <div class="row">
        <div class="col-12 col-sm-6 text-center text-sm-start">
            &copy; <a href="#" class="text-white">Your Site Name</a>, All Right Reserved.
        </div>
        <div class="col-12 col-sm-6 text-center text-sm-end">
            Designed By <a href="https://htmlcodex.com" class="text-white">HTML Codex</a>
            <br>Distributed By: <a href="https://themewagon.com" target="_blank" class="text-white">ThemeWagon</a>
        </div>
    </div>
</footer>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Main JS -->
    <script src="js/main.js"></script>
</body>

</html>
