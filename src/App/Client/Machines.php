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
      "local_admin_name" => ["type" => "string"],
      "local_admin_phone" => ["type" => "integer"],
      "upi_vpa" => ["type" => "string"],
      "latitude" => ["type" => "float"],
      "longitude" => ["type" => "float"],
      "wifi_id" => ["type" => "string"],
      "wifi_pass" => ["type" => "string"],
      "location" => ["type" => "string"],
      "area_city" => ["type" => "string"],
      "city" => ["type" => "string"],
      "pincode" => ["type" => "integer"],
      "admin_id" => ["type" => "string"]
    ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'Machine_Items' => $mapper->hasMany($entity, 'App\Machine_Items', 'id')
    ];
  }
}