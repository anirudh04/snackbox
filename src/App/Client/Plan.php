<?php

namespace App;

use Spot\EntityInterface as Entity;
use Spot\EventEmitter;
use Spot\MapperInterface as Mapper;
use Tuupola\Base62;

class Plan extends \Spot\Entity
{
    protected static $table = "plans";

    public static function fields()
    {
        return [
            "plan_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "company_id" => ["type" => "integer", "unsigned" => true], 
            "conversion" => ["type" => "string"],
            "earn_per_conversion" => ["type" => "string"],
            "price_per_product" => ["type" => "integer"],
            "difficulty" => ["type" => "string"],
            "name" => ["type" => "string"],
            "training_kit" => ["type" => "string"],
            "timestamp" => ["type" => "datetime"],
            "expiry_date" => ["type" => "datetime"],
            "about" => ["type" => "string"],
        ];
    }

    public function clear()
    {
        $this->data([

        ]);
    }

    public static function relations(Mapper $mapper, Entity $entity) {
        return [

            'Company' => $mapper->belongsTo($entity, 'App\Company', 'company_id'),
            'Likes' => $mapper->hasMany($entity, 'App\Likes', 'plan_id'),
            'Reviews' => $mapper->hasMany($entity, 'App\Reviews', 'plan_id'),
            'Discussion' => $mapper->hasMany($entity, 'App\Discussion_Questions', 'plan_id'),
            'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'plan_id'),
            'User' => $mapper->belongsto($entity, 'App\User', 'User_id')
        ];
    }
}
