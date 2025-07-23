$(document).ready(function () {
    $('#subscription-form').on('submit', function (e) {
        e.preventDefault();

        const name = $('#name').val().trim();
        const email = $('#email').val().trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const alert = $('#subscription-message');

        function showAlertMsg(message, alertClass) {
            alert.removeClass('d-none alert-success alert-danger alert-warning')
                  .addClass(alertClass)
                  .text(message);
            setTimeout(() => alert.addClass('d-none').text(''), 3000);
        }

        if (name === '') {
            showAlertMsg('The Name Field Is Required.', 'alert-danger');
            return;
        }

        if (email === '') {
            showAlertMsg('The Email Field Is Required.', 'alert-danger');
            return;
        }

        if (!emailPattern.test(email)) {
            showAlertMsg('Please enter a valid email address.', 'alert-warning');
            return;
        }
        $('#subscribe-btn').prop('disabled', true);
        $('.spinner-border').removeClass('d-none');

        $.ajax({
            url: $('form').attr('action'),
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                name: name,
                email: email
            },
            success: function (response) {
                if (response.success) {
                    showAlertMsg(response.message, 'alert-success');
                    $('#subscription-form')[0].reset();
                } else {
                    showAlertMsg(response.message, 'alert-danger');
                }
            },
            error: function (xhr) {
                let message = 'An error occurred. Please try again.';

                if (xhr.status === 422 && xhr.responseJSON?.message) {
                    message = xhr.responseJSON.message; // Handles: "The email has already been taken."
                }
                showAlertMsg(message, 'alert-danger');
            },
            complete: function () {
                $('#subscribe-btn').prop('disabled', false);
                $('.spinner-border').addClass('d-none');
            }
        });
    });
});
