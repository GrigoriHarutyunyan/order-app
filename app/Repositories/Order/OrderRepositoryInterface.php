<?php

namespace App\Repositories\Order;

use NamTran\LaravelMakeRepositoryService\Repository\RepositoryContract;

interface OrderRepositoryInterface extends RepositoryContract
{

    /**
     * @return mixed
     *
     * get all Orders from Orders table
     */
    public function getAllOrders(): mixed;


    /**
     * @param array $data
     * @return string|void
     *
     * store Order in Orders table
     */
    public function storeOrder(array $data);

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     *
     * update order in Orders table
     */
    public function updateOrderById(int $id, array $data): mixed;

    public function getOrderById(int $id);
}
