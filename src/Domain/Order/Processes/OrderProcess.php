<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Events\OrderStatusCreated;
use Domain\Order\Models\Order;
use Illuminate\Pipeline\Pipeline;
use Supports\Transaction;
use Throwable;

class OrderProcess
{
   protected array $processes = [];
   public function __construct(protected Order $order)
   {

   }

   public function processes(array $processes):self
   {
       $this->processes = $processes;
       return $this;
   }

   public function run(): ?Order
   {
       return  Transaction::run(function (){
           return app(Pipeline::class)->send($this->order)->through($this->processes)->thenReturn();
       }, function (){
//          flash()->info('good');
           event(new OrderStatusCreated($this->order));
       },
       function (Throwable $e){
           throw new \DomainException(app()->isLocal() ? $e->getMessage() : 'возникли ошибки при обработке заказа');
       });
   }
}
