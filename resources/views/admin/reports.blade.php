@include('admin.include.header')
  <main class="dashboard-content reports">
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
              <div>

                <h1 class="h3 mb-1">Reports</h1>

              </div>
            </div>

          </div>

          <section class="row g-3 mt-1" aria-label="Dashboard metrics">
            <div class="col-12 col-sm-6 col-xl-4">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Total registrations</span>
                  <a href="{{route('admin.total_register')}}"><span class="metric-icon"> <i class="bi bi-download" aria-hidden="true"></i></span></a>
                </div>

                <div class="metric-meta">

                  <span>Entry From Registration Form</span>
                </div>
              </article>
            </div>

               <div class="col-12 col-sm-6 col-xl-4">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Approved Members</span>
                  <a href="{{route('admin.export.members')}}"><span class="metric-icon"> <i class="bi bi-download" aria-hidden="true"></i></span></a>
                </div>

                <div class="metric-meta">

                  <span>Approved By our Admin/President </span>
                </div>
              </article>
            </div>


                   <div class="col-12 col-sm-6 col-xl-4">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Incharges</span>
                  <a href="{{route('admin.export.incharges')}}"><span class="metric-icon"> <i class="bi bi-download" aria-hidden="true"></i></span></a>
                </div>

                <div class="metric-meta">

                  <span>Incharges </span>
                </div>
              </article>
            </div>


          </section>


        </div>
      </main>
@include('admin.include.footer')
