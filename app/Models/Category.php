<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }

  /*   public function getImageAttributte()
    {
        if($this->image == null)
        return noimg.jpg;

        if(file_exists('storage/categories/' . $image))
            return $image;
        else
            return 'noimg.jpeg';
    } */
}
