<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use Domain\Order\Actions\NewOrderAction;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;
use Domain\Order\Processes\AssignCustomer;
use Domain\Order\Processes\AssignProducts;
use Domain\Order\Processes\ChangeStateToPending;
use Domain\Order\Processes\CheckProductQuantities;
use Domain\Order\Processes\ClearCart;
use Domain\Order\Processes\DecreaseProductQuantities;
use Domain\Order\Processes\OrderProcess;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $items = cart()->items();

        if ($items->isEmpty())
        {
            return redirect()->back();
        }

        return view('order.index', ['items'=>$items, 'payments'=>PaymentMethod::query()->get(), 'deliveries'=>DeliveryType::query()->get()]);
    }

    public function handle(OrderFormRequest $request, NewOrderAction $action)
    {
        $request->headers->set('accept','application/json');
        $order = $action($request);
        (new OrderProcess($order))->processes([new CheckProductQuantities(), new AssignCustomer(request('customer')), new AssignProducts(), new ChangeStateToPending(), new DecreaseProductQuantities(), new ClearCart()])->run();
        cart()->truncate();
        return redirect()->route('home');
    }
}
