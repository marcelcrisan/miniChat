<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
    if( !empty($_POST) ){
        
        if(isset($_POST['pseudo']) AND isset($_POST['message'])){
            $pseudo = $_POST['pseudo'] ;
            $pseudo = htmlspecialchars($pseudo) ;
            $message = $_POST['message'] ;
            $message = htmlspecialchars($message) ;
            $req = $bdd->prepare('INSERT INTO minichat(pseudo, message, date_message) VALUES(:pseudo, :message, NOW())');
            $req->execute(array(
                'pseudo' => $pseudo,
                'message' => $message,
                ));
            $_SESSION['pseudo'] = $pseudo;
            }

                    
    }
    header('Location: minichat.php');










?>