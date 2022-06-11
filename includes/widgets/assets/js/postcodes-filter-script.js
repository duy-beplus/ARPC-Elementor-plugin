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
            console.log(response);
            $('#result-download').html(response);
          }
        });
        window.open('data:application/vnd.ms-excel,' + $('#result-download').html());
    });
});
