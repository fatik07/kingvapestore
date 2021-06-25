<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count(); // menghitung semua customer
        $revenue = Transaction::sum('total_price'); // menghitung jumlah total price dari tabel transaksi
        $transaction = Transaction::count(); // mengambil semua data di tabel transaksi

        return view('pages.admin.dashboard', compact('customer','revenue','transaction'));
    }
}
