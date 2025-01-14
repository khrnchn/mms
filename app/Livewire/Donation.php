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

    // Handle form submission
    public function submitDonation()
    {
        // Validate the form inputs
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        // Generate a unique bill code
        $billCode = 'DONATION-' . uniqid();

        // Save the transaction to the database
        $transaction = Transaction::create([
            'bill_code' => $billCode,
            'name' => $this->name,
            'email' => $this->email,
            'amount' => $this->amount,
            'status' => 'success', // terus hardcode success for demo
        ]);

        // Create a ToyyibPay bill
        $paymentUrl = $this->createToyyibPayBill($billCode, $this->amount, $this->name, $this->email);

        // Redirect the user to ToyyibPay payment page
        return redirect()->away($paymentUrl);
    }

    // Create a ToyyibPay bill using the package
    protected function createToyyibPayBill($billCode, $amount, $name, $email)
    {
        try {
            // Initialize Guzzle HTTP client
            $guzzleClient = new Client();

            // Initialize ToyyibPay
            $toyyibpay = new Toyyibpay(
                config('toyyibpay.sandbox'), // Sandbox mode
                config('toyyibpay.client_secret'), // ToyyibPay user secret key
                config('toyyibpay.redirect_uri'), // Redirect URI
                $guzzleClient // Guzzle client
            );

            // Log the category code for debugging
            Log::info('ToyyibPay Category Code:', ['categoryCode' => config('toyyibpay.category_code')]);

            // Create the bill object
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

            // Create the bill
            $response = $toyyibpay->createBill(config('toyyibpay.category_code'), $billObject);

            // Log the response for debugging
            Log::info('ToyyibPay API Response:', (array) $response);

            // Check if the bill was created successfully
            if (isset($response[0]->BillCode)) { // Access the nested BillCode property
                $billCode = $response[0]->BillCode;
                return $toyyibpay->billPaymentLink($billCode);
            }

            // Handle error
            session()->flash('error', 'Failed to create payment bill. Please try again.');
            return null;
        } catch (\Exception $e) {
            // Handle exception
            Log::error('ToyyibPay API Error:', ['error' => $e->getMessage()]);
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
            return null;
        }
    }
    // Render the view
    public function render()
    {
        return view('livewire.donation');
    }
}
