<?php

namespace App\Repositories\Order;

use App\Models\Order;
use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Order::class;
    }


    /**
     * @return mixed
     *
     * get all Orders from Orders table
     */
    public function getAllOrders(): mixed
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate(20);
    }

    /**
     * @param array $data
     * @return string|void
     *
     * store Order in Orders table
     */
    public function storeOrder(array $data)
    {
        try {
           $this->model->create([
                'product_name' => $data['product_name'],
                'weight' => $data['weight'],
                'description' => $data['description'],
                'total_price' => $data['total_price'],
            ]);

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param int $id
     * @param array $data
     * @return string
     *
     * update order in Orders table
     */
    public function updateOrderById(int $id, array $data): string
    {
        try {
            $order = $this->model->findOrFail($id);
            $order->update([
                'product_name' => $data['product_name'],
                'weight' => $data['weight'],
                'description' => $data['description'],
                'total_price' => $data['total_price'],
            ]);
            return $order;
        }catch (\Exception $e) {
            return '';
        }
    }

    public function getOrderById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        }catch (\Exception $e) {
            return '';
        }
    }
}
