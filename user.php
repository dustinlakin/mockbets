<?php
session_start();
require_once 'helpers/db.php';
require_once 'classes/user.class.php';
require_once 'classes/group.class.php';
require_once 'classes/standings.class.php';
require_once 'helpers/helpers.php';

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
    
    
    case "home":
        show_home();
        break;

    case "show":
        show_user();
        break;
    
    
    case "login":
        if($_SESSION["user"]){
            show_home();
        }else{
            if($_POST){
                check_login();
            }else{
                login_form();
            }
        }
        break;
        
    default:
        show_home();
        break;
}

function check_login(){
    //check user info, redirect if correct.
    $user = new user();
    if ($user->check_login($_POST['user'], $_POST['password'])){
        $user->get_user($user->id);
        $user->login();
        redirect_to(array("controller" => "user", "action" => "home", "id" => $user->id));
    }else{
        login_form();
    }
}

function show_home(){
    if($_SESSION["user"]){
        $u = new user($_SESSION["user"]);
        
        //include show user view
        include "view/users/show.php";
    }else{
        login_form();
    }
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

function login_form(){
    require_once "view/users/login.php";
}

?>
