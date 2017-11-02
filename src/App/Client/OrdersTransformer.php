<?php



namespace App;

use App\Orders;
use League\Fractal;

class OrdersTransformer extends Fractal\TransformerAbstract
{

    public function transform(Orders $orders)
    {
        return [
            "id" => $orders->order_id ?: 0,
            "price" => $orders->price ?: 0,
            "time" => $orders->time ?: 0,
            "quantity" => $orders->items ?: 0,
            "status" => "Paid"
        ];
    }
}
