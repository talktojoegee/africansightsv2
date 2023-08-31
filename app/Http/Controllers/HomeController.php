<?php

namespace App\Http\Controllers;

use App\Models\BlogSearchPhrase;
use App\Models\ContactUs;
use App\Models\Dump\LeaseApplication;
use App\Models\Dump\Plan;
use App\Models\Dump\Property;
use App\Models\Dump\PropertyListing;
use App\Models\Dump\State;
use App\Models\Dump\Tenant;
use App\Models\Dump\TenantMessage;
use App\Models\Dump\TenantNotification;
use App\Models\Faq;
use App\Models\Post;
use App\Models\PostAsCategory;
use App\Models\PostCategory;
use App\Models\PostComment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->post = new Post();
        $this->postcomment = new PostComment();
        $this->blogsearchphrase = new BlogSearchPhrase();
        $this->contactus = new ContactUs();
        $this->postcategory = new PostCategory();
        $this->postascategory = new PostAsCategory();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homepage()
    {

            return view('homepage.index',
                [
                    'articles'=>$this->post->getArticles(),
                    'populars'=>$this->post->getPopularArticles(),
                    'related'=>$this->post->getRelatedArticles(),
                    'categories'=>$this->postcategory->getAllCategories(),
                ]);


    }

    public function listingByLocation($location)
    {
        $location = $this->state->getStateBySlug($location);
        if(!empty($location)){
            return view('homepage.index',
                [
                    'listing'=>$this->propertylisting->getTenantListingByStatus()
            ]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function getPropertyDetails($slug)
    {
        $property = $this->property->getPropertyBySlug($slug);
        if(!empty($property)){
            $listing = $this->propertylisting->getListingByPropertyId($property->id);
            return view('homepage.property-details',
                [
                    'property'=>$property,
                    'listing'=>$listing
            ]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function sendMessage(Request $request){
        $this->validate($request,[
            'fullName'=>'required',
            'email'=>'required|email',
            'mobileNo'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'tenantId'=>'required',
            'g-recaptcha-response' => 'required|captcha',
        ],[
            "fullName.required"=>"Enter your full name in the input field provided",
            "email.required"=>"Enter your email address in the input field provided",
            "email.email"=>"Enter a valid email address",
            "subject.required"=>"Give your message a subject",
            "message.required"=>"We'll like to hear from you. Type the message in the input field provided.",
            'g-recaptcha-response.captcha'=>'Incorrect captcha',
            'g-recaptcha-response.required'=>"Our system thinks you're a robot. Why not proof it wrong?",
        ]);
        $this->tenantmessage->createNewMessage($request);
        $tenant = $this->tenant->getTenantById($request->tenantId);
        session()->flash("success", "Thank you for contacting ".$tenant->company_name.". We'll get back to you as soon as possible.");
        //$route = url()->current().'#add-review';
        return back();
    }

    public function propertyListings(){
        return view('homepage.property-listings',[
            'listings'=>$this->propertylisting->paginatePropertyListingsByStatus(1),
            'locations'=>$this->state->getStates(),
            'search'=>false,
            'searchTerm'=>null,
        ]);
    }
    public function faqs(){
        return view('homepage.faqs',[
            'faqs'=>$this->faq->getFaqs()
        ]);
    }

    public function submitNewLeaseApplication(Request $request){
        $this->validate($request,[
            'listingId'=>'required',
            'leasePeriod'=>'required',
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'mobileNo'=>'required',
            'g-recaptcha-response' => 'required|captcha',
        ],[
            "property.required"=>"Select a property for this application",
            "leasePeriod.required"=>"Select a lease period",
            "firstName.required"=>"Enter your applicant first name",
            "lastName.required"=>"Enter your applicant surname",
            "email.required"=>"Enter your applicant email address",
            "email.email"=>"Enter a valid email address",
            "mobileNo.required"=>"Enter a functional mobile no",
            'g-recaptcha-response.captcha'=>'Incorrect captcha',
            'g-recaptcha-response.required'=>"Our system thinks you're a robot. Why not proof it wrong?",
        ]);
        $listing = $this->propertylisting->getListingById($request->listingId);
        $app = $this->leaseapplication->addNewLeaseApplication($request, $listing);
        #Notify tenant //$subject, $body, $route_name, $route_param, $route_type, $user_id
        $subject = "New Lease Application!";
        $body = "Hello there! You have a new lease application.";
        $this->tenantnotification->setNewAdminNotification($subject, $body, 'show-lease-application-details', $app->slug, 1, $app->tenant_id);
        session()->flash("success", "Your lease application was submitted.");
        return back();
    }

    public function searchPropertyListings(Request $request){
        $this->validate($request,[
            'searchTerm'=>'required',
        ],[
            "searchTerm.required"=>"Enter a search key phrase"
        ]);
        $propertyIds = $this->property->searchPropertyByPluckingIds($request->searchTerm, $request->location ?? 0);
        $listings = $this->propertylisting->searchPropertyListings($propertyIds, $request->budget ?? 0);
        return view('homepage.property-listings',[
            'listings'=>$listings,
            'locations'=>$this->state->getStates(),
            'search'=>true,
            'searchTerm'=>$request->searchTerm,
        ]);
    }

    public function getPropertyListingsByLocation($slug){
        $location = $this->state->getStateBySlug($slug);
        if(!empty($location)){
            $propertyIds = $this->property->pluckPropertiesByLocation($location->id);
            $listings = $this->propertylisting->propertyListingsByPropertyIds($propertyIds);
            return view('homepage.property-listings',[
                'listings'=>$listings,
                'locations'=>$this->state->getStates(),
                'search'=>false,
                'searchTerm'=>null,
            ]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function blog(){
        return view('homepage.blog',[
            'articles'=>$this->post->getArticles(),
            'populars'=>$this->post->getPopularArticles(),
            'related'=>$this->post->getRelatedArticles(),
            'categories'=>$this->postcategory->getAllCategories()
        ]);
    }

    public function readArticle($slug){
        $article = $this->post->getArticleBySlug($slug);
        if(!empty($article)){
            return view('homepage.blog-details',[
                'article'=>$article,
                'populars'=>$this->post->getPopularArticles(),
                'related'=>$this->post->getRelatedArticles(),
                'num1'=>rand(10,100),
                'num2'=>rand(10,100),
            ]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function leaveComment(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'postId'=>'required',
            'comment'=>'required',
            'sum'=>'required',
            //'g-recaptcha-response' => 'required|captcha',
        ],[
            "name.required"=>"Enter your name in the box provided",
            "email.required"=>"Enter your email address",
            "email.email"=>"Enter a valid email address",
            "comment.required"=>"What's on your mind? Type it in the box provided.",
            "sum.required"=>"Whoops! Wrong summation. Please try again.",
            //'g-recaptcha-response.captcha'=>'Incorrect captcha',
            //'g-recaptcha-response.required'=>"Our system thinks you're a robot. Why not proof it wrong?",
        ]);
        $val = $request->sum ?? 0;
        if($val == ($request->num1 + $request->num2)){
            $this->postcomment->createPostComment($request);
            session()->flash("success", "Thank you for taking your time to leave a comment. We'll review your comment and act accordingly.");
            return back();
        }else{
            session()->flash("error", "Wrong summation. Please try again.");
            return back();
        }

    }

    public function searchArticle(Request $request){
        $this->validate($request,[
            'searchTerm'=>'required'
        ],[
            "searchTerm.required"=>"Enter a search term to search"
        ]);
        $articles = $this->post->searchArticle(strip_tags($request->searchTerm));
        $this->blogsearchphrase->createBlogSearchPhrase(strip_tags($request->searchTerm));
        return view('homepage.blog',[
            'articles'=>$articles,
            'populars'=>$this->post->getPopularArticles(),
            'related'=>$this->post->getRelatedArticles(),
            'categories'=>$this->postcategory->getAllCategories()
        ]);
    }

    public function showContactUs(){
        return view('homepage.contact-us');
    }

    public function storeContactUsRequest(Request $request){
        $this->validate($request,[
            'fullName'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
            'g-recaptcha-response' => 'required|captcha',
        ],[
            "fullName.required"=>"Enter your full name in the field provided.",
            "email.email"=>"Enter a valid email address",
            "email.required"=>"Enter your email address in the field provided.",
            "subject.required"=>"What's the subject of what you want to talk to us about?",
            "message.required"=>"Whoops! Let's hear from you",
            'g-recaptcha-response.captcha'=>'Incorrect captcha',
            'g-recaptcha-response.required'=>"Our system thinks you're a robot. Why not proof it wrong?",
        ]);
        $this->contactus->newContactUsRequest($request);
        session()->flash("success", "Thank you for reaching out to us. We'll get back to you on this ASAP.");
        return back();
    }

    public function showPostByCategory($slug){
        $category = $this->postcategory->getCategoryBySlug($slug);
        if(!empty($category)){
            $postIds = $this->postascategory->getAllPostIdsByCategoryId($category->id);
            $articles = $this->post->getBulkArticlesById($postIds);
            return view('homepage.blog',
                [
                    'articles'=>$articles,
                    'populars'=>$this->post->getPopularArticles(),
                    'related'=>$this->post->getRelatedArticles(),
                    'categories'=>$this->postcategory->getAllCategories(),
                    'category'=>$category
                ]);
        }else{
            return redirect()->route('homepage');
        }
    }


    public function showPrivacyPolicy(){
        return view('homepage.privacy-policy');
    }



}
