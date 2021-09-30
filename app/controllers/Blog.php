<?php

namespace App\Controllers;

use \Core\View;

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
}
