<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhishList extends Model
{
    use HasFactory;

    // protected $table = "whish_lists";

    protected $guarded = ['id'];
}
