<?php
session_start();

// Vérifier si l'ID du produit à supprimer est présent
if (isset($_POST['remove_product_id'])) {
    // Supprimer le produit du panier
    $removeProductId = $_POST['remove_product_id'];

    // Supprimer le produit du panier en utilisant l'ID de produit et l'ID de l'utilisateur connecté
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Connexion à la base de données
        $conn = mysqli_connect("localhost", "root", "root", "ARTSHOP");

        // Vérifier la connexion
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Supprimer le produit du panier
        $sql = "DELETE FROM panier WHERE users_id = $userId AND produit_id = $removeProductId";
        if (mysqli_query($conn, $sql)) {
            echo "Le produit a été supprimé du panier.";
        } else {
            echo "Une erreur est survenue lors de la suppression du produit du panier : " . mysqli_error($conn);
        }

        // Fermer la connexion à la base de données
        mysqli_close($conn);
    }
}

// Rediriger vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
