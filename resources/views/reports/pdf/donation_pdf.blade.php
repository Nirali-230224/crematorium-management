<h2 style="text-align:center;">Donation Report</h2>

<p>Total Amount: {{ $total }}</p>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Deceased name</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Method</th>
        <th>Bank</th>
    </tr>

    @foreach($donations as $d)
    <tr>
        <td>{{ $d->donor_name }}</td>
        <td>{{ $d->type }}</td>
        <td>{{ $d->deceased->deathperson_name ?? '-' }}<</td>
        <td>{{ $d->amount }}</td>
        <td>{{ $d->donation_date }}</td>
        <td>{{ $d->payment_method }}</td>
        <td>{{ $d->bank_name }}</td>
    </tr>
    @endforeach
</table>