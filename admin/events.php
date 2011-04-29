<?php
require_once '../helpers/db.php';
require_once '../helpers/sports.helper.php';
require_once '../classes/event.class.php';

if($_POST){
    print_r($_POST);
    $e = new event();
    $e->create_event($_POST);
}else{
    $sports = find_sports();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>create new event</title>
        
    </head>
    <body>

        <form action="events.php" method="POST">
        Create an event.<br/>
        <select id="sport" name="sport" onchange="sport_select()">
            <option>SPORT</option>
            <?foreach($sports as $s):?>
                <option value="<?=$s->id?>"><?=$s->name?></option>
            <?endforeach;?>
        </select>
<br/><br/><br/>
        event name<input type="text" name="event_name"/><br/>
        desc<textarea name="desc"></textarea><br/>
        event day/time<input type="text" name="event_date"/><br/>
        bet by <input type="text" name="bet_by"/><br/><br/>

        <select id="team1" name="team1">
        </select><br/>

        Money Line<input type="text" name="team1_ml"/><br/>
        Point Spread<input type="text" name="team1_ps"/><br/><br/>

        <select id="team2" name="team2">
        </select><br/>

        Money Line<input type="text" name="team2_ml"/><br/>
        Point Spread<input type="text" name="team2_ps"/><br/><br/>

        Over Under<br/>
        Points<input type="text" name="ou_points"/><br/>
        Over odd<input type="text" name="over"/><br/>
        Under odd<input type="text" name="under"/><br/><br/>

        <input type="submit">
    </form>


        <script type="text/javascript" src="../js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript">
            function sport_select(){
                $.getJSON("../helpers/ajax.php", 
                {
                    action: "json_teams",
                    id: $("#sport").val()
                },
                function(data){
                    var html = "";
                    for (var i in data) {
                        html += '<option value="'+ data[i].id+'">'+data[i].name;
                        if(data[i].city != ""){
                            html+= ' ('+ data[i].city + ')';
                        }
                        html+= '</option>';
                    }
                    $("#team1").html(html);
                    $("#team2").html(html);
                })
            }
        </script>
    </body>
</html>
<?}?>