<?php

// error_reporting(E_ALL);
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors',1);

include_once("connect_db.php");
foreach($_REQUEST as $key => $value){
    $$key = $value;
}
if(empty($page)){
    $page = "jogos";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/inline.js"></script>
    <script src="js/script.js"></script>
    <title>Tree Skills</title>
</head>
<body>
    <header class="header" <?php include("random_gradient.php"); ?>>
        <h1>Tree Skill Maker</h1>
    </header>
    <a href="index.php?page=jogos" class="btn btn-primary">Home</a>
    
    <?php include_once($page.".php");?>
    
    <footer class="credits-footer">
        Created by Guilherme Carvalho Fritis
    </footer>
</body>
</html>
<?php
    $mysqli -> close();
?>