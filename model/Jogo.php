<?php

class Jogo{
    private $id;
    private $name;
    private $img;
    private $plataformas;
    private $lancamento;
    private $gens;
    private $desenvolvedor;
    private $publisher;
    private $price;
    private $ageRating;
    private $fileSize;

    public function __construct($nam,$img,$plat,$lan,$gs,$dev,$pub,$pri,$ageR,$fS,$id){
        $this->name = $nam;
        $this->img = $img;
        $this->plataformas = $plat;
        $this->lancamento = $lan;
        $this->gens = $gs;
        $this->desenvolvedor = $dev;
        $this->publisher = $pub;
        $this->price = $pri;
        $this->ageRating = $ageR;
        $this->fileSize = $fS;
        $this->id = $id;
        
    }
    public function stringTable(){
        return'<tr>
            <td class="text-center texto idSilva">'.$this->id.'</td>
            <td><img src="'.$this->img.'" style="width: 12.5vh;height:20vh" alt="erro"></td>
            <td class="text-center texto">'.$this->name.'</td>
            <td class="text-center texto">R$'.$this->price.'</td>
            <td class="text-center texto">'.$this->fileSize.'GB</td>
            <td><button data-bs-toggle="modal" data-bs-target="#detalhes'.$this->id.'" class="verMbutton"><p style="color:black;" class="textoB">Ver Mais</p></button></td>
            <td><button class="DELETEbutton"><a href="delete.php?id='.$this->id.'" onclick="return confirm(\'Confirma a Exclusão?\')" style="color:black;">DELETE</a></button></td>
        </tr>';

    }
    public function stringModal(){
        $genres = $this->checkGenres();
        $plats = $this->checkPlats();
        if($this->ageRating == 'L'){
            $ageCor = '#0f9142';
        }elseif($this->ageRating == "10"){
            $ageCor = '#057dc0';
        }elseif($this->ageRating == "12"){
            $ageCor = '#fbc134';
        }elseif($this->ageRating == "14"){
            $ageCor = '#ea7828';
        }elseif($this->ageRating == "16"){
            $ageCor = '#d52922';
        }elseif($this->ageRating == "18"){
            $ageCor = '#1e1819';
        }

        return'<div class="modal fade" id="detalhes'.$this->id.'" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: black;">
                <div class="modal-header">
                    <h1 class="texto modal-title fs-5" id="exampleModalLabel">'.$this->name.' - Detalhes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >

                    <img style="width:100%;" src="'.$this->img.'" alt="erroSilva">
                    <h3 class="texto text-center">'.$this->name.'</h3>
                    <br>
                    <p class="texto">Preço: R$'.$this->price.'</p>
                    <br>
                    <p class="texto">Desenvolvedores: '.$this->desenvolvedor.'</p>
                    <br>
                    <p class="texto">Publisher: '.$this->publisher.'</p>
                    <br>
                    <p class="texto">Data de Lançamento: '.$this->lancamento.'</p>
                    <br>
                    <p class="texto">Gêneros: <br>-'. join('<br>-',$genres) .'</p>
                    <br>
                    <p class="texto">Plataformas: <br>-'. join('<br>-',$plats) .'</p>
                    <br>
                    <p class="texto">Tamanho do Arquivo: '. $this->fileSize .'GB</p>
                    <br>
                    <p class="texto">Classificação etária: <b style="background-color: '. $ageCor .';border: 0.5px solid white;color: white;" >'.$this->ageRating.'</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>';
    }
    public function stringCard(){
        $genres = $this->checkGenres();
        $plats = $this->checkPlats();
        if($this->ageRating == 'L'){
            $ageCor = '#0f9142';
        }elseif($this->ageRating == "10"){
            $ageCor = '#057dc0';
        }elseif($this->ageRating == "12"){
            $ageCor = '#fbc134';
        }elseif($this->ageRating == "14"){
            $ageCor = '#ea7828';
        }elseif($this->ageRating == "16"){
            $ageCor = '#d52922';
        }elseif($this->ageRating == "18"){
            $ageCor = '#1e1819';
        }
        return '<div class="container-fluid bg-dark">
        <div class="row">
            <div class="row justify-content-center mt-5">
                <div class="card col-4" style="border-radius: 50px;">
                    <div class="card-body">
                        <div class="row col-12 d-flex justify-content-center align-items-center">
                            <h1 class="texto text-center">'.$this->name.' - Detalhes</h1>
                            <img style="width:100%;" src="'.$this->img.'" alt="ImagemNãoFoiDaSilva">
                            <h1 class="texto text-center">'.$this->name.'</h1>
                            <br>
                            <h4 class="texto mb-4">Preço: R$'.$this->price.'</h4>
                            <br>
                            <h4 class="texto mb-4">Desenvolvedores: '.$this->desenvolvedor.'</h4>
                            <br>
                            <h4 class="texto mb-4">Publisher: '.$this->publisher.'</h4>
                            <br>
                            <h4 class="texto mb-4">Data de Lançamento: '.$this->lancamento.'</h4>
                            <br>
                            <h4 class="texto mb-4">Gêneros: <br>-'. join('<br>-',$genres) .'</h4>
                            <br>
                            <h4 class="texto mb-4">Plataformas: <br>-'. join('<br>-',$plats) .'</h4>
                            <br>
                            <h4 class="texto mb-4">Tamanho do Arquivo: '. $this->fileSize .'GB</h4>
                            <br>
                            <h4 class="texto mb-4">Classificação etária: <b style="background-color: '. $ageCor .';border: 0.5px solid white;color: white;" >'.$this->ageRating.'</b></h4>
                            <button class="btn btn-danger" style="width:10vh;border-radius:10px;"><a class="texto" href="index.php">Voltar</a></button>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

    private function checkGenres(){
        $allGenres = [
        'ad'=>'Aventura','aa'=>'Ação-Aventura',
        'ti'=>'Tiro','hs'=>'Hack-N-Slash',
        'bu'=>'Beat-em-Up','pl'=>'Plataforma',
        'rp'=>'RPG','lu'=>'Luta',
        'st'=>'Stealth','so'=>'Sobrevivência',
        'pu'=>'Puzzle','es'=>'Estratégia',
        'si'=>'Simulação','ce'=>'Corrida/Esportes'
        ];
        $actualGens = [];
        foreach($this->gens as $gen){
            $actualGens[] = $allGenres[$gen];
        }
        return $actualGens;
    }
    private function checkPlats(){
        $allPlats = [
            'wi'=>'Windows','p4'=>'PlayStation4',
            'p5'=>'PlayStation5','x1'=>'Xbox One',
            'xs'=>'Xbox Series X/S','ns'=>'Nintendo Switch',
            'n2'=>'Nintendo Switch 2','mo'=>'Mobile',
            'ln'=>'Linux'
        ];
        $actualPlats = [];
        foreach($this->plataformas as $plataforma){
            $actualPlats[] = $allPlats[$plataforma];
        }
        return $actualPlats;
    }

    public static function dataToObject(array $jogo){
        $nam = $jogo['nome'];
        $img = $jogo['imgURL'];
        $plat = unserialize($jogo['plataformas']);
        $lan = $jogo['lancamento'];
        $gs = unserialize($jogo['generos']);
        $dev = $jogo['desenvolvedor'];
        $pub = $jogo['publisher'];
        $pri = $jogo['preco'];
        $ageR = $jogo['ageRating'];
        $fS = $jogo['fileSize'];
        $id = $jogo['id'];
        return new Jogo($nam,$img,$plat,$lan,$gs,$dev,$pub,$pri,$ageR,$fS,$id);
    }

}