<?php
include_once("config.php");

// SQL Connect
$sql = mysqli_connect($config["MySQL_host"],$config["MySQL_user"],$config["MySQL_pass"],$config["MySQL_db"]);
if ($config["Debug"] && mysqli_connect_errno()){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
/*
CREATE TABLE stories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(50) NOT NULL ,
  `url_title` VARCHAR(15) NOT NULL ,
  `author` VARCHAR(20) NOT NULL ,
  `content` TEXT NOT NULL ,
  `edit_pass` VARCHAR(255) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `hits` INT(11) NOT NULL ,
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
*/
if (!empty($_POST)) {
  print_r($_POST);
  die();
} else {
  header("Location: index.php");
}

mysqli_close($sql);
?>
