<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class CartConroller extends Controller
{

    public function showCart()
    {

        $cartItems = Cart::content();
        
        // haal het totaal op
        $total = Cart::total();

        return view('cart.index' , compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
    {   
        // Cart::destroy();
        Cart::add([
            "id" => $request->input('id'),
            "name" => [
                "size" => $request->input('size'),
                "type" => $request->input('type'),
            ],
            "qty" => $request->input('quantity'),
            "price" => $request->input('price'),
            "weight" => 0,
            "tax" => 0,
        ]);


        $itemId = $request->input('id');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        // redirect naar order pagina
        
    
        return redirect()->back()->with('success', 'Item added to cart successfully.');

    }

    public function deleteFromCart(Request $request)
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);

        return redirect()->back()->with('success', 'Item removed from cart successfully.');
    }

    
    public function checkout(Request $request)
    {   
        // dd($request->all());
        $shippingOption = $request->input('shipping_option');
        // naar decimal
        $shipping = number_format((float)$shippingOption, 2, '.', '');
        $totalPriceShipCart = $shipping + Cart::subtotal();
        // naar 2 decimale,
        $totalPriceShipCart2 = number_format((float)$totalPriceShipCart, 2, '.', '');
        // dd($totalPriceShipCart);
        // create new order: id, userd_id, status, total_price, payment_data, remarks = NULL, admin_remarks = NULL, created_at = time of made order, updated_at
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = 'pending';
        $order->total_price = $totalPriceShipCart2;
        $order->shipping_cost = $request->input('shipping_option');
        $order->payment_data = NULL;
        $order->remarks = NULL;
        $order->admin_remarks = NULL;
        $order->created_at = time();
        $order->updated_at = NULL;
        $order->save();

        
        // create new order_items for each item in the cart: id, order_id, ring_id, quantity, price, created_at = time of made order, updated_at
        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->ring_id = $item->id;
            $orderItem->amount = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->created_at = time();
            $orderItem->updated_at = NULL;
            $orderItem->save();
        }


        // dd($order->id);
        // dd(Cart::total());

        Log::alert('order is gemaakt');

        $webhookUrl = route('webhooks.mollie');

        if (App::environment('local')) {
            $webhookUrl = "https://8364-193-191-137-219.ngrok-free.app/webhooks/mollie"; // ngrok url ----------------------------------------------------------------------------------
        }
        // Get the total amount from the shopping cart
        $totalAmount = Cart::subtotal();
        // dd($totalAmount);

        // Create a Mollie payment
        $payment = Mollie::api()->payments()->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $totalPriceShipCart2,
            ],
            "description" => "Payment for shopping cart",
            "redirectUrl" => route("payment.success"),
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
        // Clear the shopping cart
        Cart::destroy();

        // Redirect to the payment successful page
        return view('cart.success');
    }
}
