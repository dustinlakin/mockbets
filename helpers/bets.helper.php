<?php

function find_bets_by_sport($sport_id){
    
    $sql = "SELECT e.*, s.name as sport
            FROM events e, sports s
            WHERE e.sport_id = $sport_id AND e.sport_id = s.id";
    $result = mysql_query($sql,  get_link());

    while ($row = mysql_fetch_object($result)) {
        $event = new event();
        $event->load_data($row);
        $event->load_bets();
        $events[$event->id] = $event;
    }

    return $events;
}

function find_bets_by_group($group_id){

    $sub_query = "SELECT sport_id as id FROM sports_for_groups WHERE group_id = $group_id";

    $sql = "SELECT e.*, s.name as sport
            FROM events e, sports s
            WHERE e.sport_id = s.id AND e.bet_by > NOW() AND e.sport_id IN ($sub_query)";
    $result = mysql_query($sql,  get_link());

    while ($row = mysql_fetch_object($result)) {
        $event = new event();
        $event->load_data($row);
        $event->load_bets();
        $events[$event->id] = $event;
    }

    return $events;
}
?>
