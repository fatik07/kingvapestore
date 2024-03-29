@extends('layouts.dashboard')

@section('title')
Store Dashboard-Account Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">My Account</h5>
      <p class="dashboard-subtitle">Look what you have made today !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <form action="{{ route('dashboard-settings-redirect','dashboard-settings-account') }}" method="POST"
            enctype="multipart/form-data" id="locations">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Your Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Your Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_one">Address 1</label>
                      <input type="text" class="form-control" id="address_one" name="address_one"
                        value="{{ $user->address_one }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_two">Address 2</label>
                      <input type="text" class="form-control" id="address_two" name="address_two"
                        value="{{ $user->address_two }}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="provinces_id">Province</label>
                      <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces"
                        v-model="provinces_id">
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
                      <input type="text" class="form-control" id="zip_code" name="zip_code"
                        value="{{ $user->zip_code }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone_number">Mobile</label>
                      <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ $user->phone_number }}">
                    </div>
                  </div>
                </div>
                <div class="row py-3">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">Save Now</button>
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