<?php

namespace App\Manager;

use App\Model\User;
use App\Service\Database;

/**
 * UserManager regroupe toutes les requêtes lie au utilisateurs.
 */
class UserManager extends Database
{
    /**
     * retourne tout les utilisateurs.
     *
     * @param int $id id de l'utilisateur
     *
     * @return array $user
     */
    public function getUser($id, $username)
    {
        $sql = 'SELECT id, username FROM users WHERE status = 2';
        $parameters = [
            ':id' => $id,
            ':username' => $username,
        ];
        $result = $this->sql($sql, $parameters);

        return $result;
    }

    /**
     * supprime un utilisateur.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function removeUser($id)
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $parameters = [':id' => $id];
        $result = $this->sql($sql, $parameters);

        return $result;
    }
}
