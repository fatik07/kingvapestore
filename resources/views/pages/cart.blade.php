@extends('layouts.app')

@section('title')
Store Cart Page
@endsection

@section('content')
<div class="page-content page-cart">
  <!-- breadcrum -->
  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/index.html">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Cart
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="store-cart">
    <div class="container">
      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-12 table-responsive">
          <table class="table table-borderless table-cart">
            <thead>
              <tr>
                <td>Image</td>
                <td>Name & Seller</td>
                <td>Price</td>
                <td>Menu</td>
              </tr>
            </thead>
            <tbody>
              @php $totalPrice = 0 @endphp
              @foreach ($carts as $cart)
              <tr>
                <td style="width: 20%;">
                  @if ($cart->product->galleries)
                  <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt=""
                    class="cart-images w-100">
                  @endif
                </td>
                <td style="width: 35%;">
                  <div class="product-title">{{ $cart->product->name }}</div>
                  <div class="product-subtitle">{{ $cart->product->user->store_name }}</div>
                </td>
                <td style="width: 35%;">
                  <div class="product-title">{{ number_format($cart->product->price) }}</div>
                  <div class="product-subtitle">IDR</div>
                </td>
                <td style="width: 20%;">
                  <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-remove-cart">Remove</button>
                  </form>
                </td>
              </tr>
              @php $totalPrice += $cart->product->price @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="150">
        <div class="col-lg-12">
          <hr>
        </div>
        <div class="col-3">
          <h2 class="mb-4">Shipping Details</h2>
        </div>
      </div>
      <form action="{{ route('checkout') }}" method="POST" id="locations" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
        <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
          <div class="col-md-6">
            <div class="form-group">
              <label for="address_one">address 1</label>
              <input type="text" class="form-control" id="address_one" name="address_one" value="Menyanggong">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="address_two">address 2</label>
              <input type="text" class="form-control" id="address_two" name="address_two" value="Rt 22 Rw 09">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="province_id">Province</label>
              <select name="province_id" id="province_id" class="form-control" v-if="provinces" v-model="provinces_id">
                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
              </select>
              {{-- jika select kosong --}}
              <select v-else class="form-control"></select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="regencies_id">City</label>
              <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies"
                v-model="regencies_id">
                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
              </select>
              {{-- jika select kosong --}}
              <select v-else class="form-control"></select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="zip_code">Postal Code</label>
              <input type="text" class="form-control" id="zip_code" name="zip_code" value="61257">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="country">Country</label>
              <input type="text" class="form-control" id="country" name="country" value="Indonesia">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone_number">Mobile</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" value="+62 895804481680">
            </div>
          </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-12">
            <hr>
          </div>
          <div class="col-3">
            <h2 class="mb-2">Payment Informations</h2>
          </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <div class="col-4 col-md-2">
            <div class="product-title">Rp 50.000</div>
            <div class="product-subtitle">Country fax</div>
          </div>
          <div class="col-4 col-md-3">
            <div class="product-title">Rp 50.000</div>
            <div class="product-subtitle">Product Insurance</div>
          </div>
          <div class="col-4 col-md-2">
            <div class="product-title">Rp 50.000</div>
            <div class="product-subtitle">Ship to Madura</div>
          </div>
          <div class="col-4 col-md-2">
            <div class="product-title text-success">Rp {{ number_format($totalPrice ?? 0) }}</div>
            <div class="product-subtitle">total</div>
          </div>
          <div class="col-8 col-md-3">
            <button type="submit" class="btn btn-success mt-4 px-4 btn-block">Checkout Now</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection

{{-- menambahkan script khusus --}}
{{-- menambhakan data otomatis pada provinci dan kota --}}
@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  // membuat variabel locations lalu di inisialiasi pertama
  var locations = new Vue({
    el: "#locations", // mengambil id location di form
    mounted() { // tipe lifecycle pada vue
      AOS.init();
      this.getProvincesData();
    },
    data: { // masukkan object
      provinces: null, // ambil data
      regencies: null,
      provinces_id: null, // ambil id
      regencies_id: null
    },
    methods: {
      getProvincesData() {
        var self = this;
        axios.get('{{ route('api-provinces') }}')
          .then(function(response){
            self.provinces = response.data;
          })
      },
      getRegenciesData() {
        var self = this;
        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
          .then(function(response){
            self.regencies = response.data;
          })
      },
    },
    watch: {
      provinces_id: function(val, oldVal) {
        this.regencies_id = null;
        this.getRegenciesData();
      }
    }
  });
</script>
@endpush