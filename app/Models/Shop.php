<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 24.08.17
 * Time: 17:49
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'shop_owner',
        'domain',
        'myshopify_domain',
        'country',
        'city',
        'plan_name',
        'country',
        'province',
        'timezone',
        'token'
    ];

}