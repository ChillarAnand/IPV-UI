<html>

<head>
    <title>Indian Patents Verification</title>
    <script src="js/jquery-2.1.0.js"></script>
</head>

<body>

<!--  To display pdf file -->
<?php 
    $year = $_GET["year"]; 
    $file = $_GET["file"];
    $dir = trim( $file, ".pdf" );
?>


<div id='pdf_obj'>
<?php

    //$p_path = "pdf/{$year}/{$file}";
    echo "<embed id = 'pdf' src='' align = 'left'; width='55%'; height = '97%'> ";
    //echo "<iframe src='$pdf_path' align = 'left'; width='50%'; height = '97%' /> ";
?>
</div>


<!-- to display text file save/dont save buttons -->
<div>
    <textarea id="text_area" style="float:right; width: 45%; height:96%;">
    </textarea>
    <label>Page no:</label>
    <div id="page_num" style="display: inline-block;"></div>
    <input type="submit" id="save" value="SAVE">
    <input type="submit" id="do_not_save" value="DO NOT SAVE">
</div>

<script>
    
(function(){ 

    var year = '<?php echo $year; ?>';
    var dir =  '<?php echo $dir; ?>';

    fetch_extracted();

    $('input[type="submit"]').on('click', function(){
        event.preventDefault();
        var action = $(this).val();
        save_verified( action );
        fetch_extracted();
        //location.reload(true);
    });

    function fetch_extracted() {
        $.ajax({
            type: "GET",
            url:  "fetch_extracted.php",
            data: { year: year, dir: dir },
            success: function( data ) {
                var returnData = JSON.parse(data);
                $('#text_area').val( returnData[0] ).show();
                $('#page_num').html( returnData[1] ).show();
                $('#pdf').attr( 'src', returnData[2] ).show();
                console.log(returnData[2])
//                $('#pdf').load( location.href + "#pdf" );
                var embedHtml = $('#pdf_obj').html();
                $('#pdf_obj').empty();
                console.log(embedHtml);
                $('#pdf_obj').append(embedHtml)

            }
        });
    }

    function save_verified(action) { 
        var data =  $('#text_area').val();
        var page_num = $('#page_num').text();
        console.log(page_num);
        $.ajax({
            type: "POST",
            url:  "save_verified.php",
            data: { year: year, dir: dir, action: action, data: data, page_num: page_num },
            success: function( data ) {
                console.log(data);
            }
        });
    }

})();
</script>

</body>
</html>
