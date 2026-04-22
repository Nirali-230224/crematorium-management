<!doctype html>
<html lang="en">
<!--begin::Head-->
@include('layouts.topheader')
<!--end::Head-->
<!--begin::Body-->

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
                            <h3 class="mb-0">User Form</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Form</li>
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
                    <!--begin::Row-->
                    <div class="row g-4">
                        <!--begin::Col-->
                        <div class="col-12">
                            <!-- <div class="callout callout-info">
                  For detailed documentation of Form visit
                  <a
                    href="https://getbootstrap.com/docs/5.3/forms/overview/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="callout-link"
                  >
                    Bootstrap Form
                  </a>
                </div> -->
                        </div>

                        <div class="col-md-6">

                            <div class="card card-warning card-outline mb-4">
                                <div class="card-header">
                                    <div class="card-title">New User Entry</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Form-->
                                @csrf
                                <form method="POST" action="{{ route('user.submit') }}">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" />
                                            </div>
                                            @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail3" name="email" />
                                            </div>
                                            @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword3" name="password" />
                                            </div>
                                            @error('password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="role"
                                                        id="gridRadios1"
                                                        value="admin"
                                                        checked />
                                                    <label class="form-check-label" for="gridRadios1"> Admin </label>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="role"
                                                        id="gridRadios2"
                                                        value="staff" />
                                                    <label class="form-check-label" for="gridRadios2"> Staff </label>
                                                </div>

                                            </div>
                                        </fieldset>

                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning">Sign in</button>

                                    </div>
                                    <!--end::Footer-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        @include('layouts.footer')
        <!--end::Footer-->
    </div>

    @include('layouts.scripts')

</body>
<!--end::Body-->

</html>