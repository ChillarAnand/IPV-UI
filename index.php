<?php

    include 'functions.php';
    include 'index.tmpl.php';

        if ( isset( $_GET['submit'] )) {
            
            $message = "Select a Journal";
            echo "<h3>" . $message . "</h3>";
            $year = $_GET["year"];
            $month = $_GET["month"];

            // Show journals belonging to  $month and $year
            show_journals($year, $month);

                 
        }

?>
