$(document).ready(function(){
  function filter_postcode_au(number, state, tier) {
        // Ajax load array results after filer array
        $.ajax({
					type: 'POST',
					url: ajaxObject.ajaxUrl,
					data:{
						'action' : 'load_postcodes_data',
            'postcode'  : number,
            'state'  : state,
            'tier'  : tier,
					},
					success:function(response){
              $('.postcodes-result-table').html(response);
          }
        });
  }

  // event key up and change number of input
  $("#postcodes-number").on("keyup change", function() {
        let number = $(this).val();
        let state = $("#postcodes-states").val();
        let tier = $("#postcodes-tiers").val();
        filter_postcode_au(number, state, tier);
  });

  // event change of State select
  $("#postcodes-states").change( function() {
        let state = $(this).val();
        let number = $("#postcodes-number").val();
        let tier = $("#postcodes-tiers").val();
        filter_postcode_au(number, state, tier);
  });

  // event change of Tier select
  $("#postcodes-tiers").change( function() {
        let tier = $(this).val();
        let number = $("#postcodes-number").val();
        let state = $("#postcodes-states").val();
        filter_postcode_au(number, state, tier);
  });

  // event click of button download file Excel
  $(".btn-download-excel").on("click", function() {
        let number = $("#postcodes-number").val();
        let state = $("#postcodes-states").val();
        let tier = $("#postcodes-tiers").val();

        // Ajax load array results after filer array
        $.ajax({
          type: 'POST',
          url: ajaxObject.ajaxUrl,
          data:{
            'action' : 'load_postcodes_data_download',
            'postcode'  : number,
            'state'  : state,
            'tier'  : tier,
          },
          datatype: 'json',
          success:function(response){
            var dt = new Date();
            var day = dt.getDate();
            var month = dt.getMonth() + 1;
            var year = dt.getFullYear();
            var hour = dt.getHours();
            var mins = dt.getMinutes();
            var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
            //getting data from our div that contains the HTML table
            var a = document.createElement('a');
            var data_type = 'data:application/vnd.ms-excel';
            var table_div = response;
            a.href = data_type + ', ' + table_div;
            //setting the file name
            a.download = 'ARPC_Postcodes_' + postfix + '.xls';
            //triggering the function
            a.click();
          }
        });
    });
});
