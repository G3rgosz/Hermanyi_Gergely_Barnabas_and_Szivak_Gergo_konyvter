<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    use HasFactory;

    protected $fillable = [
        "adtitle",
        "description",
        "price",
        "sawcounter",
        "picturepath",
        "badcontent",
        "book_id",
        "user_id"
    ];
}
