$('#otp_verify_form').submit(function(e) {

    e.preventDefault();
    var loginForm = $(this);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: loginForm.attr('action'),
        data: loginForm.serialize(),
        success: function(response) {
            if (response.status == 'success') {
                $("form#otp_verify_form").trigger("reset");
                success_msg("OTP Verified Successfully");
                // swal('OTP Verified Successfully', "You clicked the button!", "success");
                setInterval(function() {
                    window.location.replace(response['url']); // this will run after every 5 seconds
                }, 2000);
            } else {
                error_msg(response.error)
            }
        }
    });
});