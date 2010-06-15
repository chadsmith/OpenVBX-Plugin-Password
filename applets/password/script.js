$(document).ready(function() {
    // Only allow numbers in this input

    var app = $('.flow-instance.security---password');
    $('.vbx-applet .numeric-password', app).live('keydown', function(e) {
        if(e.keyCode == 46 || e.keyCode == 8 || e.keyCode == 37 || e.keyCode == 39) {

        // Allow backspaces, delete, left arrow, and right arrow
        } else {
            if(e.keyCode < 48 || e.keyCode > 57) {
                e.preventDefault();
            }
        }
    });
});
