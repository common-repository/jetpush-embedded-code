(function($) {
	
	$(document).ready(function() {
		
		$('#multisetting').bind('change', function() {
			if ($(this).val() == 1) {
				$('#multidomain').removeAttr('disabled') ;
			} else {
				$('#multidomain').attr('disabled', 'disabled') ;
			}
		}) ;

		$('#jetpush_form').bind('submit', function() {
			if ($('#multisetting').val() == 1 && !$('#multidomain').val()) {
				alert('Domain empty') ;
				return false ;
			} else {
				return true ;
			}
		}) ;
		
	}) ;
	
})(jQuery) ;