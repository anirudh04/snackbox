<?php
namespace App;

use App\Order_items;
use League\Fractal;

class Order_ItemsTransformer extends Fractal\TransformerAbstract
{

    public function transform(Order_items $order_items)
    {
        return [
            "id" => (integer)$order_items->id ?: 0,
            "name" => (string)$order_items->name ?: null,
            "price" => (integer)$order_items->price ?: 0,
            "quantity" => (integer)$order_items->quantity ?: 0
        ];
    }
}
