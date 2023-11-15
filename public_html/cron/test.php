<?php

include '../../inc/db.php';

$ISPORTS_API_KEY = 'gC0EEJyGzvvhXqQc';

$url = 'http://api.isportsapi.com/sport/football/livescores?api_key='.$ISPORTS_API_KEY;
// $url= asset('data/league_games2.js');
$json_data = file_get_contents($url);
$array = json_decode($json_data, true);

// echo $json_data;
// exit;
$data = $array['data'];

$all_array = array();

foreach($data as $item){
    $matchId = $item['matchId'].'<br/>';


    $check = mysqli_query($link,"SELECT `status` FROM `games` WHERE `matchId`='".$matchId."'");

    if(mysqli_num_rows($check)==0){
        $all_array[] = "INSERT INTO `games` SET 
            `matchId`='".$item['matchId']."',
            `leagueId`='".$item['leagueId']."',
            `leagueType`='".$item['leagueType']."',
            `leagueName`='".$item['leagueName']."',
            `leagueShortName`='".$item['leagueShortName']."',
            `leagueColor`='".$item['leagueColor']."',
            `matchTime`='".$item['matchTime']."',
            `status`='".$item['status']."',
            `homeName`='".$item['homeName']."',
            `awayName`='".$item['awayName']."',
            `homeScore`='".$item['homeScore']."',
            `awayScore`='".$item['awayScore']."',
            `neutral`='".$item['neutral']."' 
        ";


    }else{
        $array_games = mysqli_fetch_array($check);
        $status = $array_games['status'];
        if($status>0) {
            echo 'update';
            $all_array[] =
                "UPDATE `games` SET 
                
                `matchTime`='" . $item['matchTime'] . "',
                `status`='" . $item['status'] . "',
                `homeScore`='" . $item['homeScore'] . "',
                `awayScore`='" . $item['awayScore'] . "'
                WHERE  `matchId`='" . $matchId . "'
             ";
        }
    }


}

//print_r($all_array);
foreach($all_array as $array_value){
    mysqli_query($link, $array_value);
    mysqli_error($link);
}
