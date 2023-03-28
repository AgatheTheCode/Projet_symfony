<?php
include_once('function.php');
global $db;
//fonction de creation de compte
function creationDeCompte()
{
    // Define variables and initialize with empty values
    $username = $password = $confirm_password = "test";
    $username_err = $password_err = $confirm_password_err = "test";

// Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate username
        if (empty(trim($_POST["pseudo_client"]))) {
            $username_err = "Entrez un pseudo.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["pseudo_client"]))) {
            $username_err = "Un nom d'utilisateur ne peut-être composer que de lettres, chiffres et underscores";
        } else {
            // Prepare a select statement
            $sql = "SELECT id_client FROM client WHERE pseudo_client = :pseudo_client";

            if ($stmt = $db->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":pseudo_client", $param_username, PDO::PARAM_STR);

                // Set parameters
                $param_username = trim($_POST["pseudo_client"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        $username_err = "Ce pseudo est déjà utilisé.";
                    } else {
                        $username = trim($_POST["pseudo_client"]);
                    }
                } else {
                    echo "Oops! Promis c'est pas de ma faute !.";
                }

                // Close statement
                unset($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["mdp_client"]))) {
            $password_err = "Entrez votre mot de passe.";
        } elseif (strlen(trim($_POST["mdp_client"])) < 6) {
            $password_err = "Le mot de passe doit faire 6 charactères.";
        } else {
            $password = trim($_POST["mdp_client"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_mdp_client"]))) {
            $confirm_password_err = "Veuillez confirmer votre mot de passe.";
        } else {
            $confirm_password = trim($_POST["confirm_mdp_client"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Les mots de passes ne correspondent pas.";
            }

            // Check input errors before inserting in database
            if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

                // Prepare an insert statement
                $sql = "INSERT INTO client (pseudo_client, mdp_client) VALUES (:pseudo_client, :mdp_client)";

                if ($stmt = $pdo->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":pseudo_client", $param_username, PDO::PARAM_STR);
                    $stmt->bindParam(":mdp_client", $param_password, PDO::PARAM_STR);

                    // Set parameters
                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    //password_hash hash et "sale" le mot de passe ce qui permet d'avoir des résultats de hash différent même si deux
                    //clients ont le même mdp

                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // Redirect to login page
                        //header("location: login.php");
                        echo "done";
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    unset($stmt);
                }
            }

            // Close connection
            unset($pdo);
        }
    }
}

function login_client()
{
    // Initialize the session
    session_start();

// Verification que le client n'est pas déja logged in
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: welcome.php");
        exit;
    }

// Include config file
    require_once('include/config.php');
    $pdo = connexion();

// initialisation des variable vides
    $username = $password = "";
    $username_err = $password_err = $login_err = "";


// Process des donneés du form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // pseudo vide?
        if (empty(trim($_POST["pseudo_client"]))) {
            $username_err = "Entrez votre pseudo.";
        } else {
            $username = trim($_POST["pseudo_client"]);
        }

        // mdp vide?
        if (empty(trim($_POST["mdp"]))) {
            $password_err = "Entrez votre mot de passe.";
        } else {
            $password = trim($_POST["mdp"]);
        }

        // VERIFICATION DES INFOS FORMULAIRES
        if (empty($username_err) && empty($password_err)) {
            // Requête
            $sql = "SELECT id_client, pseudo_client, mdp_client FROM client WHERE pseudo_client = :pseudo_client";

            if ($stmt = $pdo->prepare($sql)) {
                // Liaison des variables
                $stmt->bindParam(":pseudo_client", $param_username, PDO::PARAM_STR);

                // Set parameters
                $param_username = trim($_POST["pseudo_client"]);

                // execution de $stmt (statement  = déclaration en français)
                if ($stmt->execute()) {
                    // Verifie client, si oui verify mdp
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $id = $row["id_client"];
                            $username = $row["pseudo_client"];
                            $hashed_password = $row["mdp_client"];
                            if (password_verify($password, $hashed_password)) {
                                // mdp correct
                                session_start();

                                // stock des donneées dans les varaibles
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id_client"] = $id;
                                $_SESSION["pseudo_client"] = $username;

                                // Redirection de l'utilisateur si connexion OK
                                header("location: index.php");
                            } else {
                                // mot de passe n'est pas valide
                                $password_err = "Invalid username or password.";
                            }
                        }
                    } else {
                        // Nom d'utilisateur n'existe pas
                        $password_err = "Invalid username or password.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
            }
        }

        // Close connection
        unset($pdo);
    }
}
