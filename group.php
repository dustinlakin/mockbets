<?php
session_start();
require_once 'helpers/db.php';
require_once 'classes/user.class.php';
require_once 'classes/group.class.php';
require_once 'classes/standings.class.php';

switch ($_GET['action']) {
    case "show":
        show_group();
        break;
    default:
        break;
}

function show_group(){
    //check to see if group should be private.
    $group = new group($_GET['id']);
    $group->find_users();

    require_once 'view/groups/show.php';
}


?>
