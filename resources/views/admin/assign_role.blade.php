@include('admin.include.header')
<style>
    .member-search-wrapper {
        position: relative;
    }

    .member-search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 0 0 6px 6px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 9999;
        display: none;
    }

    .member-result {
        padding: 10px 12px;
        cursor: pointer;
        border-bottom: 1px solid #c2bbbb;
    }

    .member-result:hover {
        background: #f5f5f5;
    }

    .member-result:last-child {
        border-bottom: none;
    }

    .member-result-id {
        font-weight: 600;
        color: #000;
    }

    .member-result-name {
        color: #000;
        margin-left: 5px;
    }

    .selected-member {
        padding: 12px;

    }

    .member-photo {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #ddd;
    }

    .no-member {
        padding: 12px;
        color: #777;
    }

    .tbl_color_success tr td {
        color: #000;
    }

    .tbl_color_success tr th {
        color: #000;
    }

    html[data-theme="dark"] .alert-success {
        border-color: #0f766e;
        background: rgb(0 0 0 / 94%);
        color: #99f6e4;
    }
</style>
<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-ui-checks-grid" aria-hidden="true"></i></span>
                <div>

                    <h1 class="h3 mb-1">Assign Roles</h1>
                    <p class="text-muted mb-0">Assign the roles for approved members .</p>
                </div>
            </div>

        </div>

        <section class="row g-3">
            <div class="col-12 col-xl-12">
                <form id="memberAssignmentForm"
                    class="panel needs-validation"
                    data-update-url="{{ route('admin.assign.role.update') }}"
                    novalidate>

                    @csrf
                    <!-- MEMBER DETAILS -->


                    <div class="row g-3">

                        <!-- MEMBER SEARCH -->
                        <div class="col-md-6">

                            <label class="form-label" for="member_search">
                                Select Member <span class="required">*</span>
                            </label>

                            <div class="member-search-wrapper">

                                <input
                                    type="text"
                                    class="form-control"
                                    id="member_search"
                                    name="member_search"
                                    placeholder="Search Member ID or Name..."
                                    autocomplete="off"
                                    required>

                                <div class="invalid-feedback">
                                    Please select a member.
                                </div>

                                <input
                                    type="hidden"
                                    id="member_id"
                                    name="member_id"
                                    required>

                                <div
                                    id="member_search_results"
                                    class="member-search-results">
                                </div>

                            </div>

                            <div class="invalid-feedback">
                                Please select a member.
                            </div>

                        </div>


                        <!-- SELECTED MEMBER -->
                        <div class="col-md-6">

                            <div
                                id="selected_member"
                                class="selected-member"
                                style="display:none;">

                                <div class="d-flex align-items-center gap-3">

                                    <img
                                        id="member_image"
                                        src=""
                                        alt="Member"
                                        class="member-photo">

                                    <div>

                                        <div>
                                            <strong>Member ID:</strong>
                                            <span id="selected_member_id">-</span>
                                        </div>

                                        <div>
                                            <strong>Name:</strong>
                                            <span id="selected_member_name">-</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div
                                id="member_posting_alert"
                                class="text-danger text-center small mt-2"
                                style="display:none;">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Member already has a posting. Please deactivate the existing posting first, then assign a new role.
                            </div>

                        </div>

                    </div>


                    <div class="row g-3 mt-2">

                        <div class="col-md-6">

                            <label class="form-label" for="designation_level">
                                Designation Level <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="designation_level"
                                name="designation_level" required>

                                <option value="">-- Select Level --</option>
                                <option value="STATE">State</option>
                                <option value="REGION">Region</option>
                                <option value="DISTRICT">District</option>
                                <option value="TALUK">Taluk</option>
                                <option value="BLOCK">Block</option>
                                <option value="WARD">Ward</option>
                                <option value="BOOTH">Booth</option>

                            </select>

                            <div class="invalid-feedback">
                                Please select designation level.
                            </div>

                        </div>

                        <div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="state">
                                State <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="state_id"
                                name="state_id"
                                required>

                                <option value="">
                                    -- Select State --
                                </option>
                                @foreach($state as $row)
                                <option value="{{ $row->id }}" selected>
                                    {{ $row->state_name }}
                                </option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select a state.
                            </div>

                        </div>

                        <!-- REGION -->
                        <div class="col-md-6">

                            <label class="form-label" for="region_id">
                                Region <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="region_id"
                                name="region_id"
                                required>

                                <option value="">
                                    -- Select Region --
                                </option>
                                @foreach($region as $row)
                                <option value="{{ $row->id }}">
                                    {{ $row->region_name }} | {{ $row->region_name_ta }}
                                </option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select a region.
                            </div>

                        </div>


                        <!-- DISTRICT -->
                        <div class="col-md-6">

                            <label class="form-label" for="district_id">
                                District <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="district_id"
                                name="district_id"
                                required>

                                <option value="">
                                    -- Select District --
                                </option>

                                @foreach($region as $row)
                                <option value="{{ $row->id }}">
                                    {{ $row->region_name }} | {{ $row->region_name_ta }}
                                </option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select a district.
                            </div>

                        </div>


                        <!-- TALUK -->
                        <div class="col-md-6">

                            <label class="form-label" for="taluk_id">
                                Taluk <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="taluk_id"
                                name="taluk_id"
                                required>

                                <option value="">
                                    -- Select Taluk --
                                </option>

                                @foreach($taluk as $row)
                                <option value="{{ $row->taluk_code }}">
                                    {{ $row->taluk_name_eng	 }}
                                </option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select a taluk.
                            </div>

                        </div>


                        <!-- BLOCK -->
                        <div class="col-md-6">

                            <label class="form-label" for="block_id">
                                Block <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="block_id"
                                name="block_id"
                                required>

                                <option value="">
                                    -- Select Block --
                                </option>

                                @foreach($block as $row)
                                <option value="{{ $row->block_code }}">
                                    {{ $row->block_name_eng	}}
                                </option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select a block.
                            </div>

                        </div>

                    </div>




                    <div class="row g-3 mt-2">

                        <!-- DESIGNATION LEVEL -->



                        <!-- DESIGNATION -->
                        <div class="col-md-6">

                            <label class="form-label" for="designation_id">
                                Designation <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="designation_id"
                                name="designation_id"
                                required>

                                <option value="">
                                    -- Select Designation --
                                </option>
                                @foreach($designation as $row)
                                <option value="{{ $row->id }}">
                                    {{ $row->designation_name_en}}
                                </option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select a designation.
                            </div>

                        </div>


                        <!-- ROLE -->


                    </div>




                    <!-- SUMMARY -->
                    <div class="selection-summary mt-4">

                        <strong>Assignment Summary</strong>

                        <div class="row mt-2">

                            <div class="col-md-6">
                                <strong>Region:</strong>
                                <span id="summary_region">-</span>
                            </div>

                            <div class="col-md-6">
                                <strong>District:</strong>
                                <span id="summary_district">-</span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <strong>Taluk:</strong>
                                <span id="summary_taluk">-</span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <strong>Block:</strong>
                                <span id="summary_block">-</span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <strong>Designation:</strong>
                                <span id="summary_designation">-</span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <strong>Role:</strong>
                                <span id="summary_role">-</span>
                            </div>

                        </div>

                    </div>
                    <div class="form-check mt-4 mb-3">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="role_declaration"
                            name="role_declaration"
                            value="1">

                        <label class="form-check-label" for="role_declaration">
                            I confirm that the above member, designation, and location details
                            are correct and I want to assign this role to the selected member.
                        </label>

                        <div id="declaration_error"
                            class="text-danger small mt-1"
                            style="display:none;">
                            Please confirm the declaration before assigning the role.
                        </div>

                    </div>

                    <div class="d-flex text-end mt-4">

                        <button
                            type="reset"
                            class="btn btn-secondary me-2">
                            Reset
                        </button>

                        <button
                            type="submit"
                            id="assign_role_btn"
                            class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            Assign Role
                        </button>

                    </div>





                </form>
            </div>

        </section>
    </div>
