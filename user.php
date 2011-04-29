<?php
session_start();
require_once 'helpers/db.php';
require_once 'classes/user.class.php';
require_once 'classes/group.class.php';
require_once 'classes/standings.class.php';

//check user action

//get action
switch ($_GET['action']) {
    case "create":
        if($_POST){
            //Check POST data, then create
            create();
        }else{
            //show form
        }
        break;
    case "json":
            to_json();
        break;

    case "show":
        show_user();
        break;
    default:
        break;
}

function show_user(){
    $u = new user($_GET['id']);

    //include show user view
    include "view/users/show.php";
}

function to_json(){
    $u = new user($_GET['id']);

    $obj["id"] = $u->id;
    $obj["user"] = $u->user;
    foreach ($u->groups as $group) {
        $g = array("id"=>$group->id,"name"=>$group->name);
        $obj["groups"][] = $g;
    }

    echo json_encode($obj);
}

?>
