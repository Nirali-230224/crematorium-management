<h2 style="text-align:center;">Deceased Report</h2>


<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Reason</th>
        <th>Date of Death</th>
        <th>Cremation Date</th>
        <th>Cremation type</th>
        <th>Relative name</th>
        <th>Mobile</th>
    </tr>

    @foreach($deceased as $d)
    <tr>
        <td>{{ $d->deathperson_name }}</td>
        <td>{{ $d->age }}</td>
        <td>{{ $d->reason }}<</td>
        <td>{{ $d->date_of_death }}</td>
        <td>{{ $d->cremation_date }}</td>
        <td>{{ $d->cremation_type }}</td>
        <td>{{ $d->relative_name }}</td>
        <td>{{ $d->mobile }}</td>
    </tr>
    @endforeach
</table>