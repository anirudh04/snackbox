<?php



namespace App;

use App\Machine_Items;
use League\Fractal;

class Machine_ItemsTransformer extends Fractal\TransformerAbstract
{

    public function transform(Machine_Items $machine_items)
    {


        return [
            "id" => (integer)$machine_items->id ?: 0,
            "name" => (string)$machine_items->name ?: null,
            "row_tag" => (string)$machine_items->row_tag ?: null,
            "row_total_columns" => (string)$machine_items->row_total_columns ?: null,
            "pos" => (string)$machine_items->pos ?: null,
            "price" => (integer)$machine_items->price ?: 0,
            "left_units" => (integer)$machine_items->left_units ?: 0,
            "tot_units" => (integer)$machine_items->tot_units ?: 0
        ];
    }
}
