<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>

    <style>
        @page {
            size: 4in 6in; /* Receipt size */
            margin: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .receipt {
            border: 1px solid #000;
            padding: 10px;
        }

        .header {
            text-align: center;
            font-weight: bold;
        }

        .top-line {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 10px;
        }

        .row {
            margin-bottom: 6px;
        }

        .line {
            border-bottom: 1px solid #000;
            display: inline-block;
            width: 100%;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }

        .amount-box {
            border: 1px solid #000;
            display: inline-block;
            padding: 5px 10px;
            margin-top: 5px;
        }

        .footer {
            font-size: 9px;
            margin-top: 10px;
        }

        .signature {
            margin-top: 15px;
            text-align: right;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="receipt">

    <div class="top-line">
        <span>Pan No. {{ $pan ?? 'AAATH 1348E' }}</span>
        <span>Trust Regi. No.: {{ $trust_no ?? 'A-21, VALSAD' }}</span>
    </div>

    <div class="title">
        SHRI HINDU SMASHANBHUMI VYAVASTHA MANDAL, VALSAD
    </div>

    <div class="subtitle">
        Kailash Road, Valsad
    </div>

    <div class="flex row">
        <span>Receipt No.: {{ $donation->receipt_no }}</span>
        <span>Date: {{ $donation->donation_date }}</span>
    </div>

    <div class="row">
        Received with thanks from Shree/Smt.
        <div class="line">{{ $donation->donor_name }}</div>
    </div>

    <div class="row">
        The sum of Rupees
        <div class="line">{{ $donation->amount_in_word }}</div>
    </div>

    <div class="flex row">
        <span>
            by Cash / Cheque / Draft No.
            <span class="line">{{ $donation->payment_method }}</span>
        </span>
        <span>Date {{ $donation->donation_date }}</span>
    </div>

    <div class="row">
        Bank
        <div class="line">{{ $donation->bank_name }}</div>
    </div>

    <div class="row">
        General Donation / Tithidan Fund / Specific Fund
    </div>

    <div class="row">
        <div class="amount-box">
            ₹ {{ $donation->amount }}
        </div>
    </div>

    <div class="row" style="font-size:10px;">
        (Subject to realisation of cheque)
    </div>

    <div class="signature">
        Received by: ____________________
    </div>

    <div class="footer">
        Donation entitled exemption u/s 80G(5)(vi) of the Income-tax Act
        and is valid indefinitely unless specifically withdrawn.
    </div>

</div>

</body>
</html>