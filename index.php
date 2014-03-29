<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>textgen</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="content">
  <nav class="mainNav">
    <?php 
    $files = scandir(".");
    $countFiles = count($files);
      for ($i=0; $i < $countFiles; $i++) {
        if (strpos($files[$i], ".php") !== false) {
          echo '<li><a href="/'.$files[$i].'">'.$files[$i].'</a></li>';
        }
      }
    ?>
  </nav>
</div>
</body>
</html>