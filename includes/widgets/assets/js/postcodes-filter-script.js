$(document).ready(function(){
  function filter_postcode_au(number, state, tier) {
         console.log(number, state, tier);
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
  $("#postcodes-number").on("keyup change", function() {
        let number = $(this).val();
        let state = $("#postcodes-states").val();
        let tier = $("#postcodes-tiers").val();
        filter_postcode_au(number, state, tier);
  });

  $("#postcodes-states").change( function() {
        let state = $(this).val();
        let number = $("#postcodes-number").val();
        let tier = $("#postcodes-tiers").val();
        filter_postcode_au(number, state, tier);
  });

  $("#postcodes-tiers").change( function() {
        let tier = $(this).val();
        let number = $("#postcodes-number").val();
        let state = $("#postcodes-states").val();
        filter_postcode_au(number, state, tier);
      });
  });
