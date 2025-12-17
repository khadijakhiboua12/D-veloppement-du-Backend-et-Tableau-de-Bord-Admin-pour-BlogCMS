<?php
session_start();

require_once 'include/db.php';

 $commentaire=$db->query('SELECT  *
               FROM commentaire c join utilisateur u on c.idU=u.id
               '
  )->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h3 class="mb-4">Gestion des commentaire</h3>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th>ID</th>
                                   <th>Username</th>
                                    <th>Contenu</th>
                                    <th>statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php foreach($commentaire as $elm):?>

             <tr>
              <td><?php echo ($elm['idc']);?></td>
              <td><?php echo ($elm['username']);?></td>
              <td><?php echo ($elm['content']);?></td>
              <td><?php echo ($elm['status']);?></td>
              <td>
                <a class="btn btn-sm btn-primary" href="modifier_commentaire.php?edit=<?php echo $elm['idc'];?>">Modifier
</a> 
             <a class="btn btn-sm btn-primary" href="supprimer_commentaire.php?delete=<?php echo $elm['idc'];?>"
              onclick="return 
             confirm('supprimer cet utilisateur ?')">
             supprimer
            
            </a>
            </td>
              </tr>
              <?php endforeach ;?>
                 
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
