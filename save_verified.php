<?php

    $action = $_POST['action'];
    $page_num = $_POST['page_num'];
    $data = $_POST['data'];
    $year = $_POST['year'];
    $dir = $_POST['dir'];

    $path = "pdf/" . $year . "/" . $dir;

    if ( $action == "SAVE" ) {
        $file_name = $path . "/" . $page_num . "-" . "verified.txt";
        file_put_contents($file_name, $data);
        echo "File Saved!";
        
    } else if ( $action == "DO NOT SAVE" ) {
        $file_name = $path . "/" .$page_num . "-" . "not.txt";
        file_put_contents($file_name, $data);
        echo "File Not Saved!";

    }

    // remove verified file
    $file = $path . "/" . $page_num . "-" . "extracted.txt";
    unlink( $file );


?>
