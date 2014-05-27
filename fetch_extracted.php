<?php

    $year =  $_GET["year"];
    $dir = $_GET["dir"];

    $path = "pdf/" . $year . "/" . $dir;

    $all_files = scandir( $path );
    natcasesort( $all_files );
    $page_num = null;
    $data = null;

    foreach ($all_files as $file) {
        if( substr($file, -13 ) == "extracted.txt" ) {
            $data = file_get_contents($path . "/" . $file);
            global $page_num;
            $page_num = trim($file, "-extracted.txt");
            break;
        }

    }

    $zero_fill_int = sprintf("%04d", $page_num);

    $pdf_path = $path . "/pg_" . $zero_fill_int . ".pdf";

    //print_r($zero_fill_int);


    if( $page_num ) {
        $data = array($data, $page_num, $pdf_path );
        $json_data = json_encode($data);
        echo $json_data;
    } else {
        $data = "All journals are verified. Go to next journal";
        $data = array($data, $page_num);
        $json_data = json_encode($data);
        echo $json_data;
    }
    

?>

