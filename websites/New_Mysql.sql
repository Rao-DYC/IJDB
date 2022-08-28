CREATE TABLE `authors` (
   `author_id` int(11) NOT NULL AUTO_INCREMENT,
   `author_name` varchar(255) NOT NULL,
   `author_email` varchar(255) NOT NULL,
   `password` varchar(255) NOT NULL,
   PRIMARY KEY (`author_id`),
   UNIQUE KEY `email_UNIQUE` (`author_email`),
   KEY `name_INDEX` (`author_name`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3

CREATE TABLE `categories` (
   `category_id` int(11) NOT NULL AUTO_INCREMENT,
   `category_name` varchar(255) NOT NULL,
   PRIMARY KEY (`category_id`),
   KEY `name_INDEX` (`category_name`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3

CREATE TABLE `jokes` (
   `joke_id` int(11) NOT NULL AUTO_INCREMENT,
   `joke_text` text NOT NULL,
   `joke_date` datetime NOT NULL DEFAULT current_timestamp(),
   `author_id` int(11) NOT NULL,
   `category_id` int(11) NOT NULL,
   PRIMARY KEY (`joke_id`),
   KEY `author_id` (`author_id`),
   KEY `category_id_INDEX` (`category_id`),
   CONSTRAINT `author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3

CREATE TABLE `joke_category` (
   `joke_id` int(11) NOT NULL,
   `category_id` int(11) NOT NULL,
   PRIMARY KEY (`joke_id`,`category_id`),
   KEY `category_id` (`category_id`),
   CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
   CONSTRAINT `joke_id` FOREIGN KEY (`joke_id`) REFERENCES `jokes` (`joke_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3