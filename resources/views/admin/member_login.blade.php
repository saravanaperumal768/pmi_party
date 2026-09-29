<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>PMI Admin</title>

    <link rel="stylesheet" href="{{ asset('adminfiles/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminfiles/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('adminfiles/assets/css/style.css') }}">
</head>

<body class="auth-body">
    <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
    </button>
    <main class="auth-page">
        <section class="auth-card">
            <a class="auth-brand" href="index.html"><span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span><span><strong>PMI Admin</strong></span></a>
            <div class="auth-visual"><img src="{{ asset('assets/images/election-bg.png') }}" alt="PMI dashboard interface"></div>
            <form class="needs-validation" id="adminLoginForm" novalidate>

                <div class="mb-4">
                    <h1 class="h3 mb-1 text-center">Member Login</h1>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="loginEmail">
                        Enter Member ID
                    </label>

                    <input
                        class="form-control"
                        name="memberid"
                        id="loginEmail"
                        type="text"
                        required>

                    <div class="invalid-feedback">
                        Enter a valid memberid.
                    </div>
                </div>

                <div class="mb-3">

                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="loginPassword">
                            Enter Password
                        </label>
                    </div>

                    <input
                        class="form-control"
                        id="loginPassword"
                        name="loginPassword"
                        type="password"
                        required>

                    <div class="invalid-feedback">
                        Invalid Password.
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label" for="captcha">
                        Enter CAPTCHA
                    </label>

                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="captcha-box" id="memberCaptcha">
                            {{ session('member_login_captcha') }}
                        </div>


                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            id="refreshMemberCaptcha"
                            title="Refresh CAPTCHA">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>

                    <input
                        class="form-control"
                        id="captcha"
                        name="captcha"
                        type="text"
                        autocomplete="off"
                        required>

                    <div class="invalid-feedback">
                        Enter the CAPTCHA.
                    </div>
                </div>

                <button
                    class="btn btn-primary w-100"
                    type="submit"
                    id="loginBtn">
                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                    Sign In
                </button>

                <div id="loginMessage" class="mt-3"></div>

            </form>


        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('adminfiles/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminfiles/assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#adminLoginForm').on('submit', function(e) {

                e.preventDefault();

                let form = this;

                if (!form.checkValidity()) {
                    e.stopPropagation();
                    $(form).addClass('was-validated');
                    return;
                }

                let memberid = $('#loginEmail').val().trim();
                let password = $('#loginPassword').val();
                let captcha = $('#captcha').val().trim();

                let loginBtn = $('#loginBtn');
                let messageBox = $('#loginMessage');

                loginBtn.prop('disabled', true);

                loginBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Signing In...'
                );

                messageBox.html('');

                $.ajax({

                    url: "{{ route('admin.login_member.submit') }}",

                    type: "POST",

                    data: {
                        memberid: memberid,
                        loginPassword: password,
                        captcha: captcha
                    },

                    success: function(response) {

                        if (response.status === true) {

                            messageBox.html(
                                '<div class="alert alert-success">' +
                                response.message +
                                '</div>'
                            );

                            window.location.href = response.redirect;

                        } else {

                            messageBox.html(
                                '<div class="alert alert-danger">' +
                                response.message +
                                '</div>'
                            );

                            resetLoginButton();
                        }
                    },

                    error: function(xhr) {

                        console.log(xhr.responseJSON);

                        let message = 'Something went wrong. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        messageBox.html(
                            '<div class="alert alert-danger">' +
                            message +
                            '</div>'
                        );

                        resetLoginButton();

                          setTimeout(function () {
                                location.reload();
                            }, 2000)
                    }
                });

                function resetLoginButton() {

                    loginBtn.prop('disabled', false);

                    loginBtn.html(
                        '<i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Sign In'
                    );
                }

            });

        });


$(document).on('click', '#refreshMemberCaptcha', function () {



    $.ajax({
        url: "{{ route('admin.refresh.captcha', 'member') }}",
        type: "GET",

        success: function (response) {

            if (response.status) {
                $('#memberCaptcha').text(response.captcha);
                $('#member_captcha').val('');
            }

        },

        error: function () {
            alert('Unable to refresh CAPTCHA.');
        }
    });

});

$(document).on('input', '#captcha', function () {
    this.value = this.value.toUpperCase();
});
    </script>


</body>

</html>
