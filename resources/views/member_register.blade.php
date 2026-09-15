@include('include.header')

<section class="contact-ip-area py-40 tw-mb-10">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="text-center">
                    <div class="section-wrapper ">
                        <h2 class="section-title text-cEnter tw-text-29 fw-semibold text-uppercase tw-char-animation">
                            Member Registration Form
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-50 member_regi">
            <div class="col-xl-12">
                <h2 class="text-center">Member Registration</h2>

            </div>
        </div>

        <div class="row justify-content-center pt-50 pb-100">

            <div class="col-xl-8">
                <div class="register-container">
                    <div class="sidebar">

                        <div class="progress-steps">
                            <div class="step-item active">
                                <div class="step-number">1</div>
                                <div class="step-text">Basic Details</div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-text">Educational and Job Details</div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-text">Address Details</div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-text">ID Proof</div>
                            </div>
                        </div>
                    </div>

                    <div class="main-content">
                        <form id="registrationForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Step 1: Personal Information -->
                            <div class="form-step active">
                                <div class="form-header">
                                    <h1>Basic Details</h1>

                                </div>
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" id="name" name="name" required>
                                    <div class="error-message"> </div>
                                </div>
                                <div class="form-group">
                                    <label name="full name">Father / Guardian Name </label>
                                    <input type="text" id="father_name" name="father_name" required>
                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label name="dob">Date of Birth </label>
                                    <input type="date" id="dob" name="dob" required>
                                    <div class="error-message"> </div>
                                </div>
                                <input type="hidden" name="age" id="age">


                                <div class="form-group">
                                    <label for="community">Community</label>

                                    <input
                                        type="text"
                                        id="community"
                                        name="community"
                                        required>

                                    <div class="error-message"></div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-12">Gender</label>

                                    <div class="col-md-3">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="gender" value="Male" required>
                                            <span class="ms-2">Male</span>
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="gender" value="Female">
                                            <span class="ms-2">Female</span>
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="gender" value="others">
                                            <span class="ms-2">Others</span>
                                        </label>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="error-message"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12">Marital Status</label>

                                    <div class="col-md-3">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="martialstatus" value="Single" required>
                                            <span class="ms-2">Single</span>
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="martialstatus" value="Married">
                                            <span class="ms-2">Married</span>
                                        </label>
                                    </div>

                                    <!-- ERROR -->
                                    <div class="col-12">
                                        <div class="error-message"></div>
                                    </div>
                                </div>




                                <div class="buttons">
                                    <button type="button" class="next">Continue</button>
                                </div>
                            </div>
                            <!-- Step 2: Address Details -->
                            <div class="form-step">
                                <div class="form-header">
                                    <h1>Educational and Job Details</h1>

                                </div>

                                <div class="form-group">
                                    <label for="phone">Blood Group</label>
                                    <input type="text" id="blood_group" name="blood_group" required>
                                    <div class="error-message"> </div>
                                </div>


                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="mobile_number" name="mobile_number" required>
                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email ID</label>
                                    <input type="email" id="email" name="email" required>
                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" id="qualification" name="qualification" required>
                                    <div class="error-message"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" id="occupation" name="occupation" required>
                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label for="socialmedia">Any Social Media ID (Instagram / Facebook /
                                        Twitter)</label>
                                    <input type="text" id="social_media" name="social_media" required>
                                    <div class="error-message"> </div>
                                </div>

                                <div class="buttons">
                                    <button type="button" class="prev">Back</button>
                                    <button type="button" class="next">Continue</button>
                                </div>
                            </div>

                            <!-- Step 2: Event Details -->
                            <div class="form-step">
                                <div class="form-header">
                                    <h1>Address Details</h1>
                                </div>

                                <!-- State -->
                                <div class="form-group">
                                    <label for="state">State</label>

                                    <select id="state" name="state" required>
                                        <option value="">Select State</option>

                                        <option value="tamil_nadu">Tamil Nadu</option>
                                    </select>

                                    <div class="error-message"></div>
                                </div>


                                <!-- Constitution -->
                                <div class="form-group">
                                    <label for="constitution">Constitution</label>

                                    <select id="constitution" name="constitution">
                                        <option value="">Select Constitution</option>

                                        @foreach($const as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->acname_eng }}
                                        </option>
                                        @endforeach

                                    </select>

                                    <div class="error-message"></div>
                                </div>


                                <!-- District -->
                                <div class="form-group">
                                    <label for="district">District</label>

                                    <select id="district" name="district" required>
                                        <option value="">Select District</option>

                                        @foreach($district as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->districtname_eng }}
                                        </option>
                                        @endforeach

                                    </select>

                                    <div class="error-message"></div>
                                </div>


                                <!-- Taluk -->
                                <div class="form-group">
                                    <label for="taluk">Taluk</label>

                                    <select id="taluk" name="taluk">
                                        <option value="">Select Taluk</option>

                                        @foreach($taluk as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->taluk_name_eng }}
                                        </option>
                                        @endforeach

                                    </select>

                                    <div class="error-message"></div>
                                </div>


                                <!-- Block -->
                                <div class="form-group">
                                    <label for="block">Block</label>

                                    <select id="block" name="block">
                                        <option value="">Select Block</option>

                                        @foreach($block as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->block_name_eng }}
                                        </option>
                                        @endforeach

                                    </select>

                                    <div class="error-message"></div>
                                </div>



                                <!-- Part Number -->
                                <div class="form-group">
                                    <label for="part">Part Number</label>

                                    <input
                                        type="text"
                                        id="part"
                                        name="part"
                                        placeholder="Enter Part Number">

                                    <div class="error-message"></div>
                                </div>


                                <!-- Other Details -->
                                <div class="form-group" id="otherBox">
                                    <label>Enter Details</label>

                                    <input
                                        type="text"
                                        name="other_details"
                                        placeholder="Enter your State / District / Assembly">

                                    <div class="error-message"></div>
                                </div>


                                <!-- Full Address -->
                                <div class="form-group">
                                    <label for="address">Full Address</label>

                                    <textarea
                                        rows="3"
                                        id="address"
                                        name="address"
                                        required></textarea>

                                    <div class="error-message"></div>
                                </div>


                                <div class="buttons">
                                    <button type="button" class="prev">Back</button>
                                    <button type="button" class="next">Continue</button>
                                </div>
                            </div>

                            <!-- Step 3: Additional Information -->
                            <div class="form-step">

                                <div class="form-header">
                                    <h1>ID Proof</h1>
                                </div>

                                <!-- PHOTO -->
                                <div class="form-group">

                                    <label for="photo">Upload Photo</label>

                                    <input
                                        type="file"
                                        name="photo"
                                        id="photo"
                                        accept=".png,.jpg,.jpeg"
                                        onchange="previewImage(this)">

                                    <span class="file-limit">
                                        PNG/JPG Size only (Max 1 MB)
                                    </span>

                                    <div class="error-message"></div>

                                    <img
                                        id="uploadedImage"
                                        src=""
                                        alt="Uploaded Image"
                                        style="
                                            display:none;
                                            width:150px;
                                            height:150px;
                                            object-fit:cover;
                                            margin-top:10px;
                                            border:1px solid #ddd;
                                            border-radius:5px;
                                        ">

                                </div>


                                <!-- VOTER ID -->
                                <div class="form-group">

                                    <label for="voter_id">
                                        Voter ID Number
                                    </label>

                                    <input
                                        type="text"
                                        name="voter_id"
                                        id="voter_id"
                                        placeholder="Enter your Voter ID Number">

                                    <div class="error-message"></div>

                                </div>


                                <!-- VOTER ID PROOF -->
                                <div class="form-group">

                                    <label for="id_proof">
                                        Upload Voter ID
                                    </label>

                                    <input
                                        type="file"
                                        name="id_proof"
                                        id="id_proof"
                                        accept=".pdf,.png,.jpg,.jpeg"
                                        onchange="previewIdProof(this)">

                                    <span class="file-limit">
                                        PDF/PNG/JPG Size only (Max 1 MB)
                                    </span>

                                    <div class="error-message"></div>

                                    <div
                                        id="filePreview"
                                        style="margin-top:10px;"></div>

                                </div>


                                <div class="buttons">

                                    <button type="button" class="prev">
                                        Back
                                    </button>

                                    <button type="submit" class="submit">
                                        Complete Registration
                                    </button>

                                </div>

                            </div>
                        </form>

                        <!-- Success Message -->
                        <div class="success-message" style="display:none;"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 joinus">
                <img src="assets/images/joinus.jpg">
            </div>



        </div>



    </div>
    </div>
</section>

@include('include.footer')