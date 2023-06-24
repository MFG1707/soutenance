<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="../../index.html">
            <img src="../../images/logo.svg" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html">
            <img src="../../images/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning<span class="text-black fw-bold"></span></h1>
            <h3 class="welcome-sub-text">Your performance summary this week </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          
          
          </li>
          
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.html">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">TABLEAU DE BORD</span>
            </a>
          </li>
          <li class="nav-item nav-category">GESTION DE STOCKS</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">GESTION DE STOCKS</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="ajouter.php">AJOUTER</a></li>
                <li class="nav-item"> <a class="nav-link" href="modifier.php">MODIFIER LE STOCK</a></li>
                <li class="nav-item"> <a class="nav-link" href="inventaire.php">INVENTAIRES</a></li>
                <li class="nav-item"> <a class="nav-link" href="journalisation.php">JOURNALISATION</a></li>
                <li class="nav-item"> <a class="nav-link" href="state_users.php">GESTION UTILISATEURS</a></li>
              </ul>
            </div>
          </li>
         
          <li class="nav-item nav-category">help</li>
          <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">GESTION DES UTILISATEURS</h4>
            <p class="card-description">
              
            </p>
            <?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ARTSHOP";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

// Récupérer la liste des utilisateurs depuis la table users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Vérifier si des utilisateurs sont présents dans la table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nom d'utilisateur</th>";
    echo "<th>Adresse e-mail</th>";
    echo "<th>Type</th>";
    echo "</tr>";

    // Afficher chaque utilisateur dans un row du tableau
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['type']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<br>
<br>

            <?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ARTSHOP";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier quel bouton a été cliqué
    if (isset($_POST['delete'])) {
        // Supprimer un utilisateur
        $id = $_POST['id'];

        // Vérifier si l'ID est valide
        if (empty($id)) {
            echo "Veuillez remplir tous les champs.";
        } else {
            // Supprimer l'utilisateur de la base de données
            $sql = "DELETE FROM users WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                echo "Utilisateur supprimé avec succès.";
            } else {
                echo "Erreur : " . mysqli_error($conn);
            }
        }
    } elseif (isset($_POST['update'])) {
        // Mettre à jour les informations d'un utilisateur
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Vérifier si l'ID est valide
        if (empty($id)) {
            echo "Veuillez remplir tous les champs.";
        } else {
            // Mettre à jour les informations de l'utilisateur dans la base de données
            $sql = "UPDATE users SET username = '$username', password = '$password', email = '$email' WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                echo "Informations de l'utilisateur mises à jour avec succès.";
            } else {
                echo "Erreur : " . mysqli_error($conn);
            }
        }
    } elseif (isset($_POST['add_admin'])) {
        // Ajouter un administrateur
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Vérifier si les champs requis sont remplis
        if (empty($username) || empty($password) || empty($email)) {
            echo "Veuillez remplir tous les champs.";
        } else {
            // Ajouter l'administrateur à la base de données
            $sql = "INSERT INTO users (username, password, email, type) VALUES ('$username', '$password', '$email', 'admin')";
            if (mysqli_query($conn, $sql)) {
                echo "Administrateur ajouté avec succès.";
            } else {
                echo "Erreur : " . mysqli_error($conn);
            }
        }
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<!-- Formulaire pour supprimer un utilisateur -->
<h4 class="card-title">SUPPRIMER UN UTILISATEUR</h4>
<form class="forms-sample" method="POST" action="">
    <div class="form-group">
        <label for="exampleInputName1">ID de l'utilisateur à supprimer :</label>
        <input type="text" class="form-control" id="exampleInputName1" placeholder="ID de l'utilisateur" name="id" required>
    </div>
    <button type="submit" class="btn btn-danger me-2" name="delete">Supprimer</button>
</form>

<br> 

<!-- Formulaire pour modifier les informations d'un utilisateur -->
<h4 class="card-title">MODIFIER L'ETAT D'UN UTILISATEUR</h4>
<form class="forms-sample" method="POST" action="">
    <div class="form-group">
        <label for="exampleInputName2">ID de l'utilisateur à modifier :</label>
        <input type="text" class="form-control" id="exampleInputName2" placeholder="ID de l'utilisateur" name="id" required>
    </div>
    <div class="form-group">
        <label for="exampleInputUsername">Nouveau nom d'utilisateur :</label>
        <input type="text" class="form-control" id="exampleInputUsername" placeholder="Nouveau nom d'utilisateur" name="username" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword">Nouveau mot de passe :</label>
        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Nouveau mot de passe" name="password" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail">Nouvelle adresse e-mail :</label>
        <input type="email" class="form-control" id="exampleInputEmail" placeholder="Nouvelle adresse e-mail" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary me-2" name="update">Modifier</button>
</form>

<br>

<!-- Formulaire pour ajouter un administrateur -->
<h4 class="card-title">AJOUTER UN ADMINISTRATEUR</h4>
<form class="forms-sample" method="POST" action="">
    <div class="form-group">
        <label for="exampleInputUsername2">Nom d'utilisateur :</label>
        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Nom d'utilisateur" name="username" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Mot de passe :</label>
        <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Mot de passe" name="password" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Adresse e-mail :</label>
        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Adresse e-mail" name="email" required>
    </div>
    <button type="submit" class="btn btn-success me-2" name="add_admin">Ajouter un administrateur</button>
</form>

          </div>
        </div>
      <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>

