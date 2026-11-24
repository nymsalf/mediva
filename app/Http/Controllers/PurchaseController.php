<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function buy(Request $request, string $id)
    {
        $order = DB::transaction(function () use ($id) {

            $medicine = Medicine::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($medicine->stock < 1) {
                return null;
            }

            if ($medicine->price === null) {
                return null;
            }

            $price = $medicine->price;

            $order = Order::create([
                'user_id' => auth()->id(),
                'medicine_id' => $medicine->id,
                'quantity' => 1,
                'price' => $price,
                'total_price' => $price,
                'status' => 'pending',
            ]);

            $medicine->decrement('stock', 1);

            return $order;
        });

        if (!$order) {
            return redirect()->back()->with(
                'error',
                'Obat habis atau harga belum tersedia.'
            );
        }

        return redirect()->back()->with(
            'success',
            'Pembelian berhasil dibuat! Pesanan menunggu konfirmasi.'
        );
    }
}