$('#memberAssignmentForm').on('submit', function (e) {

    e.preventDefault();

    let form = this;

    // Clear previous validation
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').hide();

    /*
    |--------------------------------------------------------------------------
    | MEMBER VALIDATION
    |--------------------------------------------------------------------------
    */

    let memberId = $('#member_id').val();

    if (!memberId) {

        $('#member_search').addClass('is-invalid');

        $('#member_search')
            .closest('.col-md-6')
            .find('.invalid-feedback')
            .first()
            .text('Please select a member.')
            .show();

        $('#member_search').focus();

        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | HTML5 / BOOTSTRAP VALIDATION
    |--------------------------------------------------------------------------
    */

    if (!form.checkValidity()) {

        form.classList.add('was-validated');

        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | FORM DATA
    |--------------------------------------------------------------------------
    */

    let formData = new FormData(form);


    /*
    |--------------------------------------------------------------------------
    | AJAX SUBMIT
    |--------------------------------------------------------------------------
    */

    $.ajax({

        url: "{{ route('admin.assign.role.update') }}",

        type: "POST",

        data: formData,

        processData: false,

        contentType: false,

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function () {

            $('button[type="submit"]')
                .prop('disabled', true)
                .html(
                    '<span class="spinner-border spinner-border-sm me-1"></span> Saving...'
                );

        },

        success: function (response) {

            if (response.status) {

                alert(response.message);

                // Reset form
                form.reset();

                form.classList.remove('was-validated');

                $('#member_id').val('');

                $('#selected_member').hide();

                $('#member_search_results')
                    .hide()
                    .html('');

                // Reset summaries
                $('#summary_region').text('-');
                $('#summary_district').text('-');
                $('#summary_taluk').text('-');
                $('#summary_block').text('-');
                $('#summary_designation').text('-');

                // Disable location fields
                $('#state_id')
                    .val('')
                    .prop('disabled', true)
                    .prop('required', false);

                $('#region_id')
                    .val('')
                    .prop('disabled', true)
                    .prop('required', false);

                $('#district_id')
                    .val('')
                    .prop('disabled', true)
                    .prop('required', false)
                    .html('<option value="">-- Select District --</option>');

                $('#taluk_id')
                    .val('')
                    .prop('disabled', true)
                    .prop('required', false)
                    .html('<option value="">-- Select Taluk --</option>');

                $('#block_id')
                    .val('')
                    .prop('disabled', true)
                    .prop('required', false)
                    .html('<option value="">-- Select Block --</option>');

                $('#designation_id')
                    .val('')
                    .prop('disabled', true)
                    .prop('required', false)
                    .html('<option value="">-- Select Designation --</option>');

            }

        },

        error: function (xhr) {

            console.log(xhr.responseText);

            if (xhr.status === 422) {

                let errors = xhr.responseJSON.errors;

                $.each(errors, function (field, messages) {

                    let input = $('#' + field);

                    input.addClass('is-invalid');

                    input
                        .closest('.col-md-6')
                        .find('.invalid-feedback')
                        .first()
                        .text(messages[0])
                        .show();

                });

            } else {

                alert('Something went wrong. Please try again.');

            }

        },

        complete: function () {

            $('button[type="submit"]')
                .prop('disabled', false)
                .html(
                    '<i class="bi bi-check-circle"></i> Assign Role'
                );

        }

    });

});
