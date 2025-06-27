<?php 

require_once "model/Jogo.php";
require_once "dao/JogoDao.php";

if(!isset($_GET['cardsID'])){
    header('location:index.php');
}else{
    $valid=0;
    foreach(JogoDao::listarJogos('id') as $id) {
        if($id['id']==$_GET['cardsID']){
            $valid++;
        }
    }
    if(!$valid){
        header('location:index.php');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CardLegal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?= Jogo::dataToObject(JogoDao::buscarJogo($_GET['cardsID']))->stringCard() ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>