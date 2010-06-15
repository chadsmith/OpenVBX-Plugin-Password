<div class="vbx-applet">
    <div class="section" style="margin-bottom:20px;">
        <h2>Password Prompt</h2>
        <p>What the caller will hear to prompt them to enter the password.</p>

        <div class="menu-prompt" style="margin-bottom:20px;">
        <?php echo AppletUI::audioSpeechPicker('prompt'); ?>
        </div>
    </div>

    <div class="section" style="margin-bottom:20px;">
        <h2>Password</h2>

        <div class="vbx-input-container input">
        <label>
            Enter the numeric password to grant access to the next applet.
            <input name="password" class="numeric-password small" type="text" value="<?php echo AppletInstance::getValue('password');?>" />
        </label>
        </div>
    </div>

    <div class="section" style="margin-bottom:20px;">
        <h2>Correct Password Prompt</h2>
        <p>What the caller hears when they enter the correct password.</p>

        <div class="menu-prompt" style="margin-bottom:20px;">
        <?php echo AppletUI::audioSpeechPicker('prompt-correct'); ?>
        </div>
    </div>

    <div>
        <h2>Next</h2>
        <p>When the correct password is received, continue to the next step</p>

        <div class="vbx-full-pane">
        <?php echo AppletUI::DropZone('next'); ?>
        </div>
    </div>
</div>
