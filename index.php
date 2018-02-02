<?php
  require __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>graby demo</title>

  <style>
    form {
      width: 50%;
      margin: 20px auto;
      min-width: 500px;
    }
    input, textarea {
      display: block;
      width: 100%;
    }
    textarea {
      min-height: 200px;
      margin-bottom: 20px;
    }
    h2 {
      border-bottom: 1px solid black;
      padding: 20px;
      margin: 40px 0;
    }
    pre {
      background: #eee;
      padding: 20px;
      overflow: scroll;
    }
  </style>
</head>
<body>
  <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
    profile url: <input type="text" name="url"><br>
    html: <textarea name="html"></textarea>
    <input type="submit">
  </form>

  <?php
  if (!empty($_POST)):
    $graby = new Graby\Graby();

    if (empty($_POST["html"])) {
      $content = $graby->fetchContent($_POST["url"]);
      $result = $content["html"];
    } else {
      $result = $graby->cleanupHtml($_POST["html"], $_POST["url"]);
    }
  ?>
    <h2>Output</h2>

    <?php echo $result; ?>

    <h2>Raw HTML</h2>

    <pre><code>
      <?php echo htmlspecialchars($result); ?>
    </pre></code>

  <?php endif; ?>
</body>
</html>
