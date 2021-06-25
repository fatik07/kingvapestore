@extends('layouts.app')

@section('title')
Store Category Page
@endsection

<style>
  .pagination {
    justify-content: center;
  }
</style>

@section('content')
<div class="page-content page-home">
  <!-- section categori -->
  <section class="store-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>All Categories</h5>
        </div>
      </div>
      <div class="row">

        @php
        $incrementCategory = 0
        @endphp

        {{-- loop category --}}
        @forelse ($categories as $category)
        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory += 100 }}">
          <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
            <div class="categories-image">
              <img src="{{ Storage::url($category->photo) }}" alt="gatget" class="w-100" />
            </div>
            <p class="categories-text">{{ $category->name }}</p>
          </a>
        </div>
        @empty

        @endforelse


      </div>
    </div>
  </section>

  <!-- section product -->
  <section class="store-new-product">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="fade-up">
          <h5>All Product</h5>
        </div>
      </div>
      <div class="row">

        {{-- buat var animasi --}}
        @php
        $incrementProduct = 0
        @endphp

        {{-- looping all product --}}
        @forelse ($products as $product)
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct += 100 }}">
          <a href="{{ route('detail', $product->slug) }}" class="component-product d-block">
            <div class="product-thumbnail">
              <div class="product-image" style="
              {{-- count agar tetep berjalan walau tnpa foto --}} 
              @if ($product->galleries->count())
                background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
              @endif'
                background-color: #eee;
              "></div>
            </div>
            <div class="product-text">{{ $product->name }}</div>
            <div class="product-price">Rp {{ $product->price }}</div>
          </a>
        </div>
        @empty
        <div class="col-12 text-center text-danger py-5" data-aos="fade-up" data-aos-delay="100">
          No Product.
        </div>
        @endforelse

      </div>
      <div class="row">
        <div class="col-12 mt-4">
          {{ $products->links() }}
        </div>
      </div>
  </section>
</div>
@endsection