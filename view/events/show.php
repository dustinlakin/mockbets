<?php

//$events which are arrays of events;


?>

<!DOCTYPE html>
<html>
    <head>
        <title><?=$group->name?></title>
        <script type="text/javascript" src="/mockbets/js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript"></script>
        <link href="/mockbets/css/events.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <?  foreach ($events as $e):?>
        <div class="event">
            <div class="event_info"><?=$e->name?></div>
            <ul class="teams">
            <?foreach($e->teams as $k=>$arr):?>
                <li class="team">
                    <div class="team_name">
                        <?=$arr['name']?><?=($arr['city'] ? " (".$arr['city'].")": "")?><br/>
                    </div>
                    <?
                    if($arr['ml']){
                        if($arr['ml']>0){
                            echo "+";
                        }
                        echo $arr['ml'];
                    }
                    ?><br/>
                    <?
                    if($arr['ps']){
                        if($arr['ps']>0){
                            echo "+";
                        }
                        echo $arr['ps'];
                    }
                    ?>

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
        <?  endforeach;?>
    </body>
</head>