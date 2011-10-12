<?php
define('PASSWORD_COOKIE', 'password-' . AppletInstance::getInstanceId());

$ci =& get_instance();
$prompt = AppletInstance::getAudioSpeechPickerValue('prompt');
$password = AppletInstance::getValue('password');
$incorrect = AppletInstance::getAudioSpeechPickerValue('incorrect');
$retries = AppletInstance::getValue('retries', 0);
$digits = clean_digits($ci->input->get_post('Digits'));

$state = array(
    'retries' => 0
);

$response = new TwimlResponse;

if(isset($_COOKIE[PASSWORD_COOKIE])) {
	$state = json_decode(str_replace(', $Version=0', '', $_COOKIE[PASSWORD_COOKIE]), true);
	if(is_object($state))
		$state = get_object_vars($state);
}

if($digits !== false) {
	if($password !== $digits) {
		$state['retries']++;
		if($state['retries'] > $retries) {
			setcookie(PASSWORD_COOKIE);
			$next = AppletInstance::getDropZoneUrl('fail');
			if(!empty($next))
				$response->redirect($next);
			$response->respond();
			die;
		}
		if($incorrect) {
			AudioSpeechPickerWidget::setVerbForValue($incorrect, $response);
			$response->redirect();
		}
		else {			 
			$response->say('Incorrect password.', array(
				'voice' => $ci->vbx_settings->get('voice', $ci->tenant->id),
				'voice_language' => $ci->vbx_settings->get('voice_language', $ci->tenant->id)
			));
			$response->redirect();
		}
	}
	else {
		setcookie(PASSWORD_COOKIE);
		$next = AppletInstance::getDropZoneUrl('next');
		if(!empty($next))
			$response->redirect($next);
		$response->respond();
		die;
	}
}
else {
	$gather = $response->gather(array('numDigits' => strlen($password)));
	if($prompt) {
		AudioSpeechPickerWidget::setVerbForValue($prompt, $response);
		$response->redirect();
	}
	else {			 
		$response->say('Please enter the ' . strlen($password) . ' digit password.', array(
			'voice' => $ci->vbx_settings->get('voice', $ci->tenant->id),
			'voice_language' => $ci->vbx_settings->get('voice_language', $ci->tenant->id)
		));
		$response->redirect();
	}
}

setcookie(PASSWORD_COOKIE, json_encode($state), time() + (5 * 60));
$response->respond();
?>
