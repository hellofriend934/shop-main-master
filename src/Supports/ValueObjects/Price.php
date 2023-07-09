<?php
declare(strict_types=1);

namespace Supports\ValueObjects;

use InvalidArgumentException;

class Price implements \Stringable
{
    private array $currencies = [
      'RUB'=>'₽'
    ];

public function __construct(private readonly int $value, private  readonly string $currency = 'RUB', private  readonly int $precision = 100) // precision - сколько знаков после запятой
{
    if ($this->value <0 )
    {
        throw  new InvalidArgumentException('Price must be more than zero');
    }

    if (!isset($this->currencies[$this->currency])){
        throw new InvalidArgumentException('Currency not allowed');
    }
}

public function raw():int
{
    return (int)$this->value;
}

public function value():float|int  // делим целое чисто на 100 и получаем число с плав точкой(double)
{
    return $this->value / $this->precision;
}

public function currency():string
{
    return $this->currency;
}

public function symbol():string
{
    return $this->currencies[$this->currency];
}

    public function __toString()
    {
       return number_format($this->value(),0, ',','') . ' ' . $this->symbol();
    }

    public static function make(mixed ...$arguments):static  //... запаковали в массив
    {
        return new static(...$arguments); //... создает экземпляр класса при этом распоковывает массив в впеременные и передает в этот класс
    }
}


