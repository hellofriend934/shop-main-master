<?php
declare(strict_types=1);

namespace Domain\Order\States\Payment;

class PendingPaymentState extends PaymentState
{
    public static string $name = 'pending';
}
