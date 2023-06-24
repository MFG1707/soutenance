<?php
session_start();

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ARTSHOP";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connexion à la base de données impossible : " . mysqli_connect_error());
}

// Process form submission
if (isset($_POST['send'])) {

    // Get form data
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_confirm = htmlspecialchars($_POST['password_confirm']);

    // Vérification si les mots de passe correspondent
    if ($password !== $password_confirm) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: registration.php");
        exit();
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Préparation de la requête SQL
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashed_password);

    // Exécution de la requête
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Inscription réussie. Vous pouvez vous connecter maintenant.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de l'inscription : " . mysqli_stmt_error($stmt);
        header("Location: registration.php");
        exit();
    }

    // Fermeture de la requête
    mysqli_stmt_close($stmt);
}

// Fermeture de la connexion MySQL
mysqli_close($conn);
?>
