<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategory extends Model
{
    use HasFactory;

    public function createNewCategory(Request $request){
        $category = new PostCategory();
        $category->category_name = $request->categoryName;
        $category->slug = Str::slug($request->categoryName);
        $category->save();
        return $category;
    }
    public function editCategory(Request $request){
        $category =  PostCategory::find($request->categoryId);
        $category->category_name = $request->categoryName;
        $category->slug = Str::slug($request->categoryName);
        $category->save();
        return $category;
    }

    public function getCategoryBySlug($slug){
        return PostCategory::whereSlug($slug)->first();
    }
    public function getAllCategories(){
        return PostCategory::orderBy('category_name', 'ASC')->get();
    }
}
