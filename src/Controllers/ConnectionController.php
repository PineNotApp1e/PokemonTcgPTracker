<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ConnectionController {
    
    // Méthode pour afficher la page web contenant le formulaire
    public function afficherFormulaire(Request $request, Response $response): Response {
        ob_start();
        require __DIR__ . '/../Views/formulaireUser.php';
        $response->getBody()->write(ob_get_clean());
        return $response;
    }

    // Méthode appelée lorsque le visiteur clique sur le bouton "Ajouter"
    public function traiterFormulaire(Request $request, Response $response): Response {
        // Slim permet de récupérer facilement toutes les données du formulaire (POST)
        $donnees = $request->getParsedBody(); 
        
        $username = $donnees['username'] ?? 'Inconnu';
        $password = $donnees['password'] ?? 'Inconnu';


        // C'est ici que vous utiliseriez un Modèle pour sauvegarder $nomPokemon dans la base de données
        
        $response->getBody()->write("User : " . htmlspecialchars($username) . "<br> Password : ". htmlspecialchars(password_hash($password, PASSWORD_DEFAULT)));
        return $response;
    }
}