<?php

namespace App\Manager;

/**
 * FromManager gère le formulaire de contact de la page d'accueil.
 */
class FormManager
{
    /**
     * Traite le formualire, envoie le message à l'administrateur et un mail de comfirmation au visiteur.
     *
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $message
     */
    public function fromTraiment($nom, $prenom, $email, $message)
    {
        $entetemail = "From: Blog Projet OpenClassroom <noreply.blog.alex@gmail.com>\r\n";
        $entetemail .= "Reply-To: noreply.blog.alex@gmail.com\n";
        $entetemail .= 'X-Mailer: PHP/' . phpversion() . "\n";
        $entetemail .= "Content-Type: text/plain; charset=utf8\r\n";
        $objet = 'Comfirmation de la récption de votre message';
        $message_email = 'Nous avons bien reçu votre message';

        mail($email, $objet, $message_email, $entetemail);

        $entetemail = 'From:' . $nom . ' ' . $prenom . ' <' . $email . ">\r\n";
        $entetemail .= 'Reply-To: ' . $email . "\n";
        $entetemail .= 'X-Mailer: PHP/' . phpversion() . "\n";
        $entetemail .= "Content-Type: text/plain; charset=utf8\r\n";
        $objet = 'Contact depuis votre Blog Alexandre Dosseto';
        $message_email = $message;

        mail('noreply.blog.alex@gmail.com', $objet, $message_email, $entetemail);
    }
}
