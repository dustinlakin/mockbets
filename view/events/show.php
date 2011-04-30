<?php

//$events which are arrays of events;
//$json has things that organization for json


?>

<!DOCTYPE html>
<html>
    <head>
        <title><?=$group->name?></title>
        <script type="text/javascript" src="/mockbets/js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript">
            var json = <?=  json_encode($json)?>;
            function select(event,team,type){
                
                var amount = $("#bet_amount").val()
                console.log(amount);
                
                if(type == "ml"){
                    payout = 0;
                    if(json[event][team]["ml"] < 0){
                        odd = Math.abs(json[event][team]["ml"])/100;
                        payout =  odd * amount;
                    }else{
                        odd = 100/Math.abs(json[event][team]["ml"]);
                        payout =  odd * amount;
                    }
                    text = "  On ";
                    text += json[event][team]["name"];
                    text += " to win will pay ";
                    text += payout;
                }
                $("#bet_"+event).html(text);
                
            }
        </script>
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
                    <div class="ml" id="ml_<?=$e->id . "_" . $k?>" onclick="select(<?=$e->id?>,<?=$k?>,'ml')">
                        <?=$arr['ml']?>
                    </div>
                    <?
                    endif;
                    ?>
                    
                    <br/>
                    <?
                    if($arr['ps']):
                        if($arr['ps']>0)
                            $arr['ps'] = "+" . $arr['ml'];
                        ?>
                    <div class="ps" id="ps_<?=$e->id . "_" . $k?>" onclick="select(<?=$e->id?>,<?=$k?>,'ps')">
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
        <div class="bet_helper">
            $ <input type="text" id="bet_amount"/> <span id="bet_<?=$e->id?>"></span>
        </div>
        <?  endforeach;?>
    </body>
</head>