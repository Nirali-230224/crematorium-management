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
            <h3 class="mb-0">Deceased List</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Deceased List</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="app-content">
      <div class="container-fluid">

        <div class="card mb-4">

          <div class="card-header">
            <h3 class="card-title mb-0">Records</h3>

            <a href="{{ route('deceased.add') }}" class="btn btn-primary btn-sm float-end">
              <i class="fas fa-plus"></i> Add New
            </a>
          </div>

          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Reason</th>
                  <th>Relative</th>
                  <th>Mobile</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($records as $item)
                <tr class="align-middle">
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->deathperson_name }}</td>
                  <td>{{ $item->reason }}</td>
                  <td>{{ $item->date_of_death }}</td>
                  <td>{{ $item->relative_name }}</td>
                  <td>{{ $item->mobile }}</td>

                  <td>
                    <span class="badge text-bg-info">
                      <a href="{{ route('deceased.edit', $item->id) }}" class="ahrefclass">
                        Edit
                      </a>
                    </span>
                  </td>

                  <td>
                    <span class="badge text-bg-danger">
                      <a href="{{ url('deceased/delete/'.$item->id) }}" 
                         class="ahrefclass"
                         onclick="return confirm('Are you sure?')">
                        Delete
                      </a>
                    </span>
                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
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