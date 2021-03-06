<?php

namespace App;

use Spot\EntityInterface as Entity;
use Spot\EventEmitter;
use Spot\MapperInterface as Mapper;
use Tuupola\Base62;

class Machine_Orders extends \Spot\Entity
{
  protected static $table = "machine_orders";

  public static function fields()
  {
    return [
      "t_id" => ["type" => "string", "unsigned" => true, "primary" => true, "autoincrement" => true],
      "mc_id" => ["type" => "string", "unsigned" => true], 
      "t_status" => ["type" => "string"],
      "price" => ["type" => "integer"],
      "items" => ["type" => "integer"],
      "trupay_txn_id" => ["type" => "string"],
      "bank_txn_id" => ["type" => "string"],
      "user_vpa" => ["type" => "string"],
      "user_name" => ["type" => "string"],
      "user_phone" => ["type" => "integer"],
      "user_email" => ["type" => "string"],
      "t_msg" => ["type" => "string"],
      "t_type" => ["type" => "string"],
      "reciever_vpa" => ["type" => "string"]
      // "timestamp" => ["type" => "timestamp"]
    ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      // 'Order_Items' => $mapper->hasMany($entity, 'App\Order_Items', 'id')

    ];
  }
}
