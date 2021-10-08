<?php

namespace App\Controllers;

require_once(__DIR__ . '/../model/PostModel.php');
require_once(__DIR__ . '/../../Core/Controller.php');

use \Core\View;
use PostModel;

/**
 * Blog controller
 *
 * PHP version 7.0
 */

class Blog extends \Core\Controller
{
    /**
     * Show blog page
     *
     * @return void
     */

    public function renderAction()
    {
        View::renderTemplate('blog.twig');
    }

    function listAllPosts()
    {

        $postModel = new PostModel();
        $posts = $postModel->getAllPosts();

        require('../../app/views/blog.twig');
    }
}
