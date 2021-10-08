<?php

use Core\Model;

require_once(__DIR__ . '../../../Core/Model.php');

class PostManager extends Model
{

    function __construct()
    {

        $this->db = $this->getDB();
    }

    function getHomePosts()
    {

        $req = $this->db->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 0, 3');

        return $req;
    }

    function getAllPosts()
    {

        $req = $this->db->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 0, 5');

        return $req;
    }

    function getPost($postId)
    {

        $req = $this->db->prepare('SELECT * FROM post WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }



    // function addPost($author, $title, $content)
    // {

    //     $addpost = $this->db->prepare('INSERT INTO post (title, content, author) VALUES (?, ?, ?)');
    //     $affectedLines = $addpost->execute(array($title, $content, $author));
    //     $lastId = $this->db->lastInsertId();

    //     if (isset($_FILES['thumbnail']) and !empty($_FILES['thumbnail']['name'])) {

    //         $path = 'public/img/blog/thumbnails/' . $lastId . '.jpg';
    //         move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
    //     }

    //     header('location: index.php?action=listPosts');
    // }

    // function editPost($postId)
    // {

    //     $req = $this->db->prepare('SELECT * FROM post WHERE id = ?');
    //     $req->execute(array($postId));
    //     $post = $req->fetch();

    //     return $post;
    // }

    // function confirmEditPost($postId, $author, $title, $content)
    // {

    //     $editpost = $this->db->prepare('UPDATE post SET title = ?, content = ?, author = ?, update_date = NOW() WHERE id = ? ');
    //     $affectedLines = $editpost->execute(array($title, $content, $author, $postId));

    //     if (isset($_FILES['thumbnail'])  and !empty($_FILES['thumbnail']['name'])) {

    //         $path = 'public/img/blog/thumbnails/' . $postId . '.jpg';
    //         move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
    //     }

    //     header('location: index.php?action=post&id=' . $postId);
    // }

    // function deletePost($postId)
    // {

    //     $deletepost = $this->db->prepare('DELETE FROM post WHERE id = ?');
    //     $affectedLines = $deletepost->execute(array($postId));

    //     $path = 'public/img/blog/thumbnails/' . $postId . '.jpg';
    //     unlink($path);
    // }
}
