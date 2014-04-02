<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>textgen</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="js/jquery.js"></script>
  <script src="js/script.js"></script>
  <script src="js/wordsProcessor.js"></script>
  <?php require_once '/scripts/script.php'; ?>
</head>
<body>
<div id="msg"></div>
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
  <div id="text" class="text--mono"></div>
</div>
</body>
</html>