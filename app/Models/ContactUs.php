<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactUs extends Model
{
    use HasFactory;
    /*
     * $table->string('full_name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->string('slug');
     */
    public function newContactUsRequest(Request $request){
        $contact = new ContactUs();
        $contact->full_name = $request->fullName;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->slug = Str::slug($request->subject).'-'.Str::random(8);
        $contact->save();
        return $contact;
    }

    public function getAllContactusRequests(){
        return ContactUs::orderBy('id', 'DESC')->get();
    }

    public function getContactUsRequestBySlug($slug){
        return ContactUs::where('slug', $slug)->first();
    }

}
