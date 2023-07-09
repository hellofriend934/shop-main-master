<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Models\Order;
use Domain\Order\States\PendingOrderState;

class ChangeStateToPending implements \Domain\Order\Contracts\OrderProcessContract
{

    public function handle(Order $order, $next)
    {
        $order->status->transitionTo(new PendingOrderState($order));
        return $next($order);
    }
}
