<?php 

	// E-Mail Adresse validieren
	function validateEmail($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		} else {
			return true;
		}
	}

	// E-Mail absenden
	function sendEmail($name, $email, $nachricht) {
		$to = $email;
		$subject = 'Neue Nachricht über das Kontaktformular';
		$message = $name.' schrieb: '.$nachricht;
		$headers = "From: test@example.com\r\n";
		if (mail($to, $subject, $message, $headers)) {
		   return true;
		} else {
		   return false;
		}
	}

	// Formular gesendet
	if (isset($_POST['send']) && $_POST['send'] == 'ok') {

		// Felder sammeln
		$name = $_POST['name'];
		$email = $_POST['email'];
		$nachricht = $_POST['nachricht'];

		// Felder überprüfen
		if (empty($name) || empty($email) || empty($nachricht)) {

			$response = array(
				'error'		=>	true,
				'message'	=>	'Alle Felder müssen ausgefüllt sein!'
			);
			
			echo json_encode($response);

		} else {

			if (!validateEmail($email)) {
				$response = array(
					'error'		=>	true,
					'message'	=>	'Keine gültige E-Mail Adresse!'
				);
			} else {

				if (!sendEmail($name, $email, $nachricht)) {
					$response = array(
						'error'		=>	true,
						'message'	=>	'Beim Versenden der Nachricht ist ein Fehler aufgetreten!'
					);
				} else {
					$response = array(
						'error'		=>	false,
						'message'	=>	'Vielen Dank für Ihre Nachricht!'
					);
				}

			}
			
			echo json_encode($response);
		}




	} else {
		// Falls die ajax.php direkt aufgerufen wurde
		header('Location: index.html');
	}

	

	

	


?>