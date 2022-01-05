<?php

namespace App\Manager;

use App\Model\Comment;
use App\Service\Database;

/**
 * CommentManager regroupe toutes les requêtes lie au commetaires.
 */
class CommentManager extends Database
{
    /**
     * retourne tout les commentaires d'un article.
     *
     * @param int $postId id de l'article
     *
     * @return array $comments
     */
    public function getComments($postId)
    {
        $sql = 'SELECT id, id_user, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y \') AS comment_date_fr FROM comments WHERE post_id = :postId and valid = 1 ORDER BY comment_date DESC';
        $parameters = [':postId' => $postId];
        $result = $this->sql($sql, $parameters);

        $comments = [];

        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }

        return $comments;
    }

    /**
     * retourne le commentaire demander.
     *
     * @param int $commentId id du commentaire
     *
     * @return mixed $comment
     */
    public function getComment($commentId)
    {
        $sql = 'SELECT id, id_user, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y \') AS comment_date_fr FROM comments WHERE id = :commentId';
        $parameters = [':commentId' => $commentId];
        $result = $this->sql($sql, $parameters);

        $row = $result->fetch();

        if ($row) {
            return $this->buildObject($row);
        } else {
            $_SESSION['flash']['danger'] = 'Aucun commentaire existant avec cet identifiant';
        }
    }

    /**
     * retourne tout les commentaire d'un utilisateur.
     *
     * @param int $userId id utilisateur
     *
     * @return array $comments
     */
    public function getUserComment($userId)
    {
        $sql = 'SELECT id, post_id, comment, valid,DATE_FORMAT(comment_date, \'%d/%m/%Y \') AS comment_date_fr FROM comments WHERE id_user = :userId ORDER BY comment_date DESC';
        $parameters = [':userId' => $userId];
        $result = $this->sql($sql, $parameters);

        $comments = [];

        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }

        return $comments;
    }

    /**
     * ajoute le commentaire d'un utilisateur.
     *
     * @param int    $id
     * @param int    $userId
     * @param string $comment
     *
     * @return mixed
     */
    public function postComment($id, $userId, $comment)
    {
        $sql = 'INSERT INTO comments(post_id, id_user, comment, comment_date, valid) VALUES(?, ?, ?, ?, NOW(), 0)';
        $parameters = [$id, $userId, $comment];
        $result = $this->sql($sql, $parameters);

        return $result;
    }

    /**
     * modifie un commentaire existant et le passe non-valide.
     *
     * @param int    $commentId
     * @param string $comment
     *
     * @return mixed
     */
    public function updateComment($commentId, $comment)
    {
        $date = date('Y-m-d');

        $sql = 'UPDATE comments SET user = :username, comment = :comment ,comment_date = :comment_date ,valid = 0 WHERE id = :id';
        $parameters = [
            ':id' => $commentId,
            ':comment' => $comment,
            ':comment_date' => $date,
        ];
        $result = $this->sql($sql, $parameters);

        return $result;
    }

    /**
     * Retourne tout les commentaires non-valide.
     *
     * @return array $comments
     */
    public function getCommentsInvalid()
    {
        $sql = 'SELECT id, comment FROM comments WHERE valid = 0 ORDER BY comment_date DESC ';
        $result = $this->sql($sql);

        $comments = [];

        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }

        return $comments;
    }

    /**
     * passe le commentaire non-valdie en valide.
     *
     * @param int $commentId
     *
     * @return mixed
     */
    public function setCommentValid($commentId)
    {
        $sql = 'UPDATE comments SET valid = :valid WHERE id = :id';
        $parameters = [
            ':id' => $commentId,
            ':valid' => 1,
        ];
        $result = $this->sql($sql, $parameters);

        return $result;
    }

    /**
     * supprime un commentaire.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function removeComment($id)
    {
        $sql = 'DELETE FROM comments WHERE id = :id';
        $parameters = [':id' => $id];
        $result = $this->sql($sql, $parameters);

        return $result;
    }

    /**
     * Construit l'objet Commentaire.
     *
     * @param array $row envoi le résultat de la requête sql
     *
     * @return mixed $comment retourne l'objet construit
     */
    private function buildObject($row)
    {
        $comment = new Comment();

        $comment->setId($row['id']);
        $comment->setComment($row['comment']);

        if (!empty($row['post_id'])) {
            $comment->setPostId($row['post_id']);
        }
        if (!empty($row['id_user'])) {
            $comment->setIdUser($row['id_user']);
        }
        if (!empty($row['comment_date_fr'])) {
            $comment->setCommentDate($row['comment_date_fr']);
        }
        if (!empty($row['valid'])) {
            $comment->setCommentValid($row['valid']);
        }

        return $comment;
    }
}
