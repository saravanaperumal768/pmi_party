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
            <div class="heading-actions"><a class="btn btn-outline-secondary btn-sm" href="{{route('admin.dashboard') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Users</a><a class="btn btn-primary btn-sm" href="add-user.html"><i class="bi bi-person-plus" aria-hidden="true"></i> Add User</a></div>
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
                            <strong>{{ $registration->dob ?? '-' }}</strong>
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

                        <table class="table table-bordered table-hover align-middle mb-0">

                            <tbody>

                                @foreach((array) $registration as $field => $value)

                                {{-- Do not display these fields --}}
                                @if(in_array($field, ['id', 'other_details', 'regi_status', 'regi_flag', 'member_registration', 'referral', 'updated_at']))
                                @continue
                                @endif

                                <tr>

                                    <th
                                        class="text-capitalize"
                                        style="width:35%;">

                                        @if($field === 'created_at')
                                        Applied On
                                        @else
                                        {{ str_replace('_', ' ', $field) }}
                                        @endif

                                    </th>

                                    <td>

                                        @if($field === 'community')

                                        {{ $community ?? '-' }}

                                        @elseif($field === 'qualification')

                                        {{ $qual ?? '-' }}

                                        @elseif($field === 'constitution')

                                        {{ $constitution ?? '-' }}

                                        @elseif($field === 'district')

                                        {{ $district ?? '-' }}

                                        @elseif($field === 'taluk')

                                        {{ $taluk ?? '-' }}

                                        @elseif($field === 'block')

                                        {{ $block ?? '-' }}

                                        @elseif($field === 'created_at')


                                        {{ $value
                                            ? \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s')
                                            : '-' }}


                                        @elseif($field === 'id_proof' && !empty($value))

                                        <a
                                            href="{{ asset($value) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View ID Proof
                                        </a>

                                        @elseif($field === 'photo' && !empty($value))

                                        <img
                                            src="{{ asset($value) }}"
                                            alt="Photo"
                                            style="width:100px;height:100px;object-fit:cover;border-radius:8px;">

                                        @elseif($field === 'created_at' || $field === 'updated_at')

                                                    {{ $value
                                    ? \Carbon\Carbon::parse($value)->format('d-m-Y')
                                    : '-' }}

                                        @else

                                        {{ $value ?? '-' }}

                                        @endif

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>
    </div>
</main>
@include('admin.include.footer')
