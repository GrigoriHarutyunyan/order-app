<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Services\Filter\FilterServiceInterface;
use App\Services\Filter\OrderFilterServiceInterface;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderServiceInterface $orderService;
    private OrderFilterServiceInterface $filterService;

    /**
     * @param OrderServiceInterface $orderService
     * @param OrderFilterServiceInterface $filterService
     */
    public function __construct(OrderServiceInterface $orderService, OrderFilterServiceInterface $filterService) {
        $this->orderService = $orderService;
        $this->filterService = $filterService;
    }

    /**
     * @return JsonResponse
     *
     * get all Orders from Orders table
     */
    public function index (Request $request): JsonResponse
    {
        $data = $request->all();
        if (isset($data['product_name']) || isset($data['total_price'])) {
             $orders = $this->filterService->filter($data);
        } else {
            $orders = $this->orderService->getAllOrders();
        }
        return response()->json(['success' => true, 'orders' =>$orders]);
    }


    /**
     * @param OrderRequest $request
     * @return JsonResponse
     *
     * store Order in Orders table
     */
    public function store (OrderRequest $request): JsonResponse
    {
        $orderData = $request->validated();
        $this->orderService->storeOrder($orderData);
        return response()->json(['success' => true, 'message' => 'Order has been created successfully!']);
    }


    /**
     * @param OrderRequest $request
     * @param int $id
     * @return JsonResponse
     *
     * update order in Orders table
     */
    public function update(OrderRequest $request, int $id): JsonResponse
    {
        $orderData = $request->validated();
        $order = $this->orderService->updateOrderById($id, $orderData);
        if(!$order) {
            return response()->json(['success' => false, 'message' => 'Order mismatch']);
        }

        return response()->json(['success' => true, 'message' => 'Order has been updated successfully!']);
    }

    public function getOrderById($id) {
        $order = $this->orderService->getOrderById($id);
        if(!$order) {
            return response()->json(['success' => false, 'message' => 'Order mismatch']);
        }
        return response()->json(['success' => true, 'order' => $order]);
    }
}
