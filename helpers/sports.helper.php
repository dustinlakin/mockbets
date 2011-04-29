<?php

function find_sports(){
    $sql = "SELECT * FROM sports";
    $result = mysql_query($sql,  get_link());
    while ($row = mysql_fetch_object($result)) {
        $sports[] = $row;
    }
    return $sports;
}


function find_teams($sport_id){
    $sql = "SELECT * FROM teams WHERE sport_id = $sport_id";
    $result = mysql_query($sql,  get_link());
    while ($row = mysql_fetch_object($result)) {
        $teams[] = $row;
    }
    return $teams;
}

?>
