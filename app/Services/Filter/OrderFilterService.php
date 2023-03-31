<?php

namespace App\Services\Filter;

use App\Repositories\Filter\OrderFilterRepositoryInterface;
use App\Services\Filter\OrderFilterServiceInterface;

class OrderFilterService implements OrderFilterServiceInterface
{
    private OrderFilterRepositoryInterface $filterRepository;

    /**
     * @param OrderFilterRepositoryInterface $filterRepository
     */
    public function __construct(OrderFilterRepositoryInterface $filterRepository)
    {
        $this->filterRepository = $filterRepository;
    }

    /**
     * @param $params
     * @return mixed
     *
     * Filter orders by total price and product name
     */
    public function filter($params): mixed
    {
        return $this->filterRepository->filter($params);
    }
}
