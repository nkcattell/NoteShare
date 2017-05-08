jQuery(document).ready(function(){
	
	$('#thumbsUp').click(function() { 
		var text = parseInt($('#numLike').text());
		var newText = text + 1;
		$('#numLike').text(newText);
		$(this).addClass('inactiveLink');
		if ($('#thumbsDown').hasClass('inactiveLink')) {
			var text2 = parseInt($('#numDislike').text());
			var newText = text2 - 1;
			$('#numDislike').text(newText);
			$('#thumbsDown').removeClass('inactiveLink');
		}
	});

	$('#thumbsDown').click(function() { 
		var text = parseInt($('#numDislike').text());
		var newText = text + 1;
		$('#numDislike').text(newText);
		$(this).addClass('inactiveLink');
		if ($('#thumbsUp').hasClass('inactiveLink')) {
			var text2 = parseInt($('#numLike').text());
			var newText = text2 - 1;
			$('#numLike').text(newText);
			$('#thumbsUp').removeClass('inactiveLink');
		}
	});
});
