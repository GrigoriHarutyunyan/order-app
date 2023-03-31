<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Order\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    /**
     * @return mixed
     *
     * get all Orders from Orders table
     */
    public function getAllOrders(): mixed
    {
        return $this->orderRepository->getAllOrders();
    }

    /**
     * @param array $data
     * @return string|void
     *
     * store Order in Orders table
     */
    public function storeOrder(array $data)
    {
        return $this->orderRepository->storeOrder($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     *
     * update order in Orders table
     */
    public function updateOrderById(int $id, array $data): mixed
    {
        return $this->orderRepository->updateOrderById($id, $data);
    }

    public function getOrderById(int $id)
    {
        return $this->orderRepository->getOrderById($id);
    }
}
