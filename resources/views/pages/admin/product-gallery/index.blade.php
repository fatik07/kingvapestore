@extends('layouts.admin')

@section('title')
Product Gallery Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">Product Gallery</h5>
      <p class="dashboard-subtitle">this list Product Gallery !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <a href="{{ route('product-gallery.create') }}" class="btn btn-primary mb-3">+ tambah product Gallery
                baru</a>
              <div class="table-responsive">
                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Produk</th>
                      <th>Foto</th>
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
          {data: 'product.name', name: 'product.name'},
          {data: 'photos', name: 'photos'},
          {data: 'action', name: 'action', orderable: false, searchable: false, width: '15%'},
        ],
      });
</script>
@endpush