<?php
declare(strict_types=1);

namespace Domain\Catalog\Filters;

use Illuminate\Database\Eloquent\Builder;
use function Clue\StreamFilter\append;

abstract class AbstractFilter implements \Stringable
{

   public function __invoke(Builder $query, $next)
    {
        $this->apply($query);
        return $next($this->apply($query));
    }
    abstract public function title(): string;

    abstract public function key(): string;
    abstract public function apply(Builder $builder): Builder; // для реализации своих обработок кастомный билдер

    abstract public function values(): array;

    abstract public function view(): string;

    public function requestValue(string $index = null, mixed $default = null): mixed
    {
        return request('filters.' . $this->key() . ($index ? ".$index" : ''),$default);
    }

    public function name(string $index = null): string  //получить имя инпута
    {
        return str($this->key())->wrap('[',']')->prepend('filters')->when($index, fn($str)=> $str->append("[$index]"))->value();
    }

    public function id(string $index = null):string
    {
        return str($this->name($index))->slug('_')->value() ;
    }
}
