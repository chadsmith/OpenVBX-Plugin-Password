<?php
$password = AppletInstance::getValue('password'); // Password settings
$password = trim($password);
$prompt = AppletInstance::getAudioSpeechPickerValue('prompt'); // Message prompt to people calling in
$prompt_correct = AppletInstance::getAudioSpeechPickerValue('prompt-correct');
$prompt_wrong = AppletInstance::getAudioSpeechPickerValue('prompt-wrong');
$next = AppletInstance::getDropZoneUrl('next'); // Next step in the flow
$digits = @$_REQUEST['Digits']; // User pass input

$response = new Response();
if(!$digits) {
    if(!strlen($password)) {
        $response->addSay('Password is not set for this applet.  Please edit your call flow.');
        $response->addHangup();
    }

    $gather = $response->addGather(array('numDigits' => strlen($password)));
    $default = new Say('Please enter the '.strlen($password).' digit passcode.');

    $prompt_verb = AudioSpeechPickerWidget::getVerbForValue($prompt, $default);
    $gather->append($prompt_verb);
} else {
    if($digits != $password) {
        $prompt_wrong_verb = AudioSpeechPickerWidget::getVerbForValue($prompt_wrong, null);
        $response->append($prompt_wrong_verb);
        $response->addRedirect();
    } else if($digits == $password) {
        $prompt_correct_verb = AudioSpeechPickerWidget::getVerbForValue($prompt_correct, null);
        $response->append($prompt_correct_verb);
        $response->addRedirect($next);
    }
}

$response->Respond();
?>
