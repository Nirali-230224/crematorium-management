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

<div class="app-content-header">
    <div class="container-fluid">
        <h3>Cremation Reports</h3>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

<!-- 📊 Summary Cards -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h5>Today</h5>
                <h3>{{ $today }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5>This Month</h5>
                <h3>{{ $thisMonth }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-bg-danger">
            <div class="card-body">
                <h5>This Year</h5>
                <h3>{{ $thisYear }}</h3>
            </div>
        </div>
    </div>

</div>

<!-- 📅 Daily Report -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Daily Cremations</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daily as $d)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($d->date)->format('d-m-Y') }}</td>
                    <td>{{ $d->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 📅 Monthly Report -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Monthly Cremations</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthly as $m)
                <tr>
                    <td>{{ $m->month }}-{{ $m->year }}</td>
                    <td>{{ $m->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 📅 Yearly Report -->
<div class="card">
    <div class="card-header">
        <h5>Yearly Cremations</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($yearly as $y)
                <tr>
                    <td>{{ $y->year }}</td>
                    <td>{{ $y->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
</div>

