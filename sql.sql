CREATE TABLE stories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(50) NOT NULL ,
  `url_title` VARCHAR(40) NOT NULL ,
  `author` VARCHAR(20) NOT NULL ,
  `content` TEXT NOT NULL ,
  `date` DATETIME NOT NULL ,
  `hits` INT(11) NOT NULL ,
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
