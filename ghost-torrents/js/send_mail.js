$(document).ready(function () {

    const reset_btn = document.getElementById('reset-btn');
    const email_input = document.getElementById('email-input');
    const form_div = document.getElementById('form-div');
    const reset_btn_icon = document.getElementById('reset-btn-icon');
    const msg_node = document.getElementById('msg');

    reset_btn.addEventListener("click", resetPassword);

    function resetPassword() {

        $.ajax({

            type: "post",
            url: "/email/sendmail.php",
            dataType: "json",
            header: 'Content-type:appSMALLcation/json',
            data: {
                type: 'password_reset', email: email_input.value,
            },

            beforeSend: function () {

                reset_btn.disabled = true;
                reset_btn_icon.className = "fa fa-spinner fa-spin";
            },

            success: function (data) {

                var response = data['response'];

                if (!response) {

                    msg_node.className = "text-danger p-1";

                    msg_node.innerHTML = "Sorry user with this email does not exist";
                }
                else {

                    msg_node.className = "text-success p-1";

                    msg_node.innerHTML = "Please check email for instructions to reset password";

                }
                $('#msg').fadeIn("slow")
                reset_btn_icon.className = "fa fa-redo";
                reset_btn.disabled = false;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },

        });

    }


});