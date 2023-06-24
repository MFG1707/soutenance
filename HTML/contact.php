<?php
/**
 * EDIT THE VALUES BELOW THIS LINE TO ADJUST THE CONFIGURATION
 * EACH OPTION HAS A COMMENT ABOVE IT WITH A DESCRIPTION
 */
/**
 * Specify the email address to which all mail messages are sent.
 * The script will try to use PHP's mail() function,
 * so if it is not properly configured it will fail silently (no error).
 */
$mailTo     = 'ahoundje29@gmail.com';

/**
 * Set the message that will be shown on success
 */
$successMsg = 'Thank you, mail sent successfully!';

/**
 * Set the message that will be shown if not all fields are filled
 */
$fillMsg    = 'Please fill all fields!';

/**
 * Set the message that will be shown on error
 */
$errorMsg   = 'Hm.. seems there is a problem, sorry!';

/**
 * DO NOT EDIT ANYTHING BELOW THIS LINE, UNLESS YOU'RE SURE WHAT YOU'RE DOING
 */

if (
    !isset($_POST['contact-name']) || 
    !isset($_POST['contact-email']) ||
    !isset($_POST['contact-subject']) ||
    !isset($_POST['contact-message']) ||
    empty($_POST['contact-name']) ||
    empty($_POST['contact-email']) ||
    empty($_POST['contact-subject']) ||
    empty($_POST['contact-message']) 
) {
    if (empty($_POST['contact-name']) && empty($_POST['contact-email']) && empty($_POST['contact-phone']) && empty($_POST['contact-message'])) {
        $json_arr = array( "type" => "error", "msg" => $fillMsg );
        echo json_encode($json_arr);		
    } else {
        $fields = "";
        if (!isset($_POST['contact-name']) || empty($_POST['contact-name'])) {
            $fields .= "Name";
        }

        if (!isset($_POST['contact-email']) || empty($_POST['contact-email'])) {
            if ($fields == "") {
                $fields .= "Email";
            } else {
                $fields .= ", Email";
            }
        }

        if (!isset($_POST['contact-subject']) || empty($_POST['contact-subject'])) {
            if ($fields == "") {
                $fields .= "Subject";
            } else {
                $fields .= ", Subject";
            }
        }

        if (!isset($_POST['contact-message']) || empty($_POST['contact-message'])) {
            if ($fields == "") {
                $fields .= "Message";
            } else {
                $fields .= ", Message";
            }		
        }

        $json_arr = array( "type" => "error", "msg" => "Please fill ".$fields." fields!" );
        echo json_encode($json_arr);
    }
} else {
    // Validate e-mail
    if (!filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL) === false) {
        $name = $_POST['contact-name'];
        $email = $_POST['contact-email'];
        $subject = $_POST['contact-subject'];
        $message = $_POST['contact-message'];

        // Connexion à la base de données
        $conn = mysqli_connect("localhost", "root", "root", "ARTSHOP");

        // Vérifier la connexion
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Préparer la requête d'insertion
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        // Exécuter la requête d'insertion
        if (mysqli_query($conn, $sql)) {
            // Envoi de l'e-mail
            $msg = "Name: ".$name."\r\n";
            $msg .= "Email: ".$email."\r\n";
            $msg .= "Subject: ".$subject."\r\n";
            $msg .= "Message: ".$message."\r\n";

            $success = @mail($mailTo, $email, $msg, 'From: ' . $name . '<' . $email . '>');
            
            if ($success) {
                $json_arr = array( "type" => "success", "msg" => $successMsg );
                echo json_encode($json_arr);
            } else {
                $json_arr = array( "type" => "error", "msg" => $errorMsg );
                echo json_encode($json_arr);
            }

            mysqli_close($conn);
        } else {
            $json_arr = array( "type" => "error", "msg" => "An error occurred while sending the message: " . mysqli_error($conn) );
            echo json_encode($json_arr);
            mysqli_close($conn);
        }
    } else {
        $json_arr = array( "type" => "error", "msg" => "Please enter a valid email address!" );
        echo json_encode($json_arr);	
    }
}
?>
