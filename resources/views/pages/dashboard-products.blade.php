@extends('layouts.dashboard')

@section('title')
Store Dashboard-Product Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">My Products</h5>
      <p class="dashboard-subtitle">Manage it will and get money !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <a href="{{ route('dashboard-product-create') }}" class="btn btn-success">Add new product</a>
        </div>
      </div>
      <div class="row mt-4">

        @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('dashboard-product-details', $product->id) }}" class="card card-dashboard-product d-block">
            <div class="card-body">
              <img src="{{  Storage::url($product->galleries->first()->photos ?? '') }}" class="w-100 mb-2" alt="">
              <div class="product-title">{{ $product->name }}</div>
              <div class="product-category">{{ $product->category->name }}</div>
            </div>
          </a>
        </div>
        @endforeach

      </div>
    </div>
  </div>
</div>
@endsection