</main>

@include('admin.include.footer')
<script>
    $(document).ready(function() {

        const locationFields = [
            '#state_id',
            '#region_id',
            '#district_id',
            '#taluk_id',
            '#block_id'
        ];

        function resetLocationFields() {

            $('#state_id').val('');
            $('#region_id').val('');
            $('#district_id').val('');
            $('#taluk_id').val('');
            $('#block_id').val('');

            $('#summary_region').text('-');
            $('#summary_district').text('-');
            $('#summary_taluk').text('-');
            $('#summary_block').text('-');

            locationFields.forEach(function(field) {
                $(field)
                    .prop('disabled', true)
                    .prop('required', false);
            });
        }

        function enableField(field) {
            $(field)
                .prop('disabled', false)
                .prop('required', true);
        }

        $('#designation_level').on('change', function() {

            let level = $(this).val();

            // --------------------------------------------------
            // RESET ALL LOCATION FIELDS
            // --------------------------------------------------

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


            // --------------------------------------------------
            // RESET SUMMARY
            // --------------------------------------------------

            $('#summary_region').text('-');
            $('#summary_district').text('-');
            $('#summary_taluk').text('-');
            $('#summary_block').text('-');


            // --------------------------------------------------
            // ENABLE BASED ON DESIGNATION LEVEL
            // --------------------------------------------------

            switch (level) {

                case 'STATE':

                    $('#state_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    break;


                case 'REGION':

                    $('#state_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#region_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    break;


                case 'DISTRICT':

                    $('#state_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#region_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#district_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    break;


                case 'TALUK':

                    $('#state_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#region_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#district_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#taluk_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    break;


                case 'BLOCK':

                    $('#state_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#region_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#district_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#taluk_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#block_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    break;


                case 'WARD':
                case 'BOOTH':

                    $('#state_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#region_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#district_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#taluk_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    $('#block_id')
                        .prop('disabled', false)
                        .prop('required', true);

                    break;


                default:
                    break;
            }

        });

        // Initial state
        resetLocationFields();

    });
</script>

<script>
    $(document).ready(function() {

        $('#region_id').on('change', function() {

            let regionId = $(this).val();
            let level = $('#designation_level').val();

            // District is needed only from DISTRICT level onward
            let allowDistrict = [
                'DISTRICT',
                'TALUK',
                'BLOCK',
                'WARD',
                'BOOTH'
            ].includes(level);

            // Always reset district
            $('#district_id')
                .prop('disabled', true)
                .prop('required', false)
                .html('<option value="">-- Select District --</option>');

            if (!regionId || !allowDistrict) {
                return;
            }

            // Load districts only when required
            $.ajax({
                url: "{{ url('/admin/get-districts-by-region') }}/" + regionId,
                type: "GET",
                dataType: "json",

                success: function(response) {

                    $('#district_id')
                        .prop('disabled', false)
                        .prop('required', true)
                        .html('<option value="">-- Select District --</option>');

                    $.each(response, function(index, district) {

                        $('#district_id').append(
                            $('<option>', {
                                value: district.district_code,
                                text: district.districtname_eng
                            })
                        );

                    });

                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                    $('#district_id')
                        .prop('disabled', true)
                        .prop('required', false)
                        .html('<option value="">-- Select District --</option>');
                }
            });

        });


        $('#district_id').on('change', function() {

            let districtCode = $(this).val();
            let level = $('#designation_level').val();

            console.log('Selected District:', districtCode);
            console.log('Designation Level:', level);

            // Reset Taluk
            $('#taluk_id')
                .prop('disabled', true)
                .prop('required', false)
                .html('<option value="">-- Select Taluk --</option>');

            // Reset Block
            $('#block_id')
                .prop('disabled', true)
                .prop('required', false)
                .html('<option value="">-- Select Block --</option>');

            $('#summary_taluk').text('-');
            $('#summary_block').text('-');

            if (!districtCode) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | TALUK
            |--------------------------------------------------------------------------
            | Only TALUK, BLOCK, WARD and BOOTH can select Taluk
            |--------------------------------------------------------------------------
            */

            let allowTaluk = [
                'TALUK',
                'BLOCK',
                'WARD',
                'BOOTH'
            ].includes(level);


            /*
            |--------------------------------------------------------------------------
            | BLOCK
            |--------------------------------------------------------------------------
            | Only BLOCK, WARD and BOOTH can select Block
            |--------------------------------------------------------------------------
            */

            let allowBlock = [
                'BLOCK',
                'WARD',
                'BOOTH'
            ].includes(level);


            /*
            |--------------------------------------------------------------------------
            | GET TALUKS
            |--------------------------------------------------------------------------
            */

            if (allowTaluk) {

                $('#taluk_id')
                    .html('<option value="">Loading Taluks...</option>')
                    .prop('disabled', true);

                $.ajax({

                    url: "{{ url('/admin/get-taluks-by-district') }}/" +
                        encodeURIComponent(districtCode),

                    type: "GET",

                    dataType: "json",

                    success: function(response) {

                        $('#taluk_id')
                            .html('<option value="">-- Select Taluk --</option>');

                        if (response.length === 0) {

                            $('#taluk_id')
                                .prop('disabled', true)
                                .prop('required', false)
                                .html('<option value="">No Taluk found</option>');

                            return;
                        }

                        $.each(response, function(index, taluk) {

                            $('#taluk_id').append(
                                $('<option>', {
                                    value: taluk.taluk_code,
                                    text: taluk.taluk_name_eng
                                })
                            );

                        });

                        $('#taluk_id')
                            .prop('disabled', false)
                            .prop('required', true);

                    },

                    error: function(xhr) {

                        console.log('Taluk AJAX Error');
                        console.log(xhr.responseText);

                        $('#taluk_id')
                            .prop('disabled', true)
                            .prop('required', false)
                            .html('<option value="">Unable to load Taluks</option>');
                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | GET BLOCKS
            |--------------------------------------------------------------------------
            */

            if (allowBlock) {

                $('#block_id')
                    .html('<option value="">Loading Blocks...</option>')
                    .prop('disabled', true);

                $.ajax({

                    url: "{{ url('/admin/get-blocks-by-district') }}/" +
                        encodeURIComponent(districtCode),

                    type: "GET",

                    dataType: "json",

                    success: function(response) {

                        $('#block_id')
                            .html('<option value="">-- Select Block --</option>');

                        if (response.length === 0) {

                            $('#block_id')
                                .prop('disabled', true)
                                .prop('required', false)
                                .html('<option value="">No Block found</option>');

                            return;
                        }

                        $.each(response, function(index, block) {

                            $('#block_id').append(
                                $('<option>', {
                                    value: block.block_code,
                                    text: block.block_name_eng
                                })
                            );

                        });

                        $('#block_id')
                            .prop('disabled', false)
                            .prop('required', true);

                    },

                    error: function(xhr) {

                        console.log('Block AJAX Error');
                        console.log(xhr.responseText);

                        $('#block_id')
                            .prop('disabled', true)
                            .prop('required', false)
                            .html('<option value="">Unable to load Blocks</option>');
                    }

                });

            }

        });


        $('#designation_level').on('change', function() {

            let level = $(this).val();

            /*
            |--------------------------------------------------------------------------
            | RESET DESIGNATION
            |--------------------------------------------------------------------------
            */

            $('#designation_id')
                .prop('disabled', true)
                .html('<option value="">-- Select Designation --</option>');

            $('#summary_designation').text('-');


            /*
            |--------------------------------------------------------------------------
            | NO LEVEL SELECTED
            |--------------------------------------------------------------------------
            */

            if (!level) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | GET DESIGNATIONS
            |--------------------------------------------------------------------------
            */

            $.ajax({

                url: "{{ url('/admin/get-designations-by-level') }}/" + encodeURIComponent(level),

                type: "GET",

                dataType: "json",

                success: function(response) {

                    console.log('Designations:', response);


                    $('#designation_id')
                        .prop('disabled', false)
                        .html('<option value="">-- Select Designation --</option>');


                    if (response.length === 0) {

                        $('#designation_id')
                            .prop('disabled', true)
                            .html('<option value="">No Designation found</option>');

                        return;
                    }


                    $.each(response, function(index, designation) {

                        $('#designation_id').append(

                            $('<option>', {

                                value: designation.id,

                                text: designation.designation_name_en

                            })

                        );

                    });

                },


                error: function(xhr, status, error) {

                    console.log('Designation AJAX Error');
                    console.log('Status:', status);
                    console.log('Error:', error);
                    console.log('Response:', xhr.responseText);


                    $('#designation_id')
                        .prop('disabled', true)
                        .html('<option value="">Unable to load Designations</option>');
                }

            });

        });

    });
</script>
<script>
    $(document).ready(function() {

        const members = @json($members);

        const searchInput = $('#member_search');
        const resultsBox = $('#member_search_results');


        /*
        |--------------------------------------------------------------------------
        | SEARCH MEMBER
        |--------------------------------------------------------------------------
        */

        searchInput.on('input', function() {

            let search = $(this).val().trim().toLowerCase();


            // Clear selected member if user changes search
            $('#member_id').val('');

            $('#selected_member').hide();


            if (search.length === 0) {

                resultsBox
                    .hide()
                    .html('');

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | FILTER MEMBER
            |--------------------------------------------------------------------------
            */

            let filteredMembers = members.filter(function(member) {

                let memberId = String(member.memberid ?? '').toLowerCase();

                let name = String(member.name ?? '').toLowerCase();

                return (
                    memberId.includes(search) ||
                    name.includes(search)
                );

            });


            resultsBox.html('');


            /*
            |--------------------------------------------------------------------------
            | NO RESULTS
            |--------------------------------------------------------------------------
            */

            if (filteredMembers.length === 0) {

                resultsBox
                    .html(
                        '<div class="no-member">No member found.</div>'
                    )
                    .show();

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | DISPLAY RESULTS
            |--------------------------------------------------------------------------
            */

            filteredMembers.forEach(function(member) {

                let result = $('<div>', {
                    class: 'member-result'
                });


                let memberId = $('<span>', {
                    class: 'member-result-id',
                    text: member.memberid
                });


                let memberName = $('<span>', {
                    class: 'member-result-name',
                    text: '- ' + member.name
                });


                result.append(memberId);
                result.append(memberName);


                /*
                |--------------------------------------------------------------------------
                | MEMBER CLICK
                |--------------------------------------------------------------------------
                */

                result.on('click', function() {

                    selectMember(member);

                });


                resultsBox.append(result);

            });


            resultsBox.show();

        });


        /*
        |--------------------------------------------------------------------------
        | SELECT MEMBER
        |--------------------------------------------------------------------------
        */

        function selectMember(member) {

            $('#member_id').val(member.memberid);

            $('#member_search').val(
                member.memberid + ' - ' + member.name
            );

            resultsBox
                .hide()
                .html('');

            $('#selected_member_id').text(member.memberid);
            $('#selected_member_name').text(member.name);

            let image = member.photo;

            if (image) {
                $('#member_image').attr(
                    'src',
                    "{{ asset('') }}" + image
                );
            } else {
                $('#member_image').attr(
                    'src',
                    "{{ asset('images/default-user.png') }}"
                );
            }

            $('#selected_member').show();

            // Reset alert and button
            $('#member_posting_alert').hide();
            $('#assign_role_btn').prop('disabled', false);

            // Check existing posting
            if (String(member.posting) === '1') {

                $('#member_posting_alert').show();

                // Disable Assign Role button
                $('#assign_role_btn').prop('disabled', true);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CLICK OUTSIDE
        |--------------------------------------------------------------------------
        */

        $(document).on('click', function(e) {

            if (
                !$(e.target).closest('.member-search-wrapper').length
            ) {

                resultsBox.hide();

            }

        });

    });
</script>

<script>
    $(document).on('submit', '#memberAssignmentForm', function(e) {

        e.preventDefault();
        e.stopPropagation();

        let form = this;

        console.log('SUBMIT AJAX');

        // Bootstrap validation
        // Remove previous validation
        $('.is-invalid').removeClass('is-invalid');

        // Hide previous error messages
        $('.invalid-feedback').hide();


    $('#declaration_error').hide();

        let level = $('#designation_level').val();

        let isValid = true;

        if (!$('#role_declaration').is(':checked')) {

            $('#declaration_error')
                .text('Please confirm the declaration before assigning the role.')
                .show();

            $('#role_declaration').focus();

            isValid = false;
        }
        // --------------------------------------------------
        // DESIGNATION LEVEL
        // --------------------------------------------------

        if (!level || level.trim() === '') {

            $('#designation_level').addClass('is-invalid');
            $('#designation_level')
                .closest('.col-md-6')
                .find('.invalid-feedback')
                .show();

            isValid = false;
        }


        // --------------------------------------------------
        // STATE
        // --------------------------------------------------

        if (
            level === 'STATE' ||
            level === 'REGION' ||
            level === 'DISTRICT' ||
            level === 'TALUK' ||
            level === 'BLOCK' ||
            level === 'WARD' ||
            level === 'BOOTH'
        ) {

            if (!$('#state_id').val()) {

                $('#state_id')
                    .addClass('is-invalid');

                $('#state_id')
                    .closest('.col-md-6')
                    .find('.invalid-feedback')
                    .first()
                    .text('Please select state.')
                    .show();

                isValid = false;
            }
        }


        // --------------------------------------------------
        // REGION
        // --------------------------------------------------

        if (
            level === 'REGION' ||
            level === 'DISTRICT' ||
            level === 'TALUK' ||
            level === 'BLOCK' ||
            level === 'WARD' ||
            level === 'BOOTH'
        ) {

            if (!$('#region_id').val()) {

                $('#region_id')
                    .addClass('is-invalid');

                $('#region_id')
                    .closest('.col-md-6')
                    .find('.invalid-feedback')
                    .first()
                    .text('Please select region.')
                    .show();

                isValid = false;
            }
        }


        // --------------------------------------------------
        // DISTRICT
        // --------------------------------------------------

        if (
            level === 'DISTRICT' ||
            level === 'TALUK' ||
            level === 'BLOCK' ||
            level === 'WARD' ||
            level === 'BOOTH'
        ) {

            if (!$('#district_id').val()) {

                $('#district_id')
                    .addClass('is-invalid');

                $('#district_id')
                    .closest('.col-md-6')
                    .find('.invalid-feedback')
                    .first()
                    .text('Please select district.')
                    .show();

                isValid = false;
            }
        }


        // --------------------------------------------------
        // TALUK
        // --------------------------------------------------

        if (
            level === 'TALUK' ||
            level === 'BLOCK' ||
            level === 'WARD' ||
            level === 'BOOTH'
        ) {

            if (!$('#taluk_id').val()) {

                $('#taluk_id')
                    .addClass('is-invalid');

                $('#taluk_id')
                    .closest('.col-md-6')
                    .find('.invalid-feedback')
                    .first()
                    .text('Please select taluk.')
                    .show();

                isValid = false;
            }
        }


        // --------------------------------------------------
        // BLOCK
        // --------------------------------------------------

        if (
            level === 'BLOCK' ||
            level === 'WARD' ||
            level === 'BOOTH'
        ) {

            if (!$('#block_id').val()) {

                $('#block_id')
                    .addClass('is-invalid');

                $('#block_id')
                    .closest('.col-md-6')
                    .find('.invalid-feedback')
                    .first()
                    .text('Please select block.')
                    .show();

                isValid = false;
            }
        }


        // --------------------------------------------------
        // DESIGNATION
        // --------------------------------------------------

        if (!$('#designation_id').val()) {

            $('#designation_id')
                .addClass('is-invalid');

            $('#designation_id')
                .closest('.col-md-6')
                .find('.invalid-feedback')
                .first()
                .text('Please select designation.')
                .show();

            isValid = false;
        }


        // --------------------------------------------------
        // STOP AJAX IF INVALID
        // --------------------------------------------------

        if (!isValid) {

            $(form).addClass('was-validated');

            return false;
        }

        let formData = new FormData(form);

        $.ajax({

            url: $(form).data('update-url'),

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function() {

                $(form).find('button[type="submit"]')
                    .prop('disabled', true)
                    .html(
                        '<span class="spinner-border spinner-border-sm me-1"></span> Saving...'
                    );
            },

            success: function(response) {

                console.log('SUCCESS:', response);

                if (response.status) {

                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS SWEETALERT
                    |--------------------------------------------------------------------------
                    */

                    Swal.fire({

                        icon: 'success',

                        title: 'Role Assigned Successfully',

                        html: `
                <div class="text-start">

                    <div class="alert alert-success mb-3">
                        ${response.message}
                    </div>

                    <table class="table table-bordered table-sm mb-0 tbl_color_success">

                        <tr>
                            <th style="width:40%;">
                                Designation Level
                            </th>
                            <td>
                                ${response.posting.level ?? '-'}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Designation
                            </th>
                            <td>
                                <strong>
                                    ${response.posting.designation ?? '-'}
                                </strong>
                            </td>
                        </tr>

                    </table>

                </div>
            `,

                        confirmButtonText: 'OK',

                        allowOutsideClick: false,

                        allowEscapeKey: false

                    }).then((result) => {

                        /*
                        |--------------------------------------------------------------------------
                        | RESET ONLY AFTER USER CLICKS OK
                        |--------------------------------------------------------------------------
                        */

                        if (result.isConfirmed) {

                            // Reset form
                            form.reset();

                            $(form).removeClass('was-validated');


                            // Remove validation errors
                            $('.is-invalid')
                                .removeClass('is-invalid');

                            $('.invalid-feedback')
                                .hide();


                            // Reset hidden member
                            $('#member_id').val('');


                            // Hide selected member
                            $('#selected_member').hide();


                            // Clear search results
                            $('#member_search_results')
                                .hide()
                                .html('');


                            /*
                            |--------------------------------------------------------------------------
                            | RESET SUMMARY
                            |--------------------------------------------------------------------------
                            */

                            $('#summary_region').text('-');

                            $('#summary_district').text('-');

                            $('#summary_taluk').text('-');

                            $('#summary_block').text('-');

                            $('#summary_designation').text('-');

                            $('#summary_role').text('-');


                            /*
                            |--------------------------------------------------------------------------
                            | RESET STATE
                            |--------------------------------------------------------------------------
                            */

                            $('#state_id')
                                .val('')
                                .prop('disabled', true)
                                .prop('required', false);


                            /*
                            |--------------------------------------------------------------------------
                            | RESET REGION
                            |--------------------------------------------------------------------------
                            */

                            $('#region_id')
                                .val('')
                                .prop('disabled', true)
                                .prop('required', false);


                            /*
                            |--------------------------------------------------------------------------
                            | RESET DISTRICT
                            |--------------------------------------------------------------------------
                            */

                            $('#district_id')
                                .val('')
                                .prop('disabled', true)
                                .prop('required', false)
                                .html(
                                    '<option value="">-- Select District --</option>'
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | RESET TALUK
                            |--------------------------------------------------------------------------
                            */

                            $('#taluk_id')
                                .val('')
                                .prop('disabled', true)
                                .prop('required', false)
                                .html(
                                    '<option value="">-- Select Taluk --</option>'
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | RESET BLOCK
                            |--------------------------------------------------------------------------
                            */

                            $('#block_id')
                                .val('')
                                .prop('disabled', true)
                                .prop('required', false)
                                .html(
                                    '<option value="">-- Select Block --</option>'
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | RESET DESIGNATION LEVEL
                            |--------------------------------------------------------------------------
                            */

                            $('#designation_level')
                                .val('')
                                .removeClass('is-invalid');


                            /*
                            |--------------------------------------------------------------------------
                            | RESET DESIGNATION
                            |--------------------------------------------------------------------------
                            */

                            $('#designation_id')
                                .val('')
                                .prop('disabled', true)
                                .prop('required', false)
                                .html(
                                    '<option value="">-- Select Designation --</option>'
                                );

                        }

                    });

                }
            },

            error: function(xhr) {

                console.log('ERROR:', xhr);
                console.log('RESPONSE:', xhr.responseText);

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    // Remove previous errors
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').hide();

                    // Collect all validation messages
                    let errorMessages = '';

                    $.each(errors, function(field, messages) {

                        // Show inline validation error also
                        let input = $('#' + field);

                        input.addClass('is-invalid');

                        input
                            .closest('.col-md-6')
                            .find('.invalid-feedback')
                            .first()
                            .text(messages[0])
                            .show();

                        // Add error to SweetAlert
                        errorMessages += '• ' + messages[0] + '<br>';
                    });

                    // SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages,
                        confirmButtonText: 'OK'
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            },

            complete: function() {

                $(form).find('button[type="submit"]')
                    .prop('disabled', false)
                    .html(
                        '<i class="bi bi-check-circle"></i> Assign Role'
                    );
            }

        });

        return false;
    });


    $(document).ready(function() {

        // ==========================================
        // UPDATE ASSIGNMENT SUMMARY
        // ==========================================

        function updateAssignmentSummary() {

            // Region
            let regionText = $('#region_id option:selected').text().trim();

            if (!$('#region_id').val()) {
                regionText = '-';
            }

            $('#summary_region').text(regionText);


            // District
            let districtText = $('#district_id option:selected').text().trim();

            if (!$('#district_id').val()) {
                districtText = '-';
            }

            $('#summary_district').text(districtText);


            // Taluk
            let talukText = $('#taluk_id option:selected').text().trim();

            if (!$('#taluk_id').val()) {
                talukText = '-';
            }

            $('#summary_taluk').text(talukText);


            // Block
            let blockText = $('#block_id option:selected').text().trim();

            if (!$('#block_id').val()) {
                blockText = '-';
            }

            $('#summary_block').text(blockText);


            // Designation
            let designationText = $('#designation_id option:selected').text().trim();

            if (!$('#designation_id').val()) {
                designationText = '-';
            }

            $('#summary_designation').text(designationText);


            // Role
            let roleText = $('#role_id option:selected').text().trim();

            if (!$('#role_id').val()) {
                roleText = '-';
            }

            $('#summary_role').text(roleText);
        }


        // ==========================================
        // UPDATE WHEN USER SELECTS REGION
        // ==========================================

        $('#region_id').on('change', function() {

            updateAssignmentSummary();

        });


        // ==========================================
        // UPDATE WHEN USER SELECTS DISTRICT
        // ==========================================

        $('#district_id').on('change', function() {

            updateAssignmentSummary();

        });


        // ==========================================
        // UPDATE WHEN USER SELECTS TALUK
        // ==========================================

        $('#taluk_id').on('change', function() {

            updateAssignmentSummary();

        });


        // ==========================================
        // UPDATE WHEN USER SELECTS BLOCK
        // ==========================================

        $('#block_id').on('change', function() {

            updateAssignmentSummary();

        });


        // ==========================================
        // UPDATE WHEN USER SELECTS DESIGNATION
        // ==========================================

        $('#designation_id').on('change', function() {

            updateAssignmentSummary();

        });


        // ==========================================
        // UPDATE WHEN USER SELECTS ROLE
        // ==========================================

        $('#role_id').on('change', function() {

            updateAssignmentSummary();

        });


        // Initial summary
        updateAssignmentSummary();

    });
</script>
