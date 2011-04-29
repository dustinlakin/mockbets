<?php
/**
 * Description of standing
 *
 * @author Dustin
 */
class standings {
    public $group_id;
    public $users;
    public $users_ranked;

    public function __construct($group_id = 0) {
        if($group_id != 0){
            $this->load_data($group_id);
        }
    }

    public function load_data($group_id){
        $this->group_id = $group_id;
        $sql = "SELECT u.*, ug.money, ug.bets_money
                FROM users_in_groups ug, users u
                WHERE ug.group_id = $this->group_id
                AND u.id = ug.user_id
                ORDER BY ug.money DESC";
        //echo $sql;
        $result = mysql_query($sql, get_link());

        $i = 1;
        while ($row = mysql_fetch_object($result)) {
            $u = new user();
            $u->load_user($row);
            $this->users[$row->id]['id'] = $row->id;
            $this->users[$row->id]['user'] = $row->user;
            $this->users[$row->id]['money'] = $row->money;
            $this->users[$row->id]['bets_money'] = $row->bets_money;
            $this->users_ranked[$i++] = $row->id;
        }
    }
}
?>
