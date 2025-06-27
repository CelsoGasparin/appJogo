<?php

require_once "dao/JogoDao.php";
require_once "model/Jogo.php";

function nullSession(){
    $session=[];
    if($_SESSION!==[]){
        foreach($_SESSION as $key => $sess){
            if($key != 'erros'){
                $session[] = $sess;
            }
        }
    }
    return $session!==[];
}






session_start();

// die;
$erros = [];
if(nullSession() && !$_SESSION['sucesso']){
    $name = $_SESSION['name'];
    $imgURL = $_SESSION['imgURL'];
    $dev = $_SESSION['dev'];
    $publisher = $_SESSION['publisher'];
    $price = $_SESSION['price'];
    $genres = $_SESSION['genres'];
    $plats = $_SESSION['plats'];
    $fileSize = $_SESSION['fileSize'];
    $ageRating = $_SESSION['ageRating'];
    $data = $_SESSION['date'];
}else{
    $name = null;
    $imgURL = null;
    $dev = null;
    $publisher = null;
    $price = null;
    $genres = [];
    $plats = [];
    $fileSize = null;
    $ageRating = null;
    $data = null;
    
}
if(isset($_SESSION['erros'])){
    $erros = $_SESSION['erros'];
}
session_destroy();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formPhp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>


    


    <button style="background-color: #fcbc41;" class="btn float-end" data-bs-toggle="modal" data-bs-target="#extras" id="toggleMenu">
        <!-- Não sei oque isso significa mas funciona -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"></path>
        </svg>
    </button>

    <div class="container-fluid bg-dark" >
        <div class="row">
            <div class="row justify-content-center mt-5">
                <div class="card col-8" style="border-radius: 50px;">
                    
                    <div class="card-body" >
                        
                        <div class="row col-12 d-flex justify-content-center align-items-center">

                            <table style="width: 110vh;">
                                <tr>
                                    <th style="width: 10vh;" class="text-center texto">ID</th>
                                    <th style="width: 13vh;" class="text-center texto">Imagem</th>
                                    <th class="text-center texto">Nome</th>
                                    <th class="text-center texto">Preço</th>
                                    <th class="text-center texto">Arquivo</th>
                                    <th style="width: 8vh;" class="text-center verM">Ver Mais</th>
                                    <th style="width: 9vh;" class="text-center DELETE">DELETE</th>
    
                                </tr>
                                <?php 
                                foreach(JogoDao::listarJogos() as $key => $jogo){
                                    $actualJogo = Jogo::dataToObject($jogo);
                                    print $actualJogo->stringTable();
                                }
                                ?>
                                
                            </table>
    
                            <form action="insert.php" method="post">
                                <div class="alerts" style="display:<?php $erros!==[]? 'block' :'none'; ?>;background-color:red;border-radius:10px;text-align:center;width:30vh;">
                                    <?=join('<br>',$erros);?>
                                </div>
                        
                        
                                <label for="name" class="mt-5">Nome:</label>
                                <input style="margin-left:1vh;width: 65vh;border-radius:10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);"type="text" id="name" name="name" value="<?= $name ?>"><br><br>
                        
                                <label for="imgURL">Url da imagem:</label>
                                <input style="margin-left:1vh;width: 65vh;border-radius:10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="url" id="imgURL" name="imgURL" value="<?= $imgURL ?>"><br><br>
                        
                                <label for="dev">Developer:</label>
                                <input style="margin-left:1vh;width: 65vh;border-radius:10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="text" id="dev" name="dev" value="<?= $dev ?>"><br><br>
                        
                                <label for="publisher">Publisher:</label>
                                <input style="margin-left:1vh;width: 65vh;border-radius:10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="text" id="publisher" name="publisher" value="<?= $publisher ?>"><br><br>
                        
                                <label for="price">Preço: R$</label>
                                <input style="margin-left:1vh;width: 10vh;border-radius:10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="number" id="price" name="price" min="0" step="0.05" max="500" value="<?= $price ?>"><br><br>
                        
                                <h3 class="texto">Gêneros:</h3>
                                <div>
                                    <label><input type="checkbox" name="genres[]" value="ad"<?= in_array('ad',$genres) ? 'checked' : null ?>> Aventura</label><br>
                                    <label><input type="checkbox" name="genres[]" value="aa"<?= in_array('aa',$genres) ? 'checked' : null ?>> Ação-Aventura</label><br>
                                    <label><input type="checkbox" name="genres[]" value="ti"<?= in_array('ti',$genres) ? 'checked' : null ?>> Tiro</label><br>
                                    <label><input type="checkbox" name="genres[]" value="hs"<?= in_array('hs',$genres) ? 'checked' : null ?>> Hack-N-Slash</label><br>
                                    <label><input type="checkbox" name="genres[]" value="bu"<?= in_array('bu',$genres) ? 'checked' : null ?>> Beat-em-up</label><br>
                                    <label><input type="checkbox" name="genres[]" value="pl"<?= in_array('pl',$genres) ? 'checked' : null ?>> Plataforma</label><br>
                                    <label><input type="checkbox" name="genres[]" value="rp"<?= in_array('rp',$genres) ? 'checked' : null ?>> RPG</label><br>
                                    <label><input type="checkbox" name="genres[]" value="lu"<?= in_array('lu',$genres) ? 'checked' : null ?>> Luta</label><br>
                                    <label><input type="checkbox" name="genres[]" value="st"<?= in_array('st',$genres) ? 'checked' : null ?>> Stealth</label><br>
                                    <label><input type="checkbox" name="genres[]" value="so"<?= in_array('so',$genres) ? 'checked' : null ?>> Sobrevivência</label><br>
                                    <label><input type="checkbox" name="genres[]" value="pu"<?= in_array('pu',$genres) ? 'checked' : null ?>> Puzzle</label><br>
                                    <label><input type="checkbox" name="genres[]" value="es"<?= in_array('es',$genres) ? 'checked' : null ?>> Estratégia</label><br>
                                    <label><input type="checkbox" name="genres[]" value="si"<?= in_array('si',$genres) ? 'checked' : null ?>> Simulação</label><br>
                                    <label><input type="checkbox" name="genres[]" value="ce"<?= in_array('ce',$genres) ? 'checked' : null ?>> Corrida/Esportes</label>
                                </div>
                        
                        
                                <br><br>
                        
                                <h3 class="texto">Plataformas:</h3>
                                <div>
                                    <label><input type="checkbox" name="plats[]" value="wi"<?= in_array('wi',$plats) ? 'checked' : null ?>> Windows</label><br>
                                    <label><input type="checkbox" name="plats[]" value="p4"<?= in_array('p4',$plats) ? 'checked' : null ?>> PlayStation 4</label><br>
                                    <label><input type="checkbox" name="plats[]" value="p5"<?= in_array('p5',$plats) ? 'checked' : null ?>> PlayStation 5</label><br>
                                    <label><input type="checkbox" name="plats[]" value="x1"<?= in_array('x1',$plats) ? 'checked' : null ?>> Xbox One</label><br>
                                    <label><input type="checkbox" name="plats[]" value="xs"<?= in_array('xs',$plats) ? 'checked' : null ?>> Xbox Series X/S</label><br>
                                    <label><input type="checkbox" name="plats[]" value="ns"<?= in_array('ns',$plats) ? 'checked' : null ?>> Nintendo Switch</label><br>
                                    <label><input type="checkbox" name="plats[]" value="n2"<?= in_array('n2',$plats) ? 'checked' : null ?>> Nintendo Switch 2</label><br>
                                    <label><input type="checkbox" name="plats[]" value="mo"<?= in_array('mo',$plats) ? 'checked' : null ?>> Mobile</label><br>
                                    <label><input type="checkbox" name="plats[]" value="ln"<?= in_array('ln',$plats) ? 'checked' : null ?>> Linux</label><br>
                                    
                                </div>
                         
                                <br><br>
                        
                                <label for="fileSize">Tamanho dos Arquivos(em GB):</label>
                                <input style="margin-left:1vh;border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="number" id="fileSize" name="fileSize" min="0" step="0.1" placeholder="GigaBytes" max="999" value="<?= $fileSize ?>"><br><br>
                        
                                <label for="ageRating">Classificação etária:</label>
                                <select style="margin-left:1vh;border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" name="ageRating" id="ageRating">
                                    <option value="" <?=$ageRating==""?'selected':null?>>--</option>
                                    <option value="L"<?=$ageRating=="L"?'selected':null?>>Livre</option>
                                    <option value="10"<?=$ageRating=="10"?'selected':null?>>10</option>
                                    <option value="12"<?=$ageRating=="12"?'selected':null?>>12</option>
                                    <option value="14"<?=$ageRating=="14"?'selected':null?>>14</option>
                                    <option value="16"<?=$ageRating=="16"?'selected':null?>>16</option>
                                    <option value="18"<?=$ageRating=="18"?'selected':null?>>18</option>
                                </select><br><br>
                        
                                <label for="date">Data de Lançamento</label>
                                <input class="mb-5" style="margin-left:1vh;border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="date" name="date" id="date" min="01-01-1950" max="01-01-2026" value="<?= $data ?>">
                                <br><br>
                                <button style="position:absolute;left:30%;top:98%;border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);width: 65vh;" type="submit">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    
    foreach(JogoDao::listarJogos() as $jogo){
        $actualJogo = Jogo::dataToObject($jogo);
        print $actualJogo->stringModal();
    }
    
    
    ?>
    </div>
    <div class="modal fade" id="extras" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#fcbc41;">
                <!-- <div class="modal-header">
                    <h1 class="textoB modal-title fs-5 text-center" id="exampleModalLabel">EXTRAS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="modal-body" >

                    <h1 class="textoB text-center">EXTRAS</h1>      
                    <br>
                    <form action="extraGames.php" method="get">
    
                        <label for="extra"><h3 class="textoB">Escolha um Jogo:</h3></label>
                        <select style="width: 14vh;margin-left:1vh;border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" name="extra" id="extra">
                            <option value="">--</option>
                            <option value="gk">Garfield Kart - Furious Racing</option>
                            <option value="mc">Minecraft</option>
                            <option value="hs">Hollow Knight: Silksong</option>
                            <option value="hk">Hollow Knight</option>
                            <option value="dt">DELTARUNE</option>
                            <option value="ed">ELDEN RING</option>
                        </select>

                        <button style="border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="submit">Executar</button>
                    </form>

                    <form action="card.php" method="get">
                        

                        
                        <label for="cardsID"><h3 class="textoB">Abrir Card:</h3></label>
                        <select style="width: 14vh;margin-left:1vh;border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" name="cardsID" id="cardsID">
                            <option value="">--</option>
                            <?php 
                            foreach(JogoDao::listarJogos('id') as $id){
                                print "<option value='{$id['id']}'>ID-{$id['id']}</option>";
                            }

                            ?>
                        </select>
                        <button style="border-radius: 10px;border:rgb(220, 249, 255) 1px solid;background-color:black;color:rgb(220, 249, 255);" type="submit">Redirecionar</button>
                    </form>
                    <br>
                    <label for="verMlegal"><h4 class="textoB">Ver Mais-MODAL:</h4></label>
                    <input style="width: 10vh;" type="radio" value="0" name="verMlegal" id="verMlegal">
                    <br>
                    <label for="verMlegal"><h4 class="textoB">Ver Mais-CARD:</h4></label>
                    <input style="width:15.3vh;" type="radio" value="1" name="verMlegal" id="verMlegal">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <script>

        // setTim
        // eout(()=>{

        var ids = document.querySelectorAll('.idSilva');
        var verBotao = document.querySelectorAll('.verMbutton');
        
        



        botaoChange();



        document.querySelectorAll("#verMlegal").forEach(element=>{
            element.addEventListener('click',()=>{
                localStorage.setItem('verMlegal',document.querySelector('input[name="verMlegal"]:checked').value);
                botaoChange();
            })
        });


           
            

        // },300);
        function botaoChange(){
            var ids = document.querySelectorAll('.idSilva');
            var verBotao = document.querySelectorAll('.verMbutton');
            if(localStorage.getItem('verMlegal')==1){
                document.querySelector('.verM').style.color = '#fcbc41';
                document.querySelectorAll('#verMlegal')[1].checked = true;
                for(let index = 0; index < ids.length; index++){
                    verBotao[index].style.backgroundColor = '#fcbc41';
                    verBotao[index].innerHTML = '<a href="card.php?cardsID='+ ids[index].innerText +'" style="color:black;font-size:20px;" class="textoB">Ver Mais</a>';
                    
                }
            }else{
                document.querySelector('.verM').style.color = 'rgb(55, 255, 0)';
                document.querySelectorAll('#verMlegal')[0].checked = true;
                for(let index = 0; index < ids.length; index++){
                    verBotao[index].style.backgroundColor = 'rgb(55, 255, 0)';
                    verBotao[index].innerHTML = '<p style="color:black;" class="textoB">Ver Mais</p>';
                    
                }
            }
        }

        

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
