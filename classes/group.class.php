<?php
/**
 * Groups for each
 *
 * @author Dustin
 */
class group {
    public $id;
    public $name;
    public $min_bet;
    public $max_bet;
    public $start_date;
    public $end_date;
    public $starting_funds;
    public $base_price;
    public $password;
    public $sports;

    //standings
    public $standings;
    public $admins;
    
    public function __construct($id = 0) {
        if($id != 0){
            $this->get_group($id);
        }
    }

    public function get_group($id){
        $this->id = $id;
        $sql = "SELECT * FROM groups WHERE id = '$this->id' LIMIT 1";
        $result = mysql_query($sql, get_link());
        if(mysql_num_rows($result) > 0){
            $row = mysql_fetch_object($result);
            $this->load_group($row);
            return true;
        }else{
            return false;
        }
    }

    public function load_group($row){
        $this->id = $row->id;
        $this->name = $row->name;
        $this->min_bet = $row->min_bet;
        $this->max_bet = $row->max_bet;
        $this->start_date = $row->start_date;
        $this->end_date = $row->end_date;
        $this->starting_funds = $row->starting_funds;
        $this->base_price = $row->base_price;
        $this->password = $row->password;

        //get group
        $sql = "SELECT s.* FROM sports_for_groups sg, sports s WHERE sg.group_id = $this->id AND s.id = sg.sport_id";
        $result = mysql_query($sql, get_link());
        while ($row = mysql_fetch_object($result)) {
            $this->sports[$row->id] = $row->name;
        }
    }

    /**
     *
     * Fills users into members/admins
     *
     * @return void
     * @access public
     */
    public function find_users(){
        unset($this->admins);
        $this->standings = new standings($this->id);

        $sql = "SELECT u.*
                FROM group_admins ga, users u
                WHERE ga.group_id = $this->id AND u.id = ga.user_id";
        $result = mysql_query($sql, get_link());

        while ($row = mysql_fetch_object($result)) {
            $u = new user();
            $u->load_user($row);
            $this->admins[$u->id] = $u;
        }
    }

    public function add_member($id){
        if(!isset($this->standings->users[$id])){
            $sql = "INSERT INTO users_in_groups VALUES($id,$this->id,$this->starting_funds,0,NOW());";
            mysql_query($sql, get_link());
            
            if(mysql_affected_rows() != -1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function remove_member($id){
        if(isset($this->standings->users[$id])){
            $sql = "DELETE FROM users_in_groups WHERE user_id = $id AND group_id = $this->id";
            mysql_query($sql,  get_link());
            unset($this->members[$id]);
            return true;
        }else{
            return false;
        }
    }

    public function add_admin($id){
        if(!isset($this->admins[$id])){
            $sql = "INSERT INTO group_admins VALUES($id,$this->id,NOW());";
            mysql_query($sql, get_link());

            if(mysql_affected_rows() != -1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function add_sport($sport_id){
        $sql = "INSERT INTO sports_for_groups VALUES($this->id,$sport_id);";
        mysql_query($sql, get_link());
    }

    public function remove_sport($sport_id){
        $sql = "DELETE FROM sports_for_groups WHERE group_id = $this->id AND sport_id = $sport_id";
        mysql_query($sql, get_link());
    }

    public function remove_admin($id){
        if(isset($this->admins[$id])){
            $sql = "DELETE FROM group_admins WHERE user_id = $id AND group_id = $this->id";
            mysql_query($sql,  get_link());
            unset($this->admins[$id]);
            return true;
        }else{
            return false;
        }
    }

    public function save(){
        //create new!
        if(!isset ($this->id)){
            $sql = "INSERT INTO groups (id) VALUES (NULL)";
            mysql_query($sql,  get_link());
            $this->id = mysql_insert_id(get_link());
        }

        //save
        $sql = "UPDATE groups
                SET name = '$this->name',
                min_bet = $this->min_bet,
                max_bet = $this->max_bet,
                start_date = '$this->start_date',
                end_date = '$this->end_date',
                starting_funds = $this->starting_funds,
                base_price = $this->base_price,
                password = '$this->password'
                WHERE id = $this->id";
        mysql_query($sql,  get_link());
        if(mysql_affected_rows() != -1){
            return true;
        }else{
            echo $sql;
            return false;
        }
    }
}
?>

