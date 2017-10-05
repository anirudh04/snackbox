<?php

/*
 * This file is part of the Slim API skeleton package
 *
 * Copyright (c) 2016-2017 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/slim-api-skeleton
 *
 */

namespace App;

use Spot\EntityInterface;
use Spot\MapperInterface;
use Spot\EventEmitter;
use Tuupola\Base62;
use Psr\Log\LogLevel;
use App\User;
use App\Company;

class User_Companies extends \Spot\Entity
{
    protected static $table = "user_companies";

    public static function fields()
    {
        return [
            "user_company_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "company_id" => ["type" => "integer","unsigned"=>true],
            "user_id" => ["type" => "integer","unsigned"=>true],
            "timestamp" => ["type" => "datetime"],
            
        ];
    }

    $app->get("/user_companies/{id}", function ($request, $response, $arguments) {
      $id = $arguments['id'];
      $user_companies = $this->spot->mapper("App\Company")
      ->query("SELECT user_companies.company_id , companies.company_name compnaies.logo,companies.rating,comapnies.name,companies.enrolled
        from companies NATURAL JOIN user_companies NATURAL JOIN user ON  (user_companies.user_id= user.user_id AND  user_companies.company_id=companies.companies_id) WHERE user.  );

       $fractal = new Manager();
       $fractal->setSerializer(new DataArraySerializer);

       $resource = new Collection($user_companies, new CompanyTransformer);
       $data = $fractal->createData($resource)->toArray();

       return $response->withStatus(200)
       ->withHeader("Content-Type", "application/json")
       ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
   });



}

