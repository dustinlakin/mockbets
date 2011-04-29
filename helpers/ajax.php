<?php
//figure out what they want;
require_once '../helpers/db.php';
require_once 'sports.helper.php';

//get action
switch($_GET['action']){
    case "json_teams":
        $id = mysql_real_escape_string($_GET['id'], get_link());
        get_json_teams($id);
        break;
}

function get_json_teams($sport_id){
    $teams = find_teams($sport_id);
    echo json_encode($teams);
}

?>
