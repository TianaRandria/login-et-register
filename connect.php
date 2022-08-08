<?php
$servername = 'localhost';
$dbname = 'defiphp';
$dbuser = 'root';
$dbpassword = '';

if(isset($_POST)) {   
    if($_POST['action'] === 'register') { // Si c'est register
        register();
    } else if($_POST['action'] === 'login') { // Si c'est login
        login();
    }
} else {
    echo 'rien de rien';
}

function register() {
    // récuperer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $motdepasse = password_hash($password, PASSWORD_BCRYPT);

    // connexion à la base de données
    try{
        $connexion = new PDO(
            'mysql:host=localhost;dbname=defiphp;',
            'root',
            ''
        );
        // requete d'insertion des données
        $requete = 'INSERT INTO user(login_user, password_user) VALUES(:username, :motdepasse)';
        // Préparation
        $enregistrer = $connexion->prepare($requete);
        // Exécution de la requete
        $enregistrer->execute([
            'username' => $username,
            'motdepasse' => $motdepasse
        ]);

        // on rédirige vers la page de connexion

       ////// Ressource === https://www.php.net/manual/fr/function.header//////
       header("Location: /login.php", TRUE, 301);
    }catch(PDOException $e){
        // si erreur de connexion à la base
        die("Erreur :". $e->getMessage());
    }
}

function login() {
    // récuperer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    try{
        $connexion = new PDO(
            'mysql:host=localhost;dbname=defiphp;',
            'root',
            ''
        );
        // requete pour la récuperation de l'utilisateur
        $requete = 'SELECT * FROM user WHERE login_user = :username';
        // Préparation
        $recuperer = $connexion->prepare($requete);
        // Exécution de la requete
        $recuperer->execute([
            'username' => $username
        ]);
        // Récupération du résultat
        $resultat = $recuperer->fetchAll(PDO::FETCH_ASSOC);
        // On prend la première ligne
        $utilisateur = $resultat[0];

        // On vérifie si le mot de passe saisie correspond à celui hashé sur la base de données
        if(password_verify($password, $utilisateur['password_user'])) {
            echo 'Valid username and password';
        } else {
            echo 'Invalid username or password';
        }
        ;
    }catch(PDOException $e){
        // si erreur de connexion à la base
        die("Erreur :". $e->getMessage());
    }
} 
