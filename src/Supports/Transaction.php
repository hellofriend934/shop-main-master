<?php
declare(strict_types=1);

namespace Supports;

use Illuminate\Support\Facades\DB;

final class Transaction
{
    public  static function  run(\Closure $callback, \Closure $finished = null, \Closure $onError = null)
    {

        try {
            DB::beginTransaction();

            $result = $callback();

            if ($finished !== null)
            {
                $finished($result);
            }
            DB::commit();
            return $result;



        }catch (Throwable $e){
            DB::rollback();
//            if (!is_null($onError)){
//                $onError($e);
//            }
            throw $e;
        }
    }
}
