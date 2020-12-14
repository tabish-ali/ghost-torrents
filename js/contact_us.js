$(document).ready(function (e) {
    $('#contact-form').submit(function (ev) {
        ev.preventDefault();
        message_obj = {
            name: $('#name').val(),
            email: $('#email').val(),
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
                console.log(response);
                if (response === 'success') {
                    $("#contact-form small:last-child").remove();
                    var msg = $("<small class='success-label' style='display:none'> " + data["response"] + "</small > ");
                    $('#contact-form').append(msg);
                    msg.fadeIn("slow");
                }
                else {
                    $("#contact-form small:last-child").remove();
                    var msg = $("<small class='success-label' style='display:none'> " + data["response"] + "</small > ");
                    $('#contact-form').append(msg);
                    msg.fadeIn("slow");
                }
            },
           
        });
    });
});