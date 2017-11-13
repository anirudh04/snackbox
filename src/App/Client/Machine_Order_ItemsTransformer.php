<?php
namespace App;

use App\Machine_Order_items;
use League\Fractal;

class Machine_Order_ItemsTransformer extends Fractal\TransformerAbstract
{

    public function transform(Machine_Order_items $machine_order_items)
    {
        return [
            "id" => (integer)$machine_order_items->id ?: 0,
            "name" => (string)$machine_order_items->name ?: null,
            "price" => (float)$machine_order_items->price ?: 0,
            "quantity" => (integer)$machine_order_items->quantity ?: 0
        ];
    }
}
