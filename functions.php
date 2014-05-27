<?php

    include_once 'config.php';

    function show_journals( $year, $month ) {

        global $pdf_path; 
        $pdf_path .= $year;
        $all_files = scandir($pdf_path);
        $sub_str = $month . $year;
        
        foreach ( $all_files as $file ) {
            if ( (substr($file, -3) == "pdf") && (substr( $file, 2, 6 ) == $sub_str) )  {
                    $url = "show_pdf_text.php" . "?year={$year}&file={$file}" ;
                    echo "<a href=$url>" . $file . "</a><br /><br />";
            }
        }

    }


?>
