<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>textgen</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="js/script.js"></script>
  <?php require_once '/scripts/script.php'; ?>
</head>
<body>
<div class="content">
  <pre class="text">
    <?php echo processTxt("master.txt"); ?>
  </pre>
</div>
</body>
</html>