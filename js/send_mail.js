$(document).ready(function () {

    const reset_btn = document.getElementById('reset-btn');
    const email_input = document.getElementById('email-input');
    const form_div = document.getElementById('form-div');
    const reset_btn_icon = document.getElementById('reset-btn-icon');

    reset_btn.addEventListener("click", resetPassword);

    function resetPassword() {

        $.ajax({

            type: "post",
            url: "/email/sendmail.php",
            dataType: "json",
            data: {
                type: "password_reset",
                email: email_input.value,
            },

            beforeSend: function () {

                reset_btn.disabled = true;
                reset_btn_icon.className = "fa fa-spinner fa-spin";
            },

            success: function (data) {

                var response = data['response'];

                if (!response) {

                    var msg_node = document.createElement("small");

                    msg_node.className = "text-danger p-1";

                    msg_node.appendChild(document.createTextNode("User with this username does not exist"));

                    form_div.appendChild(msg_node);

                }
                else{
                    var msg_node = document.createElement("small");

                    msg_node.className = "text-success p-1";

                    msg_node.appendChild(document.createTextNode("Password sent to email, please check inbox"));

                    form_div.appendChild(msg_node);
                }
                reset_btn_icon.className = "fa fa-redo";
            }
        });

    }


});