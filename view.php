<?php
include_once("config.php");
// SQL Connect
$sql = mysqli_connect($config["MySQL_host"],$config["MySQL_user"],$config["MySQL_pass"],$config["MySQL_db"]);
if ($config["Debug"] && mysqli_connect_errno()){
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (!empty($_GET["url_title"])) {
  $ut_result = $sql->query("SELECT url_title FROM stories WHERE url_title = '" . $_GET["url_title"] . "'");
  $url_title = $ut_result->num_rows > 0 ? true : false;

  $from_url_title = $sql->real_escape_string($_GET["url_title"]);
  $get_data = $sql->query("SELECT title, author, content, edit_pass, date FROM stories WHERE url_title = '$from_url_title'")->fetch_assoc();

} else {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $config["Site_Title"]; ?></title>
  <meta name="description" content="<?php echo $config["Site_Description"]; ?>">
  <meta name="author" content="<?php echo $config["Site_Author"]; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="//cdn.quilljs.com/1.1.5/quill.bubble.css">
  <script src="//cdn.quilljs.com/1.1.5/quill.min.js"></script>
  <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <div class="container">
    <div class="row" id="rowtop">
      <div class="eleven columns">
        <form>
          <h4 class="E-title"><?php echo $get_data["title"]; ?></h4>
          <h6 class="E-author"><?php echo $get_data["author"]; ?></h6>
          <div class="editor">
            <p>Hello World!</p>
            <p>Some initial <strong>bold</strong> text</p>
            <p><br></p>
          </div>
        </div>
        <div class="one column">
          <label for="edit_pass">Edit password:</label>
          <?php
          if (!empty($get_data["edit_pass"])) {
            echo "<input type=\"submit\" value=\"Edit\">";
          }
          ?>
        </form>
      </div>
      <script>
      var quill = new Quill('.editor', {
        theme: 'bubble',
        readOnly: true
      });
      quill.setContents([
        <?php echo $get_data["content"]; ?>
        { insert: '\n' }
      ]);
      var form = document.querySelector('form');
      form.onsubmit = function() {
        var content = document.querySelector('input[name=content]');
        content.value = JSON.stringify(quill.getContents());
        $.ajax({
          type: "POST",
          url: "process.php",
          async: false,
          data: $(form).serializeArray(),
          success: function(data){
            console.log(data);
            return true;
          },
          complete: function() {},
          error: function(xhr, textStatus, errorThrown) {
            console.log('Ajax error...');
            return false;
          }
        });
        return false;
      };
      </script>
      </div>
      </div>
      </body>
      </html>
