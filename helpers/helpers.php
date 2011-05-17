<?php

/**
 *
 * This is a simple way to add some js files through php. $name accepts a single
 * value or an array of values.
 * 
 * Valid params include:
 * jquery, betting
 *  
 * @param array $name array of script titles
 */
function include_js($name){
    if (!is_array($name)) {
        $name = array($name);
    }

    $template = "<script type=\"text/javascript\" src=\"%s\"></script>";

    if (in_array("jquery", $name))
        echo sprintf($template, "js/jquery-1.5.2.min.js");
    if (in_array("betting",$name))
        echo sprintf($template, "js/betting.js");
    
}

/**
 *
 * Sets up styles for you, create an array of locations. 
 * No real complicated stuff allowed just yet.
 * 
 * @param array $styles
 * @return boolean
 */
function include_style($styles){
    if(!isset($styles))
        return false;
    if (!is_array($styles)) {
        $styles = array($styles);
    }

    $template = "<link href=\"%s\" rel=\"stylesheet\" type=\"text/css\"/>";
    
    foreach ($styles as $s) {
        echo sprintf($template,$s);
    }
    return true;
}

/**
 * Redirect to a url
 * 
 * @param string $url
 */

function redirect_to_url($url){
    header("location:".$url);
}

/**
 * 
 * Sends to controller, action and id
 *
 * @param array $array 
 */

function redirect_to($array){
    $url = $array["controller"] . ".php";
    if($array["action"]){
        $url .= "?action=".$array["action"];
        if($array["id"]){
            $url .= "&id=".$array["id"];
        }
    }
    header("location:".$url);
}


/**
 *
 * gets links from controller, action and id
 * 
 * @param array $array 
 */
function link_to($array){
    $url = $array["controller"] . ".php";
    if($array["action"]){
        $url .= "?action=".$array["action"];
        if($array["id"]){
            $url .= "&id=".$array["id"];
        }
    }
}

?>
