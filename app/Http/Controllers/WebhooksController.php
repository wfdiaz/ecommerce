<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhooksController extends Controller
{
    public function __invoke(Order $order, Request $request)
    {
        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-2703406764553486-111913-4895254bd5922043689aedb4d51d5adb-1556981132");
        
        $response = json_decode($response);

        $status = $response->status;

        if($status == "approved"){
            $order->status = 2;
            $order->save();
        }

        return redirect()->route('orders.show', $order); 
    }
}
