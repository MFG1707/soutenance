
<!DOCTYPE php>
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

	<title>Afrik Art - Paiement</title>

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
							<label>Currency :</label>
							<button class="btn dropdown-toggle" type="button" id="currency" title="currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">USD<span class="caret"></span></button>
							<ul class="dropdown-menu no-padding">
								<li><a href="#" title="Usd">Usd</a></li>
								<li><a href="#" title="Ora">Ora</a></li>
								<li><a href="#" title="Riyal">Riyal</a></li>
							</ul>
						</div>
						<div class="language-dropdown dropdown">
							<button class="btn dropdown-toggle" type="button" id="Username" title="Username" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">My Account<span class="caret"></span></button>
							<ul class="dropdown-menu no-padding">
								<li><a href="#" title="sarah1">sarah1</a></li>
								<li><a href="#" title="sarah2">sarah2</a></li>
								<li><a href="#" title="sarah3">sarah2</a></li>
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
								<a href="index.php"><img src="images/logo-1.png" alt="logo" height="38" width="56"/>Furn<span>Home</span></a>
							</div>
						</div>
						<div class="header-info">
							<div class="col-md-5 col-sm-6 col-xs-6">
								<div class="input-group">
									<div class="input-group-btn">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category<span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li><a href="#">Action</a></li>
											<li><a href="#">Another action</a></li>
											<li><a href="#">Something else here</a></li>
										</ul>
									</div><!-- /btn-group -->
									<input type="text" placeholder="Search..." class="form-control">
									<span class="input-group-btn">
										<button type="button" title="Search" class="btn btn-search"><i class="fa fa-search"></i></button>
									</span>
								</div><!-- /input-group -->
							</div>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2 add-to-cart">
						<?php
							session_start();

							// Vérifier si des choix ont été ajoutés au panier
							if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
								// Récupérer l'ID du produit
								$productId = $_POST['product_id'];
								$quantity = 1; // Par défaut, on ajoute un seul produit au panier

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
							}

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
								$sql = "SELECT produits.id, produits.nom, produits.prix, produits.image, produits.description, panier.quantite
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
								$html .= '<h5>(' . mysqli_num_rows($result) . ') Articles - <span>$' . $totalPrice . '</span></h5>';
								$html .= '</a>';
								$html .= '<ul class="dropdown-menu no-padding">';

								// Vérifier si des produits ont été trouvés
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										// Récupérer les données du produit
										$id_produit = $row['id'];
										$nom = $row['nom'];
										$prix = $row['prix'];
										$image = $row['image']; // Colonne contenant le nom de l'image dans la base de données
										$description = $row['description']; // Colonne contenant la description du produit
										$quantity = $row['quantite']; // Récupérer la quantité du produit dans le panier

										// Calculer le total du prix pour le produit actuel
										$subtotal = $prix * $quantity;

										// Ajouter les informations du produit au HTML
										$html .= '<li class="mini_cart_item">';
										$html .= '<a title="Remove this item" class="remove" href="#">&#215;</a>';
										$html .= '<a href="#" class="shop-thumbnail">';
										$html .= '<img width="60" height="60" alt="' . $nom . '" class="attachment-shop_thumbnail" src="images/' . $image . '" />' . $nom;
										$html .= '</a>';
										$html .= '<span class="quantity">' . $quantity . ' &#215; <span class="amount">$' . $prix . '</span></span>';
										$html .= '</li>';

										// Mettre à jour le nombre total d'articles et le total des prix
										$totalItems += $quantity;
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
								echo '<a href="cart.php?user_id=' . $userId . '" title="Voir panier">Voir panier</a>';
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
						<a class="text-logo desktop-hide" href="index.php"><span>Furn</span>Home</a>
					</div>
					<div class="navbar-collapse collapse navbar-right" id="navbar">
						<ul class="nav navbar-nav menubar">
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="Home" href="shop-1.php">Home</a>
								<i class="ddl-switch fa fa-angle-down"></i>
								<ul class="dropdown-menu">
									<li><a title="Home 2" href="index-2.php">Home 2</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="Home" href="shop-2.php">Living Room</a>
								<i class="ddl-switch fa fa-angle-down"></i>
								<ul class="dropdown-menu">
									<li><a title="Shop 1" href="shop-1.php">Shop 1</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="Home" href="index.php">Bed Room</a>
								<i class="ddl-switch fa fa-angle-down"></i>
								<ul class="dropdown-menu">
									<li><a title="Shop 2" href="shop-2.php">Shop 2</a></li>
								</ul>
							</li>
							<li><a title="Sofas" href="index.php#saleup-section">Sofas</a></li>
							<li><a title="Latest Product" href="index.php#latest-product">Latest Product</a></li>
							<li class="dropdown active">
								<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="best seller" href="shop.php">best seller</a>
								<i class="ddl-switch fa fa-angle-down"></i>
								<ul class="dropdown-menu">
									<li><a title="product-detail" href="product-detail.php">product Detail</a></li>
									<li><a title="Cart" href="cart.php">Cart</a></li>
									<li><a title="Checkout" href="checkout.php">Checkout</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="Latest News" href="#latest-blog">Latest News</a>
								<i class="ddl-switch fa fa-angle-down"></i>
								<ul class="dropdown-menu">
									<li><a title="Blog" href="blog.php">Blog</a></li>
									<li><a title="Blog Post" href="blog-post.php">Blog Post</a></li>
								</ul>
							</li>
							<li><a title="Contact Us" href="contact-us.php">Contact Us</a></li>
						</ul>
					</div>
				</nav><!-- Navigation /- -->
			</div><!-- Container /- -->
		</div><!-- Menu Block /- -->
	</header><!-- Header /- -->
	
	<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="page-banner checkout-banner container-fluid no-padding">
			<div class="page-banner-content">
				<h3>Checkout</h3>
			</div>
		</div><!-- Page Banner /- -->
		
		<!-- Checkout -->
		<div class="woocommerce-checkout">
			<div class="section-padding"></div>
			<div class="container">
				<div class="woocommerce row">
					<div class="woocommerce-info">
						<p>Returning Customer ?</p>
						<a class="showlogin" href="#">Click here to login</a>
					</div>
					<div class="woocommerce-info">
						<p>Have a Coupon ?</p>
						<a class="showcoupon" href="#">Click here to enter your code</a>
					</div>
					<form class="checkout woocommerce-checkout row" method="post" name="checkout">
						<div class="col-md-6 col-sm-6 col-xs-12 woocommerce-billing-fields">
							<h4>Billing Details</h4>
							<div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
								<input type="text" class="form-control" placeholder="First Name" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 no-right-padding">
								<input type="text" class="form-control" placeholder="Last Name" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
								<input type="text" class="form-control" placeholder="Email" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 no-right-padding">
								<input type="text" class="form-control" placeholder="Phone" />
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<textarea class="form-control" placeholder="Address"></textarea>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<select>
									<option>Country</option>
									<option>USA</option>
									<option>UAE</option>
									<option>Australia</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 no-left-padding">
								<input type="text" class="form-control" placeholder="State" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 no-right-padding">
								<input type="text" class="form-control" placeholder="Zip" />
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<input type="checkbox" />
								<label>Create a account?</label>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 woocommerce-shipping-fields">
							<h4>Ship To a Different Address?</h4>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<textarea class="form-control" placeholder="Change Your Shipping Address Here . . ."></textarea>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<input type="checkbox" />
								<label>Click to change address?</label>
							</div>
						</div>
						<div class="cart-main col-md-12 col-sm-12 col-xs-12">
							<h4>Your Order Summary</h4>
							<table class="shop_table cart">
								<thead>
									<tr>
										<th class="product-name" colspan="2">Products</th>
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Total</th>
										<th class="product-remove">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr class="cart_item">
										<td data-title="Product" class="product-thumbnail">
											<a title="Product Thumbnail" href="">
												<img class="attachment-shop_thumbnail wp-post-image" src="images/cart-1.png" alt="cart" />
											</a>					
										</td>
										<td class="product-name">
											<a title="Product Name" href="#">Modern Chair</a>
											<h4>SKU<span>: 0522c</span></h4>
											<h4>Color<span>: Yellow</span></h4>
										</td>
										<td data-title="Price" class="product-price">
											<span class="amount">$50</span>
										</td>
										<td data-title="Quantity" class="product-quantity">
											<div class="quantity">
												<input type="button" value="-" class="qtyminus btn" data-field="quantity1" />
												<input type="text" name="quantity1" value="0" class="qty btn" />
												<input type="button" value="+" class="qtyplus btn" data-field="quantity1" />
											</div>
										</td>
										<td data-title="Total" class="product-subtotal">
											<span class="amount">$50</span>
										</td>
										<td class="product-remove">
											<a title="Remove this item" class="remove" href=""><img src="images/close.png" alt="close" /></a>
										</td>
									</tr>
									
									<tr class="cart_item">
										<td data-title="Product" class="product-thumbnail">
											<a title="Product Thumbnail" href="">
												<img class="attachment-shop_thumbnail wp-post-image" src="images/cart-2.png" alt="cart" />
											</a>					
										</td>
										<td class="product-name">
											<a title="Product Name" href="#">Modern Chair</a>
											<h4>SKU<span>: 14b55</span></h4>
											<h4>Color<span>: Black</span></h4>
										</td>
										<td data-title="Price" class="product-price">
											<span class="amount">$20</span>
										</td>
										<td data-title="Quantity" class="product-quantity">
											<div class="quantity">
												<input type="button" value="-" class="qtyminus btn" data-field="quantity2" />
												<input type="text" name="quantity2" value="0" class="qty btn" />
												<input type="button" value="+" class="qtyplus btn" data-field="quantity2" />
											</div>
										</td>
										<td data-title="Total" class="product-subtotal">
											<span class="amount">$20</span>
										</td>
										<td class="product-remove">
											<a title="Remove this item" class="remove" href=""><img src="images/close.png" alt="close" /></a>
										</td>
									</tr>
									
									<tr class="cart_item">
										<td data-title="Product" class="product-thumbnail">
											<a title="Product Thumbnail" href="">
												<img class="attachment-shop_thumbnail wp-post-image" src="images/cart-3.png" alt="cart" />
											</a>					
										</td>
										<td class="product-name">
											<a title="Product Name" href="#">Modern Chair</a>
											<h4>SKU<span>: Xdc10</span></h4>
											<h4>Color<span>: Red</span></h4>
										</td>
										<td data-title="Price" class="product-price">
											<span class="amount">$15</span>
										</td>
										<td data-title="Quantity" class="product-quantity">
											<div class="quantity">
												<input type="button" value="-" class="qtyminus btn" data-field="quantity3" />
												<input type="text" name="quantity3" value="0" class="qty btn" />
												<input type="button" value="+" class="qtyplus btn" data-field="quantity3" />
											</div>
										</td>
										<td data-title="Total" class="product-subtotal">
											<span class="amount">$15</span>
										</td>
										<td class="product-remove">
											<a title="Remove this item" class="remove" href=""><img src="images/close.png" alt="close" /></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="cart_totals">
								<h4>Shiping</h4>
								<div class="cart_totals_table">
									<table>
										<tbody>
											<tr class="shipping">
												<th colspan="2">
													<div class="form-group"><input type="checkbox"><label>Free Shipping</label></div>
													<div class="form-group"><input type="checkbox"><label>Local Delivery (Free)</label></div>
													<div class="form-group"><input type="checkbox" checked=""><label>Local Pickup (Free)</label></div>
												</th>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="totals">
									<h3>Total</h3>
									<h4>$85</h4>
								</div>							
							</div>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 woocommerce-checkout-payment">
							<h4>Payment Methods</h4>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<input type="checkbox" />
								<label>Direct Bank Transfer</label>
							</div>
							<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<input type="checkbox" />
								<label>Cheque Payment</label>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<input type="checkbox" />
								<label>Cash on Delivery</label>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
								<input type="checkbox" />
								<label>PayPal</label>
							</div>
						</div>
						
						<div class="place-order col-md-12 col-sm-12 col-xs-12">
							<input type="submit" value="place order" />
						</div>
					</form>

				</div>
			</div>
			<div class="section-padding"></div>
		</div><!-- Checkout /- -->
	</main>
	
	<!-- Footer Main -->
	<footer class="footer-main container-fluid no-padding">
		<div class="container">
			<div class="row">
				<div class="footer-header">
				<a href="index.php"><img src="images/white-logo.png" alt="logo" height="150" width="220"/><span></span></a>
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