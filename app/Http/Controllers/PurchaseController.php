<?php

namespace App\Http\Controllers;

use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
     public function index()
     {
         return redirect(PaymentSystem::create(new PaymentData())->url());
     }

     public function callback()
     {
        return PaymentSystem::validate()->response();
     }
}
