<?php
if (!isset($mysql_link)) {
    $mysql_link = false;
}

function get_link()
{
    global $mysql_link;
    if( $mysql_link )
        return $mysql_link;
    $mysql_link = mysql_connect( 'localhost', 'root', '') or die('Could not connect to mysql server.' );
    mysql_select_db('mockbets', $mysql_link) or die('Could not select database.');
    return $mysql_link;
}

function close_link()
{
    global $mysql_link;
    if( $mysql_link != false )
        mysql_close($mysql_link);
    $mysql_link = false;
}

/**
 *
 * Sends array with use of "controller", "action", "id" , "text", "class"
 *
 * @param $arr
 */
function create_link($text,$arr){
    $a  = "<a href=\"". $arr["controller"]. ".php?action=". $arr["action"] ."&id=" . $arr["id"] ."\">";
    $a .= $text;
    $a .= "</a>";
    return $a;
}


?>