@extends('layouts.dashboard')

@section('title')
Store Dashboard-Setting Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">Store Setting</h5>
      <p class="dashboard-subtitle">Look what you have made today !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <form action="{{ route('dashboard-settings-redirect','dashboard-settings-store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Store Name</label>
                      <input type="text" name="store_name" class="form-control" value="{{ $user->store_name }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Kategori</label>
                      <select name="categories_id" id="" class="form-control">
                        <option value="{{ $user->categories_id }}">Tidak diganti ({{ $category->name }})
                        </option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col md-6">
                    <div class="form-group">
                      <label for="">Store</label>
                      <p class="text-muted">Apakah anda ingin membuka toko ?</p>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="store_status" id="openStoreTrue"
                          value="1" {{ $user->store_status= 1 ? 'checked' : '' }}>
                        <label for="openStoreTrue" class="custom-control-label">Buka</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="store_status" id="openStoreFalse"
                          value="0" {{ $user->store_status= 0 || $user->store_status = NULL ? 'checked' : '' }}>
                        <label for="openStoreFalse" class="custom-control-label">Sementara tutup</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row py-5">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">Save Now</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection