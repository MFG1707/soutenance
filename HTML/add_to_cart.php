<?php

$id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

session_start();

// Vérifier si des choix ont été ajoutés au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
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

        // Connexion à la base de données
        $conn = mysqli_connect("localhost", "root", "root", "ARTSHOP");

        // Vérifier la connexion
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Récupérer l'ID de l'utilisateur depuis la session
        $userId = $_SESSION['user_id'];

        // Vérifier si le produit existe déjà dans la table "panier" pour l'utilisateur
        $sql = "SELECT * FROM panier WHERE users_id = '$userId' AND produit_id = '$productId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Mettre à jour la quantité du produit dans le panier
            $updateSql = "UPDATE panier SET quantite = quantite + $quantity WHERE users_id = '$userId' AND produit_id = '$productId'";
            if (mysqli_query($conn, $updateSql)) {
                echo "La quantité du produit a été mise à jour dans le panier.";
            } else {
                echo "Une erreur est survenue lors de la mise à jour de la quantité du produit dans le panier : " . mysqli_error($conn);
            }
        } else {
            // Insérer le produit dans la table "panier"
            $insertSql = "INSERT INTO panier (users_id, produit_id, quantite) VALUES ('$userId', '$productId', '$quantity')";
            if (mysqli_query($conn, $insertSql)) {
                echo "Le produit a été ajouté au panier.";
            } else {
                echo "Une erreur est survenue lors de l'ajout du produit au panier : " . mysqli_error($conn);
            }
        }

        // Fermer la connexion à la base de données
        mysqli_close($conn);

        // Actualiser la page actuelle
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        // Rediriger vers la page de connexion
        header("Location: login.php");
        exit;
    }
}
?>
