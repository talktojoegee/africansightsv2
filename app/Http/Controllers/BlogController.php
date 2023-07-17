<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostAsCategory;
use App\Models\PostCategory;
use App\Models\PostComment;
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
       // return dd($request->all());
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
        $post = $this->post->createNewPost($request);
        foreach($request->category as $cat){
            $this->postascategory->createPostAsCategory($post->id, $cat);
        }
        session()->flash("success", "Your article was published!");
        return back();
    }


    public function editArticle(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'postContent'=>'required',
            //'featuredImage'=>'required|image|mimes:jpg,jpeg,png',
            'category'=>'required|array',
            'category.*'=>'required'
        ],[
            "title.required"=>"What's the title of your article?",
            "postContent.required"=>"Certainly your article should have content",
            //"featuredImage.required"=>"Choose a featured image; a nice one will make sense",
            //"featuredImage.mimes"=>"Unsupported format. The following formats are allowed: jpg, jpeg, png",
            //"featuredImage.image"=>"Choose an image to feature in this post",
            "category.required"=>"Select a category for this article",
        ]);
        $post = $this->post->updatePost($request);
        $this->postascategory->deleteAllRelatedCat($post->id);
        foreach($request->category as $cat){
            $this->postascategory->createPostAsCategory($post->id, $cat);
        }
        session()->flash("success", "Your article was published!");
        return redirect()->route('manage-articles');
    }

    public function deleteArticle(Request $request){

        $this->validate($request,[
            'articleId'=>'required'
        ]);
        $article = $this->post->getPostById($request->articleId);
        if(!empty($article)){
            $article->delete();
            session()->flash("success", "Success! Article deleted");
            return redirect()->route('manage-articles');
        }else{
            abort(404);
        }
    }

    public function readArticle($slug){
        $article = $this->post->getArticleBySlug($slug);
        if(!empty($article)){

            return view('super-admin.blog.view',['article'=>$article]);
        }else{
            abort(404);
        }
    }


    public function actionArticleComment(Request $request){
        $this->validate($request, [
            'commentId'=>'required',
            'status'=>'required'
        ]);
        $comment = PostComment::find($request->commentId);
        if(!empty($comment)){
            $comment->status = $request->status;
            $comment->save();
            session()->flash("success", "Comment status updated!");
            return back();
        }else{
            session()->flash("error", "Whoops! Could not update comment status");
            return redirect()->route('manage-articles');
        }
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


    public function showEditArticle($slug){
        $article = $this->post->getArticleBySlug($slug);
        if(!empty($article)){
            return view('super-admin.blog.edit',
                [
                    'article'=>$article,
                    'categories'=>$this->postascategory->getAllCategories(),
                    'catIds'=>$this->postascategory->pluckPostCategoryIds($article->id),
                ]);
        }else{
            session()->flash("error", "Record not found");
            return back();
        }
    }

}
