<?php
define('PASSWORD_COOKIE', 'password-' . AppletInstance::getInstanceId());

$prompt = AppletInstance::getAudioSpeechPickerValue('prompt');
$password = AppletInstance::getValue('password');
$incorrect = AppletInstance::getAudioSpeechPickerValue('incorrect');
$retries = AppletInstance::getValue('retries', 0);
$digits = isset($_REQUEST['Digits']) ? $_REQUEST['Digits'] : false;

$state = array(
    'retries' => 0
);

$response = new Response();

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
				$response->addRedirect($next);
			$response->Respond();
			die;
        }
        $verb = AudioSpeechPickerWidget::getVerbForValue($incorrect, new Say('Incorrect password.'));
        $response->append($verb);
        $response->addRedirect();
    }
    else {
		setcookie(PASSWORD_COOKIE);
		$next = AppletInstance::getDropZoneUrl('next');
		if(!empty($next))
			$response->addRedirect($next);
		$response->Respond();
		die;
    }
}
else {
    $gather = $response->addGather(array('numDigits' => strlen($password)));
    $verb = AudioSpeechPickerWidget::getVerbForValue($prompt, new Say('Please enter the '.strlen($password).' digit password.'));
    $gather->append($verb);
}

setcookie(PASSWORD_COOKIE, json_encode($state), time() + (5 * 60));
$response->Respond();
?>
