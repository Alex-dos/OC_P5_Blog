<?php

// Db connection

require 'connDb.php';

// Create users table

$pdo->exec("CREATE TABLE IF NOT EXISTS user (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `picture` VARCHAR(255) NULL,
  `role` TINYINT(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;");

echo 'Tables : USER, ';

// Create posts table

$pdo->exec("CREATE TABLE IF NOT EXISTS `blog_db`.`post` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `title` VARCHAR(100) NOT NULL , 
  `content` TEXT(5000) NOT NULL , 
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP , 
  `picture` VARCHAR(100) NOT NULL , 
  `subheading` VARCHAR(255) NOT NULL , 
  `user_id` INT NOT NULL , 
  PRIMARY KEY (`id`),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE) 
  ENGINE = InnoDB");

echo 'POST, ';

//Create comments table

$pdo->exec("CREATE TABLE IF NOT EXISTS comment (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `user_id` INT NOT NULL,
  `post_id` INT NOT NULL,
  `comment` TEXT(1000) NOT NULL,
  `comment_validate` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_id_comment`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `post_id`
    FOREIGN KEY (`post_id`)
    REFERENCES `post` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;");

echo 'COMMENT, were created successfull, ';
