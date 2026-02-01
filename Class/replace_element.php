<?php 
function replace_element_3($element) {
    $element = str_replace("&lt;", "<", AsciiConverter::asciiToString($element));
    $element = str_replace("&gt;", ">",  $element);
    $element = str_replace("&nbsp;", "",  $element);
    return $element ;      
}

function replace_element_4($element) {
    $element = str_replace("&lt;", "<", removeHtmlTags(AsciiConverter::asciiToString($element)));
    $element = str_replace("&gt;", ">",  $element);
    $element = str_replace("&nbsp;", "",  $element);
    return $element ;      
}


function replace_element_1($element) {
    $element = str_replace("&lt;", "<", $element);
    $element = str_replace("&gt;", ">",  $element);
    $element = str_replace("&nbsp;", "",  $element);
    return $element ;      
}

function replace_element_2($element) {
    $element = str_replace("&lt;", "<", removeHtmlTags($element));
    $element = str_replace("&gt;", ">",  $element);
    $element = str_replace("&nbsp;", "",  $element);
    return $element ;      
}

?>