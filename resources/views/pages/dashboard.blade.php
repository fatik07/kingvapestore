@extends('layouts.dashboard')

@section('title')
Store Dashboard Page
@endsection

@section('content')
<div class="section-content setion-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h5 class="dashboard-title">Dashboard</h5>
      <p class="dashboard-subtitle">Look what you have made today !</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <div class="dashboard-card-title">Customer</div>
              <div class="dashboard-card-subtitle">Rp {{ number_format($customer) }}</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <div class="dashboard-card-title">Revenue</div>
              <div class="dashboard-card-subtitle">Rp {{ number_format($revenue) }}</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-2">
            <div class="card-body">
              <div class="dashboard-card-title">Transaction</div>
              <div class="dashboard-card-subtitle">Rp {{ number_format($transaction_count) }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 mt-2">
          <h5 class="mb-3">Recent Transactions</h5>

          {{-- looping buat isi transaction --}}
          @foreach ($transaction_data as $transaction)
          <a href="{{ route('dashboard-transaction-details', $transaction->id) }}" class="card card-list d-block">
            <div class="card-body">
              <div class="row">
                <div class="col-md-1">
                  <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}" alt=""
                    class="w-75">
                </div>
                <div class="col-md-4">
                  {{ $transaction->product->name ?? '' }}
                </div>
                <div class="col-md-3">
                  {{ $transaction->user->name ?? '' }}
                </div>
                <div class="col-md-3">
                  {{ $transaction->created_at ?? '' }}
                </div>
                <div class="col-md-1 d-none d-md-block">
                  <img src="/images/dashboard/panah.svg" alt="">
                </div>
              </div>
            </div>
          </a>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
@endsection