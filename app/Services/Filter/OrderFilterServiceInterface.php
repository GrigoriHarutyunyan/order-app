<?php

namespace App\Services\Filter;

interface OrderFilterServiceInterface
{
    /**
     * @param $params
     * @return mixed
     *
     * Filter orders by total price and product name
     */
    public function filter($params): mixed;
}
