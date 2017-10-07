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

use App\Company;
use League\Fractal;

class CompanyTransformer extends Fractal\TransformerAbstract
{ 


     private $params = [];
    function __construct($params = []) 
    {
        $this->params = $params;
        $this->params['enrolled'] = 0;
        $this->params['rating']=0;
        $this->params['plans']=0;
        
    }

    public function transform(Company $company)
    {


        $appreciates = null;
        $appreciates = $company->User_Companies;
        $this->params['enrolled'] =  count($appreciates);

        $number = null;
        $number = $company->Plans;
        $this->params['plans']=count($number);

        return [
            "company_id" => (integer)$company->company_id ?: 0,
            "logo" => (string)$company->logo ?: null,
            "plans" => (string)$this->params['plans'] ? :0,
            "rating" => $company->rating ?: null,
            "name" => (string)$company->name ?: null,
            "enrolled" => (integer) $this->params['enrolled'] ?: 0,
            "type" => (string)$company->type ?: null,
            
        ];
    }
}
