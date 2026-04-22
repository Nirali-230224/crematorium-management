<!doctype html>
<html lang="en">

@include('layouts.topheader')

<style>
    a.ahrefclass {
        text-decoration: none;
        color: #000;
    }
</style>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        @include('layouts.message')
        @include('layouts.header')
        @include('layouts.sidebar')

        <main class="app-main">

            <div class="app-content-header">
                <div class="container-fluid">
                    <h3>Deceased Report</h3>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    <!-- 🔍 Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" class="row g-3">

                                <div class="col-md-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ request('name') }}" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>Date of Death</label>
                                    <input type="date" name="date_of_death" id="date_of_death" value="{{ request('date_of_death') }}" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>Cremation Type</label>
                                    <select name="cremation_type" class="form-control">
                                        <option value="">All</option>
                                        <option value="wood" {{ request('cremation_type')=='wood'?'selected':'' }}>Wood</option>
                                        <option value="electric" {{ request('cremation_type')=='electric'?'selected':'' }}>Electric</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Age</label>
                                    <input type="number" name="age" value="{{ request('age') }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Date Filter</label>
                                    <select name="date_filter" class="form-control">
                                        <option value="">All</option>
                                        <option value="daily" {{ request('date_filter')=='daily' ? 'selected' : '' }}>Today</option>
                                        <option value="monthly" {{ request('date_filter')=='monthly' ? 'selected' : '' }}>This Month</option>
                                        <option value="yearly" {{ request('date_filter')=='yearly' ? 'selected' : '' }}>This Year</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>From Date</label>
                                    <input type="date"
                                        name="from_date" id="from_date"
                                        value="{{ request('from_date') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>To Date</label>
                                    <input type="date"
                                        name="to_date" id="to_date"
                                        value="{{ request('to_date') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-3 d-flex align-items-end gap-2">
                                    <button class="btn btn-primary flex-fill">Filter</button>

                                    <a href="{{ route('deceased.report') }}" class="btn btn-secondary flex-fill">
                                        Reset
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- 📊 Table -->
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Deceased List</h3>

                            <div class="float-end">
                                <!-- <a href="{{ route('deceased.excel', request()->query()) }}" class="btn btn-success btn-sm">Excel</a> -->
                                <a href="{{ route('deceased.pdf', request()->query()) }}" class="btn btn-danger btn-sm">PDF</a>
                            </div>
                        </div>

                        <div class="card-body">

                            @if($deceased->isEmpty())
                            <div class="alert alert-warning">No records found</div>
                            @else

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Reason</th>
                                        <th>Date of Death</th>
                                        <th>Cremation Date</th>
                                        <th>Cremation Type</th>
                                        <th>Relative name</th>
                                        <th>Mobile</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($deceased as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->deathperson_name }}</td>
                                        <td>{{ $d->age }}</td>
                                        <td>{{ $d->reason }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->date_of_death)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->cremation_date)->format('d-m-Y') }}</td>
                                        <td>{{ ucfirst($d->cremation_type) }}</td>
                                        <td>{{ $d->relative_name }}</td>
                                        <td>{{ $d->mobile }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @endif

                        </div>

                        <div class="card-footer">
                            {{ $deceased->links() }}
                        </div>

                    </div>

                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script>
                flatpickr("#date_of_death", {
                    dateFormat: "Y-m-d",
                    maxDate: "today"
                });
                flatpickr("#from_date", {
                    dateFormat: "Y-m-d",
                    maxDate: "today"
                });
                flatpickr("#to_date", {
                    dateFormat: "Y-m-d",
                    maxDate: "today"
                });
            </script>