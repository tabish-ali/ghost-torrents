$(document).ready(function (e) {

    var code = generateCode();

    function generateCode() {
        var num1 = Math.floor(Math.random() * 10);
        var num2 = Math.floor(Math.random() * 10);
        $('#code-div #code-text').remove();
        $('#code-div').append("<b id='code-text' class='text-light'>" + num1 + " + " + num2 + "</b>");

        return num1 + num2;
    }

    $('#contact-form').submit(function (ev) {
        ev.preventDefault();

        var entered_code = parseInt($('#code-input').val());
        if (entered_code === code) {
            if (user == null)
                message_obj = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    message: $('#message').val(),
                };
            else
                message_obj = {
                    name: user.username,
                    email: user.email,
                    message: $('#message').val(),
                };
            $.ajax({
                type: 'post',
                url: '/users/contact-us.php',
                dataType: 'json',
                header: 'Content-type:appSMALLcation/json',
                data: {
                    message_obj: message_obj,
                },
                success: function (data) {
                    var response = data['response'];
                    if (response === 'success') {
                        $("#contact-form #msg:last-child").remove();
                        var msg = $("<small id='msg' class='success-label' style='display:none'> " + data["response"] + "</small > ");
                        $('#contact-form').append(msg);
                        msg.fadeIn("slow");

                    }
                    else {
                        $("#contact-form #msg:last-child").remove();
                        var msg = $("<small id='msg' class='success-label' style='display:none'> " + data["response"] + "</small > ");
                        $('#contact-form').append(msg);
                        msg.fadeIn("slow");
                    }
                    code = generateCode();
                },

            });
        }
        else {
            $("#contact-form #msg:last-child").remove();
            var msg = $("<small id='msg' class='danger-label' style='display:none'>Incorrect code entered</small > ");
            $('#contact-form').append(msg);
            msg.fadeIn("slow");
        }
    });
});