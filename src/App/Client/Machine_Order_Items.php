<?php



namespace App;

use Spot\EntityInterface as Entity;
use Spot\EventEmitter;
use Spot\MapperInterface as Mapper;
use Tuupola\Base62;

class Machine_Order_Items extends \Spot\Entity
{
    protected static $table = "machine_order_items";

    public static function fields()
    {
        return [
            "id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "order_id" => ["type" => "string","unsigned"=>true],
            "name" => ["type" => "string","unsigned"=>true],
            "price" => ["type" => "float"],
            "quantity" => ["type" => "integer"],
            // "timestamp" => ["type" => "timestamp"]
        ];
    }

    public static function relations(Mapper $mapper, Entity $entity) {
        return [

            // 'Owner' => $mapper->belongsTo($entity, 'App\User', 'user_id'),
            // 'Plan' => $mapper->belongsTo($entity, 'App\Plan', 'plan_id')
            
        ];
    }
}
