

@include('include.header')



        <!-- Page Title -->
        <div class="page-title-area ">
            <div class="title-shape">
                <img src="assets/images/page_banner_img.jpg" alt="Title">

            </div>
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">

                        <div class="title-content">
                            <h2>About Us</h2>
                            <ul>
                                <li>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li>
                                    <span>About Us</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- About Party -->
        <section class="about-section">
            <div class="container">



                <div class="row">

                    <div class="col-md-7">
                        <div class="about-content">

                            <h3>Our Commitment</h3>

                            <p>
                                Our party is committed to serving the people and
                                working towards inclusive, transparent and
                                sustainable development.
                            </p>

                            <p>
                                We believe that effective public participation,
                                responsible governance and equal opportunities
                                are essential for building a stronger society.
                            </p>

                            <p>
                                Our focus is on addressing the needs of citizens,
                                supporting development initiatives and creating
                                opportunities for future generations.
                            </p>

                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="about-image">
                            <img src="assets/images/banner/banner-bg2.jpg"
                                alt="About Party" class="img-responsive">
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- Vision & Mission -->
        <section class="vision-mission-section">

            <div class="container">

                <div class="section-heading">
                    <h2>Vision & Mission</h2>
                    <span></span>
                </div>

                <div class="row">

                    <!-- Vision -->
                    <div class="col-md-6">
                        <div class="info-card">



                            <div class="info-content">
                                <h3>Our Vision</h3>

                                <p>
                                    To build a progressive, inclusive and
                                    prosperous society where every citizen has
                                    equal opportunities and access to development.
                                </p>
                            </div>

                        </div>
                    </div>


                    <!-- Mission -->
                    <div class="col-md-6">
                        <div class="info-card">



                            <div class="info-content">
                                <h3>Our Mission</h3>

                                <p>
                                    To work with people and communities to promote
                                    responsible governance, social development,
                                    transparency and sustainable growth.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

@include('include.footer')
