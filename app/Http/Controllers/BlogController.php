<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostAsCategory;
use App\Models\PostCategory;
use App\Models\PostImage;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->postcategory = new PostCategory();
        $this->post = new Post();
        $this->postascategory = new PostAsCategory();
    }

    public function showBlogCategories(){
        return view('super-admin.blog.categories', [
            'categories'=>$this->postcategory->getAllCategories()
        ]);
    }

    public function storePostCategory(Request $request){
        $this->validate($request,[
            'categoryName'=>'required|unique:post_categories,category_name'
        ],[
            'categoryName.required'=>"Enter a category name in the field provided",
            'categoryName.unique'=>"There's an existing category by that name"
        ]);
        $this->postcategory->createNewCategory($request);
        session()->flash("success", "Your category was published!");
        return back();
    }

    public function editPostCategory(Request $request){
        $this->validate($request,[
            'categoryName'=>'required|unique:post_categories,category_name',
            'categoryId'=>'required'
        ],[
            'categoryName.required'=>"Enter a category name in the field provided",
            'categoryName.unique'=>"There's an existing category by that name"
        ]);
        $this->postcategory->editCategory($request);
        session()->flash("success", "Your changes were saved!");
        return back();
    }

    public function showNewArticleForm(){
        return view('super-admin.blog.add-new-article',[
            'categories'=>$this->postcategory->getAllCategories()
        ]);
    }

    public function storeArticle(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'postContent'=>'required',
            'featuredImage'=>'required|image|mimes:jpg,jpeg,png',
            'category'=>'required|array',
            'category.*'=>'required'
        ],[
            "title.required"=>"What's the title of your article?",
            "postContent.required"=>"Certainly your article should have content",
            "featuredImage.required"=>"Choose a featured image; a nice one will make sense",
            "featuredImage.mimes"=>"Unsupported format. The following formats are allowed: jpg, jpeg, png",
            "featuredImage.image"=>"Choose an image to feature in this post",
            "category.required"=>"Select a category for this article",
        ]);
       /* $content = $request->postContent;
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFiles = $dom->getElementsByTagName('img');
        foreach($imageFiles as $item=> $image ){
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $imageData = base64_decode($data);
            $imageName = "/upload".time().$item.'.png';
            $path = public_path().$imageName;
            file_put_contents($path, $imageData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $imageName);
        }
        $content = $dom->saveHTML();*/
        //return dd($content);
        $post = $this->post->createNewPost($request);
        foreach($request->category as $cat){
            $this->postascategory->createPostAsCategory($post->id, $cat);
        }
        session()->flash("success", "Your article was published!");
        return back();
    }

    public function uploadArticleFiles(Request $request){
        $this->validate($request, [

            'file' => 'required|mimes:pdf,png,jpg,jpeg',
        ]);
        $timestamps = time();

        $base_location = 'uploads';

        // Handle File Upload
        if($request->hasFile('file'))
        {
            $documentPath = $request->file('file')->store($base_location, 's3');
        } else
        {

            $pri2 = new PostImage();
            $pri2 = $pri2::where('blogcode', $timestamps)->get();
            return view('admin.Images')->with(['images'=>$pri2]);
        }

        $filename = explode("/", $documentPath);
        $filename =  $filename[1];
        //We save new path


        $awsurl = $this->AWSLinkHelper();
        $pri = new PostImage();
        $pri->blogcode = $timestamps;
        $pri->url = $awsurl.$documentPath;
        $pri->imagedesc = $request->imagedesc;
        $pri->save();

        $pri2 = new PostImage();
        $pri2 = $pri2::where('blogcode', $timestamps)->get();
        return view('admin.Images')->with(['images'=>$pri2]);

    }

    public function AWSLinkHelper()
    {

        return "https://" . "africansights". ".s3".".". "us-east-1" ."."."amazonaws.com/";
    }

    public function manageArticles(){
        return view('super-admin.blog.index',[
            'articles'=>$this->post->getArticles()
        ]);
    }


}
