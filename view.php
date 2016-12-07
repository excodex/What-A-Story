<?php
include_once("config.php");
// SQL Connect
$sql = mysqli_connect($config["MySQL_host"],$config["MySQL_user"],$config["MySQL_pass"],$config["MySQL_db"]);
if ($config["Debug"] && mysqli_connect_errno()){
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// If there is no input to associate in mysql, then go home
if (!empty($_GET["url_title"])) {
  $ut_result = $sql->query("SELECT url_title FROM stories WHERE url_title = '" . $_GET["url_title"] . "'");
  $url_title = $ut_result->num_rows > 0 ? true : false;
  if (!$url_title) {
    header("Location: index.php");
    die();
  }

  $from_url_title = $sql->real_escape_string($_GET["url_title"]);
  // Get data from database
  $get_data = $sql->query("SELECT title, author, content, date, hits FROM stories WHERE url_title = '$from_url_title'")->fetch_assoc();
  // Add +1 to hits in database since someone viewed the story
  $get_hits = $get_data["hits"] +1;
  $sql->query("UPDATE stories SET hits = '$get_hits' WHERE url_title = '$from_url_title'");
} else {
  header("Location: index.php");
  die();
}
$og_title = strlen($get_data["title"]) > 36 ? substr($get_data["title"], 0, 36) . " ..." : $get_data["title"];
$og_description = strlen($get_data["content"]) > 106 ? substr($get_data["content"], 0, 106) . " ..." : $get_data["content"];
$og_author = $get_data["author"];
mysqli_close($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $config["Site_Title"]; ?></title>
  <meta name="description" content="<?php echo $config["Site_Description"]; ?>">
  <meta name="author" content="<?php echo $config["Site_Author"]; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <meta property="og:site_name" content="<?php echo $config["Site_Title"]; ?>">
  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php echo $og_title; ?>">
  <meta property="og:description" content="<?php echo $og_description; ?>">
  <meta property="article:published_time" content="<?php echo date("Y-m-d", strtotime($get_data["date"])) . "T" . date("H:i:s", strtotime($get_data["date"])) . "+0000"; ?>">
  <meta property="article:author" content="<?php echo $og_author; ?>">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="//cdn.quilljs.com/1.1.5/quill.bubble.css">
  <script src="//cdn.quilljs.com/1.1.5/quill.min.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <div class="container">
    <div class="row" id="rowtop">
      <div class="eleven columns">
        <form>
          <h4 class="E-title"><strong><?php echo $get_data["title"]; ?></strong></h4>
          <br>
          <h6 class="V-author"><?php echo $get_data["author"]; ?>
            &nbsp;&times;&nbsp;
            <?php echo date($config["DateShowTypeView"], strtotime($get_data["date"])); ?></h6>
            <div class="editor"></div>
          </div>
          <div class="one column"></div>
        </form>
        <script>
        var quill = new Quill('.editor', {
          theme: 'bubble',
          readOnly: true
        });
        quill.setContents(<?php echo $get_data["content"]; ?>);
        </script>
    </div>
  </div>
</body>
</html>
