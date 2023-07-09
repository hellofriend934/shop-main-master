<?php
declare(strict_types=1);

namespace Domain\Order\States\Payment;

class PaidPaymentState extends PaymentState
{
    public static string $name = 'paid';
}
