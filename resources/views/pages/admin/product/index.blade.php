@extends('layouts.admin')

@section('title')
Product Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">Product</h5>
      <p class="dashboard-subtitle">this list Product !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">+ tambah product baru</a>
              <div class="table-responsive">
                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Pemilik</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
{{-- memanggil data tables --}}
<script>
  var dataTable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          url: '{!! url()->current() !!}',
        },
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'user.name', name: 'user.name'},
          {data: 'category.name', name: 'category.name'},
          {data: 'price', name: 'price'},
          {data: 'action', name: 'action', orderable: false, searchable: false, width: '15%'},
        ],
      });
</script>
@endpush