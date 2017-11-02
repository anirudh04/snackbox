<?php



namespace App;

use Spot\EntityInterface;
use Spot\MapperInterface;
use Spot\EventEmitter;
use Tuupola\Base62;
use Psr\Log\LogLevel;

class Machine_Items extends \Spot\Entity
{
    protected static $table = "machine_items";

    public static function fields()
    {
        return [
            "id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "pos" => ["type" => "string", "unsigned" => true], 
            "mc_id" => ["type" => "string","unsigned"=>true],
            "name" => ["type" => "string","unsigned"=>true],
            "price" => ["type" => "integer","unsigned"=>true],
            "tot_units" => ["type" => "integer"],
            "left_units" => ["type" => "integer"],
            "row_tag" => ["type" => "string"],
            "row_total_columns" => ["type" => "integer"]
            ];
    }


  //    public static function relations(Mapper $mapper, Entity $entity) {
  //   return [
  //     'Machine' => $mapper->belongsTo($entity, 'App\Machines', 'id')
  //       ];

  // }

}




   