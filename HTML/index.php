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

	<title>Afrik Art - Accueil</title>

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
						<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="text-logo desktop-hide" href="index.php?user_id=<?php echo $_GET['id']; ?>"><span>Afrik</span>Art</a>
					</div>
					<div class="navbar-collapse collapse navbar-right" id="navbar">
						<ul class="nav navbar-nav menubar">
							<li><a title="Home" href="index.php?user_id=<?php echo $_GET['id']; ?>">ACCUEIL</a></li>
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="Home" href="shop.php?user_id=<?php echo $_GET['id']; ?>">BOUTIQUE</a>
								<i class="ddl-switch fa fa-angle-down"></i>
								<ul class="dropdown-menu">
									<li><a title="Shop 2" href="tableaux.php?user_id=<?php echo $_GET['id']; ?>">Tableaux</a></li>
									<li><a title="Shop 2" href="sculptures.php?user_id=<?php echo $_GET['id']; ?>">Sculptures</a></li>
									<li><a title="Shop 2" href="vases.php?user_id=<?php echo $_GET['id']; ?>">Vases</a></li>
									<li><a title="Shop 2" href="lampes.php?user_id=<?php echo $_GET['id']; ?>">Lampes</a></li>
									<li><a title="Shop 2" href="tables.php?user_id=<?php echo $_GET['id']; ?>">Tables</a></li>
								</ul>
							</li>
							<li><a title="Home" href="about.php?user_id=<?php echo $_GET['id']; ?>">A PROPOS DE NOUS</a></li>
							<li><a title="Contact Us" href="contact-us.php?user_id=<?php echo $_GET['id']; ?>">CONTACTEZ-NOUS</a></li>
						</ul>
					</div>

					</div>
				</nav><!-- Navigation /- -->
			</div><!-- Container /- -->
		</div><!-- Menu Block /- -->
	</header><!-- Header /- -->
	
	
	<main class="site-main page-spacing">
		<!-- Photo Slider -->
		<div class="photo-slider container-fluid no-padding">
			<!-- Main Carousel -->
			<div id="main-carousel" class="carousel slide carousel-fade" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#main-carousel" data-slide-to="1"></li>
					<li data-target="#main-carousel" data-slide-to="2"></li>
				</ol>
				<div role="listbox" class="carousel-inner">
					<div class="item active">
						<div class="carousel-caption">
							<h3 data-animation="animated fadeInLeft">Une nouvelle facon de decorer chez vous</h3>
							<p data-animation="animated fadeInRight"></p>
							<div class="col-md-12">
								<a href="shop.php?user_id=<?php echo $_GET['id']; ?>" data-animation="animated fadeInUp" title="Shop Now" class="shop-now">Achetez-maintenant</a>
							</div>
							<img data-animation="animated fadeInDown" src="images/design2.png" alt="slider" width="900" height="342" />
						</div>
					</div>
					<div class="item slide-1">
						<div class="carousel-caption">
							<h3 data-animation="animated fadeInLeft">Redécouvrez le bois autrement</h3>
							<p data-animation="animated fadeInRight"></p>
							<div class="col-md-12">
								<a href="shop.php?user_id=<?php echo $_GET['id']; ?>" data-animation="animated fadeInUp" title="Shop Now" class="shop-now">Achetez-maintenant</a>
							</div>
							<img data-animation="animated fadeInDown" src="images/design5.png" alt="slider" width="722" height="343" />
						</div>
					</div>
					<div class="item slide-2">
						<div class="carousel-caption">
							<h3 data-animation="animated fadeInLeft">Nous aimons enormément travailler avec le bois</h3>
							<p data-animation="animated fadeInRight"></p>
							<div class="col-md-12">
								<a href="shop.php?user_id=<?php echo $_GET['id']; ?>" data-animation="animated fadeInUp" title="Shop Now" class="shop-now">Achetez-maintenant</a>
							</div>
							<img data-animation="animated fadeInDown" src="images/design4.png" alt="slider" width="1056" height="345" />
						</div>
					</div>
				</div>
			</div><!-- Main Carousel /-  -->
		</div><!-- Photo Slider /- -->
		
		<!-- Ad Banner 1 -->
		<div id="ad-banner-1" class="ad-banner-1 container-fluid no-padding">
			<div class="section-padding"></div>
			<!-- Container -->
			<div class="container">
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="modern-box" id="tableaux">
						<div class="col-md-7 col-sm-6 col-xs-6">
							<img src="images/tableau-07_1.jpg" alt="ad-banner" style=" width: 216 px; height: 294px;"/>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-6">
							<h3 class="ad-heading">Nos tableaux</h3>
							<h5></h5>
						</div>
						<a href="tableaux.php?user_id=<?php echo $_GET['id']; ?>" class="shop-now" title="Shop Now">Achetez-maintenant<i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
					
					<div class="modern-box modern-ads" id="sculptures">
						<div class="col-md-5 col-sm-6 col-xs-6">
							<h3 class="ad-heading">Nos sculptures</h3>
							<h5></h5>
						</div>
						<div class="col-md-7 col-sm-6 col-xs-6">
							<img src="images/sculpture_07.png" alt="ad-banner" style=" width: 224 px; height: 290px;" />
						</div>
						<a href="sculptures.php?user_id=<?php echo $_GET['id']; ?>" class="shop-now" title="Shop Now">Achetez-maintenant<i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
				</div>
				
				<div class="col-md-7 col-sm-7 col-xs-12">
					<div class="modern-box modern-shop" id="vases">
						<div class="col-md-7 col-sm-6 col-xs-6">
							<img src="images/vase_04.png" alt="ad-banner"  style=" width: 394 px; height: 174px;"/>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-6">
							<h3 class="ad-heading">Nos vases</h3>
						</div>
						<a href="vases.php?user_id=<?php echo $_GET['id']; ?>" class="shop-now" title="Shop Now">Achetez-maintenant<i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
					
					<div class="modern-box modern-shop-1" id="lampes">
						<div class="col-md-5 col-sm-6 col-xs-6">
							<h3 class="ad-heading">Nos lampes</h3>
						</div>
						<div class="col-md-7 col-sm-6 col-xs-6">
							<img src="images/lampe_07.png" alt="ad-banner" style=" width: 414px; height: 250px;"/>
						</div>
						<a href="lampes.php?user_id=<?php echo $_GET['id']; ?>" class="shop-now" title="Shop Now">Achetez-maintenant<i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-12" id="tables">
					<div class="modern-box modern-shop">
						<div class="col-md-7 col-sm-6 col-xs-6">
							<img src="images/table_03.png" alt="ad-banner"  style=" width: 394 px; height: 174px;"/>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-6">
							<h3 class="ad-heading">Nos tables</h3>
						</div>
						<a href="tables.php?user_id=<?php echo $_GET['id']; ?>" class="shop-now" title="Shop Now">Achetez-maintenant<i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
					
					
				</div>
			</div><!-- Container /- -->
		</div><!-- Ad Banner 1 -->
		
		
		
		<!-- Saleup Section -->
		<div id="saleup-section" class="saleup-section container-fluid no-padding">
			<div class="col-md-6 col-sm-12 col-xs-12 saleup-info no-padding">
				<ul id="imageGallery">
					<li data-thumb="images/table_03.png">
						<h3>Economisez jusqu'à 50%</h3>
						<img src="images/table_03.png" alt="large-thumb" width="485" height="181" />
						<span>NOTRE TABLE CARREE</span>
						<p>Un style unique</p>
						<h5>$120.00</h5><del>$240.00</del>
					</li>
					<li data-thumb="images/table_03-01.png">
						<h3>Economisez jusqu'à 50%</h3>
						<img src="images/table_03-01.png" alt="large-thumb" width="485" height="181" />
						<span>NOTRE TABLE CARREE</span>
						<p>Un style unique</p>
						<h5>$120.00</h5><del>$240.00</del>
					</li>
					
					<li data-thumb="images/table_03-02.png">
						<h3>Economisez jusqu'à 50%</h3>
						<img src="images/table_03-02.png" alt="large-thumb" width="485" height="181" />
						<span>NOTRE TABLE CARREE</span>
						<p>Un style unique</p>
						<h5>$120.00</h5><del>$240.00</del>
					</li>
					

					
					
				</ul>
			</div>
			
			<div class="col-md-6 col-sm-12 co-xs-12 saleup-img no-padding">
				<!--img src="images/banner.jpeg"  width="893" height="1200.27" alt="saleup-bg"-->
				<h3>Les bonnes affaires</h3>
				<p></p>
				<div></div>
				<a href="shop.php?user_id=<?php echo $_GET['id']; ?>" title="shop Now">Achetez-maintenant<i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
		</div><!-- Saleup Section /- -->
	
		<!-- Subscribe Section -->
		<div class="subscribe-section container-fluid no-padding">
			<div class="container">
				<div class="subscribe-content">
					<h5>Notre derniere collection</h5>
					<h3></h3>
					<p>Soyez les premiers à connaitre les nouveautés</p>
					<div class=" col-md-6 col-sm-8 col-xs-10 input-group">
						<input type="text" placeholder="Votre adresse e-mail" class="form-control">
						<span class="input-group-btn">
							<button type="button" title="Sign Up" class="btn btn-default">Enregistrez vous</button>
						</span>
					</div><!-- /input-group -->
				</div>
			</div>
		</div><!-- Subscribe Section /- -->
		
		
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
					<h3>A propos de notre boutique</h3>
					<p></p>
					<p><i aria-hidden="true" class="fa fa-phone"></i>Call Us 08 523 456 78</p>
					<p><i aria-hidden="true" class="fa fa-envelope-o"></i><a title="Info@ourdomain.Com" href="mailto:Info@ourdomain.Com">Info@ourdomain.Com</a></p>
					<p><i aria-hidden="true" class="fa fa-map-marker"></i>59 Downtown St, Melbourne, Australia.</p>
				</aside><!-- Widget About /- -->
				<!-- Widget Links -->
				<aside class="col-md-2 col-sm-6 col-xs-6 ftr-widget link-widget">
					<h3>Liens utiles</h3>
					<ul>
						<li><a href="about.php?user_id=<?php echo $_GET['id']; ?>" title="Abou Us">A PROPOS DE NOUS</a></li>
						<li><a href="shop.php?user_id=<?php echo $_GET['id']; ?>" title="Nos produits">NOS PRODUITS</a></li>
						<li><a href="contact-us.php?user_id=<?php echo $_GET['id']; ?>" title="Contact Us">Contact Us</a></li>
					</ul>
				</aside><!-- Widget Links /- -->
				<!-- Widget Contact -->
				<aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget contact-widget">
					<h3>CONTACTEZ-NOUS</h3>
					<ul>
						<li><a href="#" title="Help & FAQs">Aide et FAQs</a></li>
					</ul>
				</aside><!-- Widget Contact /- -->
				<!-- Widget Isnstagram -->
				<aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget instagram-widget">
					<h3>Nos reseaux sociaux</h3>
					<ul>
						<li><a href="#" title=""><img src="images/insta-1.jpg" alt="Insta1" width="83" height="83" /></a></li>
						<li><a href="#" title=""><img src="images/insta-2.jpg" alt="Insta1" width="83" height="83" /></a></li>
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
						<li><a title="Services" href="#ad-banner-1">Services</a></li>
						<li><a title="terms & condition" href="checkout.php">terms & condition</a></li>
						<li><a title="privacy policy" href="index-2.php#detail-section">privacy policy</a></li>
						<li><a title="Contact Us" href="contact-us.php">Contactez-nous</a></li>
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