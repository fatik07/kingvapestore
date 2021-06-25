@extends('layouts.admin')

@section('title')
User Update Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">Update User</h5>
      <p class="dashboard-subtitle">this update user!</p>
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
              <form action="{{ route('user.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Nama User</label>
                      <input type="text" name="name" id="" class="form-control" value="{{ $item->name }}" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Email User</label>
                      <input type="email" name="email" id="" class="form-control" value="{{ $item->email }}" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Password User</label>
                      <input type="password" name="password" id="" class="form-control">
                      <small>Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Roles</label>
                      <select name="roles" id="" class="form-control" required>
                        <option value="{{ $item->roles }}" selected>Tidak diganti</option>
                        <option value="ADMIN">Admin</option>
                        <option value="USER">User</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">Update Now</button>
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