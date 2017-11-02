<?php



namespace App;

use App\Orders;
use League\Fractal;

class OrdersTransformer extends Fractal\TransformerAbstract
{

    public function transform(Orders $orders)
    {


        return [
            "id" => (integer)$orders->id ?: 0,
            "name" => (string)$orders->name ?: null,
            "row_tag" => (string)$orders->row_tag ?: null,
            "price" => (integer)$orders->price ?: 0,
            "left_units" => (integer)$orders->left_units ?: 0,
            "tot_units" => (integer)$orders->tot_units ?: 0
        ];
    }
}
