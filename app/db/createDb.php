<?php

// Db connection

require 'connDb.php';

// Create users table

$pdo->exec("CREATE TABLE IF NOT EXISTS `blog_db`.`user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone_number` VARCHAR(45) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `profile_picture` BLOB NOT NULL,
    `hook_phrase` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`))
  ENGINE = InnoDB;");

echo 'Tables : USERS, ';

// Create posts table

$pdo->exec("CREATE TABLE IF NOT EXISTS `blog_db`.`post` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `content` TEXT(5000) NOT NULL,
    `creation_date` DATETIME NOT NULL,
    `post_picture` VARCHAR(100) NOT NULL,
    `subheading` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `user_id_idx` (`user_id` ASC) VISIBLE,
    CONSTRAINT `user_id`
      FOREIGN KEY (`user_id`)
      REFERENCES `blog_db`.`user` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;");

echo 'POSTS, ';

// Create comments table

$pdo->exec("CREATE TABLE IF NOT EXISTS `blog_db`.`comment` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `comment_date` DATETIME NOT NULL,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `comment` TEXT(1000) NOT NULL,
    `comment_validate` TINYINT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `user_id_idx` (`user_id` ASC) VISIBLE,
    INDEX `post_id_idx` (`post_id` ASC) VISIBLE,
    CONSTRAINT `user_id`
      FOREIGN KEY (`user_id`)
      REFERENCES `blog_db`.`user` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `post_id`
      FOREIGN KEY (`post_id`)
      REFERENCES `blog_db`.`post` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;");

echo 'COMMENTS, were created successfull, ';

// Create categories table

// $pdo->exec("CREATE TABLE categories (
//     id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
//     title VARCHAR(255) NOT NULL,
//     slug VARCHAR(255) NOT NULL,
//     ft_image VARCHAR(255) NOT NULL,
//     content text NOT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// echo 'CATEGORIES, ';

// Create posts_comments table

// $pdo->exec("CREATE TABLE posts_comments (
//     post_id INT UNSIGNED NOT NULL,
//     comment_id INT UNSIGNED NOT NULL,
//     PRIMARY KEY (post_id, comment_id),
//     CONSTRAINT fk_post
//         FOREIGN KEY (post_id)
//         REFERENCES posts (id)
//         ON UPDATE CASCADE
//         ON DELETE RESTRICT,
//     CONSTRAINT fk_comment
//         FOREIGN KEY (comment_id)
//         REFERENCES comments (id)
//         ON UPDATE CASCADE
//         ON DELETE RESTRICT
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// echo 'POSTS_COMMENTS, ';

// Create users_posts table

// $pdo->exec("CREATE TABLE users_posts (
//     user_is INT UNSIGNED NOT NULL,
//     post_id INT UNSIGNED NOT NULL,
//     PRIMARY KEY (user_id, post_id),
//     CONSTRAINT fk_user
//         FOREIGN KEY (user_id)
//         REFERENCES users (id)
//         ON UPDATE CASCADE
//         ON DELETE RESTRICT,
//     CONSTRAINT fk_post
//         FOREIGN KEY (post_id)
//         REFERENCES posts (id)
//         ON UPDATE CASCADE
//         ON DELETE RESTRICT
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// echo 'USERS_POSTS, ';

// Create posts_categories table

// $pdo->exec("CREATE TABLE posts_categories (
//     post_is INT UNSIGNED NOT NULL,
//     category_id INT UNSIGNED NOT NULL,
//     PRIMARY KEY (post_id, category_id),
//     CONSTRAINT fk_post
//         FOREIGN KEY (post_id)
//         REFERENCES posts (id)
//         ON UPDATE CASCADE
//         ON DELETE RESTRICT,
//     CONSTRAINT fk_category
//         FOREIGN KEY (category_id)
//         REFERENCES categories (id)
//         ON UPDATE CASCADE
//         ON DELETE RESTRICT
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// echo 'POSTS_CATEGORIES were created successfull, ';
