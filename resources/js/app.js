$(function() {
	$('input, textarea').placeholder();

	$('form').on('submit', function() {
		$(this).find('input[type=submit]').addClass('disabled');
	});

	if ($("#copy-button").length) {

		ZeroClipboard.config({ swfPath: window.ZCPath });
		var client = new ZeroClipboard(document.getElementById('copy-button'));

		client.on('ready', function(readyEvent) { 
			client.on('aftercopy', function(event) {
				$("#copy-confirmation").fadeIn();
				$("#copy-confirmation").fadeOut();
			});
		});
	}
});	
