<?php

namespace App\Repositories\Filter;

use App\Models\Order;
use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Filter\OrderFilterRepositoryInterface;

class OrderFilterRepository extends BaseRepository implements OrderFilterRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * @param $params
     * @return mixed
     *
     * Filter orders by total price and product name
     */
    public function filter($params): mixed
    {
       return $this->model->when(isset($params['product_name']), function ($q) use ($params){
            return $q->where('product_name', 'like', '%'.$params['product_name'].'%');
        })->when(isset($params['total_price']), function ($q) use ($params) {
            return $q->where('total_price', '=', $params['total_price']);
        })->paginate(20);

    }
}
