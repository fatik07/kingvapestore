<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
            ->whereHas('product', function($product){
                $product->where('users_id', Auth::user()->id);
            })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
            ->whereHas('transaction', function($transaction){
                $transaction->where('users_id', Auth::user()->id);
            })->get();
            
        return view('pages.dashboard-transactions', compact('sellTransactions','buyTransactions'));
    }

    // membuat fungsi transaction details
    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])->findOrFail($id);

        return view('pages.dashboard-transactions-details', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details', $id);

    }
}
