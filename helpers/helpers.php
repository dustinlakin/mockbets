<?php

/**
 *
 * This is a simple way to add some js files through php. $name accepts a single
 * value or an array of values.
 * 
 * Valid includes:
 * jquery
 * 
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

?>
