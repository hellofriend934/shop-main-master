<?php
declare(strict_types=1);

namespace Domain\Order\States\Payment;

class CancelledPaymentState extends PaymentState
{
 public static string $name = 'cancelled';
}
