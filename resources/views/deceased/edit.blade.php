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
                    <h3 class="mb-0">Edit Deceased Entry</h3>
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
                            <div class="card-title">Update Deceased Entry</div>
                        </div>

                        <!-- ✅ CHANGE: route + method -->
                        <form method="POST" action="{{ route('deceased.update', $record->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">

                                    <!-- LEFT SIDE -->
                                    <div class="col-md-6 border-end">

                                        <h5 class="mb-3 text-primary">Deceased Details</h5>

                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input type="text" name="deathperson_name"
                                                value="{{ $record->deathperson_name }}"
                                                class="form-control @error('deathperson_name') is-invalid @enderror">
                                            @error('deathperson_name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label>Age</label>
                                            <input type="number" name="age"
                                                value="{{ $record->age }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Address</label>
                                            <textarea name="address"
                                                class="form-control @error('address') is-invalid @enderror">{{ $record->address }}</textarea>
                                            @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <hr>

                                        <h5 class="mb-3 text-primary">Death Details</h5>

                                        <div class="mb-3">
                                            <label>Reason</label>
                                            <input type="text" name="reason"
                                                value="{{ $record->reason }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Date of Death</label>
                                            <input type="text" name="date_of_death" id="date_of_death"
                                                value="{{ $record->date_of_death }}"
                                                class="form-control @error('date_of_death') is-invalid @enderror">
                                        </div>

                                    </div>

                                    <!-- RIGHT SIDE -->
                                    <div class="col-md-6">

                                        <h5 class="mb-3 text-success">Cremation Details</h5>

                                        <div class="mb-3">
                                            <label>Cremation Date</label>
                                            <input type="text" name="cremation_date" id="cremation_date"
                                                value="{{ $record->cremation_date }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Time</label>
                                            <input type="text" name="death_time" id="death_time"
                                                value="{{ $record->death_time }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Cremation Type</label>
                                            <select name="cremation_type" class="form-control">
                                                <option value="wood" {{ $record->cremation_type == 'wood' ? 'selected' : '' }}>Wood</option>
                                                <option value="electric" {{ $record->cremation_type == 'electric' ? 'selected' : '' }}>Electric</option>
                                                <option value="gas" {{ $record->cremation_type == 'gas' ? 'selected' : '' }}>Gas</option>
                                            </select>
                                        </div>

                                        <hr>

                                        <h5 class="mb-3 text-success">Relative Details</h5>

                                        <div class="mb-3">
                                            <label>Relative Name</label>
                                            <input type="text" name="relative_name"
                                                value="{{ $record->relative_name }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Relative Address</label>
                                            <textarea name="relative_address" class="form-control">{{ $record->relative_address }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Mobile</label>
                                            <input type="text" name="mobile"
                                                value="{{ $record->mobile }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Remarks</label>
                                            <textarea name="remarks" class="form-control">{{ $record->remarks }}</textarea>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="{{ route('deceased.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

</main>

@include('layouts.footer')

</div>

@include('layouts.scripts')

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
flatpickr("#date_of_death", { dateFormat: "Y-m-d" });
flatpickr("#cremation_date", { dateFormat: "Y-m-d" });
flatpickr("#death_time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_12hr: true
});
</script>

</body>
</html>