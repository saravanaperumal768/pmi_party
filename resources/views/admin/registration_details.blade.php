@include('admin.include.header')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-person-lines-fill" aria-hidden="true"></i></span>
                <div>

                    <h1 class="h3 mb-1">Registered Person Details</h1>

                </div>
            </div>
            <div class="heading-actions"><a class="btn btn-outline-secondary btn-sm" href="{{route('admin.dashboard') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Users</a></div>
        </div>

        <section class="row g-3">

            {{-- Profile --}}
            <div class="col-12 col-xl-4">
                <div class="panel h-100 text-center profile-card">

                    <div class="profile-cover">
                        <img
                            src="{{ asset('assets/images/election-bg.png') }}"
                            alt="User workspace preview">
                    </div>

                    <div class="profile-hero">

                        <img
                            class="avatar-img avatar-sm"
                            src="{{ !empty($registration->photo)
                        ? asset($registration->photo)
                        : asset('adminfiles/assets/images/avatar/avatar.jpg') }}"
                            alt="{{ $registration->name ?? '-' }}">

                        <h2 class="h5 mb-1">
                            {{ $registration->name ?? '-' }}
                        </h2>

                        <p class="text-muted mb-3">
                            {{ $registration->application_id ?? '-' }}
                        </p>

                        <span class="badge text-bg-success">
                            Registered
                        </span>

                    </div>

                    <div class="info-list mt-4 text-start">

                        <div>
                            <span>Email</span>
                            <strong>{{ $registration->email ?? '-' }}</strong>
                        </div>

                        <div>
                            <span>Phone</span>
                            <strong>{{ $registration->mobile_number ?? '-' }}</strong>
                        </div>

                        <div>
                            <span>Gender</span>
                            <strong>{{ $registration->gender ?? '-' }}</strong>
                        </div>

                        <div>
                            <span>Date of Birth</span>
                            <strong>{{ !empty($registration->dob)
                    ? \Carbon\Carbon::parse($registration->dob)->format('d-m-Y ')
                    : '-' }}</strong>
                        </div>

                        @if($registration->regi_flag != '1')

                        <div class="row">


                            <a href="javascript:void(0);"
                                id="approvemember"
                                data-application-id="{{ $registration->application_id }}"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> Approve
                            </a>


                            <a href="#"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-close"></i> Reject
                            </a>


                        </div>
                        @endif

                    </div>

                </div>
            </div>


            {{-- Registration Details --}}
            <div class="col-12 col-xl-8">

                <div class="panel">

                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title">
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Registration Details</span>
                            </h2>

                            <p class="text-muted mb-0">
                                Complete registration information
                            </p>
                        </div>
                    </div>


                    <div class="table-responsive">



                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th style="width: 20%;">Application ID</th>
                                    <td>{{ $registration->application_id ?? '-' }}</td>

                                    <th style="width: 20%;">Name</th>
                                    <td>{{ $registration->name ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Mobile Number</th>
                                    <td>{{ $registration->mobile_number ?? '-' }}</td>

                                    <th>Email</th>
                                    <td>{{ $registration->email ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Community</th>
                                    <td>{{ $community ?? '-' }}</td>

                                    <th>Qualification</th>
                                    <td>{{ $qual ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Constitution</th>
                                    <td>{{ $constitution ?? '-' }}</td>

                                    <th>District</th>
                                    <td>{{ $district ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Taluk</th>
                                    <td>{{ $taluk ?? '-' }}</td>

                                    <th>Block</th>
                                    <td>{{ $block ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td colspan="3">{{ $registration->address ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Applied On</th>
                                    <td colspan="3">
                                        {{ !empty($registration->created_at)
                    ? \Carbon\Carbon::parse($registration->created_at)->format('d-m-Y ')
                    : '-' }}
                                    </td>
                                </tr>

                                <tr>

                                    <th>Photo</th>
                                    <td>
                                        @if(!empty($registration->photo))
                                        <img src="{{ asset($registration->photo) }}"
                                            alt="Photo"
                                            style="width:70px;height:70px;object-fit:cover;border-radius:8px;">
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>

                                <tr>

                                </tr>

                                <tr>
                                    <th>Voter ID</th>
                                    <td>{{ $registration->voter_id ?? '-' }}</td>

                                    <th>Voter ID Proof</th>
                                    <td> <a href="{{ asset($registration->id_proof) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View ID Proof
                                        </a></td>
                                </tr>


                                <tr>
                                    <th>Aadhaar ID</th>
                                    <td>{{ $registration->aadhaar_id ?? '-' }}</td>

                                    <th>Aadhaar ID Proof</th>
                                    <td> <a href="{{ asset($registration->aadhaar_proof) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View Aadhaar ID Proof
                                        </a></td>
                                </tr>



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </section>
    </div>
</main>
@include('admin.include.footer')
