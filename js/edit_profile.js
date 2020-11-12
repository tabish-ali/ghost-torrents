$(document).ready(function () {

    const save_username_btn = document.getElementById('save-username-btn');
    const save_email_btn = document.getElementById('save-email-btn');
    const username_field = document.getElementById('username-field');
    const email_field = document.getElementById('email');
    const intro_input = document.getElementById('intro-input');
    const save_intro_btn = document.getElementById('save-intro-btn');

    save_username_btn.addEventListener("click", function () {

        updateData("username");
    });

    save_email_btn.addEventListener("click", function () {

        updateData("email");
    });

    save_intro_btn.addEventListener("click", function () {

        updateData("intro");
    });

    function updateData(data_type) {

        var new_username = username_field.value;
        var new_email = email_field.value;
        var new_intro = intro_input.value;

        if (data_type == "username")
            updated_data = { type: data_type, username: new_username };

        else if (data_type == "email")
            updated_data = { type: data_type, email: new_email };

        else if (data_type == "intro")
            updated_data = { type: data_type, intro: new_intro };


        $.ajax({
            type: 'POST',
            data: updated_data,
            url: '/users/update_profile.php',
            header: 'Content-type:appSMALLcation/json',
            dataType: 'json',
            success: function (data) {

                var response = data['response'];

                if (response == "taken") {
                    iziToast.warning({
                        title: data_type.charAt(0).toUpperCase() + data_type.slice(1),
                        message: "already taken. Please choose another one.",
                    });
                }
                else if (response == "no-change") {
                    iziToast.info({
                        title: 'OK',
                        message: "No change in " + data_type,
                    });
                }

                else if (response == "updated") {
                    iziToast.success({
                        title: 'Success',
                        message: data_type.charAt(0).toUpperCase() + data_type.slice(1) +
                            " updated successfully.",
                    });
                    document.getElementById('nav-username').innerHTML = username_field.value;
                    document.getElementById('username-text').innerHTML = username_field.value;

                }
            }


        });
    }
});