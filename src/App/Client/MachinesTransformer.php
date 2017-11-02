<?php



namespace App;

use App\Machines;
use League\Fractal;

class MachinesTransformer extends Fractal\TransformerAbstract
{ 



public function transform(Machines $machines)
{

    return [
        "id" => (integer)$machines->id ?: 0,
        "area" => (string)$machines->area_city ?: null,
        "city" => (string)$machines->city ?: null,
        "left_units" => (integer) $machines->left_units ?: 0,
        "tot_units" => (integer) $machines->tot_units ?: 0
    ];
}
}
