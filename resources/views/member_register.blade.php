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

        <div class="row justify-content-center pt-100 pb-100">
            <div class="col-xl-8 ">
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


                                <div class="form-group">
                                    <label name="age">Age </label>
                                    <input type="number" id="age" name="age" required>
                                    <div class="error-message"> </div>
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
                                            <input type="radio" name="gender" value="female">
                                            <span class="ms-2">Female</span>
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="others" value="others">
                                            <span class="ms-2">Others</span>
                                        </label>
                                    </div>


                                    <div class="error-message "></div>
                                    <!-- ERROR -->
                                    <div class="col-md-12">

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

                                <div class="form-group">
                                    <label>State</label>
                                    <select id="state" name="state" required>
                                        <option value="">Select State</option>
                                        <option value="tamilnadu">Tamil Nadu</option>
                                        <option value="puducherry">Puducherry</option>
                                        <option value="kerala">Kerala</option>
                                        <option value="karnataka">Karnataka</option>
                                        <option value="telangana">Telangana</option>
                                        <option value="andhra_pradesh">Andhra Pradesh</option>
                                        <option value="others">Others</option>
                                    </select>

                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label>District</label>
                                    <select id="district" name="district">
                                        <option value="">Select District</option>
                                    </select>

                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label>Assembly</label>
                                    <select id="assembly" name="assembly">
                                        <option value="">Select Assembly</option>
                                    </select>

                                    <div class="error-message"> </div>
                                </div>

                                <div class="form-group">
                                    <label>Taluk</label>
                                    <input type="text" name="taluk" placeholder="Enter your Taluk">
                                </div>

                                <div class="form-group" id="otherBox">
                                    <label>Enter Details</label>
                                    <input type="text" name="other_details" placeholder="Enter your State / District / Assembly">
                                </div>



                                <div class="form-group">
                                    <label for="phone">Full Address</label>
                                    <textarea rows="3" id="address" name="address" required></textarea>
                                    <div class="error-message"> </div>
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
                                <div class="form-group">
                                    <label for="dietary">Upload Photo</label>
                                    <input type="file" name="photo" accept="image/*" required>
                                    <span class="file-limit">Image Size only (Max 250 KB)</span><br>

                                    <div class="error-message"></div>
                                    <img id="uploadedImage" src="#" alt="Uploaded Image" accept="image/png, image/jpeg"
                                        style="display:none;">
                                </div>

                                <div class="form-group">
                                    <label>ID Proof (Aadhaar/ Voter ID)</label>

                                    <input type="file" name="id_proof" accept=".pdf,image/*" required>

                                    <span class="file-limit">PNG/PDF Size only (Max 250 KB)</span><br>

                                    <!-- FILE PREVIEW -->
                                    <div id="filePreview" style="margin-top:10px;"></div>

                                    <div class="error-message"></div>

                                </div>

                                <div class="buttons">
                                    <button type="button" class="prev">Back</button>
                                    <button type="submit" class="submit">Complete Registration</button>
                                </div>
                            </div>
                        </form>

                        <!-- Success Message -->
                        <div class="success-message" style="display:none;"></div>
                    </div>
                </div>
            </div>



        </div>



    </div>
    </div>
</section>

@include('include.footer')