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

            <!-- Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Donation Report</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Donation Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="app-content">
                <div class="container-fluid">

                    <!-- 🔍 Filters -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Filter Report</h3>
                        </div>

                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-3">
                                    <label>Donor Name</label>
                                    <input type="text"
                                        name="donor_name"
                                        value="{{ request('donor_name') }}"
                                        class="form-control"
                                        placeholder="Search name">
                                </div>

                                <div class="col-md-3">
                                    <label>Type</label>
                                    <select name="type" class="form-control">
                                        <option value="">All</option>
                                        <option value="after_death" {{ request('type')=='after_death' ? 'selected' : '' }}>
                                            After Death
                                        </option>
                                        <option value="open" {{ request('type')=='open' ? 'selected' : '' }}>
                                            Open
                                        </option>
                                    </select>
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
                                    <input type="date" name="from" value="{{ request('from') }}" class="form-control" id="from_date">
                                </div>

                                <div class="col-md-3">
                                    <label>To Date</label>
                                    <input type="date" name="to" value="{{ request('to') }}" class="form-control" id="to_date">
                                </div>

                                <div class="col-md-3">
                                    <label>Payment Method</label>
                                    <select name="payment_method" class="form-control">
                                        <option value="">All</option>
                                        <option value="cash" {{ request('payment_method')=='cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="cheque" {{ request('payment_method')=='cheque' ? 'selected' : '' }}>UPI</option>
                                        <option value="bank_transfer" {{ request('payment_method')=='bank_transfer' ? 'selected' : '' }}>Bank</option>
                                    </select>
                                </div>

                                <div class="col-md-3 d-flex align-items-end">

                                    <button type="submit" class="btn btn-primary me-2 w-50">
                                        <i class="fas fa-search"></i> Filter
                                    </button>

                                    <!-- 🔄 Reset Button -->
                                    <a href="{{ route('donation.report') }}" class="btn btn-secondary w-50">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>

                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- 💰 Summary -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-0">
                                Total Donation: <span class="text-success">₹{{ $total }}</span>
                            </h5>
                        </div>
                    </div>

                    <!-- 📊 Report Table -->
                    <div class="card mb-4">

                        <!-- Card Header -->
                        <div class="card-header">
                            <h3 class="card-title mb-0">Donation Report List</h3>

                            <a href="{{ route('donation.pdf', request()->query()) }}"
                                class="btn btn-danger btn-sm float-end">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>

                            <!-- <a href="{{ route('donation.excel', request()->query()) }}"
                                class="btn btn-success btn-sm float-end">
                                Excel
                            </a> -->
                        </div>

                        <!-- Card Body -->
                        <div class="card-body" id="printArea">

                            @if($donations->isEmpty())
                            <div class="alert alert-warning">No records found</div>
                            @else

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Receipt</th>
                                        <th>Donor</th>
                                        <th>Type</th>
                                        <th>Deceased</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Bank</th>
                                        <th>Mobile</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($donations as $donation)
                                    <tr class="align-middle">

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <span class="badge text-bg-success">
                                                {{ $donation->receipt_no }}
                                            </span>
                                        </td>

                                        <td>{{ $donation->donor_name }}</td>

                                        <td>
                                            <span class="badge text-bg-info">
                                                {{ $donation->type == 'after_death' ? 'After Death' : 'Open' }}
                                            </span>
                                        </td>

                                        <td>{{ $donation->deceased->deathperson_name ?? '-' }}</td>

                                        <td>₹{{ $donation->amount }}</td>

                                        <td>{{ ucfirst($donation->payment_method) }}</td>

                                        <td>{{ $donation->bank_name ?? '-' }}</td>

                                        <td>{{ $donation->mobile }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($donation->donation_date ?? $donation->created_at)->format('d-m-Y') }}
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            @endif

                        </div>

                        <!-- Footer -->
                        <div class="card-footer clearfix">
                            {{ $donations->links() }}
                        </div>

                    </div>

                </div>
            </div>

        </main>

        @include('layouts.footer')

    </div>

    @include('layouts.scripts')

</body>
<script>
    function printReport() {
        let content = document.getElementById('printArea').innerHTML;
        let original = document.body.innerHTML;

        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = original;


    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#from_date", {
        dateFormat: "Y-m-d",
        maxDate: "today"
    });

    flatpickr("#to_date", {
        dateFormat: "Y-m-d",
        maxDate: "today"
    });
</script>

</html>