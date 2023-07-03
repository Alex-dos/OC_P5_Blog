<?php

namespace App\Controller;

use App\Service\TwigRenderer;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Validator\FunctionValidator;
use App\Manager\UserManager;

/**
 * class BackendController le controller de la parti Admin.
 */
class BackendController
{
    private $renderer;
    private $verif;
    private $postManager;
    private $commentManager;
    private $userManager;

    public function __construct()
    {
        $this->verif = new FunctionValidator();
        $this->renderer = new TwigRenderer();
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['auth'])) {
            $_SESSION['flash']['danger'] = 'Vous n\'avez pas le droit d\'accéder à cette page';
            header('Location: /login');
        }
        if (isset($_SESSION['auth'])) {
            if ($_SESSION['auth']->getStatus() != 1) {
                $_SESSION['flash']['danger'] = 'Vous n\'avez pas le droit d\'accéder à cette page';
                header('Location: /user');
            }
        }
    }

    public function interfaceAdmin()
    {
        if (isset($_SESSION['auth'])) {
            $data_posts = $this->postManager->getPostPreview();

            $data_comments = $this->commentManager->getCommentsInvalid();
            $data_users = $this->userManager->getUser($_SESSION['auth']->getId(), $_SESSION['auth']->getUsername());

            $this->renderer->render('backend/adminView', ['data_posts' => $data_posts, 'data_comments' => $data_comments, 'data_users' => $data_users]);
            $_SESSION['flash'] = array();
        }
    }

    public function viewAddPost()
    {
        $data_authors = $this->postManager->getAllAuthors();

        $this->renderer->render('backend/addPostView', ['data_authors' => $data_authors]);
    }

    public function commentValid()
    {
        $id = $this->verif->check($_POST['id']);

        $affectedLines = $this->commentManager->setCommentValid($id);

        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible de valider le commentaire !';
        } else {
            $_SESSION['flash']['success'] = 'Votre commentaire a bien été valider.';
        }
        header('Location: /admin');
    }





    public function addPostManager()
    {
        $title = $this->verif->check($_POST['title']);

        $chapo = $this->verif->checkForContent($_POST['chapo']);

        $content = $this->verif->checkForContent($_POST['content']);

        $idUser = $this->verif->check($_SESSION['auth']->getId());

        $idAuthor = $_POST['id_author'];

        $affectedLines = $this->postManager->addpost($title, $chapo, $content, $idUser, $idAuthor);
        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette article.';
        } else {
            $_SESSION['flash']['success'] = 'Votre article a bien été ajouter.';
        }
        header('Location: /admin');
    }

    public function post($id)
    {
        $data_post = $this->postManager->getPost($id);
        $data_authors = $this->postManager->getAllAuthors();

        $this->renderer->render('backend/editPostView', ['data_post' => $data_post, 'data_authors' => $data_authors]);
        $_SESSION['flash'] = array();
    }

    public function editPostManager($id)
    {
        $title = $this->verif->check($_POST['title']);
        $idAuthor = $this->verif->check($_POST['id_author']);

        $chapo = $this->verif->checkForContent($_POST['chapo']);

        $content = $this->verif->checkForContent($_POST['content']);

        $idUser = $this->verif->check($_SESSION['auth']->getId());

        $affectedLines = $this->postManager->setPost($id, $title, $chapo, $content, $idUser, $idAuthor);
        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible de modifier cette article.';
        } else {
            $_SESSION['flash']['success'] = 'Votre article a bien été modifier.';
        }
        header('Location: /admin');
    }

    public function removePostManager()
    {
        $postId = $this->verif->check($_POST['postId']);

        $affectedLines = $this->postManager->removePost($postId);
        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible de suprrimer cette article.';
        } else {
            $_SESSION['flash']['success'] = 'Votre article a bien été supprimer.';
        }
        header('Location: /admin');
    }

    public function comment($id)
    {
        $comment = $this->commentManager->getComment($id);

        $this->renderer->render('backend/editComment', ['data_comment' => $comment]);
        $_SESSION['flash'] = array();
    }

    public function editComment($id)
    {
        $comment = $this->verif->check($_POST['comment']);

        $affectedLines = $this->commentManager->updateComment($id, $comment);

        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible de modifier le commentaire !';
        } else {
            $_SESSION['flash']['success'] = 'Votre commentaire a bien été modifier.';
        }

        header('Location: /admin');
    }

    public function removeCommentManager($id)
    {
        $affectedLines = $this->commentManager->removeComment($id);
        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible de suprrimer ce commentaire.';
        } else {
            $_SESSION['flash']['success'] = 'Votre commentaire a bien été supprimer.';
        }
        header('Location: /admin');
    }

    public function errorView($errorMessage)
    {
        $this->renderer->render('frontend/errorView', ['data_message' => $errorMessage]);
        $_SESSION['flash'] = array();
    }


    public function removeUserManager($id)
    {
        $affectedLines = $this->userManager->removeUser($id);
        if ($affectedLines === false) {
            $_SESSION['flash']['danger'] = 'Impossible de suprrimer cet utilisateur.';
        } else {
            $_SESSION['flash']['success'] = 'Cet utilisateur a bien été supprimer.';
        }
        header('Location: /admin');
    }
}
