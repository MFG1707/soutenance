
<!DOCTYPE php>
<?php
$id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
?>
<!--[if lt IE 7 ]> <php class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <php class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <php class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <php class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><php class=""><!--<![endif]-->
<head>
	<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

	<title>Afrik Art - Mon panier</title>

	<!-- Standard Favicon -->
	<link rel="icon" type="image/x-icon" href="images//favicon.ico" />
	
	<!-- For iPhone 4 Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images//apple-touch-icon-114x114-precomposed.png">
	
	<!-- For iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images//apple-touch-icon-72x72-precomposed.png">
	
	<!-- For iPhone: -->
	<link rel="apple-touch-icon-precomposed" href="images//apple-touch-icon-57x57-precomposed.png">	
	
	<!-- Custom - Theme CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!--[if lt IE 9]>
		<script src="js/html5/respond.min.js"></script>
    <![endif]-->
	
</head>

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
	<!-- Loader -->
	<div id="site-loader" class="load-complete">
		<div class="loader">
			<div class="loader-inner ball-clip-rotate">
				<div></div>
			</div>
		</div>
	</div><!-- Loader /- -->
	
	
	<!-- Header -->
	<header class="header-main container-fluid no-padding">
		<!-- SidePanel -->
		<div id="slidepanel">
			<!-- Top Header -->
			<div class="top-header container-fluid no-padding">
				<!-- Container -->
				<div class="container">
					<ul class="contact">
						<li><a href="tel:(+1)123-456-7890" title="(+1) 123 - 456 - 7890"><i class="fa fa-phone" aria-hidden="true"></i><span>Phone :</span> (+1) 123 - 456 - 7890</a></li>
						<li><a href="mailto:Info@Ourdomain.Com" title="Info@Ourdomain.Com"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Email :</span> Info@Ourdomain.Com</a></li>
					</ul>
					<div class="dropdown-bar">
						
						<div class="language-dropdown dropdown">
							<button class="btn dropdown-toggle" type="button" id="Username" title="Username" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Mon compte<span class="caret"></span></button>
							<ul class="dropdown-menu no-padding">
								<li><a href="login.php?user_id=<?php echo $_GET['id']; ?>" title="Authentification">Connexion</a></li>
								<li><a href="register.php?user_id=<?php echo $_GET['id']; ?>" title="Authentification">Inscription</a></li>
								<li><a href="logout.php?user_id=<?php echo $_GET['id']; ?>" title="Deconnexion">Deconnexion</a></li>
							</ul>
						</div>
					</div>
				</div><!-- Container /- -->
			</div><!-- Top Header /- -->
			
			<!-- Middel Header -->
			<div class="middle-header container-fluid no-padding">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-4 col-xs-4">
							<div class="logo-block">
								<a href="index.php?user_id=<?php echo $_GET['id']; ?>"><img src="images/logo.png" alt="logo" height="150" width="220"/><span></span></a>
							</div>
						</div>
						<div class="header-info">
							<div class="col-md-5 col-sm-6 col-xs-6">
								<div class="input-group">
									<div class="input-group-btn">
										
									</div><!-- /btn-group -->
									
									<span class="input-group-btn">
									</span>
								</div><!-- /input-group -->
							</div>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2 add-to-cart">
						<?php
							session_start();

							// Connexion à la base de données
							$conn = mysqli_connect("localhost", "root", "root", "ARTSHOP");

							// Vérifier la connexion
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}

							// Vérifier si l'utilisateur est connecté
							if (isset($_SESSION['user_id'])) {
								// Récupérer l'ID de l'utilisateur connecté
								$userId = $_SESSION['user_id'];

								// Récupérer les données des produits dans le panier pour l'utilisateur connecté
								$sql = "SELECT produits.id, produits.nom, produits.prix, produits.prix2, produits.image, produits.description, panier.quantite
										FROM produits
										INNER JOIN panier ON produits.id = panier.produit_id
										WHERE panier.users_id = $userId";
								$result = mysqli_query($conn, $sql);

								// Calculer le nombre total d'articles dans le panier
								$totalItems = 0;
								// Calculer le total des prix des articles dans le panier
								$totalPrice = 0;

								// Construire la structure HTML du panier
								$html = '<ul class="cart">';
								$html .= '<li>';
								$html .= '<a aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="cart" class="btn dropdown-toggle" title="Add To Cart" href="#">';
								$html .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
								$html .= '<h3>Votre panier</h3>';
								$html .= '<h5>(' . mysqli_num_rows($result) . ') Article</h5>';
								$html .= '</a>';
								$html .= '<ul class="dropdown-menu no-padding">';

								// Vérifier si des produits ont été trouvés
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										// Récupérer les données du produit
										$id_produit = $row['id'];
										$nom = $row['nom'];
										$quantite = $row['quantite'];
										$image = $row['image']; // Colonne contenant le nom de l'image dans la base de données
										$description = $row['description']; // Colonne contenant la description du produit
										$prix = ($quantite > 100) ? $row['prix2'] : $row['prix']; // Utiliser prix2 si la quantité est supérieure à 100, sinon utiliser prix

										// Calculer le total du prix pour le produit actuel
										$subtotal = $prix * $quantite;

										// Ajouter les informations du produit au HTML
										$html .= '<li class="mini_cart_item">';
										$html .= '<a title="Remove this item" class="remove" href="#">&#215;</a>';
										$html .= '<a href="#" class="shop-thumbnail">';
										$html .= '<img width="60" height="60" alt="' . $nom . '" class="attachment-shop_thumbnail" src="data:image/jpeg;base64,' . base64_encode($image) . '" />' . $nom;
										$html .= '</a>';
										$html .= '<span class="quantity">' . $quantite . ' &#215; <span class="amount">$' . $prix . '</span></span>';
										$html .= '</li>';

										// Mettre à jour le nombre total d'articles et le total des prix
										$totalItems += $quantite;
										$totalPrice += $subtotal;
									}
								} else {
									// Aucun produit trouvé dans le panier
									$html .= '<li class="empty-cart">Aucun produit trouvé dans le panier.</li>';
								}

								$html .= '<li class="button">';
								$html .= '<a href="cart.php?user_id=' . $userId . '" title="Voir panier">Voir panier</a>';
								$html .= '<a href="#" title="Procéder au paiement">Procéder au paiement</a>';
								$html .= '</li>';
								$html .= '</ul>';
								$html .= '</li>';
								$html .= '</ul>';

								// Afficher le panier
								echo $html;
							} else {
								// L'utilisateur n'est pas connecté
								echo '<ul class="cart">';
								echo '<li>';
								echo '<a aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="cart" class="btn dropdown-toggle" title="Add To Cart" href="#">';
								echo '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
								echo '<h3>Votre panier</h3>';
								echo '<h5>(0) Articles - <span>$0</span></h5>';
								echo '</a>';
								echo '<ul class="dropdown-menu no-padding">';
								echo '<li class="empty-cart">Aucun produit trouvé dans le panier.</li>';
								echo '<li class="button">';
								echo '<a href="cart.php" title="Voir panier">Voir panier</a>';
								echo '<a href="#" title="Procéder au paiement">Procéder au paiement</a>';
								echo '</li>';
								echo '</ul>';
								echo '</li>';
								echo '</ul>';
							}

							// Fermer la connexion à la base de données
							mysqli_close($conn);
							?>

						</div>
					</div><!-- Row /- -->
				</div><!-- Container /- -->
			</div><!-- Middel Header /- -->	
		</div>		
		
		<!-- Menu Block -->
