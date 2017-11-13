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
            "address" => (string)$machines->address ?: null
        ];
    }



    public function includeplans(Machines $machines) {
        $machine_items = $machines->Machine_Items;

        return $this->collection($machine_items, new Machine_ItemsTransformer);
    }
}
