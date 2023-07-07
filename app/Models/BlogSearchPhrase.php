<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSearchPhrase extends Model
{
    use HasFactory;

    public function createBlogSearchPhrase($phrase){
        $search = new BlogSearchPhrase();
        $search->search_phrase = $phrase;
        $search->save();
    }

    public function getSearchPhrases(){
        return BlogSearchPhrase::orderBy('id', 'DESC')->get();
    }
}