<div class="menu-block menu-block-section container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <nav class="navbar ow-navigation">
            <div id="loginpanel" class="desktop-hide">
                <div class="right" id="toggle">
                    <a id="slideit" href="#slidepanel"><i class="fo-icons fa fa-inbox"></i></a>
                    <a id="closeit" href="#slidepanel"><i class="fo-icons fa fa-close"></i></a>
                </div>
            </div>
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="text-logo desktop-hide" href="index.php?user_id=<?php echo $_GET['user_id']; ?>"><span>Afrik</span>Art</a>
            </div>
            <div class="navbar-collapse collapse navbar-right" id="navbar">
                <ul class="nav navbar-nav menubar">

                    <li><a title="Home" href="index.php?user_id=<?php echo $_GET['user_id']; ?>">ACCUEIL</a></li>
                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle"
                            title="Home" href="shop.php?user_id=<?php echo $_GET['user_id']; ?>">BOUTIQUE</a>
                        <i class="ddl-switch fa fa-angle-down"></i>

                        <ul class="dropdown-menu">
                            <li><a title="Shop 2" href="tableaux.php?user_id=<?php echo $_GET['user_id']; ?>">Tableaux</a></li>
                            <li><a title="Shop 2" href="sculptures.php?user_id=<?php echo $_GET['user_id']; ?>">Sculptures</a></li>
                            <li><a title="Shop 2" href="vases.php?user_id=<?php echo $_GET['user_id']; ?>">Vases</a></li>
                            <li><a title="Shop 2" href="lampes.php?user_id=<?php echo $_GET['user_id']; ?>">Lampes</a></li>
                            <li><a title="Shop 2" href="tables.php?user_id=<?php echo $_GET['user_id']; ?>">Tables</a></li>
                        </ul>

                    </li>

                    <li><a title="Home" href="about.php?user_id=<?php echo $_GET['user_id']; ?>">A PROPOS DE NOUS </a></li>
                    <li><a title="Contact Us" href="contact-us.php?user_id=<?php echo $_GET['user_id']; ?>">CONTACTEZ-NOUS </a></li>
                </ul>
            </div>
        </nav><!-- Navigation /- -->
    </div><!-- Container /- -->
