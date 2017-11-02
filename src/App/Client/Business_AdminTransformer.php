<?php



namespace App;

use App\Business_Admin;
use League\Fractal;

class Business_AdminTransformer extends Fractal\TransformerAbstract
{ 



public function transform(Business_Admin $business_admin)
{

    return [
        "id" => (integer)$business_admin->id ?: 0,
        "admin_name" => (string)$business_admin->admin_name ?: null,
        "phone_no" => (integer)$business_admin->phone_no ?: 0,
        "email" => (string) $business_admin->email ?: 0
         ];
}
}
