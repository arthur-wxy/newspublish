<!DOCTYPE html>
<html>
<head>
    <title>新闻管理系统</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.-theme.css" />
    <script src="https://cdn.bootcss.com/jquery/3.3.1/core.js"></script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
        @media (max-width: 980px) {
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;

            }
        }
    </style>
</head>
<?php
    include_once("../db.php");
    $ceshi=new DB();
    if($_POST['name']){
        $name=$_POST['name'];
        $pass=$_POST['pass'];
        $pass1=$_POST['pass1'];
    }


?>
</html>