</div><!-- Menu Block /- -->

	</header><!-- Header /- -->
	
	<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="page-banner cart-banner container-fluid no-padding">
			<div class="page-banner-content">
				<h3>Votre panier</h3>
			</div>
		</div><!-- Page Banner /- -->
		
		
		<!-- Cart -->
		<div id="cart-main" class="cart-main">
			<div class="section-padding"></div>
			<div class="container">
				<div class="woocommerce">
					<form method="post" class="col-md-12 col-sm-12 col-xs-12 no-padding">
					<?php
session_start();

// Vérifier si des choix ont été ajoutés au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // Récupérer l'ID du produit
    $productId = $_POST['product_id'];
    $quantity = isset($_POST['quantity1']) ? $_POST['quantity1'] : 0; // Récupérer la quantité du produit, sinon la quantité par défaut est 0

    // Ajouter les choix au panier
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Vérifier si le produit est déjà dans le panier
    if (isset($_SESSION['cart'][$productId])) {
        // Mettre à jour la quantité du produit dans le panier
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        // Ajouter le produit au panier avec la quantité spécifiée
        $_SESSION['cart'][$productId] = $quantity;
    }

    // Répondre avec succès à la requête AJAX
    http_response_code(200);
    echo "Le produit a été ajouté au panier.";
    exit();
} elseif (isset($_POST['remove_product_id'])) {
    // Supprimer le produit du panier
    $removeProductId = $_POST['remove_product_id'];
    unset($_SESSION['cart'][$removeProductId]);

    // Répondre avec succès à la requête AJAX
    http_response_code(200);
    echo "Le produit a été supprimé du panier.";
    exit();
} elseif (isset($_SESSION['cart'])) {
    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "root", "root", "ARTSHOP");

    // Vérifier la connexion
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Récupérer l'ID de l'utilisateur connecté
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    // Récupérer les données des produits dans le panier de l'utilisateur connecté
    $sql = "SELECT p.*, c.quantite FROM produits p INNER JOIN panier c ON p.id = c.produit_id WHERE c.users_id = $userId";
    $result = mysqli_query($conn, $sql);

    // Vérifier si des produits ont été trouvés
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="shop_table cart">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="product-name" colspan="2">Produits</th>';
        echo '<th class="product-price">Prix</th>';
        echo '<th class="product-quantity">Quantité</th>';
        echo '<th class="product-subtotal">Total</th>';
        echo '<th class="product-remove">&nbsp;</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            // Récupérer les données du produit
            $id_produit = $row['id'];
            $nom = $row['nom'];
            $prix = $row['prix'];
            $prix2 = $row['prix2']; // Nouvelle colonne pour le deuxième prix
            $image = $row['image']; // Colonne contenant l'image dans la base de données
            $description = $row['description']; // Colonne contenant la description du produit
            $quantity = $row['quantite']; // Récupérer la quantité du produit dans le panier

            // Déterminer le prix à afficher en fonction de la quantité
            $displayedPrice = ($quantity > 100) ? $prix2 : $prix;

            // Afficher le produit dans le panier
            echo '<tr class="cart_item">';
            echo '<td data-title="Produt" class="product-thumbnail">';
            echo '<a title="Product Thumbnail" href="">';
            echo '<img class="attachment-shop_thumbnail wp-post-image" src="data:image/png;base64,' . base64_encode($image) . '" alt="Product Thumbnail">';
            echo '</a>';
            echo '</td>';
            echo '<td data-title="Produits" class="product-name">';
            echo '<a title="Product Name" href="">';
            echo $nom;
            echo '</a>';
            echo '</td>';
            echo '<td data-title="Prix" class="product-price">';
            echo $displayedPrice . '<br>';
            echo '</td>';
            echo '<td data-title="Quantité" class="product-quantity">';
            echo $quantity;
            echo '</td>';
            echo '<td data-title="Total" class="product-subtotal">';
            echo $displayedPrice * $quantity;
            echo '</td>';
            echo '<td data-title="Remove" class="product-remove">';
			echo '<a title="Remove this item" class="remove" href="#" onclick="removeProduct(' . $id_produit . ')">×</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Aucun produit trouvé dans le panier.</p>';
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    echo '<p>Aucun produit dans votre panier.</p>';
}
?>

