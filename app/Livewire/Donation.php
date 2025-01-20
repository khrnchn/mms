<?php

namespace App\Livewire;

use Livewire\Component;
use Tarsoft\Toyyibpay\Toyyibpay; // Correct namespace
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Donation extends Component
{
    // Form fields
    public $name = '';
    public $email = '';
    public $amount = '';
    public $donation_type = ''; 

    public function submitDonation()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'donation_type' => 'required|in:sedekah,infaq,ramadhan', 
        ]);

        $billCode = 'DONATION-' . uniqid();

        $transaction = Transaction::create([
            'bill_code' => $billCode,
            'name' => $this->name,
            'email' => $this->email,
            'amount' => $this->amount,
            'donation_type' => $this->donation_type, 
            'status' => 'success', 
        ]);

        $paymentUrl = $this->createToyyibPayBill($billCode, $this->amount, $this->name, $this->email);

        return redirect()->away($paymentUrl);
    }

    protected function createToyyibPayBill($billCode, $amount, $name, $email)
    {
        try {
            $guzzleClient = new Client();

            $toyyibpay = new Toyyibpay(
                config('toyyibpay.sandbox'), // Sandbox mode
                config('toyyibpay.client_secret'), // ToyyibPay user secret key
                config('toyyibpay.redirect_uri'), // Redirect URI
                $guzzleClient // Guzzle client
            );

            Log::info('ToyyibPay Category Code:', ['categoryCode' => config('toyyibpay.category_code')]);

            $billObject = (object) [
                'billName' => 'Mosque Donation',
                'billDescription' => 'Donation for Mosque Development',
                'billPriceSetting' => 1, // 1 for fixed amount
                'billAmount' => $amount * 100, // Amount in cents
                'billReturnUrl' => config('toyyibpay.redirect_uri'), // Callback URL
                'billCallbackUrl' => config('toyyibpay.redirect_uri'), // Callback URL
                'billExternalReferenceNo' => $billCode,
                'billTo' => $name,
                'billEmail' => $email,
                'billContentEmail' => 'Thank you for your donation!',
                'billPayorInfo' => 1, // Set to 1 to collect payer info, 0 to skip
                'billPhone' => '0123456789', // Add payer's phone number (required)
                'billSplitPayment' => 0, // Set to 1 if you want to split payment
                'billSplitPaymentArgs' => '', // Required if billSplitPayment is 1
                'billPaymentChannel' => '0', // 0 for all channels, 1 for FPX only, 2 for credit card only
                'billChargeToCustomer' => 1, // 1 to charge payment fees to customer
            ];

            $response = $toyyibpay->createBill(config('toyyibpay.category_code'), $billObject);

            Log::info('ToyyibPay API Response:', (array) $response);

            if (isset($response[0]->BillCode)) { // Access the nested BillCode property
                $billCode = $response[0]->BillCode;
                return $toyyibpay->billPaymentLink($billCode);
            }

            session()->flash('error', 'Failed to create payment bill. Please try again.');
            return null;
        } catch (\Exception $e) {
            Log::error('ToyyibPay API Error:', ['error' => $e->getMessage()]);
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
            return null;
        }
    }

    public function render()
    {
        return view('livewire.donation');
    }
}