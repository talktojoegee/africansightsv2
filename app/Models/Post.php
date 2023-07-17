<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public function getAuthor(){
        return $this->belongsTo(User::class, 'author');
    }

    public function getFeaturedCategories()
    {
        return $this->hasMany(PostAsCategory::class, 'post_id')->take(2);
    }
    public function getPostComments()
    {
        return $this->hasMany(PostComment::class, 'post_id')->orderBy('id', 'DESC');
    }

    public function createNewPost(Request $request){

        $content = $request->postContent;
        $dom = new \DOMDocument();
        @$dom->loadHTML($content, LIBXML_NOWARNING| LIBXML_NOERROR);
        $imageFiles = $dom->getElementsByTagName('img');
        foreach($imageFiles as $item=> $image ){
            $data = $image->getAttribute('src');
            if (strpos($data, 'data:image')!==false){
                @list($type, $data) = explode(';', $data);
                @list(, $data) = explode(',', $data);
                //decode base64
                $imageData = base64_decode($data);
                $imageName = "/upload".time().$item.'.png';
                $path = public_path().'/drive'.$imageName;
                file_put_contents($path, $imageData);

                $image->removeAttribute('src');
                $image->setAttribute('src', '/drive/'.$imageName);
            }
        }
        $content = $dom->saveHTML();

        $featuredImage = null;
        $article = new Post();
        $article->title = $request->title;
        $article->author = Auth::user()->id;
        $article->article_content = $content;// $request->postContent;
        $article->slug = Str::slug($request->title).'-'.Str::random(4);
        //$article->categories = implode(',',$request->category);
        if ($request->file()) {
            $extension = $request->featuredImage->getClientOriginalExtension();
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $dir = 'assets/drive/blog/';
            $request->featuredImage->move(public_path($dir), $filename);
            $featuredImage = $filename;
        }
        $article->featured_image = $featuredImage;
        $article->save();
        return $article;
    }
    public function updatePost(Request $request){

        //try {

            $content = $request->postContent;
            $dom = new \DOMDocument();
        //return dd($dom);
            @$dom->loadHTML($content, LIBXML_NOWARNING| LIBXML_NOERROR);
            //@$dom->loadHTML($content, LIBXML_HTML_NOIMPLIED| LIBXML_HTML_NODEFDTD);
            $imageFiles = $dom->getElementsByTagName('img');
            //return dd($imageFiles);
            foreach($imageFiles as $item=> $image ){
                $data = $image->getAttribute('src');
                if (strpos($data, 'data:image')!==false){
                    @list($type, $data) = explode(';', $data);
                    @list(, $data) = explode(',', $data);
                    //decode base64
                    $imageData = base64_decode($data);
                    $imageName = "/upload".time().$item.'.png';
                    $path = public_path().'/drive'.$imageName;
                    file_put_contents($path, $imageData);

                    $image->removeAttribute('src');
                    $image->setAttribute('src', '/drive/'.$imageName);
                }

            }
            $content = $dom->saveHTML();

            $featuredImage = null;
            $article =  Post::find($request->postId);
            $article->title = $request->title;
            $article->author = Auth::user()->id;
            $article->article_content = $content;// $request->postContent;
            $article->slug = Str::slug($request->title).'-'.Str::random(4);
            //$article->categories = implode(',',$request->category);
            if ($request->hasFile('featuredImage')) {
                $extension = $request->featuredImage->getClientOriginalExtension();
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/blog/';
                $request->featuredImage->move(public_path($dir), $filename);
                $featuredImage = $filename;
                $article->featured_image = $featuredImage;
            }
            $article->save();
            return $article;
        /*}catch (\Exception $exception){
            return back();
        }*/
    }

    public function getArticles(){
        return Post::orderBy('id', 'DESC')->paginate(10);
    }
    public function getBulkArticlesById($ids){
        return Post::whereIn('id', $ids)->orderBy('id', 'DESC')->paginate(10);
    }

    public function getArticleBySlug($slug){
        return Post::where('slug', $slug)->first();
    }
    public function getLatestArticles(){
        return Post::orderBy('id', 'DESC')->take(3)->get();
    }
    public function getPopularArticles(){
        return Post::orderBy('id', 'ASC')->take(3)->get();
    }
    public function getRelatedArticles(){
        return Post::inRandomOrder(2)->get();
    }

    public function searchArticle($searchTerm){
        return Post::where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('article_content', $searchTerm)
            ->paginate(10);
    }

    public function getPostById( $articleId)
    {
        return Post::find($articleId);
    }



    public function getCurrentYearArticles(){
        return Post::whereYear('created_at', date('Y'))
            ->get();
    }

    public function getLastYearArticles(){
        $current = date('Y');
        return Post::whereYear('created_at', $current-1)
            ->get();
    }


    public function getCurrentMonthArticles(){
        return Post::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->get();
    }

    public function getLastMonthArticles(){
        $currentMonth = date('m');
        $lastMonth = $currentMonth - 1;
        if($lastMonth == 0){
            $lastMonth = 12;
        }
        return Post::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $lastMonth)
            ->get();
    }


}