<script>
function removeProduct(productId) {
    // Envoyer une requête AJAX pour supprimer le produit
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'removeproduct.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Afficher la réponse du serveur
            console.log(xhr.responseText);
            // Rediriger vers la page actuelle
            window.location.href = window.location.href;
        }
    };
    xhr.send('remove_product_id=' + productId);
}
</script>



							
					</form>

					<div class="cart-collaterals row">
						
					<div class="col-md-12 col-sm-12 col-xs-24">
					<?php
session_start();

// Fonction pour calculer le sous-total du panier
function calculateSubTotal()
{
    if (isset($_SESSION['cart'])) {
        $total = 0;

        // Connexion à la base de données
        $conn = mysqli_connect("localhost", "root", "root", "ARTSHOP");

        // Vérifier la connexion
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Récupérer l'ID de l'utilisateur connecté
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        // Récupérer les données des produits dans le panier de l'utilisateur connecté
        $sql = "SELECT p.*, c.quantite FROM produits p INNER JOIN panier c ON p.id = c.produit_id WHERE c.users_id = $userId";
        $result = mysqli_query($conn, $sql);

        // Vérifier si des produits ont été trouvés
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Récupérer les données du produit
                $id_produit = $row['id'];
                $prix = $row['prix'];
                $prix2 = $row['prix2']; // Nouvelle colonne pour le deuxième prix
                $quantity = $row['quantite']; // Récupérer la quantité du produit dans le panier

                // Déterminer le prix à afficher en fonction de la quantité
                $displayedPrice = ($quantity > 100) ? $prix2 : $prix;

                // Calculer le prix total pour ce produit
                $total += $displayedPrice * $quantity;
            }
        }

        // Fermer la connexion à la base de données
        mysqli_close($conn);

        return $total;
    }

    return 0;
}

// Fonction pour calculer le total du panier (sous-total + frais de livraison, etc.)
function calculateTotal()
{
    $subTotal = calculateSubTotal();
    // Calculer le total en ajoutant les frais de livraison, taxes, etc. si nécessaire
    $total = $subTotal;

    return $total;
}
?>

<div class="cart_totals">
    <h4>Cart Totals</h4>
    <div class="cart_totals_table">
        <table>
            <tbody>
                <tr class="cart-subtotal">
                    <th>Sous-total</th>
                    <td><span class="amount"><?php echo calculateSubTotal(); ?></span></td>
                </tr>
                <tr class="shipping">
                    <th colspan="2">
                        <span>Livraison</span>
                        <div class="form-group"><input type="checkbox" /><label>Livraison gratuite</label></div>
                       
                      
                    </th>
                </tr>
               
            </tbody>
        </table>
    </div>
</div>
<div class="wc-proceed-to-checkout">
    <a title="Proceed To CheckOut" class="btn" href="checkout.php">Procedez au paiement</a>
