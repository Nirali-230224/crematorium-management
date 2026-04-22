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
                            <h3 class="mb-0">Donation Entry Form</h3>
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
                                    <div class="card-title">New Donation</div>
                                </div>

                                <form method="POST" action="{{ route('donation.store') }}">
                                    @csrf

                                    <div class="card-body">
                                        <div class="row">

                                            <!-- LEFT SIDE -->
                                            <div class="col-md-6 border-end">

                                                <h5 class="mb-3 text-primary">Donation Details</h5>

                                                <!-- Type -->
                                                <div class="mb-3">
                                                    <label>Donation Type</label>
                                                    <select name="type" id="type"
                                                        class="form-control @error('type') is-invalid @enderror">
                                                        <option value="open">Open Donation</option>
                                                        <option value="after_death">After Death</option>
                                                    </select>
                                                    @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Donation Date</label>
                                                    <input type="date" name="donation_date" id="donation_date" class="form-control @error('donation_date') is-invalid @enderror">
                                                    @error('donation_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Deceased Dropdown -->
                                                <div class="mb-3" id="deceased_div" style="display:none;">
                                                    <label>Select Deceased</label>
                                                    <select name="deceased_id" class="form-control">
                                                        <option value="">-- Select --</option>
                                                        @foreach($deceased as $d)
                                                        <option value="{{ $d->id }}">
                                                            {{ $d->deathperson_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div id="deceased_details" class="card mt-3" style="display:none;">
                                                    <div class="card-body">

                                                        <h6 class="text-primary">Deceased Details</h6>
                                                        <hr>

                                                        <p><strong>Name:</strong> <span id="d_name"></span></p>
                                                        <p><strong>Age:</strong> <span id="d_age"></span></p>
                                                        <p><strong>Date of Death:</strong> <span id="d_dod"></span></p>
                                                        <p><strong>Cremation Date:</strong> <span id="d_cdate"></span></p>
                                                        <p><strong>Relative:</strong> <span id="d_relative"></span></p>

                                                    </div>
                                                </div>

                                                <!-- Amount -->
                                                <div class="mb-3">
                                                    <label>Amount</label>
                                                    <input type="number" name="amount" id="amount"
                                                        class="form-control @error('amount') is-invalid @enderror">
                                                    @error('amount')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Amount in Words -->
                                                <div class="mb-3">
                                                    <label>Amount in Words</label>
                                                    <input type="text" name="amount_in_word" id="amount_in_word"
                                                        class="form-control">
                                                </div>

                                            </div>

                                            <!-- RIGHT SIDE -->
                                            <div class="col-md-6">

                                                <h5 class="mb-3 text-success">Donor Details</h5>

                                                <div class="mb-3">
                                                    <label>Donor Name</label>
                                                    <input type="text" name="donor_name" id="donor_name"
                                                        class="form-control @error('donor_name') is-invalid @enderror">
                                                    @error('donor_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label>Mobile</label>
                                                    <input type="text" name="mobile" id="mobile"
                                                        class="form-control @error('mobile') is-invalid @enderror">
                                                    @error('mobile')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Payment Method</label>
                                                    <select name="payment_method" class="form-control">
                                                        <option value="cash">Cash</option>
                                                        <option value="cheque">Cheque</option>
                                                        <option value="bank_transfer">Bank Transfer</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Bank Deatils</label>
                                                    <input type="text" name="bank_name" class="form-control" placeholder="Bank Name">
                                                </div>
                                               

                                                <hr>

                                                <h5 class="mb-3 text-success">Additional Info</h5>

                                                <div class="mb-3">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                        <a href="{{ route('donation.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </main>
        <script>
            document.querySelector('select[name="deceased_id"]').addEventListener('change', function() {

                let id = this.value;

                if (id) {
                    fetch("{{ url('get-deceased', '') }}/" + id)
                        .then(response => response.json())
                        .then(data => {

                            document.getElementById('deceased_details').style.display = 'block';

                            document.getElementById('d_name').innerText = data.deathperson_name ?? '-';
                            document.getElementById('d_age').innerText = data.age ?? '-';
                            document.getElementById('d_dod').innerText = data.date_of_death ?? '-';
                            document.getElementById('d_cdate').innerText = data.cremation_date ?? '-';
                            document.getElementById('d_relative').innerText = data.relative_name ?? '-';

                            //auto fill donor name
                            document.getElementById('donor_name').value = data.relative_name ?? '';
                            document.getElementById('mobile').value = data.mobile ?? '';

                        });
                } else {
                    document.getElementById('deceased_details').style.display = 'none';

                    // Optional: clear fields
                    document.getElementById('donor_name').value = '';
                    document.getElementById('mobile').value = '';
                }
            });
        </script>

        <script>
            function numberToWords(num) {

                const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
                    'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen',
                    'Seventeen', 'Eighteen', 'Nineteen'
                ];

                const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

                function convertBelowThousand(n) {
                    let str = '';

                    if (n >= 100) {
                        str += ones[Math.floor(n / 100)] + ' Hundred ';
                        n = n % 100;
                    }

                    if (n >= 20) {
                        str += tens[Math.floor(n / 10)] + ' ';
                        n = n % 10;
                    }

                    if (n > 0) {
                        str += ones[n] + ' ';
                    }

                    return str;
                }

                if (num == 0) return 'Zero Only';

                let result = '';

                if (num >= 10000000) {
                    result += convertBelowThousand(Math.floor(num / 10000000)) + 'Crore ';
                    num %= 10000000;
                }

                if (num >= 100000) {
                    result += convertBelowThousand(Math.floor(num / 100000)) + 'Lakh ';
                    num %= 100000;
                }

                if (num >= 1000) {
                    result += convertBelowThousand(Math.floor(num / 1000)) + 'Thousand ';
                    num %= 1000;
                }

                if (num > 0) {
                    result += convertBelowThousand(num);
                }

                return 'Rupees ' + result.trim();
            }

            // Auto convert
            document.getElementById('amount').addEventListener('input', function() {
                let value = parseInt(this.value);
                document.getElementById('amount_in_word').value =
                    value ? numberToWords(value) : '';
            });
        </script>
        @include('layouts.footer')

    </div>

    @include('layouts.scripts')

    <!-- Toggle JS -->
    <script>
        document.getElementById('type').addEventListener('change', function() {
            document.getElementById('deceased_div').style.display =
                this.value === 'after_death' ? 'block' : 'none';
        });
    </script>

</body>

</html>