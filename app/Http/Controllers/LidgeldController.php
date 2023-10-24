<?php

namespace App\Http\Controllers;

use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;

class LidgeldController extends Controller
{
    //
    public function payment()
    {
        $totalAmount = "26.00";

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = 'pending';
        $order->total_price = $totalAmount;
        $order->payment_data = "lidgeld";
        $order->remarks = NULL;
        $order->admin_remarks = NULL;
        $order->created_at = time();
        $order->updated_at = NULL;
        $order->save();

        $webhookUrl = route('webhooks.lid.mollie');

        if (App::environment('local')) {
            $webhookUrl = "https://8364-193-191-137-219.ngrok-free.app/webhooks/lid/mollie";
        }
        // Get the total amount = 26,00
        
        // dd($totalAmount);

        // Create a Mollie payment
        $payment = Mollie::api()->payments()->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $totalAmount,
            ],
            "description" => "dit is de betaling van het",
            "redirectUrl" => route("lidgeld.success"),
            "webhookUrl" => $webhookUrl,
            "metadata" => [
                "order_id" => $order->id,
            ],
        ]);

        // Store the Mollie payment ID in the shopping cart
        // Cart::storeMolliePaymentId($payment->id);

        // Redirect the customer to the Mollie checkout page
        return redirect($payment->getCheckoutUrl());
    }

    public function success()
    {
        // Redirect the customer to the payment complete page
        return "bedankt voor de betaling van het lidgeld";
    }
}
