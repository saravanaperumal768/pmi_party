     <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 PMI.  Developed by <a target="_blank" class="fw-bold text-success" href="https://solverssoftech.com/">Solvers Softech</a> </span>

        </div>
      </footer>
    </div>
  </div>


<script src="{{ asset('adminfiles/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminfiles/assets/js/main.js') }}"></script>
<!-- <script src="{{ asset('adminfiles/assets/js/admin.js') }}"></script> -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.adminHMDUser = {name: @json($profile->name ?? 'President'),
        workspace: @json($profile->designation_name_en ?? 'Active Workspace'),
        avatar: @json(!empty($profile->photo)
                ? asset( $profile->photo)
                : asset('assets/images/about_img.png'))};
</script>
<script>


$(document).on('click', '#approvemember', function () {

    let button = $(this);
    let applicationId = button.data('application-id');

    if (!applicationId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Application ID not found.'
        });
        return;
    }

    Swal.fire({
        title: 'Approve Member',
        text: 'Are you sure you want to approve this member?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, Approve',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d'
    }).then((result) => {

        if (!result.isConfirmed) {
            return;
        }

        button.prop('disabled', true);
        button.html(
            '<i class="fa fa-spinner fa-spin"></i> Approving...'
        );

        $.ajax({
            url: "{{ route('admin.approve_member') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                application_id: applicationId
            },

            success: function (response) {

                if (response.status) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Member Approved Successfully!',
                        html:

                            '<strong>Member ID:</strong> ' +
                            response.memberid,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#198754',
                        allowOutsideClick: false
                    }).then((result) => {

                        if (result.isConfirmed) {
                            window.location.href =
                                "{{ route('admin.dashboard') }}";
                        }

                    });

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Already Approved',
                        text: response.message
                    });

                    button
                        .html('<i class="fa fa-check"></i> Approve')
                        .prop('disabled', false);
                }
            },

            error: function (xhr) {

                console.log(xhr.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                    text: 'Unable to approve the member. Please try again.'
                });

                button
                    .html('<i class="fa fa-check"></i> Approve')
                    .prop('disabled', false);
            }
        });

    });

});
</script>
</body>

</html>
