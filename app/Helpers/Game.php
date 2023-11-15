<?php // Code within app\Helpers\Date.php

namespace App\Helpers;


class Game
{

    public static  function eventName($type){

        $array = [
            1=> '<i class="fas fa-futbol" style="color:red"></i>',
            2=> '<span class="red-card">&nbsp;&nbsp;</span>',
            3=> '<span class="yellow-card">&nbsp;&nbsp;</span>',
            7=> 'Penalty scored',
            8=> 'Own goal',
            9=> 'Second yellow card',
            11=> 'Substitution',
            13=> 'Penalty missed '
        ];
        return $array[$type];

    }

    public static function gameTime($status, $halfStartTime, $time){
        $status_text = '';

        // 0: Not started
        // 1: First half
        // 2: Half-time break
        // 3: Second half
        // 4: Extra time
        // 5: Penalty
        // -1: Finished
        // -10: Cancelled
        // -11: TBD
        // -12: Terminated
        // -13: Interrupted
        // -14: Postponed

        if($status==0)$status_text = date('H:i', $time);
        if($status==-1)$status_text = '<span class="game-time-finished">F</span>'.date('d/m H:i', $time);
        if($status==-10)$status_text = 'C'.date('d/m H:i', $time);
        if($status==-11)$status_text = 'TBD'.date('d/m H:i', $time);
        if($status==-12)$status_text = 'T'.date('d/m H:i', $time);
        if($status==-13)$status_text = 'I'.date('d/m H:i', $time);
        if($status==-14)$status_text = 'P'.date('d/m H:i', $time);
        if($status==-2)$status_text = 'No info'.date('d/m H:i', $time);
        if($status==2)$status_text = '<span class="game-time-ht">HT</span>';

        $min = floor((time() - $time)/60);
        if($status==3){
            $min = 45+floor((time() - $halfStartTime)/60);
        }
        if($min>90)$min = '90+';
        if($min==0)$min=1;
        if($status==1){
            $status_text = '<span class="game-time-live">'.$min.'<span class="blink">\'</span></span>';
        }
        if($status==3){
            $status_text = '<span class="game-time-live">'.$min.'<span class="blink">\'</span></span>';
        }
        if($status==4){
            $status_text = '<span class="game-time-live">Ex<span class="blink">\'</span></span>';
        }
        if($status==5){
            $status_text = '<span class="game-time-live">Pen<span class="blink">\'</span></span>';
        }
        return $status_text;
    }



    public static function positionName($formation, $position){
        //If the Formation has no data, all the Position return 0.

        //  If the Formation returns 3 columns:
        //0: Goalkeeper
        //1: Defender
        //2: Midfielder
        //3: Forward

        //  If the Formation returns 4 columns:
        //0: Goalkeeper
        //1: Defender
        //2: Defending midfielder
        //3: Attacking midfielder
        //4: Forward

        //  If the Formation returns 5 columns:
        //0: Goalkeeper
        //1: Defender
        //2: Defending midfielder
        //3: Midfielder
        //4: Attacking midfielder
        //5: Forward

        $text = '';
        if(strlen($formation)==3){
            if($position==0)$text = 'Goalkeeper';
            if($position==1)$text = 'Defender';
            if($position==2)$text = 'Midfielder';
            if($position==3)$text = 'Forward';
        }

        if(strlen($formation)==4){
            if($position==0)$text = 'Goalkeeper';
            if($position==1)$text = 'Defender';
            if($position==2)$text = 'Defending midfielder';
            if($position==3)$text = 'Attacking midfielder';
            if($position==4)$text = 'Forward';
        }
        if(strlen($formation)==4){
            if($position==0)$text = 'Goalkeeper';
            if($position==1)$text = 'Defender';
            if($position==2)$text = 'Defending midfielder';
            if($position==3)$text = 'Midfielder';
            if($position==4)$text = 'Attacking midfielder';
            if($position==5)$text = 'Forward';
        }

        return $text;
    }

    public static function getLeaguePos($id){
        $array = [111=>80,122=>91,133=>91,144=>80,188=>99,199=>50,1112=>97,1314=>89,1718=>80,1224=>80,1325=>50,1527=>80,1628=>80,1033=>89,1134=>99,1336=>50,1437=>90,1538=>80,1639=>100,1730=>98,1932=>89,1145=>88,1055=>50,1156=>99,1459=>80,1066=>90,1763=>99,1965=>80,1370=>50,1673=>80,1875=>20,1189=>99,1381=>90,1482=>98,1886=>99,1099=>99,1392=>98,13014=>102,19010=>100,13115=>99,14419=>80,16411=>80,13610=>50,17614=>60,16714=>60,12912=>90,13025=>50,17029=>40,15128=>70,19122=>50,19728=>50,17928=>89,18929=>80,13036=>89,16332=>89,15836=>99,14341=>20,16747=>20,13250=>70,16657=>80,18468=>97,10561=>99,11562=>97,12563=>98,13968=>10,13171=>80,14374=>20,13777=>50,12383=>30,162110=>40,190212=>40,185216=>80,106219=>80,158216=>85,299211=>98,172313=>20,166316=>87,133411=>80,138517=>80,299514=>80,171615=>90,146819=>999];
        if (array_key_exists($id, $array)) {
            return $array[$id];
        }else{
            return 0;
        }
    }
    
}