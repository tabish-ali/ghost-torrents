$(document).ready(function (e) {
    if (user_id !== "") {
        const password1_field = document.getElementById("password1");

        const password2_field = document.getElementById("password2");

        const password3_field = document.getElementById("password3");

        const change_btn = document.getElementById("change-btn");

        const matched_text_node = document.getElementById('match-text');

        const password_match_notification = document.getElementById('password-match-notification');

        change_btn.addEventListener("click", checkNewPassword);

        password1_field.addEventListener("focusout", checkOldPassword);

        function changePassword() {

            $.ajax({
                data: {
                    password1: password1_field.value,
                    password2: password2_field.value,
                    password3: password3_field.value,
                    type: 'change_password',
                },
                type: 'post',
                url: '/users/change-password.php',
                dataType: 'json',

                success: function (data) {

                    var response = data['response'];

                    if (response == 'success') {
                        password_match_notification.innerHTML = "Password changed successfully";
                        password_match_notification.className = "text-success p1";
                        $('#password-match-notification').fadeIn();
                    }
                    else {

                        $("#match-text").fadeIn();

                        matched_text_node.innerHTML = "Old password is incorrect.";

                        matched_text_node.className = "text-danger p-1";
                    }

                }
            });
        }

        // this function check whether new password matches confirm password
        function checkNewPassword() {

            $('#password-match-notification').fadeOut();

            var password2 = password2_field.value;
            var password3 = password3_field.value;

            if (password2 === password3) {

                changePassword();
            }
            else {

                password_match_notification.innerHTML = "Two passwords does not matched";
                password_match_notification.className = "text-danger p-1";
                $('#password-match-notification').fadeIn();
            }
        }

        function checkOldPassword() {
            $.ajax({
                data: {
                    type: 'old_pass_check',
                    password1: password1_field.value,
                },
                type: 'post',
                url: '/users/change-password.php',
                dataType: 'json',

                success: function (data) {

                    var response = data['response'];

                    matched_text_node.className = '';

                    if (response == "matched") {

                        $("#match-text").fadeIn();

                        matched_text_node.innerHTML = "Old password matched correctly.";

                        matched_text_node.className = "text-success p-1";

                    }
                    else {

                        $("#match-text").fadeIn();

                        matched_text_node.innerHTML = "Old password is incorrect.";

                        matched_text_node.className = "text-danger p-1";
                    }
                }
            });
        }
    }
});

