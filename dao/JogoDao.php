<?php
require_once __DIR__."/../util/Connection.php";

class JogoDao{

    
    public static function insert($nam,$imgURL,$plats,$lan,$gens,$dev,$pub,$pri,$ageR,$fileSize){
        try{
            $sql = "INSERT INTO jogo(nome,imgURL,plataformas,lancamento,generos,desenvolvedor,publisher,preco,ageRating,fileSize) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stm = Connection::getConn()->prepare($sql);
            $stm->execute([$nam,$imgURL,$plats,$lan,$gens,$dev,$pub,$pri,$ageR,$fileSize]);
            return true;
        }catch(Exception $e) {
            print $e;
            return false;
        }
    }
    public static function delete($chave,$condicao = 'id'){
        $sql = "DELETE FROM jogo WHERE $condicao = ?";
        $stm = Connection::getConn()->prepare($sql);
        $stm->execute([$chave]);
    }
    public static function listarJogos(string $string = '*'){
        $sql = "SELECT $string FROM jogo";
        $stm = Connection::getConn()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
    public static function buscarJogo($chave,$condicao = 'id'){
        $sql = "SELECT * FROM jogo WHERE $condicao = ? ";
        $stm = Connection::getConn()->prepare($sql);
        $stm->execute([$chave]);
        return $stm->fetch();
    }


}