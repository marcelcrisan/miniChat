<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
require_once 'header.php';

echo ' <form action="minichat_post.php" method="post">
            <fieldset>
                <legend>Votre message :</legend>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" value="' . $_SESSION['pseudo'] .' ">
                <label for="message">Message :</label>
                <input type="text" name="message" id="message">
                <input type="submit" value="Valider">
            </fieldset>
        </form>
        <h2>Derniers messages postés :</h2>
        <main>';
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


 $chat = $bdd->query('SELECT ID, pseudo, message, DATE_FORMAT(date_message, "%d/%m/%Y") AS date_year, DATE_FORMAT(date_message, "%Hh%imin%ss") AS date_hour FROM minichat ORDER BY ID DESC');
                            
while ($donnees = $chat->fetch()){

    
    echo '<p><em>[ le ' . $donnees['date_year'] . ' à ' . $donnees['date_hour'] . ' ]</em> <span>' . $donnees['pseudo'] . ' :</span> ' . $donnees['message'] . ' </p>';

                           
                        
         }
$chat->closeCursor();

    echo '</main>';
   
   

require_once 'footer.php';

?>