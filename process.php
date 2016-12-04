<?php
include_once("config.php");

// SQL Connect
$sql = mysqli_connect($config["MySQL_host"],$config["MySQL_user"],$config["MySQL_pass"],$config["MySQL_db"]);
if ($config["Debug"] && mysqli_connect_errno()){
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (!empty($_POST)) {
  // Insert into database
  $stmt = $sql->prepare("INSERT INTO stories (title, url_title, author, content, date, hits) VALUES (?, ?, ?, ?, ?, ?)");
  $title = $sql->real_escape_string($_POST["title"]);
  $title = !empty($title) ? $title : "Untitled";

  // Generate SEO URL
  $ut_recipe = strlen($title) > 30 ? substr($title, 0, 30) . "-" . date("m-d") : $title . "-" . date("m-d");

  $ut_result = $sql->query("SELECT url_title FROM stories WHERE url_title='$ut_recipe'");
  if ($ut_result->num_rows > 0) {
    $url_title = strlen($title) > 30 ? substr($title, 0, 30) . "-" . date("m-d") . $ut_result->num_rows : $title . "-" . date("m-d") . "-" . $ut_result->num_rows;
  } else {
    $url_title = $ut_recipe;
  }

  $author = $sql->real_escape_string($_POST["author"]);
  $author = !empty($author) ? $author : "Anonymous";
  $content = $_POST["content"];
  $date = date("Y-m-d H:i:s");
  $hits = 0;

  $stmt->bind_param("sssssi", $title, $url_title, $author, $content, $date, $hits);
  if ($stmt->execute()) {
    echo $url_title;
    die();
  }
  $stmt->close();
} else {
  echo "new";
  die();
}
mysqli_close($sql);
?>
