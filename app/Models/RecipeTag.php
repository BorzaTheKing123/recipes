<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'recipe_tag';
    protected $fillable = ['recipes_id', 'tag_id'];
}
