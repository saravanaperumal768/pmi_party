 @include('admin.include.header')

 <section class="panel mt-3">
            <div class="panel-header">
                <div class="row align-items-center g-2 w-100">

                    <div class="col-md-9">
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-table"></i>
                            <span>Our Party Incharges</span>
                        </h2>
                    </div>

                    <div class="col-md-3">
                        <input
                            class="form-control form-control-sm table-search"
                            type="search"
                            placeholder="Search users"
                            data-table-search="usersTable"
                            aria-label="Search users">
                    </div>

                    <!-- <div class="col-md-2 text-md-end">
                        <a class="btn btn-primary btn-sm" href="add-user.html">
                            <i class="bi bi-person-plus"></i>
                            Add User
                        </a>
                    </div> -->

                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle" id="usersTable">

                    <thead>
                        <tr>
                            <th>Designation Level</th>
                            <th>Incharge of</th>


                            <th scope="col"> Name</th>

                            <th scope="col">Mobile</th>

                            <th scope="col">Action</th>

                            <!-- <th class="text-center" >Action</th> -->
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($posting as $member)

                        <tr>
                            <td>{{ $member->designation_level ?? '-' }}</td>
                            <td>{{ $member->designation_name_en ?? '-' }}</td>

                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img
                                        class="avatar-img avatar-sm"
                                        src="{{ asset($member->photo) }}"
                                        alt="{{ $member->name ?? '-' }}">
                                    <div>
                                        <p class="fw-semibold mb-0">
                                            {{ $member->name ?? '-' }}
                                        </p>

                                        <p class="text-muted small mb-0">
                                            {{ $member->email ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </td>




                            <td>
                                {{ $member->mobile_number ?? '-' }}
                            </td>

                        <td>
    <div class="form-check form-switch">
        <input
            class="form-check-input posting-toggle"
            type="checkbox"
            role="switch"
            id="posting_{{ $member->id }}"
            data-id="{{ $member->id }}"
            {{ (int) $member->posting === 1 ? 'checked' : '' }}>

        <label
            class="form-check-label"
            for="posting_{{ $member->id }}">
            {{ (int) $member->posting === 1 ? 'Active' : 'Inactive' }}
        </label>
    </div>
</td>





                        <!-- <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.registration_details', ['memberid' => $member->application_id]) }}"
                                class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View
                                </a>


                            </div>
                        </td> -->

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No registrations found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                <p class="text-muted small mb-0">Showing 1 to 5 of 124 users</p>
                <nav aria-label="Users pagination">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </section>
@include('admin.include.footer')

<script>

</script>
