jQuery(document).ready(function(){

	var url = "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/285701757&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true";
	$("#videoPlayer").attr("src", url);

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

	$('#commentButton').click(function() { 
		var comment = $('#addComment').val();
		$('#commentSection').append('<hr><h5>Username</h5><p>'+comment+'</p>');
		$('#addComment').val('');
	});
});