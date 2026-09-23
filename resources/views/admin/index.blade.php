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
                    <h1 class="h3 mb-1">Login</h1>
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

                let loginBtn = $('#loginBtn');
                let messageBox = $('#loginMessage');

                loginBtn.prop('disabled', true);

                loginBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Signing In...'
                );

                messageBox.html('');

                $.ajax({

                    url: "{{ route('admin.login.submit') }}",

                    type: "POST",

                    data: {
                        _token: "{{ csrf_token() }}",
                        memberid: memberid,
                        loginPassword: password
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
    </script>
</body>

</html>
