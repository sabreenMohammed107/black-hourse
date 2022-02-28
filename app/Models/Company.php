<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'phone',
        'address',
        'crm_link',
        'active',
    ];
    public function getSlugAttribute(): string
    {

            return urlencode($this->name);


    }




    public function getUrlAttribute(): string
    {
        // return action('App\Http\Controllers\Web\BlogsController', [$this->id, $this->slug]);
        return $this->slug;
    }
}
