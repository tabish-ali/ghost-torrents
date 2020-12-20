
$(document).ready(function () {

    var password1 = document.getElementById('password1');
    var password2 = document.getElementById('password2');

    var password_notification = document.getElementById('password-notification');
    var password_not_div = document.getElementById('p-n');
    var reg_btn = document.getElementById('reg-btn');

    password1.addEventListener("input", checkPassword);
    password2.addEventListener("input", checkPassword);


    function checkPassword() {

        if (password1.value != "" && password2.value != "") {

            if (password1.value === password2.value) {
                $('#p-n').fadeIn("slow");
                password_not_div.className = "alert border-dark bg-success text-light alert-secondary alert-dismissible fade show";
                password_notification.innerHTML = "Password matched.";
                reg_btn.disabled = false;

            }
            else {
                $('#p-n').fadeIn("slow");
                password_not_div.className = "alert border-dark bg-warning text-dark alert-secondary alert-dismissible fade show";
                password_notification.innerHTML = "Please make sure two passwords must match.";
                reg_btn.disabled = true;
            }
        }
        else {
            $('#p-n').fadeOut("slow");
        }
    }
});