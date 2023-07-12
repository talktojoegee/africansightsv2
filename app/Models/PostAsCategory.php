<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAsCategory extends Model
{
    use HasFactory;

    public function getCategory(){
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function createPostAsCategory($postId, $catId){
        $pac = new PostAsCategory();
        $pac->post_id = $postId;
        $pac->category_id = $catId;
        $pac->save();
    }

    public function getAllPostIdsByCategoryId($catId){
        return PostAsCategory::where('category_id', $catId)->pluck('post_id');
    }

    public function getAllCategories(){
        return PostCategory::all();
    }
}
