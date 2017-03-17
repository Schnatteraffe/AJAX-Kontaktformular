// Scripts

$(init);

function init() {



	$('#sendmessage').click(sendMessage);

	function sendMessage(e) {

		var name = $('#name').val();
		var email = $('#email').val();
		var nachricht = $('#nachricht').val();

		$.post(
			'ajax.php',
			{
				send: 'ok',
				name: name,
				email: email,
				nachricht: nachricht
			},
			response,
			'json'
		);




	}


	function response(data) {
		//console.log(data);
		if (data.error == true) {
			$('div.alert').remove();
			$('#form').after('<div class="alert alert-danger" role="alert">' + data.message + '</div>');
		} else {
			$('div.alert').remove();
			$('#form').after('<div class="alert alert-success" role="alert">' + data.message + '</div>');
		}
		
	}



}