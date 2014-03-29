<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>textgen</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="js/script.js"></script>
</head>
<body>
<div class="content">
  <nav class="mainNav leftSidebar">
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