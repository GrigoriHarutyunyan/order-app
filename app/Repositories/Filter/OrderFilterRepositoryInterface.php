<?php

namespace App\Repositories\Filter;

use NamTran\LaravelMakeRepositoryService\Repository\RepositoryContract;

interface OrderFilterRepositoryInterface extends RepositoryContract
{
    /**
     * @param $params
     * @return mixed
     *
     * Filter orders by total price and product name
     */
    public function filter($params): mixed;
}
