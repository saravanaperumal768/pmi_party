@include('admin.include.header')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                <div>
                    <!-- <p class="eyebrow mb-1">Management</p> -->
                    <h1 class="h3 mb-1 text-uppercase">Member Card</h1>

                </div>
            </div>

        </div>



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
                            src="{{ !empty($member_details->photo)
                        ? asset($member_details->photo)
                        : asset('adminfiles/assets/images/avatar/avatar.jpg') }}"
                            alt="{{ $member_details->name ?? '-' }}">

                        <h2 class="h5 mb-1">
                            {{ $member_details->name ?? '-' }}
                        </h2>

                        <p class="text-muted mb-3">
                            {{ $member_details->application_id ?? '-' }}
                        </p>

                        @if($member_details->posting == '1')

                         <span class="badge text-bg-success">
                            {{$profile->designation_name_en}}
                        </span>

                        @endif


                    </div>

                    <div class="info-list mt-4 text-start">

                        <div>
                            <span>Email</span>
                            <strong>{{ $member_details->email ?? '-' }}</strong>
                        </div>

                        <div>
                            <span>Phone</span>
                            <strong>{{ $member_details->mobile_number ?? '-' }}</strong>
                        </div>

                        <div>
                            <span>Gender</span>
                            <strong>{{ $member_details->gender ?? '-' }}</strong>
                        </div>

                        <div>
                            <span>Date of Birth</span>
                            <strong>{{ !empty($member_details->dob)
                    ? \Carbon\Carbon::parse($member_details->dob)->format('d-m-Y ')
                    : '-' }}</strong>
                        </div>



                        <div class="row">




                            <a href="{{ route('admin.member.card', auth()->user()->memberid) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="fa fa-eye"></i> View Member Card
                            </a>


                        </div>


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
                                    <td>{{ $member_details->application_id ?? '-' }}</td>

                                    <th style="width: 20%;">Name</th>
                                    <td>{{ $member_details->name ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Mobile Number</th>
                                    <td>{{ $member_details->mobile_number ?? '-' }}</td>

                                    <th>Email</th>
                                    <td>{{ $member_details->email ?? '-' }}</td>
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
                                    <td colspan="3">{{ $member_details->address ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Applied On</th>
                                    <td colspan="3">
                                        {{ !empty($member_details->created_at)
                    ? \Carbon\Carbon::parse($member_details->created_at)->format('d-m-Y ')
                    : '-' }}
                                    </td>
                                </tr>

                                <tr>

                                    <th>Photo</th>
                                    <td>
                                        @if(!empty($member_details->photo))
                                        <img src="{{ asset($member_details->photo) }}"
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
                                    <td>{{ $member_details->voter_id ?? '-' }}</td>

                                    <th>Voter ID Proof</th>
                                    <td> <a href="{{ asset($member_details->id_proof) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View ID Proof
                                        </a></td>
                                </tr>


                                <tr>
                                    <th>Aadhaar ID</th>
                                    <td>{{ $member_details->aadhaar_id ?? '-' }}</td>

                                    <th>Aadhaar ID Proof</th>
                                    <td> <a href="{{ asset($member_details->aadhaar_proof) }}"
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


</main>
@include('admin.include.footer')
