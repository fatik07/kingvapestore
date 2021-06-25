@extends('layouts.dashboard')

@section('title')
Store Dashboard-Product-Detail Page
@endsection

@section('content')
<div id="page-content-wrapper">
  <!-- section content -->
  <div class="section-content setion-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h5 class="dashboard-title">Create new product</h5>
        <p class="dashboard-subtitle">Look what you have made today !</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">

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

            <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="categories_id" id="" class="form-control">
                          <option value="{{ $product->categories_id }}">Tidak diganti ({{ $product->category->name }})
                          </option>
                          @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Descriptions</label>
                        <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row py-5">
                    <div class="col text-right">
                      <button type="submit" class="btn btn-success px-5 btn-block">Save Now</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">

                  @foreach ($product->galleries as $gallery)
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img src="{{ Storage::url($gallery->photos ?? '') }}" class="w-100 mt-3" alt="">
                      <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                        <img src="/images/close.svg" class="mt-3" alt="">
                      </a>
                    </div>
                  </div>
                  @endforeach

                  <div class="col-12">
                    <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST"
                      enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="products_id" value="{{ $product->id }}">
                      <input type="file" name="photos" id="file" value="" style="display: none;"
                        onchange="form.submit()">
                      <button type="button" class="btn btn-secondary mt-3 btn-block" onclick="thisFileUpload()">
                        Add photo
                      </button>
                    </form>
                  </div>
                </div>
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
<script>
  $('#menu-toggle').click(function (e) {
    e.preventDefault();
    $('#wrapper').toggleClass('toggled')
  });
</script>

<!-- ck editor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');
</script>
<script>
  function thisFileUpload() {
    document.getElementById("file").click()
  };
</script>
@endpush