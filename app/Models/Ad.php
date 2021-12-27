<?php

namespace App\Models;

use App\Models\User;
use App\Models\AdImage;
use App\Models\Category;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id',
    ];

    public function toSearchableArray()
    {
        $array = [
            'id' =>$this->id,
            'title' =>$this->title,
            'description' =>$this->description,
            'category' =>$this->category,
        ];

        return $array;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function url()
    {

        return route('ads.show', [$this->id, Str::slug($this->title)]);
    }

    public function preview($description)
    {
        $description = strip_tags($description);
        if (strlen($description) > 50) {
            $description = substr($description, 0, 50);
            $description = $description . "...";
        }
        return $description;
    }

    public function images(){
        return $this->hasMany(AdImage::class);
    }
}
