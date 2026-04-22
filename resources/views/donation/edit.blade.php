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
                    <h3>Edit Donation</h3>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Update Donation</h5>
                        </div>

                        <form method="POST" action="{{ route('donation.update', $donation->id) }}">
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <!-- LEFT -->
                                    <div class="col-md-6 border-end">

                                        <h5 class="text-primary mb-3">Donation Details</h5>

                                        <!-- Type -->
                                        <div class="mb-3">
                                            <label>Type</label>
                                            <select name="type" id="type" class="form-control" disabled>
                                                <option value="open" {{ $donation->type=='open' ? 'selected' : '' }}>Open</option>
                                                <option value="after_death" {{ $donation->type=='after_death' ? 'selected' : '' }}>After Death</option>
                                            </select>
                                            <input type="hidden" name="type" value="{{ $donation->type }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Donation Date</label>
                                            <input type="date" name="donation_date" id="donation_date" class="form-control" value="{{ $donation->donation_date }}">

                                        </div>

                                        <!-- Deceased -->
                                        <div class="mb-3" id="deceased_div" style="{{ $donation->type=='after_death' ? '' : 'display:none;' }}">
                                            <label>Select Deceased</label>
                                            <select name="deceased_id" class="form-control" disabled>
                                                <option value="">-- Select --</option>
                                                @foreach($deceased as $d)
                                                <option value="{{ $d->id }}"
                                                    {{ $donation->deceased_id == $d->id ? 'selected' : '' }}>
                                                    {{ $d->deathperson_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="deceased_id" value="{{ $donation->deceased_id }}">
                                        </div>

                                        <!-- Amount -->
                                        <div class="mb-3">
                                            <label>Amount</label>
                                            <input type="number" id="amount" name="amount"
                                                value="{{ $donation->amount }}"
                                                class="form-control" readonly>
                                        </div>

                                        <!-- Amount in Words -->
                                        <div class="mb-3">
                                            <label>Amount in Words</label>
                                            <input type="text" id="amount_in_word" name="amount_in_word"
                                                value="{{ $donation->amount_in_word }}"
                                                class="form-control" readonly>
                                        </div>

                                    </div>

                                    <!-- RIGHT -->
                                    <div class="col-md-6">

                                        <h5 class="text-success mb-3">Donor Details</h5>

                                        <div class="mb-3">
                                            <label>Donor Name</label>
                                            <input type="text" id="donor_name" name="donor_name"
                                                value="{{ $donation->donor_name }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Mobile</label>
                                            <input type="text" id="mobile" name="mobile"
                                                value="{{ $donation->mobile }}"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Payment Method</label>
                                            <select name="payment_method" class="form-control">
                                                    <option value="cash" {{ $donation->payment_method=='cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="cheque" {{ $donation->payment_method=='cheque' ? 'selected' : '' }}>Cheque</option>
                                                    <option value="bank_transfer" {{ $donation->type=='bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                                </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Bank Deatils</label>
                                            <input type="text" name="bank_name" value="{{ $donation->bank_name }}" class="form-control" placeholder="Bank Name" readonly>
                                        </div>

                                        <hr>

                                        <h5 class="text-success mb-3">Remarks</h5>

                                        <div class="mb-3">
                                            <textarea name="remarks" class="form-control">{{ $donation->remarks }}</textarea>
                                        </div>

                                    </div>

                                </div>

                                <!-- Deceased Details -->
                                <div id="deceased_details" class="card mt-3" style="display:none;">
                                    <div class="card-body">
                                        <h6 class="text-primary">Deceased Details</h6>
                                        <p><strong>Name:</strong> <span id="d_name"></span></p>
                                        <p><strong>Age:</strong> <span id="d_age"></span></p>
                                        <p><strong>Date of Death:</strong> <span id="d_dod"></span></p>
                                        <p><strong>Cremation Date:</strong> <span id="d_cdate"></span></p>
                                        <p><strong>Relative:</strong> <span id="d_relative"></span></p>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="{{ route('donation.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </main>

        @include('layouts.footer')

    </div>
    <script src="{{ asset('admin/dist/js/donation.js?ver=1.0') }}"></script>
    @include('layouts.scripts')

    <!-- JS -->


</body>

</html>