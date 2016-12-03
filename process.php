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
  `url_title` VARCHAR(40) NOT NULL ,
  `author` VARCHAR(20) NOT NULL ,
  `content` TEXT NOT NULL ,
  `edit_pass` VARCHAR(255) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `hits` INT(11) NOT NULL ,
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
*/
if (!empty($_POST)) {
  $stmt = $sql->prepare("INSERT INTO stories (title, url_title, author, content, edit_pass, date, hits) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $title = $sql->real_escape_string($_POST["title"]);

  $ut_result = $sql->query("SELECT url_title FROM stories");
  if ($ut_result->num_rows > 0) {
    $url_title = strlen($title) > 30 ? substr($title, 0, 30) . "-" . date("m-d") . $ut_result->num_rows : $title . "-" . date("m-d") . "-" . $ut_result->num_rows;
  } else {
    $url_title = strlen($title) > 30 ? substr($title, 0, 30) . "-" . date("m-d") : $title . "-" . date("m-d");
  }

  $author = $sql->real_escape_string($_POST["author"]);
  $content = $_POST["content"];
  $edit_pass = !empty($_POST["edit_pass"]) ? password_hash($_POST["edit_pass"], PASSWORD_DEFAULT) : "";
  $date = date("Y-m-d H:i:s");
  $hits = 0;

  $stmt->bind_param("ssssssi", $title, $url_title, $author, $content, $edit_pass, $date, $hits);
  if ($stmt->execute()) {
    echo "view.php?url_title=" . $url_title;
  }
  $stmt->close();
} else {
  echo "index.php";
}
mysqli_close($sql);
?>
