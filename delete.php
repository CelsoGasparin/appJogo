<?php

require_once "dao/JogoDao.php";

if(isset($_GET['id'])){
    JogoDao::delete($_GET['id']);   
}
header('location:index.php');
