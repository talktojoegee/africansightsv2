<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostComment extends Model
{
    use HasFactory;

    public function getPost(){
        return $this->belongsTo(Post::class, 'post_id');
    }
    /*
     * $table->unsignedBigInteger('post_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('comment')->nullable();
     */
    public function createPostComment(Request $request){
        $comment = new PostComment();
        $comment->post_id = $request->postId;
        $comment->name = strip_tags($request->name);
        $comment->email = strip_tags($request->email);
        $comment->comment = strip_tags($request->comment);
        $comment->save();
    }

    public function updateCommentStatus($commentId, $status){
        $comment = PostComment::find($commentId);
        $comment->status = $status;
        $comment->save();
    }

    public function getRecentComments(){
        return PostComment::orderBy('id', 'DESC')->take(7)->get();
    }
}
