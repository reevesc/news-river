<?php

  require_once './config.php';
  require __DIR__ . '/../../vendor/autoload.php';

  use ReevesC\NewsRiver\Stream;

  $reqParams = array(
    'params' => array(
      'limit' => 15,
    ),
    'fields' => array(
      'text' => 'Test',
      'website.domainName' => '',
      'language' => 'en',
    )
  );

  $stream = new Stream($conf['token'], $reqParams);

?>

<html>
<head>
<style>
  body { width: 100%; }
  pre { font-size: 10px; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word; }
  .output-block { position: relative; width: 40%; padding-right: 50px; }
  .left { float: left; }
</style>

</head>
<body>
  <h1>Example 1</h1>
  <p>A simple test requet to the NewsRiver Steam API.</p>

  <h2>Before continuing:</h2>
  <p>Please review the contents of sample-config.php and follow the instructions in the file.</p>


  <h3>Sample Request:</h3>
  <pre><?php print_R($reqParams); ?></pre>
  <br>
  <hr>

  <div class="output-block left">
    <h3>Response (as Array):</h3>
    <pre style="font-size: 10px;"><?php print_R($stream->request->send()); ?></pre>
  </div>

  <div class="output-block left">
    <h3>Response (as Object):</h3>
    <pre style="font-size: 10px;"><?php print_R($stream->request('object')); ?></pre>
  </div>

</body>
</html>
