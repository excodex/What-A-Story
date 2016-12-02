<?php include_once("config.php"); ?>
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
  <link href="//cdn.quilljs.com/1.1.5/quill.snow.css" rel="stylesheet">
  <script src="//cdn.quilljs.com/1.1.5/quill.min.js"></script>
  <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <div class="container">
    <div class="row" id="rowtop">
      <div class="eleven columns">
        <h4 class="E-title"><input type="text" placeholder="Title"></h4>
        <h6 class="E-author"><input type="text" placeholder="Author"></h6>
        <div class="editor">
          <p>Hello World!</p>
          <p>Some initial <strong>bold</strong> text</p>
          <p><br></p>
        </div>
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
        </script>
      </div>
      <div class="one column">
        <input type="submit" value="Publish">
      </div>
    </div>
  </div>
</body>
</html>
