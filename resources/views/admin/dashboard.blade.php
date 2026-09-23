@include('admin.include.header')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                <div>
                    <!-- <p class="eyebrow mb-1">Management</p> -->
                    <h1 class="h3 mb-1 text-uppercase">Registration DETAILS</h1>
                    <p class="text-muted mb-0">Review Registration details, roles and status</p>
                </div>
            </div>
            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="#"><i class="bi bi-download" aria-hidden="true"></i> Export</a>
                <!-- <a class="btn btn-primary btn-sm" href="#"><i class="bi bi-person-plus" aria-hidden="true"></i> Add User</a> -->
            </div>
        </div>

        <section class="row g-3 mt-1" aria-label="User summary">
            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-primary">
                    <div class="metric-top">
                        <span class="metric-label">Total registrations</span>
                        <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                    </div>
                    <div class="metric-value">{{$registrationCount}}</div>
                    <div class="metric-meta">
                        <!-- <span class="text-success">+5.1%</span> -->
                        <span>this month</span>
                    </div>
                </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-success">
                    <div class="metric-top">
                        <span class="metric-label">Active</span>
                        <span class="metric-icon"><i class="bi bi-check2-circle" aria-hidden="true"></i></span>
                    </div>
                    <div class="metric-value">0</div>
                    <div class="metric-meta">
                        <!-- <span class="text-success">91%</span> -->
                        <span>healthy accounts</span>
                    </div>
                </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-warning">
                    <div class="metric-top">
                        <span class="metric-label">Pending</span>
                        <span class="metric-icon"><i class="bi bi-hourglass-split" aria-hidden="true"></i></span>
                    </div>
                    <div class="metric-value">0</div>
                    <div class="metric-meta">
                        <!-- <span class="text-warning">12</span> -->
                        <span>need approval</span>
                    </div>
                </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-danger">
                    <div class="metric-top">
                        <span class="metric-label">Suspended</span>
                        <span class="metric-icon"><i class="bi bi-slash-circle" aria-hidden="true"></i></span>
                    </div>
                    <div class="metric-value">0</div>
                    <div class="metric-meta">
                        <!-- <span class="text-danger">4</span> -->
                        <span>flagged today</span>
                    </div>
                </article>
            </div>
        </section>

        <section class="panel mt-3">
            <div class="panel-header">
                <div class="row align-items-center g-2 w-100">

                    <div class="col-md-9">
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-table"></i>
                            <span>Registered Details</span>
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
                            <th scope="col"> Name</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Mobile</th>
                            <!-- <th scope="col">Address</th> -->
                            <th scope="col">Voter Id</th>

                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($registration as $registration)

                        <tr>

                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img
                                        class="avatar-img avatar-sm"
                                        src="{{ asset($registration->photo) }}"
                                        alt="{{ $registration->name ?? '-' }}">
                                    <div>
                                        <p class="fw-semibold mb-0">
                                            {{ $registration->name ?? '-' }}
                                        </p>

                                        <p class="text-muted small mb-0">
                                            {{ $registration->email ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </td>


                            <td>
                                {{ $registration->dob ?? '-' }}
                            </td>

                            <td>
                                {{ $registration->gender ?? '-' }}
                            </td>

                            <td>
                                {{ $registration->mobile_number ?? '-' }}
                            </td>

                            <!-- <td>
                                {{ $registration->address ?? '-' }}
                            </td> -->

                            <td>
                                {{ $registration->voter_id ?? '-' }}
                            </td>



                            <td class="text-end">
                                <a
                                    href="{{ route('admin.registration_details', ['memberid' => $registration->application_id]) }}"
                                    class="btn btn-light btn-sm">
                                    View
                                </a>
                            </td>

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
    </div>
</main>
@include('admin.include.footer')
