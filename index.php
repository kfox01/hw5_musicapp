<?php
require __DIR__ . "/inc/bootstrap.php";
header('Access-Control-Allow-Origin: http://localhost:3000');


// Set the allowed origin for CORS (replace 'http://localhost:3000' with your actual frontend URL)

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');

// Check the origin of the incoming request

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
  header('Access-Control-Allow-Headers: Content-Type, Authorization');
  header('Access-Control-Allow-Credentials: true');
  http_response_code(200);
  exit;
}



$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (isset($uri[2])) {
  if ($uri[2] === 'song') {
    // Handle song-related requests
    require PROJECT_ROOT_PATH . "/Controller/Api/SongController.php";
    $objFeedController = new SongController();
    $strMethodName = $uri[3] . 'Action';
    $objFeedController->{$strMethodName}();
  } elseif ($uri[2] === 'user') {
    // Handle user-related requests
    require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
    $objFeedController = new UserController();
    $strMethodName = $uri[3] . 'Action';
    $objFeedController->{$strMethodName}();
  } else {
    // Invalid request
    header("HTTP/1.1 404 Not Found");
    exit();
  }
} else {
  // Invalid request
  header("HTTP/1.1 404 Not Found");
  exit();
}

?>