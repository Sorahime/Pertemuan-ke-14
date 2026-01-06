<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    // List barang
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    // PROSES PINJAM
    public function borrow($id)
    {
        DB::transaction(function () use ($id) {

            $item = Item::lockForUpdate()->findOrFail($id);

            if ($item->stock <= 0) {
                abort(400, 'Stok habis');
            }

            $item->stock -= 1;
            $item->save();

            Loan::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
                'loan_date' => now(),
                'status' => 'borrowed'
            ]);
        });

        return back()->with('success', 'Barang berhasil dipinjam');
    }

    // LIST PINJAMAN USER
    public function myLoans()
    {
        $loans = Loan::where('user_id', Auth::id())->get();
        return view('loans.index', compact('loans'));
    }

    // PROSES PENGEMBALIAN
    public function returnItem($loanId)
    {
        DB::transaction(function () use ($loanId) {

            $loan = Loan::lockForUpdate()->findOrFail($loanId);

            if ($loan->status === 'returned') {
                abort(400,'Sudah dikembalikan');
            }

            $item = Item::lockForUpdate()->findOrFail($loan->item_id);

            $item->stock += 1;
            $item->save();

            $loan->update([
                'status' => 'returned',
                'return_date' => now()
            ]);
        });

        return back()->with('success', 'Barang dikembalikan');
    }
}
