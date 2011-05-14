<?php
//$events which are arrays of events;
//$json has things that organization for json


$title = $group->name ." Bets";
$scripts = array("jquery","betting");
$styles = array("css/events.css");

?>




<!DOCTYPE html>
<html>
    <head>
        <title><?=$group->name?></title>
        
        <script type="text/javascript" src="/mockbets/js/jquery-1.5.2.min.js"></script>
        
        <script type="text/javascript" src="/mockbets/js/betting.js"></script>
        
        <link href="/mockbets/css/events.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <?foreach ($events as $e):?>
        <div class="event">
            <div class="event_info"><?=$e->name?></div>
            <ul class="teams">
            <?foreach($e->teams as $k=>$arr):?>
                <li class="team">
                    <div class="team_name">
                        <?=$arr['name']?><?=($arr['city'] ? " (".$arr['city'].")": "")?><br/>
                    </div>
                    <?
                    if($arr['ml']):
                        if($arr['ml']>0)
                            $arr['ml'] = "+" . $arr['ml'];
                        ?>
                    <div class="ml" id="ml_<?=$e->id . "_" . $k?>" onclick="select_bet(<?=$e->id?>,<?=$k?>,'ml')">
                        <?=$arr['ml']?>
                    </div>
                    <?
                    endif;
                    ?>
                    
                    <br/>
                    <?
                    if($arr['ps']):
                        if($arr['ps']>0)
                            $arr['ps'] = "+" . $arr['ps'];
                        ?>
                    <div class="ps" id="ps_<?=$e->id . "_" . $k?>" onclick="select_bet(<?=$e->id?>,<?=$k?>,'ps')">
                        <?=$arr['ps']?>
                    </div>
                    <?
                    endif;?>
                </li>
            <?endforeach;?>
            </ul>
            <?if($e->over_under):?>
            <div class="over_under">
                Over <?=$e->over_under['points']?>(<?=$e->over_under['over']?>) 
                Under <?=$e->over_under['points']?>(<?=$e->over_under['under']?>)
            </div>
            <?endif;?>
        </div>
        <div id="bet_helper_<?=$e->id?>" class="bet_helper">
            $ <input type="text" class="bet_amount" id="bet_amount_<?=$e->id?>"/> <span id="bet_<?=$e->id?>"></span>
        </div>
        <?  endforeach;?>
        
        <? include_js()?>
        <script type="text/javascript">
            var json = <?=  json_encode($json)?>;
            var current_bets = new Array();
            //add events;
            $(document).ready(function(){
                $(".bet_amount").keyup(function(){
                    event = $(this).attr('id');
                    event = parseInt(event.replace("bet_amount_",""));
                    if(current_bets && current_bets[event]){
                        select_bet(current_bets[event].Event,current_bets[event].Team,current_bets[event].Type);
                    }
                })
            });
            
        </script>
    </body>
</head>