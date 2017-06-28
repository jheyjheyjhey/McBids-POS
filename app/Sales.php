<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    //Enabling soft-deleting of data.
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'qty', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function product(){
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
