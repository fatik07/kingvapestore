@extends('layouts.app')

@section('title')
Store Hompage
@endsection

@section('content')
<div class="page-content page-home">
  <section class="store-carousel">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="zoom-in">
          <div id="storeCarousel" class="carousel slide" data-ride="carousel">
            <!-- buat indicator garis bawah -->
            <ol class="carousel-indicators">
              <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
              <li data-target="#storeCarousel" data-slide-to="1"></li>
              <li data-target="#storeCarousel" data-slide-to="2"></li>
            </ol>
            <!-- buat slide gambar -->
            <div class="carousel-inner" style="max-height: 420px; border-radius:20px">
              <div class="carousel-item active">
                <img src="/images/3.jpg" alt="Carousel" class="d-block w-100" />
              </div>
              <div class="carousel-item">
                <img src="/images/4.jpg" alt="Carousel" class="d-block w-100" />
              </div>
              <div class="carousel-item">
                <img src="/images/2.jpg" alt="Carousel" class="d-block w-100" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- section categori -->
  <section class="store-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>All Categories</h5>
        </div>
      </div>
      <div class="row justify-content-center">

        {{-- loop agar animasi berjalan satu persatu saat create category --}}
        @php
        $incrementCategory = 0
        @endphp

        {{-- looping buat categori --}}
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
        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
          No categories Found !
        </div>
        @endforelse

      </div>
    </div>
  </section>

  <!-- section product -->
  <section class="store-new-product">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="fade-up">
          <h5>What News</h5>
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
        <div class="col-12 text-danger py-5" data-aos="fade-up" data-aos-delay="100">
          No Product.
        </div>
        @endforelse

      </div>
    </div>
  </section>
</div>
@endsection