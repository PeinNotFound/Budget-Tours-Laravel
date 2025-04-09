<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Destinations extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'content',
        'price',
        'days',
        'location',
        'category_id',
        'pricing'
    ];

    protected $attributes = [
        'image' => 'placeholder.jpg'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($destination) {
            if (empty($destination->content)) {
                $destination->content = $destination->description;
            }
            if (empty($destination->pricing)) {
                $destination->pricing = 'Kshs ' . number_format($destination->price);
            }
        });

        static::updating(function ($destination) {
            if ($destination->isDirty('price')) {
                $destination->pricing = 'Kshs ' . number_format($destination->price);
            }
        });
    }

    /**
     * delete image from storage
     * @return void 
     */

    public function deleteImage()
    {
        if($this->image) {
            Storage::delete($this->image);
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany('App\DestinationImage', 'destination_id');
    }

    public function primaryImage()
    {
        return $this->hasOne('App\DestinationImage', 'destination_id')->where('is_primary', true);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * 
     * check if post has a tag
     */
     
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
}
