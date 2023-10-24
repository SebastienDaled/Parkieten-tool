<?php

namespace App\Http\Controllers;

use App\Order;
use App\UserStatus;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;


class PaymentController extends Controller
{
    

    public function handleWebhook(Request $request)
    {   
        if (! $request->has('id')) {
            return;
        }
        
        Log::alert('webhook is gelukt' . $request->id);

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
            /*
             * The payment is paid and isn't refunded or charged back.
             * At this point you'd probably want to start the process of delivering the product to the customer.
             */

            $orderId = $payment->metadata->order_id;
            $order = Order::findOrFail($orderId);
            $order->status = 'paid';
            $order->payment_data = "bestelling";
            // save payment method
            // $order->payment_data = $payment->method;
            $order->save();

            Log::alert('betaling is gelukt');

        } elseif ($payment->isOpen()) {
            /*
             * The payment is open.
             */
        } elseif ($payment->isPending()) {
            /*
             * The payment is pending.
             */
        } elseif ($payment->isFailed()) {
            /*
             * The payment has failed.
             */
        } elseif ($payment->isExpired()) {
            /*
             * The payment is expired.
             */
        } elseif ($payment->isCanceled()) {
            /*
             * The payment has been canceled.
             */
        } elseif ($payment->hasRefunds()) {
            /*
             * The payment has been (partially) refunded.
             * The status of the payment is still "paid"
             */
        } elseif ($payment->hasChargebacks()) {
            /*
             * The payment has been (partially) charged back.
             * The status of the payment is still "paid"
             */
        }

        // Handle a mismatch between the received payment ID and the stored Mollie payment ID
        return response('Invalid payment ID', 400);
    }


    public function lidgeldHook(Request $request) 
    {
        if (! $request->has('id')) {
            return;
        }
        
        Log::alert('webhook is gelukt voor het lidgeld' . $request->id);

        $payment = Mollie::api()->payments()->get($request->id);
        // Log::alert($payment);

        if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
            /*
             * The payment is paid and isn't refunded or charged back.
             * At this point you'd probably want to start the process of delivering the product to the customer.
             */
            Log::alert('betaling is gelukt 1');
            $order_id = $payment->metadata->order_id;
            $order = Order::findOrFail($order_id);
            Log::alert($order);
            $order->status = 'paid';
            $order->payment_data = "lidgeld";
            $order->save();

            // user_status van deze user
            $userStatus = UserStatus::where('user_id', $order->user_id)->first();
            Log::alert($userStatus);
            $userStatus->status = 'actief';
            $userStatus->description = 'deze gebruiker heeft betaald';
            // plus een jaar bij date
            $userStatus->date = date('Y-m-d', strtotime('+1 year'));
            $userStatus->updated_at = now();
            $userStatus->save();

            Log::alert('betaling lidgeld is gelukt');

        }
    }
}
