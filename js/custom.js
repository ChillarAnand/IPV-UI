(function() {

var year = '<?php echo $year; ?>';
var dir =  '<?php echo $dir; ?>';

    fetch_extracted();

    $('input[type="submit"]').on('click', function(){
        event.preventDefault();
        var action = $(this).val();
        process_data( action );
        fetch_extracted();
    });


    function fetch_extracted() {
        $.ajax({
            type: "POST",
            url:  "fetch_extracted.php",
            data: { year: year, dir: dir },
            success: function(data) {
                var returnData = JSON.parse(data);
                $('#text_area').val( returnData[0] ).show();
                $('#page_num').html( returnData[1] ).show();
            }
        });
    }

    function process_data(action) { 
        var data =  $('#text_area').val();
        var page_num = $('#page_num').text();
        console.log(page_num);
        $.ajax({
            type: "POST",
            url:  "process_data.php",
            data: { year: year, dir: dir, action: action, data: data, page_num: page_num },
            success: function( data ) {
                console.log(data);
            }
        });
    }

})();
 
