<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use App\Exceptions\OrderProcessExceptions;
use Domain\Order\Models\Order;

class CheckProductQuantities
{
    public function handle(Order $order, $next)
    {
        foreach (cart()->items() as $item) {
            if ($item->product->quantity < $item->quantity){
                throw new OrderProcessExceptions('на складе не хватает товара');
            };
        }
    }
}
