<?php
/**
 * Description of event
 *
 * @author Dustin
 */
class event {
    public $id;
    public $sport;
    public $name;
    public $description;
    public $event_date;
    public $bet_by;
    public $teams;
    public $over_under;
    public $bets;

    public function __construct($id=0) {
        if($id != 0)
            $this->get_event($id);
    }
   

    public function get_event($id){
        $sql = "SELECT e.*, s.name as sport
                FROM events e, sports s
                WHERE e.id = $id AND e.sport_id = s.id";
        $result = mysql_query($sql, get_link());
        $row = mysql_fetch_object($result);
        $this->load_data($row);
        
    }

    public function load_data($row){
        $this->id = $row->id;
        $this->sport = $row->sport;
        $this->name = $row->name;
        $this->description = $row->description;
        $this->event_date = $row->event_date;
        $this->bet_by = $row->bet_by;
        $this->bets["ml"] = $row->ml;
        $this->bets["ps"] = $row->ps;
        $this->bets["ou"] = $row->ou;
    }

    public function load_bets(){
        if($this->bets["ml"]){
            $sql = "SELECT *
                    FROM money_line ml, teams t
                    WHERE ml.event_id = $this->id
                    AND t.id = ml.team_id";
            $result = mysql_query($sql, get_link());

            while ($row = mysql_fetch_object($result)) {
                $this->teams[$row->team_id]["ml"] = $row->odd;
                $this->teams[$row->team_id]["name"] = $row->name;
                $this->teams[$row->team_id]["city"] = $row->city;
            }
        }

        if($this->bets["ps"]){
            $sql = "SELECT *
                    FROM point_spread ps, teams t
                    WHERE ps.event_id = $this->id
                    AND t.id = ps.team_id";
            $result = mysql_query($sql, get_link());

            while ($row = mysql_fetch_object($result)) {
                if(!isset($this->teams)){
                        $this->teams[$row->team_id]["name"] = $row->name;
                        $this->teams[$row->team_id]["city"] = $row->city;
                }
                $this->teams[$row->team_id]["ps"] = $row->odd;
                
            }
        }

        if($this->bets["ou"]){
            $sql = "SELECT *
                    FROM over_under ou
                    WHERE event_id = $this->id";
            $result = mysql_query($sql, get_link());

            while ($row = mysql_fetch_object($result)) {
                $this->over_under["points"] = abs($row->points);
                if($row->points > 0){
                    $this->over_under["over"] = $row->odd;
                }else{
                    $this->over_under["under"] = $row->odd;
                }
            }
        }
    }


    public function create_event($arr){
        //use array to fill things needed.
        foreach ($arr as $key => $value) {
            $arr[$key] = mysql_real_escape_string($value,  get_link());
        }

        $ml = (isset ($arr['team1_ml']) ? 1 : 0);
        $ps = (isset ($arr['team1_ps']) ? 1 : 0);
        $ou = (isset ($arr['ou_points']) ? 1 : 0);
        $sql = "INSERT INTO events VALUES(NULL,". $arr['sport']. ",'".$arr['event_name'] ."','".$arr['desc']."','".$arr['event_date']."','".$arr['bet_by']."',$ml,$ps,$ou);";
        //echo $sql;
        $result = mysql_query($sql,get_link());
        $id = mysql_insert_id(get_link());

        //moneyline
        if($ml):
            $sql = "INSERT INTO money_line VALUES($id,".$arr['team1'].",".$arr['team1_ml'].",0);";
            mysql_query($sql,  get_link());
            $sql = "INSERT INTO money_line VALUES($id,".$arr['team2'].",".$arr['team2_ml'].",0);";
            mysql_query($sql,  get_link());
        endif;

        //moneyline
        if($ps):
            $sql = "INSERT INTO point_spread VALUES($id,".$arr['team1'].",".$arr['team1_ps'].",0);";
            mysql_query($sql,  get_link());
            $sql = "INSERT INTO point_spread VALUES($id,".$arr['team2'].",".$arr['team2_ps'].",0);";
            mysql_query($sql,  get_link());
        endif;

        //moneyline
        if($ou):
            //over
            $sql = "INSERT INTO over_under VALUES($id,".$arr['over'].",".$arr['ou_points'].",0);";
            mysql_query($sql,  get_link());
            //under
            $sql = "INSERT INTO over_under VALUES($id,".$arr['under'].",".($arr['ou_points']*-1).",0);";
            mysql_query($sql,  get_link());
        endif;

    }

}
?>
