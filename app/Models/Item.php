<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $hidden = ['id', 'weather' ,'created_at', 'updated_at'];

    //protected $fillable = ['name'];
}
