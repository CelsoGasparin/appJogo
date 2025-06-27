<?php
require_once "dao/JogoDao.php";
require_once "model/Jogo.php";



function validValue($value,$min,$max){

    $trimValue = trim($value);
    return $trimValue==''|| (strlen($trimValue) < $min || strlen($trimValue) > $max);

}
function validGenre(array $array){
    $allGenres = ['ad','aa','ti','hs','bu','pl','rp',
                  'lu','st','so','pu','es','si','ce'];
    $arrayN = 0;
    foreach($array as $value){
        foreach($allGenres as $genre){
            if($value == $genre){
                $arrayN++;
                break;
            }
        }
    }
    return $arrayN==count($array);    
}
function validPlats(array $array){
    $allPlats = ['wi','p4','p5','x1','xs','ns','n2','mo','ln'];
    $arrayN = 0;
    foreach($array as $value){
        foreach($allPlats as $plat){
            if($value == $plat){
                $arrayN++;
                break;
            }
        }
    }
    return $arrayN==count($array);
}
function validAge($age){
    $allAges = ['L','10','12','14','16','18'];
    foreach($allAges as $validAge){
        if($age==$validAge){
            return 1;
        }
    }
}



session_start();
// print_r($_POST);




if($_POST!==[]){
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['imgURL'] = $_POST['imgURL'];
    $_SESSION['dev'] = $_POST['dev'];
    $_SESSION['publisher'] = $_POST['publisher'];
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['genres'] = [];
    $_SESSION['plats'] = [];   
    $_SESSION['fileSize'] = $_POST['fileSize'];
    $_SESSION['ageRating'] = $_POST['ageRating'];
    $_SESSION['date'] = $_POST['date'];


    // Nome
    $trimName = trim($_POST['name']);
    $nomeRep = 0;
    foreach(JogoDao::listarJogos('nome') as $key => $value){
        if($value['nome'] == $trimName){
            $nomeRep++;
        }
    }
    if($_POST['name']==""){
        $_SESSION['erros'][] = "Escolha um nome!";
    }elseif(validValue($_POST['name'],3,65)){
        $_SESSION['erros'][] = "Informe um nome válido!";
    }elseif($nomeRep){
        $_SESSION['erros'][] = "Esse nome é repetido!";
    }

    


    // imgURL
    if($_POST['imgURL']==""){
        $_SESSION['erros'][] = "Escolha uma imagem!";
        // print"teste";
    }elseif(!getimagesize($_POST['imgURL'])){
        $_SESSION['erros'][] = "Sua URL não é válida!";
    }

    

    // Desenvolvedora
    if($_POST['dev']==""){
        $_SESSION['erros'][] = "Escolha uma Desenvolvedora!";
    }elseif(validValue($_POST['dev'],3,65)){
        $_SESSION['erros'][] = "Informe uma Desenvolvedora válida!";
    }

    

    // Publisher
    if($_POST['publisher']==""){
        $_SESSION['erros'][] = "Escolha uma Publisher!";
    }elseif(validValue($_POST['publisher'],3,65)){
        $_SESSION['erros'][] = "Informe uma Publisher válida!";
    }

    

    // Preco
    if($_POST['price']==""){
        $_SESSION['erros'][] = "Escolha um Preço!";
    }elseif(!is_numeric($_POST['price'])){
        $_SESSION['erros'][] = "Seu Preço não é numérico!";
    }
    
    

    // Generos
    if(!isset($_POST['genres'])){
        $_SESSION['erros'][] = "Escolha pelo menos um gênero!";
    }elseif(!validGenre($_POST['genres'])){
        $_SESSION['erros'][] = "Fazendo favor não mexe no html.";
    }else{
        $_SESSION['genres'] = $_POST['genres'];
    }

    

    // Plataformas
    if(!isset($_POST['plats'])){
        $_SESSION['erros'][] = "Escolha pelo menos uma Plataforma!";
    }elseif(!validPlats($_POST['plats'])){
        $_SESSION['erros'][] = "Fazendo favor não mexe no html.";
    }else{
        $_SESSION['plats'] = $_POST['plats'];
    }


    // AgeRating
    if(!validAge($_POST['ageRating'])){
        $_SESSION['erros'][] = "Escolha uma Classificação etária!";
    }

    
    // Data de Lancamento
    if((strtotime($_POST['date']) > strtotime('01-01-2026') || strtotime($_POST['date']) < strtotime('01-01-1950'))){
        $_SESSION['erros'][] = "Informe uma data Válida!";
        
    }else{
        $_SESSION['date'] = date('Y/m/d',strtotime($_POST['date']));
    }
    
    
    // Inserir
    if(!isset($_SESSION['erros'])){
        JogoDao::insert($_SESSION['name'],$_SESSION['imgURL'],serialize($_SESSION['plats']),$_SESSION['date'],serialize($_SESSION['genres']),$_SESSION['dev'],
        $_SESSION['publisher'],$_SESSION['price'],$_SESSION['ageRating'],$_SESSION['fileSize']);
        $_SESSION['sucesso'] = true;
    }else{
        $_SESSION['sucesso'] = false;
    }

    header('location:index.php');
    

    
    // die;




}else{
    $_SESSION['erros'][] = 'Você acessou o insert.php diretamente!';
    header('location:index.php');
}




// header('location:index.php');

