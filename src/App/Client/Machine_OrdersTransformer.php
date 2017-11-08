<?php



namespace App;

use App\Machine_Orders;
use League\Fractal;

class Machine_OrdersTransformer extends Fractal\TransformerAbstract
{

    public function transform(Machine_Orders $machine_orders)
    {
        return [
            "id" => $machine_orders->t_id ?: 0,
            "price" => $machine_orders->price ?: 0,
            // "time" => $machine_orders->timestamp ?: 0,
            "items" => $machine_orders->items ?: 0,
            "status" => "Paid"
        ];
    }
}
