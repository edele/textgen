<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>textgen</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="js/script.js"></script>
  <?php require_once '/scripts/script.php'; ?>
</head>
<body>
<div class="content">
  <div class="text--mono" id="emmanuele">
    <?php echo processTxt("master.txt"); ?>
  </div>
</div>
</body>
</html>