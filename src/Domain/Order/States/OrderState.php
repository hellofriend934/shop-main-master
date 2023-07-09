<?php
declare(strict_types=1);

namespace Domain\Order\States;

use Domain\Order\Events\OrderStatusChanged;
use Domain\Order\Models\Order;
use http\Exception\InvalidArgumentException;

abstract class OrderState
{
    public function __construct(protected Order $order)
    {
    }

    protected array $allowedTransitions = [

    ];


 abstract public function canBeChanged():bool;


 abstract public function value() : string ;

  public function transitionTo(OrderState $state)
  {
      if (!$this->canBeChanged()){
          return InvalidArgumentException('status cant be changed');
      }

      if (!in_array(get_class($state), $this->allowedTransitions)){
          return InvalidArgumentException("no transition for {$this->order->status->value()} to {$state->value()}");
      }

      $this->order->updateQuietly(['status'=>$state->value()]);
      event(new OrderStatusChanged($this->order, $this->order->status, $state));
  }
}
