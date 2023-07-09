<?php

namespace Domain\Order\Models;

use Domain\Order\States\Payment\CancelledPaymentState;
use Domain\Order\States\Payment\PaidPaymentState;
use Domain\Order\States\Payment\PaymentState;
use Domain\Order\States\Payment\PendingPaymentState;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\StateConfig;

class Payment extends Model
{
    use HasFactory;
    use HasUuids;
    protected $guarded = false;
    protected $casts = [
        'state'=>PaymentState::class
    ];
    public function uniqueIds()
    {
        return['payment_id'];
    }

    public static function config(): StateConfig
    {
       return parent::config()->default(PendingPaymentState::class)->allowedTransition(PendingPaymentState::class, PaidPaymentState::class)->allowedTransition(PendingPaymentState::class, CancelledPaymentState::class);
    }
}
