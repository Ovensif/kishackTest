<?php 

    foreach ($js_files as $key_js => $value_js) :
        echo "<script src='{$value_js}'></script>";
    endforeach;

?>