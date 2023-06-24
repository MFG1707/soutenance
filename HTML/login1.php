<?php
// Récupérer les données envoyées depuis le formulaire de connexion
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Se connecter à la base de données
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password_db = "root"; // Remplacez par votre mot de passe MySQL
    $dbname = "ARTSHOP";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué: " . $conn->connect_error);
    }

    // Échapper les variables pour éviter les injections SQL
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Requête pour récupérer l'utilisateur correspondant à l'email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Utilisateur trouvé, vérifier le mot de passe
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Mot de passe correct, rediriger vers la page correspondante avec l'ID retenu en mémoire
            $userType = $row['type'];
            $userId = $row['id'];

            if ($userType === 'admin') {
                // Utilisateur admin, redirection vers la page d'administration
                header("Location: admin/template/index.html?id=$userId");
                exit();
            } else {
                // Utilisateur non admin, redirection vers la page par défaut
                header("Location: index.php?id=$userId");
                exit();
            }
        }
    }

    // Utilisateur non trouvé ou mot de passe incorrect, redirection vers la page de connexion
    header("Location: login.php");
    exit();

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Les données du formulaire n'ont pas été soumises, redirection vers la page de connexion
    header("Location: login.php");
    exit();
}
?>
