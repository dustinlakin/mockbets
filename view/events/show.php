<?php
//$events which are arrays of events;
//$json has things that organization for json


$title = $group->name ." Bets";
$scripts = array("jquery","betting");
$styles = array("css/events.css");

require_once 'view/heading.php';
?>
        <?foreach ($events as $e):?>
        <div class="event">
            <div class="event_info"><?=$e->name?></div>
            <ul class="teams">
            <?foreach($e->teams as $k=>$arr):?>
                <li class="team">
                    <div class="team_name">
                        <?=$arr['name']?><?=($arr['city'] ? " (".$arr['city'].")": "")?><br/>
                    </div>
                    
                    <!-- moneyline -->
                    <?if($arr['ml']):
                        if($arr['ml']>0)
                            $arr['ml'] = "+" . $arr['ml'];?>
                    <div class="ml" id="ml_<?=$e->id . "_" . $k?>" onclick="select_bet(<?=$e->id?>,<?=$k?>,'ml')">
                        <?=$arr['ml']?>
                    </div>
                    <?endif;?>
                    <!-- end moneyline -->
                    
                    
                    <!-- start point spread -->
                    <br/>
                    <?if($arr['ps']):
                        if($arr['ps']>0)
                            $arr['ps'] = "+" . $arr['ps'];?>
                    <div class="ps" id="ps_<?=$e->id . "_" . $k?>" onclick="select_bet(<?=$e->id?>,<?=$k?>,'ps')">
                        <?=$arr['ps']?>
                    </div>
                    <?endif;?>
                    <!-- end point spread -->
                    
                </li>
            <?endforeach;?>
            </ul>
            
            <!-- over-under options -->
            <?if($e->over_under):?>
            <div class="over_under">
                Over <?=$e->over_under['points']?>(<?=$e->over_under['over']?>) 
                Under <?=$e->over_under['points']?>(<?=$e->over_under['under']?>)
            </div>
            <?endif;?>
            <!-- end over-under -->
            
        </div>

        <!-- bet helpers -->
        <div id="bet_helper_<?=$e->id?>" class="bet_helper">
            $ <input type="text" class="bet_amount" id="bet_amount_<?=$e->id?>"/> <span id="bet_<?=$e->id?>"></span>
        </div>
        <!-- end bet helper -->
        <?endforeach;?>
        
        <? include_js($scripts)?>
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
<?require_once 'view/footer.php';?>