<div class="password-vbx vbx-applet">
  <h2>Password Prompt</h2>
  <p>What the caller will hear to prompt them to enter the password.</p>
  <div class="menu-prompt" style="margin-bottom:20px;">
    <?php echo AppletUI::audioSpeechPicker('prompt'); ?>
  </div>
  <div class="vbx-input-container input">
    <p>
      <label>
        Enter the numeric password to grant access to the next applet.<br/>
        <input name="password" class="numeric-password small" type="text" value="<?php echo AppletInstance::getValue('password');?>" />
      </label>
    </p>
  </div>
  <p>Where the caller goes when they enter the correct password.</p>
  <div class="vbx-full-pane">
    <?php echo AppletUI::DropZone('next'); ?>
  </div>
  <h2>Incorrect Password</h2>
  <p>What the caller hears when they enter an incorrect password.</p>
  <div class="menu-prompt" style="margin-bottom:20px;">
    <?php echo AppletUI::audioSpeechPicker('incorrect'); ?>
  </div>
  <div class="vbx-input-container input">
    <p>
      <label>
        Number of retries<br/>
        <input name="retries" class="small" type="text" value="<?php echo AppletInstance::getValue('retries', '0');?>" />
      </label>
    </p>
  </div>
  <p>Where the caller goes when they enter the incorrect password too many times.</p>
  <div class="vbx-full-pane">
    <?php echo AppletUI::DropZone('fail'); ?>
  </div>
</div>
