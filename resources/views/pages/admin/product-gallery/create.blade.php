@extends('layouts.admin')

@section('title')
Product Gallery Create Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">New Create Product Gallery</h5>
      <p class="dashboard-subtitle">this create product gallery !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-md-12">

          {{-- error bawaan laravel --}}
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="card">
            <div class="card-body">
              <form action="{{ route('product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Product</label>
                      <select name="products_id" id="" class="form-control">
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Foto Product</label>
                      <input type="file" name="photos" id="" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">Save Now</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection