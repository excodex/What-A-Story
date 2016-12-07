<?php global $config; global $l; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $config["Site_Title"]; ?></title>
  <meta name="description" content="<?php echo $config["Site_Description"]; ?>">
  <meta name="author" content="<?php echo $config["Site_Author"]; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 25%">
        <h4><?php echo $l["offline_Title"]; ?></h4>
        <p><?php echo $l["offline_Message"]; ?></p>
      </div>
    </div>
  </div>
</body>
</html>
