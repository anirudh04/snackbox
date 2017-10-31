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
      "price" => ["type" => "integer"],
      "items" => ["type" => "integer"],
      "trupay_txn_id" => ["type" => "string"],
      "bank_txn_id" => ["type" => "string"],
      "user_vpa" => ["type" => "string"],
      "user_name" => ["type" => "string"],
      "user_phone" => ["type" => "integer"],
      "t_msg" => ["type" => "string"],
      "reciever_vpa" => ["type" => "string"],
      "details" => ["type" => "string"],
      "status" => ["type" => "string"],
      "timestamp" => ["type" => "timestamp"]
    ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [

      'Likes' => $mapper->hasMany($entity, 'App\Likes', 'plan_id'),
      'Company' => $mapper->belongsTo($entity, 'App\Company', 'company_id'),
      'Reviews' => $mapper->hasMany($entity, 'App\Reviews', 'plan_id'),
      'Discussion' => $mapper->hasMany($entity, 'App\Discussion_Questions', 'plan_id')
      // 'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'plan_id'),
    ];
  }
}
