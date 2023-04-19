<?php

require_once __DIR__ . "/core/router.php";

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', './../src/App/Views/SendMail.phtml');

post('/send', './../src/App/ProcessMail.php');

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', './../src/App/Views/404.phtml');
