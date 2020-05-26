function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#nomb_completo').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'autocomplete.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#country_list_id').show();
				$('#country_list_id').html(data);
			}
		});
	} else {
		$('#country_list_id').hide();
	}
}
 
// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#nomb_completo').val(item);
	// hide proposition list
	$('#country_list_id').hide();
}