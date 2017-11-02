<?php



namespace App;

use App\Machines;
use League\Fractal;

class Single_MachineTransformer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [

        'machine_items',

    ];

    public function transform(Machines $machines)
    {


        return [
            "id" => (integer)$machines->id ?: 0,
            "area_city" => (string)$machines->area_city ?: null
        ];
    }



    public function includeplans(Machines $machines) {
        $machine_items = $machines->Machine_Items;

        return $this->collection($machine_items, new Machine_ItemsTransformer);
    }
}
