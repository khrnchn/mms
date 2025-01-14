<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function handleCallback(Request $request)
    {
        // Log the request for debugging
        Log::info('ToyyibPay Callback Request:', $request->all());

        // Extract parameters from the request
        $billCode = $request->input('billcode');
        $status = $request->input('status_id'); // 1 for success, 2 for failure
        $transactionId = $request->input('transaction_id');

        // Find the transaction by bill code
        $transaction = Transaction::where('bill_code', $billCode)->first();

        if ($transaction) {
            // Update the transaction status
            $transaction->update([
                'status' => $status == 1 ? 'success' : 'failed',
                'transaction_id' => $transactionId,
            ]);
        }

        // Return a success response to ToyyibPay
        return response()->json(['status' => 'success']);
    }
}