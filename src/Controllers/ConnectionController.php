<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use App\Services\Database;

class ConnectionController
{

    // Méthode pour afficher la page web contenant le formulaire
    public function afficherFormulaire(Request $request, Response $response): Response
    {
        ob_start();
        require __DIR__ . '/../Views/formulaireUser.php';
        $response->getBody()->write(ob_get_clean());
        return $response;
    }
    public function ConnectionFormulaire(Request $request, Response $response): Response
    {
        ob_start();
        require __DIR__ . '/../Views/formulaireConnection.php';
        $response->getBody()->write(ob_get_clean());
        return $response;
    }

    public function traiterFormulaire(Request $request, Response $response): Response
    {

        $donnees = $request->getParsedBody();

        $username = $donnees['username'] ?? 'Inconnu';
        $email = $donnees['email'] ?? 'Inconnu';

        $password = password_hash($donnees['password'], PASSWORD_DEFAULT) ?? 'Inconnu';
        $user_friend_id = $donnees['ami'] ?? 'Inconnu';
        $user_level = 11;

        User::UserCreate($username, $email, $password, $user_friend_id, $user_level);

        $response->getBody()->write("User : " . htmlspecialchars($username) . "<br> Password : " . password_hash($password, PASSWORD_DEFAULT));
        return $response;
    }
    public function Connection(Request $request, Response $response): Response
    {

        $donnees = $request->getParsedBody();

        $email = $donnees['email'] ?? 'Inconnu';

        $password = $donnees['password'] ?? 'Inconnu';


        if (User::Connection($email, $password)) {
            $response->getBody()->write(User::find($email)[0]['username']." ".User::find($email)[0]['email']);
        } else {
            $response->getBody()->write("no account");
        }

        // $response->getBody()->write("User : " . htmlspecialchars($username) . "<br> Password : ". password_hash($password, PASSWORD_DEFAULT));
        return $response;
    }
}