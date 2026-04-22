<!doctype html>
<html lang="en">

@include('layouts.topheader')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        @include('layouts.header')
        @include('layouts.sidebar')

        <main class="app-main">

            <!-- Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Deceased Entry Form</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Deceased Form</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="app-content">
                <div class="container-fluid">

                    <div class="row g-4">

                        <div class="col-md-12">

                            <div class="card card-warning card-outline mb-4">

                                <div class="card-header">
                                    <div class="card-title">New Deceased Entry</div>
                                </div>

                                <form method="POST" action="{{ route('deceased.store') }}">
                                    @csrf

                                    <div class="card-body">

                                        <div class="row">

                                            <!-- LEFT SIDE -->
                                            <div class="col-md-6 border-end">

                                                <h5 class="mb-3 text-primary">Deceased Details</h5>

                                                <div class="mb-3">
                                                    <label>Name</label>
                                                    <input type="text" name="deathperson_name"
                                                        class="form-control @error('deathperson_name') is-invalid @enderror">
                                                    @error('deathperson_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label>Age</label>
                                                    <input type="number" name="age" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Address</label>
                                                    <textarea name="address"
                                                        class="form-control @error('address') is-invalid @enderror"></textarea>
                                                    @error('address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <hr>

                                                <h5 class="mb-3 text-primary">Death Details</h5>
                                                <div class="mb-3">
                                                    <label>Reason</label>
                                                    <input type="text" name="reason"
                                                        class="form-control @error('reason') is-invalid @enderror">
                                                    @error('reason')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Date of Death</label>
                                                    <input type="text" name="date_of_death" id="date_of_death"
                                                        class="form-control @error('date_of_death') is-invalid @enderror">
                                                    @error('date_of_death')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                

                                            </div>

                                            <!-- RIGHT SIDE -->
                                            <div class="col-md-6">

                                                

                                                <h5 class="mb-3 text-success">Cremation Details</h5>
                                                <div class="mb-3">
                                                    <label>Cremation Date</label>
                                                    <input type="text" name="cremation_date" id="cremation_date"
                                                        class="form-control @error('cremation_date') is-invalid @enderror">
                                                    @error('cremation_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label>Time</label>
                                                    <input type="text" name="death_time" id="death_time"
                                                        class="form-control">
                                                </div>

                                               
                                                <div class="mb-3">
                                                    <label>Cremation Type</label>
                                                    <select name="cremation_type" class="form-control">
                                                        <option value="wood">Wood</option>
                                                        <option value="electric">Electric</option>
                                                        <option value="electric">Gas</option>
                                                    </select>
                                                </div>

                                                <hr>

                                                <h5 class="mb-3 text-success">Relative Details</h5>

                                                <div class="mb-3">
                                                    <label>Relative Name</label>
                                                    <input type="text" name="relative_name"
                                                        class="form-control @error('relative_name') is-invalid @enderror">
                                                    @error('relative_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label>Relative Address</label>
                                                    <textarea name="relative_address" class="form-control"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Mobile</label>
                                                    <input type="text" name="mobile"
                                                        class="form-control @error('mobile') is-invalid @enderror">
                                                    @error('mobile')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                

                                                <div class="mb-3">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control"></textarea>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                        <a href="{{ route('deceased.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </main>

        @include('layouts.footer')

    </div>

    @include('layouts.scripts')

</body>

</html>