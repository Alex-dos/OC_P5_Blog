<?php

namespace App\Manager;

use App\Model\User;
use App\Service\Database;

/**
 * LoginCompteManagaer regroupe tout les requêtes lié a l'identification, inscription de l'utilisateur et l'admin.
 */
class LoginAccountManager extends Database
{
    /**
     * retourne les informations de l'utilisateur ou l'admin.
     *
     * @param string $username
     *
     * @return mixed $user
     */
    public function getLogin($username)
    {
        $sql = 'SELECT * FROM users WHERE username = :username';
        $parameters = ['username' => $username];
        $result = $this->sql($sql, $parameters);

        $row = $result->fetch();

        if ($row) {
            return $this->buildObject($row);
        } else {
            $_SESSION['flash']['danger'] = 'Aucun Utilisateur existant avec cet identifiant';
            header('Location: /login');
        }
    }

    /**
     * Vérifie si le nom est déjà dans la base.
     */
    public function checkUsername()
    {
        if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
            $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide (alphanumérique)';

            return false;
        } else {
            $username = htmlspecialchars($_POST['username']);

            $sql = 'SELECT id FROM users WHERE username = :username';
            $parameters = ['username' => $username];
            $req = $this->sql($sql, $parameters);
            $user = $req->fetch();
            if ($user) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Vérifie si l'email est valide et si il est déjà dans la base.
     */
    public function checkEmail()
    {
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide.';

            return false;
        } else {
            $email = $_POST['email'];

            $sql = 'SELECT id FROM users WHERE email = ?';
            $parameters = [$email];
            $result = $this->sql($sql, $parameters);

            $user = $result->fetch();

            if ($user) {
                $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé pour un autre compte.';

                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Vérifie le mot de passe.
     */
    public function checkPassword()
    {
        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $_SESSION['flash']['danger'] = 'vous devez rentrer les mêmes mot de passe';

            return false;
        } elseif (empty($_POST['password']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password'])) {
            $_SESSION['flash']['danger'] = 'Votre password n\'est pas valide (alphanumérique)';

            return false;
        } else {
            return true;
        }
    }

    /**
     * inscrit l'utilisateur dans la base et lui envoie un mail de comfirmation.
     */
    public function registerUser()
    {
        $satuts = 2;
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users SET username = ?, password = ?, email = ?, status = ?';
        $parameters = [$_POST['username'], $password, $_POST['email'], $satuts];
        $this->sql($sql, $parameters);

        $entetemail = "From: Blog Alex  <noreply.blog.alex@gmail.com>\r\n";
        $entetemail .= "Reply-To: noreply.blog.alex@gmail.com \n";
        $entetemail .= 'X-Mailer: PHP/' . phpversion() . "\n";
        $entetemail .= "Content-Type: text/plain; charset=utf8\r\n";
        $objet = 'Comfirmation de la création de votre compte sur le blog alex';
        $message_email = 'Votre compte a bien été créé ' . $_POST['username'] . ', vous pouvez maintenant vous connecter. Rendez-vous sur http://blog.juliencarre.fr/login';

        mail($_POST['email'], $objet, $message_email, $entetemail);
        $_SESSION['flash']['success'] = 'Votre compte à bien été créé.';
    }

    /**
     * Construit l'objet Utilisateur.
     *
     * @param array $row envoi le résultat de la requête sql
     *
     * @return mixed $article retourne l'objet construit
     */
    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);
        $user->setStatus($row['status']);

        return $user;
    }
}
