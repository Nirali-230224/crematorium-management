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
                        <h3 class="mb-0">Donation List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Donation List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <div class="card mb-4">

                            <!-- Card Header -->
                            <div class="card-header">
                                <h3 class="card-title mb-0">Donations</h3>

                                <a href="{{ route('donation.add') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="fas fa-plus"></i> Add Donation
                                </a>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Receipt No</th>
                                            <th>Donor Name</th>
                                            <th>Type</th>
                                            <th>Deceased</th>
                                            <th>Amount</th>
                                            <th>Mobile</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Receipt</th>
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

                                            <td>
                                                {{ $donation->deceased->deathperson_name ?? '-' }}
                                            </td>

                                            <td>₹{{ $donation->amount }}</td>

                                            <td>{{ $donation->mobile }}</td>

                                            <td>{{ $donation->donation_date }}</td>

                                            <td>
                                                <span class="badge text-bg-warning">
                                                    <a href="{{ route('donation.edit', $donation->id) }}" class="ahrefclass">
                                                        Edit
                                                    </a>
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge text-bg-danger">
                                                    <a href="{{ route('donation.delete', $donation->id) }}" 
                                                       class="ahrefclass"
                                                       onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </a>
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge text-bg-primary">
                                                    <a href="{{ route('donation.receipt', $donation->id) }}" class="ahrefclass">
                                                        Print
                                                    </a>
                                                </span>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                            <!-- Footer -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <!-- optional pagination -->
                                </ul>
                            </div>

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