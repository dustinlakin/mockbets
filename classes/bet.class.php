<?php

/**
 * Description of bet
 *
 * @author Dustin
 */
class bet {
    public $user;
    public $group;
    public $event;
    public $amount;
    public $ml,$ps,$ou;
    public $status;

    public function __construct($bet_id) {
        if($bet_id != 0){
            $this->get_bet($bet_id);
        }
    }
    
    public function get_bet($bet_id){
        /*$sql = "SELECT b.id AS bet_id, b.amount, b.ml AS ml_id, b.ps AS ps_id, b.ou AS ou_id, u.* , g.* , g.name AS group_name, e.*, e.name as event_name
            FROM bet b, users u, groups g, events e
            WHERE b.id =1
            AND u.id = b.user_id
            AND g.id = b.group_id
            AND e.id = b.event_id";
         *
         */
        $sql = "SELECT * FROM bet WHERE id = $bet_id";
        $result = mysql_query($sql, get_link());
        $row = mysql_fetch_object($result);
        
        
        $this->load_data($row);
    }

    public function load_data($row) {
        $this->id = $row->bet_id;
        $this->user = new user($row->user_id);
        $this->event = new event($row->event_id);
        $this->group = new group($row->group_id);
        $this->amount = $row->amount;
        $this->status = $row->status;
        $this->ml = $row->ml;
        $this->ps = $row->ps;
        $this->ou = $row->ou;
    }




}
?>
