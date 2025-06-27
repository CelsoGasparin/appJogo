<?php

require_once "dao/JogoDao.php";



$games = ['gk'=>['name'=>'Garfield Kart - Furious Racing',
           'img'=>'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1085510/b124a0dbf4fdc5b984268f92921f246ecba04c9c/header.jpg?t=1750323385',
           'plats'=>['wi','p4','ns','x1'],
           'lan'=>'2019-11-06',
           'gens'=>['ce'],
           'dev'=>'Artefacts Studio',
           'pub'=>'Microids',
           'pri'=>'39.99',
           'age'=>'L',
           'file'=>'1.4'],
          'mc'=>['name'=>'Minecraft',
           'img'=>'https://upload.wikimedia.org/wikipedia/en/thumb/b/b6/Minecraft_2024_cover_art.png/250px-Minecraft_2024_cover_art.png',
           'plats'=>['wi','ln'],
           'lan'=>'2009/05/17',
           'gens'=>['so'],
           'dev'=>'Mojang Studios',
           'pub'=>'Mojang Studios',
           'pri'=>'99',
           'age'=>'L',
           'file'=>'1~2.5'],
          'hs'=>['name'=>'Hollow Knight: Silksong',
           'img'=>'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1030300/header.jpg?t=1742776298',
           'plats'=>['wi','ns','n2','p5','p4','xs','ln'],
           'lan'=>'2077/06/17',
           'gens'=>['pl','ad'],
           'dev'=>'Team Cherry',
           'pub'=>'Team Cherry',
           'pri'=>'999',
           'age'=>'12',
           'file'=>'9'],
          'hk'=>['name'=>'Hollow Knight',
           'img'=>'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/367520/header.jpg?t=1695270428',
           'plats'=>['wi','ns','n2','p5','xs','p4','x1','ln'],
           'lan'=>'2017/02/24',
           'gens'=>['pl','ad'],
           'dev'=>'Team Cherry',
           'pub'=>'Team Cherry',
           'pri'=>'46.99',
           'age'=>'L',
           'file'=>'9'],
        'dt'=>['name'=>'DELTARUNE',
           'img'=>'https://imgs.search.brave.com/Erj4wLRjzx3oM0Fu2AObod2zRHSMRkvCYZArTxPBnOc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YXByb3h5LnR2dHJv/cGVzLm9yZy93aWR0/aC8xMjAwL2h0dHBz/Oi8vc3RhdGljLnR2/dHJvcGVzLm9yZy9w/bXdpa2kvcHViL2lt/YWdlcy9kZWx0YXJ1/bmUuanBlZw',
           'plats'=>['wi','ns','n2','p5','p4',],
           'lan'=>'2025/06/04',
           'gens'=>['rp'],
           'dev'=>'tobyfox',
           'pub'=>'tobyfox',
           'pri'=>'73.99',
           'age'=>'14',
           'file'=>'1'],
        'ed'=>['name'=>'ELDEN RING',
           'img'=>'https://imgs.search.brave.com/hhRTO5loei5NwB0ccUITuJ8qC79Wf6RGuX4b3O84FRg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJzLmNvbS9p/bWFnZXMvZmVhdHVy/ZWQvZWxkZW4tcmlu/Zy1waWN0dXJlcy02/cjg1dGgwZ25oaWZz/cWQwLmpwZw',
           'plats'=>['wi','ns','n2','p5','p4',],
           'lan'=>'2022/02/25',
           'gens'=>['aa','rp'],
           'dev'=>'FromSoftware, Inc.',
           'pub'=>'FromSoftware, Inc., Bandai Namco Entertainment',
           'pri'=>'274.50',
           'age'=>'16',
           'file'=>'60']];


if(!isset($_GET['extra'])){
    header('location:index.php');
}else{
    $valid = 0;
    foreach($games as $key => $game){
        if($key==$_GET['extra']){
            $valid++;
        }
    }
    if(!$valid){
        header('location:index.php');
    }
    JogoDao::insert($games[$_GET['extra']]['name'],$games[$_GET['extra']]['img'],serialize($games[$_GET['extra']]['plats']),$games[$_GET['extra']]['lan'],
                    serialize($games[$_GET['extra']]['gens']),$games[$_GET['extra']]['dev'],$games[$_GET['extra']]['pub'],$games[$_GET['extra']]['pri'],
                $games[$_GET['extra']]['age'],$games[$_GET['extra']]['file']);
    header('location:index.php');
}

