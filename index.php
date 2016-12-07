<?php include_once("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $config["Site_Title"]; ?></title>
  <meta name="description" content="<?php echo $config["Site_Description"]; ?>">
  <meta name="author" content="<?php echo $config["Site_Author"]; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="//cdn.quilljs.com/1.1.5/quill.snow.css" rel="stylesheet">
  <script src="//cdn.quilljs.com/1.1.5/quill.min.js"></script>
  <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <div class="container">
    <div class="row" id="rowtop">
      <div class="ten columns">
        <form>
          <h4 class="E-title"><input type="text" id="tb" name="title" placeholder="<?php echo $l["index_Title"]; ?>" autofocus="autofocus"></h4>
          <h6 class="E-author"><input type="text" id="tb" name="author" placeholder="<?php echo $l["index_Your_Name"]; ?>"></h6>
          <input name="content" type="hidden">
          <div class="editor">
            <p><?php echo $l["index_Your_Story"]; ?></p>
          </div>
        </div>
        <div class="two columns">
          <input type="submit" value="<?php echo $l["index_Publish"]; ?>">
        </div>
      </form>
      <script>
      var toolbarOptions = [
        ['bold', 'italic', { 'header': 1 }, { 'header': 2 }],
        ['link', 'image', 'video'],
        ['blockquote', 'code-block']
      ];
      var quill = new Quill('.editor', {
        theme: 'snow',
        modules: {
          toolbar: toolbarOptions
        }
      });
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
            window.location.href = data;
          },
          complete: function() {},
          error: function(xhr, textStatus, errorThrown) {
            console.log('<?php echo $l["index_Ajax_error"]; ?>');
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
