<?php
session_start();
require_once 'helpers/db.php';
require_once 'helpers/bets.helper.php';
require_once 'classes/user.class.php';
require_once 'classes/group.class.php';
require_once 'classes/standings.class.php';
require_once 'classes/event.class.php';

switch ($_GET['action']) {
    case "group":
        show_group_events($_GET['id']);
        break;
    default:
        break;
}

function show_group_events($id){
    //check to see if group should be private.
    $id = mysql_real_escape_string($id, get_link());

    $events = find_bets_by_group($id);
    
    //json events
    foreach ($events as $id => $e) {
        $json[$id] = $e->teams;
    }

    require_once 'view/events/show.php';
}


?>