</div>

					</div>
				</div>
			</div><!-- container -->
			<div class="section-padding"></div>
		</div><!-- Cart /- -->
	</main>
	
	<!-- Footer Main -->
	<footer class="footer-main container-fluid no-padding">
		<div class="container">
			<div class="row">
				<div class="footer-header">
				<a href="index.php?user_id=<?php echo $_GET['id']; ?>"><img src="images/white-logo.png" alt="logo" height="150" width="220"/><span></span></a>
				</div>
				<div class="footer-social">
					<ul>
						<li><a href="#" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" title="Google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li><a href="#" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<!-- Widget About -->
				<aside class="col-md-4 col-sm-6 col-xs-6 ftr-widget about-widget">
					<h3>About The Store</h3>
					<p>Songs that made the hit parade. Guys like us Those were the days. Wouldn't you it made. Those were the days. Wouldn't you like to get.</p>
					<p><i aria-hidden="true" class="fa fa-phone"></i>Call Us 08 523 456 78</p>
					<p><i aria-hidden="true" class="fa fa-envelope-o"></i><a title="Info@ourdomain.Com" href="mailto:Info@ourdomain.Com">Info@ourdomain.Com</a></p>
					<p><i aria-hidden="true" class="fa fa-map-marker"></i>59 Downtown St, Melbourne, Australia.</p>
				</aside><!-- Widget About /- -->
				<!-- Widget Links -->
				<aside class="col-md-2 col-sm-6 col-xs-6 ftr-widget link-widget">
					<h3>Useful links</h3>
					<ul>
						<li><a href="#" title="Abou Us">About Us</a></li>
						<li><a href="#" title="Our Products">Our Products</a></li>
						<li><a href="#" title="Customer Support">Customer Support</a></li>
						<li><a href="#" title="Our Sitemap">Our Sitemap</a></li>
						<li><a href="#" title="Contact Us">Contact Us</a></li>
					</ul>
				</aside><!-- Widget Links /- -->
				<!-- Widget Contact -->
				<aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget contact-widget">
					<h3>Contact Us</h3>
					<ul>
						<li><a href="#" title="Product Recall">Product Recall</a></li>
						<li><a href="#" title="Gift Vouchers">Gift Vouchers</a></li>
						<li><a href="#" title="Returns & Exchange">Returns & Exchange</a></li>
						<li><a href="#" title="Shipping Options">Shipping Options</a></li>
						<li><a href="#" title="Help & FAQs">Help & FAQs</a></li>
					</ul>
				</aside><!-- Widget Contact /- -->
				<!-- Widget Isnstagram -->
				<aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget instagram-widget">
					<h3>Contact Us</h3>
					<ul>
						<li><a href="#" title=""><img src="images/insta-1.jpg" alt="Insta1" width="83" height="83" /></a></li>
						<li><a href="#" title=""><img src="images/insta-2.jpg" alt="Insta1" width="83" height="83" /></a></li>
						<li><a href="#" title=""><img src="images/insta-3.jpg" alt="Insta1" width="83" height="83" /></a></li>
						<li><a href="#" title=""><img src="images/insta-4.jpg" alt="Insta1" width="83" height="83" /></a></li>
						<li><a href="#" title=""><img src="images/insta-5.jpg" alt="Insta1" width="83" height="83" /></a></li>
						<li><a href="#" title=""><img src="images/insta-6.jpg" alt="Insta1" width="83" height="83" /></a></li>
					</ul>
				</aside><!-- Widget Newsletter /- -->
			</div>
		</div>
	</footer><!-- Footer Main /- -->
	
	<!-- Bottom Footer -->
	<div class="bottom-footer container-fluid no-padding">
		<div class="container">
			<div class="footer-content">
				<div class="footer-copyright">
					<p>&copy; 2016 All Rights Reserved</p>
				</div>
				<div class="footer-breadcrumb pull-right">
					<ol class="breadcrumb">
						<li title="Home" class="active">Home</li>					
						<li><a title="Services" href="index.php#ad-banner-1">Services</a></li>
						<li><a title="terms & condition" href="checkout.php">terms & condition</a></li>
						<li><a title="privacy policy" href="index-2.php#detail-section">privacy policy</a></li>
						<li><a title="Contact Us" href="contact-us.php">Contact Us</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div><!-- Bottom Footer /- -->
	
	
	
	<!-- JQuery v1.11.3 -->
	<script src="js/jquery.min.js"></script>

	<!-- Library - Js -->
	<script src="libraries/lib.js"></script>
	<!-- Bootstrap JS File v3.3.5 -->
	
	<script src="libraries/jquery.countdown.min.js"></script>
	
	<script src="libraries/lightslider-master/lightslider.js"></script>
	
	<script src="libraries/slick/slick.min.js"></script>

	<!-- Library - Google Map API -->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	
	<!-- Library - Theme JS -->
	<script src="js/functions.js"></script>
</body>
</php>