$(document).ready(function () {

    $('#delete-account-form').on('submit', function (e) {
        e.preventDefault();
        var password = $('#password-field').val();
        $.ajax({
            data: {
                type: 'old_pass_check',
                password1: password,
            },
            type: 'post',
            url: '/users/change-password.php',
            dataType: 'json',
            success: function (response) {
                if (response['response'] === "matched") {
                    deleteConfirmation();
                }
                else {
                    $('#delete-account-form').append("<small id='msg' class='dark-bg p-2 danger-label'>Invalid password.</small>");
                }
            }
        });
    });

    function deleteAccount() {
        $.ajax({
            type: "POST",
            url: "/users/delete-account.php",
            dataType: "json",
        });
    }

    function deleteConfirmation() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteAccount();
                    swal("Poof! Your account has been deleted!. Redirecting...", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);

                } else {

                }
            });
    }

});