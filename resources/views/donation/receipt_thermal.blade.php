<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>

    <style>
        body {
            font-family: monospace;
            width: 300px;
            margin: 0 auto;
            font-size: 12px;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }

        @media print {
            body {
                width: 80mm;
            }
            button {
                display: none;
            }
        }
    </style>
</head>

<body>

<button onclick="window.print()">Print</button>

<div class="center">
    <strong>SMASHAN TRUST</strong><br>
    Address Line<br>
    Contact No<br>
</div>

<div class="line"></div>

<div class="flex">
    <span>Receipt:</span>
    <span>{{ $donation->receipt_no }}</span>
</div>

<div class="flex">
    <span>Date:</span>
    <span>{{ $donation->created_at->format('d-m-Y') }}</span>
</div>

<div class="line"></div>

<p><strong>Donor:</strong><br>
{{ $donation->donor_name }}</p>

<p><strong>Mobile:</strong><br>
{{ $donation->mobile }}</p>

@if($donation->type == 'after_death')
<p><strong>Deceased:</strong><br>
{{ $donation->deceased_name }}</p>
@endif

<div class="line"></div>

<div class="flex">
    <strong>Amount:</strong>
    <strong>₹{{ $donation->amount }}</strong>
</div>

<p>{{ $donation->amount_in_word }}</p>

<div class="line"></div>

<p><strong>Type:</strong>
{{ $donation->type == 'after_death' ? 'After Death' : 'Open Donation' }}</p>

<p><strong>Remarks:</strong><br>
{{ $donation->remarks ?? '-' }}</p>

<div class="line"></div>

<div class="center">
    Thank You 🙏<br>
</div>

<br><br>

<div class="center">
    ------------------------<br>
    Authorized Sign
</div>

<script>
window.onload = function() {
    window.print();
}
</script>

</body>
</html>