<?php

namespace UnitConnection\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address_street', 'address_city', 'address_postcode', 'address_country'];
}
