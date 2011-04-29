<?php
session_start();
require_once 'helpers/db.php';
require_once 'classes/user.class.php';
require_once 'classes/group.class.php';
require_once 'classes/standings.class.php';
require_once 'classes/event.class.php';
require_once 'helpers/bets.helper.php';
require_once 'classes/bet.class.php';

/*
$g = new group(5);
$g->name = "dustin\'s ufc pool";
$g->start_date = date("Y-m-d");
$g->end_date = "2012-05-20";
$g->starting_funds = 10000;
$g->min_bet = 100;
$g->max_bet = 1000;
$g->password = "test";
$g->base_price = 5;
if($g->save()){
    echo "saved";
}else{
    echo "error";
}
*/

//$g = new group(5);
//$g->add_member(4);

//$u = new user(3);
//print_r($u);

$g = new group(5);
//$g->remove_sport(2);
//$g->add_sport(2);
//$g->find_users();
//print_r($g);
//$g->add_admin(3);
//$g->add_member(3);
//$g->remove_member(4);
//print_r($g);
//$g->


//$u = new user($_SESSION['user']);
//$u = new user();
//echo $u->check_login("jacob", "lol");
//print_r($u);
//$u->get_user($u->check_login("dustin", "test"));
//$u->user = "jacob";
//$u->email = "jacob@aol.com";
//$u->set_password("lol");
//$u->save();
//$u->login();
//print_r($_SESSION['user'])
//close_link();
//$u->delete();
//$u->create_user("dustin", "dustin.lakin@gmail.com", "test");
//print_r($u);

//$e = new event(1);
//$e->load_bets();
//print_r($e);


//print_r(find_bets_by_sport(2));
//print_r(find_bets_by_group(5));

//$b = new bet(1);
//print_r($b);

?>