<?php

namespace App;
use Spot\EntityInterface as Entity;
use Spot\EventEmitter;
use Spot\MapperInterface as Mapper;
use Tuupola\Base62;

class Machines extends \Spot\Entity
{
  protected static $table = "machines";

  public static function fields()
  {
    return [
      "id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" =>true], 
      "address" => ["type" => "string"],
      "latitude" => ["type" => "float"],
      "longitude" => ["type" => "float"],
      "merchant_id" => ["type" => "integer"]
    ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'Machine_Items' => $mapper->hasMany($entity, 'App\Machine_Items', 'id')
    ];
  }
}