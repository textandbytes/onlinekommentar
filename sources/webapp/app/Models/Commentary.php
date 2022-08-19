<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Commentary extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'label_de',
        'label_en',
        'label_fr',
        'label_it',
        'content_de',
        'content_en',
        'content_fr',
        'content_it',
        'suggested_citation_long',
        'suggested_citation_short',
        'status',
        'original_language',
        'doi',
        'slug',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_x_commentaries', 'commentary_id', 'user_id');
    }

    public function editors()
    {
        return $this->users()->where('role_id', 2);
    }

    public function authors()
    {
        return $this->users()->where('role_id', 3);
    }

    public function proofreaders()
    {
        return $this->users()->where('role_id', 4);
    }

    /**
     * Use the slug as the route key for binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('label_de')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}