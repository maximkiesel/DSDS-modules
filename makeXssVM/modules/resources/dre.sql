GRANT ALL ON *.* to 'sewing_site'@'localhost' IDENTIFIED BY 'HusiSQILe' WITH GRANT OPTION;
FLUSH PRIVILEGES;
CREATE DATABASE sewingdb;
USE sewingdb;

CREATE TABLE `users` (
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pictures` (
  `pic_id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(1000) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `pic_id` int DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sewingdb`.`users`
(`user_name`,`password`,`email`)
VALUES
('Otto','OttoTotto','Otto@gmail.com');

INSERT INTO `sewingdb`.`users`
(`user_name`,`password`,`email`)
VALUES
('Anna','AnnaNanna','Anna@gmail.com');

INSERT INTO `sewingdb`.`users`
(`user_name`,`password`,`email`,`isAdmin`)
VALUES
('Admin','DerAdmin','Admin@gmail.com','1');

INSERT INTO `sewingdb`.`pictures`
VALUES
('1','images/uploads/Anna1.jpg','Anna','Rote Jacke');

INSERT INTO `sewingdb`.`pictures`
VALUES
('2','images/uploads/Otto2.jpg','Otto','Weiße Jacke');

INSERT INTO `sewingdb`.`comments`
VALUES
('1','Otto',1,'Coole Rote Jacke');

INSERT INTO `sewingdb`.`comments`
VALUES
('2','Anna',1,'Danke ich hab mir Mühe gegeben');


INSERT INTO `sewingdb`.`comments`
VALUES
('3','Anna',2,'Das sieht sehr gut aus');

INSERT INTO `sewingdb`.`comments`
VALUES
('4','Otto',2,'Danke schön!');
