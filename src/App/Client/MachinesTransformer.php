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
        "merchant_id" => (integer)$machines->merchant_id ?: 0,
        "address" => (string)$machines->address ?: null,
        "latitude" => (float) $machines->latitude ?: 0,
        "longitude" => (float) $machines->longitude ?: 0
    ];
}
}
