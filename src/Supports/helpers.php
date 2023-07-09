<?php
declare(strict_types=1);

use Support\Flash\Flash;

if (!function_exists('flash')) {
    function flash(): \Supports\Flash\FlashHelper
    {
        return app(\Supports\Flash\FlashHelper::class);
    }

}
    if (!function_exists('filters')){
        function filters (): array
        {
            return app(\Domain\Catalog\Filters\FilterManager::class)->items();
        }
    }

    if (!function_exists('cart')){
        function cart (): \Domain\Cart\CartManager
        {
            return app(\Domain\Cart\CartManager::class);
        }
    }

    if (!function_exists('is_catalog_view')){
        function is_catalog_view (string $type, string $default = 'grid'): bool
        {
            return session('view', $default) === $type;
        }
    }

    if (!function_exists('filter_url')){
        function filter_url (?\Domain\Catalog\Model\Category $category, array $params = []):string
        {
            return route('catalog',[
               ...request()->only(['filters','sort']),
               ...$params,
               'category'=>$category
            ]);
        }
    }


if (!function_exists('filters')){
    function filters (): array
    {
        return app(\Domain\Catalog\Filters\FilterManager::class)->items();
    }
}


if (!function_exists('filter_url')){
    function filter_url (?\Domain\Catalog\Model\Category $category, array $params = []):string
    {
        return route('catalog',[
            ...request()->only(['filters','sort']),
            ...$params,
            'category'=>$category
        ]);
    }
}
