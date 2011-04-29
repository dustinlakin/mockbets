<?php
/**
 * Users for mockbets
 *
 * @author Dustin Lakin
 */

class user {
    public $id;
    public $user;
    public $email;
    public $groups;

    public $standings;
    private $password;

    /**
     *  Constructs with id or allows new user to be created or test login.
     *
     * @param int $id
     * @access public
     * @return void
     */
    public function __construct($id = 0) {
        if ($id != 0) {
            $this->get_user($id);
        }
    }

    /**
     *  Fills information into the user.
     *
     * @param int $id
     * @access public
     * @return void
     */
    public function get_user($id){
        $this->id = $id;

        // get users info.
        $sql = "SELECT * FROM users WHERE id = $this->id LIMIT 1;";
        $result = mysql_query($sql, get_link());
        $row = mysql_fetch_object($result);
        $this->user = $row->user;
        $this->email = $row->email;

        //check out the groups
        $sql = "SELECT g.*, ug.money, ug.bets_money
                FROM users_in_groups ug, groups g
                WHERE ug.user_id = $this->id AND g.id = ug.group_id";
        $result = mysql_query($sql);

        while ($row = mysql_fetch_object($result)) {
            $g = new group();
            $g->load_group($row);
            //$g->find_users();
            $this->groups[$g->id] = $g;
        }
    }

    public function load_user($row){
        $this->id = $row->id;
        $this->user = $row->user;
        $this->email = $row->email;
    }

    /**
     *
     * Sets new password. It returns the db password, and also sets the variable
     *
     * @param string $new_password
     * @return string
     * @access public
     */
    public function set_password($new_password){
        $salt = "a8dZl2kaDeX01uMpA";
        $db_password = md5($this->salt . $new_password);
        $this->password = $db_password;
        return $this->password;
    }


    /**
     *
     * Saves any changes to object made.
     *
     * @access public
     * @return boolean
     */
    public function save(){
        if(isset($this->password)){
            $sql = "UPDATE users
                    SET user = '$this->user',
                    email = '$this->email',
                    password = '$this->password'
                    WHERE id = $this->id";
        }else{
            $sql = "UPDATE users
                SET user = '$this->user',
                email = '$this->email',
                WHERE id = $this->id";
        }
        mysql_query($sql, get_link());

        if(mysql_affected_rows(get_link()) != -1){
            return true;
        }else{
            return false;
        }
    }


    /**
     *
     * Deletes current object, make sure id has been placed in object.
     *
     * @access public
     * @return void
     */
    public function delete(){
        $sql = "DELETE FROM users WHERE id = $this->id";
        mysql_query($sql, get_link());
    }

    /**
     *
     * Checks to see if user has entered corect info. If they have, it returns
     * the id, otherwise it returns 0
     *
     * @access public
     * @param string $user
     * @param string $password
     * @return int
     */
    public function check_login($user,$password){
        $user = mysql_real_escape_string($user, get_link());
        $password = mysql_real_escape_string($password, get_link());
        
        $this->set_password($password);
        $sql = "SELECT id FROM users WHERE user = '$user' AND password = '$this->password' LIMIT 1";
        $result = mysql_query($sql, get_link());
        if(mysql_num_rows($result) == 1){
            //set id then return id;
            $row = mysql_fetch_object($result);
            $this->id = $row->id;
            return $this->id;
        }else{
            return 0;
        }
    }

    /**
     *
     * Logs in user with a id
     *
     * @access public
     * @return boolean
     */
    public function login(){
        if($this->id > 0){
            $_SESSION['user'] = $this->id;
            return true;
        }else{
            return false;
        }
        
    }

    /**
     * Creating user with username, email, password
     *
     * @param string $user
     * @param string $email
     * @param string $password
     * @access public
     * @return int
     *
     */
    public function create_user($user,$email,$password){
        $this->user = $user;
        $this->email = $email;
        $this->set_password($password);

        $sql = "INSERT INTO users VALUES(NULL,'$this->user','$this->email','$this->password')";
        mysql_query($sql,get_link());
        if(mysql_affected_rows(get_link()) == 1){
            $this->id = mysql_insert_id(get_link());
            return $this->id;
        }else{
            return 0;
        }
    }

}
?>
