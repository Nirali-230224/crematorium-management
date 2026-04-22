<!doctype html>
<html lang="en">
<!--begin::Head-->
@include('layouts.topheader')

<!--end::Head-->
<!--begin::Body-->
<style>
  .icon-box {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .bg-purple {
    background: linear-gradient(45deg, #6f42c1, #9b59b6);
  }

  .card {
    border: none;
  }

  .table td,
  .table th {
    vertical-align: middle;
  }
</style>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    @include('layouts.header')

    <!--end::Header-->
    <!--begin::Sidebar-->
    @include('layouts.sidebar')

    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
      <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
          <!-- TOP CARDS -->
          <div class="row g-3">

            <!-- Today Cremations -->
            <div class="col-md-3">
              <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                  <div class="icon-box bg-primary text-white me-3">
                    <i class="bi bi-fire"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 text-muted">Today Cremations</h6>
                    <h3 class="mb-0">{{ $todayCremations }}</h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Month Cremations -->
            <div class="col-md-3">
              <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                  <div class="icon-box bg-success text-white me-3">
                    <i class="bi bi-calendar-check"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 text-muted">This Month Cremations</h6>
                    <h3 class="mb-0">{{ $monthCremations }}</h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Donation -->
            <div class="col-md-3">
              <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                  <div class="icon-box bg-purple text-white me-3">
                    ₹
                  </div>
                  <div>
                    <h6 class="mb-1 text-muted">Total Donations</h6>
                    <h3 class="mb-0">₹{{ number_format($totalDonation) }}</h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Month Donation -->
            <div class="col-md-3">
              <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                  <div class="icon-box bg-warning text-white me-3">
                    ₹
                  </div>
                  <div>
                    <h6 class="mb-1 text-muted">This Month Donations</h6>
                    <h3 class="mb-0">₹{{ number_format($monthDonation) }}</h3>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row mt-3 g-3">

            <div class="col-md-3">
              <div class="card p-3 shadow-sm rounded-4">
                <h6>Total Deceased</h6>
                <h3>{{ $totalDeceased }}</h3>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card p-3 shadow-sm rounded-4">
                <h6>Total Cremations</h6>
                <h3>{{ $totalCremations }}</h3>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card p-3 shadow-sm rounded-4">
                <h6>Total Donations</h6>
                <h3>₹{{ number_format($totalDonation) }}</h3>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card p-3 shadow-sm rounded-4">
                <h6>Total Donors</h6>
                <h3>{{ $totalDonors }}</h3>
              </div>
            </div>

          </div>

          <div class="row mt-4">

            <!-- Cremations -->
            <div class="col-md-6">
              <div class="card shadow-sm rounded-4">
                <div class="card-header d-flex justify-content-between">
                  <h5>Recent Cremations</h5>
                  <a href="{{ url('/deceased') }}" class="btn btn-sm btn-light">View All</a>
                </div>

                <div class="card-body p-0">
                  <table class="table mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Date</th>
                        <th>Type</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($recentCremations as $c)
                      <tr>
                        <td>{{ $c->deathperson_name }}</td>
                        <td>{{ $c->age }}</td>
                        <td>{{ \Carbon\Carbon::parse($c->date_of_death)->format('d-m-Y') }}</td>
                        <td>
                          <span class="badge bg-{{ $c->cremation_type=='electric'?'success':'warning' }}">
                            {{ ucfirst($c->cremation_type) }}
                          </span>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Donations -->
            <div class="col-md-6">
              <div class="card shadow-sm rounded-4">
                <div class="card-header d-flex justify-content-between">
                  <h5>Recent Donations</h5>
                  <a href="{{ url('/donation') }}" class="btn btn-sm btn-light">View All</a>
                </div>

                <div class="card-body p-0">
                  <table class="table mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($recentDonations as $d)
                      <tr>
                        <td>{{ $d->donor_name }}</td>
                        <td>₹{{ $d->amount }}</td>
                        <td>
                          <span class="badge bg-info">{{ $d->payment_method }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($d->donation_date)->format('d-m-Y') }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>

          <div class="row mt-4">

            <!-- Cremation Summary -->
            <div class="col-md-6">
              <div class="card shadow-sm rounded-4 p-4 text-center">
                <h5>This Month Cremation</h5>

                <p>Wood: <strong>{{ $wood }}</strong></p>
                <p>Electric: <strong>{{ $electric }}</strong></p>
                <p>Gas: <strong>{{ $gas }}</strong></p>

              </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-md-6">
              <div class="card shadow-sm rounded-4 p-4">
                <h5>Quick Actions</h5>

                <div class="d-flex justify-content-between mt-3">

                  <a href="{{ route('deceased.add') }}" class="btn btn-outline-primary">Add Deceased</a>

                  <a href="{{ route('donation.add') }}" class="btn btn-outline-success">Add Donation</a>

                  <a href="{{ route('deceased.report') }}" class="btn btn-outline-warning">Reports</a>

                </div>

              </div>
            </div>

          </div>


        </div>
      </div>
    </main>
    <!--end::App Main-->
    <!--begin::Footer-->
    @include('layouts.footer')

  </div>

  @include('layouts.scripts')

</body>

</html>