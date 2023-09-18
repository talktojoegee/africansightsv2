<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'homepage'])->name('homepage');

//Route::post('/send/message', [App\Http\Controllers\HomeController::class, 'sendMessage'])->name('send-message');
//Route::get('/property/listings', [App\Http\Controllers\HomeController::class, 'propertyListings'])->name('property-listings');

Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [App\Http\Controllers\HomeController::class, 'readArticle'])->name('view-blog');
Route::post('/leave-comment', [App\Http\Controllers\HomeController::class, 'leaveComment'])->name('leave-comment');
Route::get('/search-article', [App\Http\Controllers\HomeController::class, 'searchArticle'])->name('search-article');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'showContactUs'])->name('show-contact-us');
Route::post('/contact-us', [App\Http\Controllers\HomeController::class, 'storeContactUsRequest']);
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'showPrivacyPolicy'])->name('show-privacy-policy');
Route::get('/category/{slug}', [App\Http\Controllers\HomeController::class, 'showPostByCategory'])->name('show-post-by-category');



Auth::routes();
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);


Route::get('/general-login', [App\Http\Controllers\Auth\LoginController::class, 'showGeneralLoginForm'])->name('general-login');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);


Route::group(['prefix'=>'manager', 'middleware'=>'auth'],function(){
    #Profile routes
    Route::get('/profile/{uuid}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/add-new-team-member', [App\Http\Controllers\UserController::class, 'addNewTeamMember'])->name('add-new-team-member');
    Route::post('/add-new-team-member', [App\Http\Controllers\UserController::class, 'storeNewTeamMember']);
    Route::get('/manage-team', [App\Http\Controllers\UserController::class, 'manageTeam'])->name('manage-team');
    Route::post('/update-team-profile', [App\Http\Controllers\UserController::class, 'updateMyProfile'])->name('update-team-profile');
    Route::post('/change-photo-profile', [App\Http\Controllers\UserController::class, 'changeProfilePhoto'])->name('change-photo-profile');
    Route::get('/manage-tenants', [App\Http\Controllers\UserController::class, 'manageTenants'])->name('manage-tenants');
    Route::post('/grant-permission', [App\Http\Controllers\UserController::class, 'grantPermission'])->name('grant-permission');
    #Accounting routes
    Route::prefix('/cloud-storage')->group(function(){
        Route::get('/', [App\Http\Controllers\CloudStorageController::class, 'showCloudStorage'])->name('cloud-storage');
        Route::post('/manage-files', [App\Http\Controllers\CloudStorageController::class, 'storeFiles'] )->name('upload-files');
        Route::post('/create-folder', [App\Http\Controllers\CloudStorageController::class, 'createFolder'] )->name('create-folder');
        Route::get('/folder/{slug}', [App\Http\Controllers\CloudStorageController::class, 'openFolder'] )->name('open-folder');
        Route::get('/download/{slug}', [App\Http\Controllers\CloudStorageController::class, 'downloadAttachment'] )->name('download-attachment');
        Route::post('/delete-file', [App\Http\Controllers\CloudStorageController::class, 'deleteAttachment'])->name('delete-file');
        Route::post('/delete-folder', [App\Http\Controllers\CloudStorageController::class, 'deleteFolder'])->name('delete-folder');
    });


});

Route::get('/authenticate', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('authenticate');
Route::post('/authenticate', [App\Http\Controllers\Admin\AdminAuthController::class, 'login']);
Route::get('/sign-out', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('sign-out');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/upload-article-files', [App\Http\Controllers\BlogController::class, 'uploadArticleFiles'])->name('upload-article-files');
    Route::prefix('/overview')->group(function(){
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('super-admin-dashboard');
        #To be removed to super-admin middleware
        Route::get('/categories', [App\Http\Controllers\BlogController::class, 'showBlogCategories'])->name('show-blog-categories');
        Route::post('/categories', [App\Http\Controllers\BlogController::class, 'storePostCategory']);
        Route::post('/edit-category', [App\Http\Controllers\BlogController::class, 'editPostCategory'])->name('edit-category');
        Route::get('/add-new-article', [App\Http\Controllers\BlogController::class, 'showNewArticleForm'])->name('show-new-article');
        Route::post('/add-new-article', [App\Http\Controllers\BlogController::class, 'storeArticle']);
        Route::get('/manage-articles', [App\Http\Controllers\BlogController::class, 'manageArticles'])->name('manage-articles');
        Route::get('/edit-article/{slug}', [App\Http\Controllers\BlogController::class, 'showEditArticle'])->name('edit-article');
        Route::post('/save-article-changes', [App\Http\Controllers\BlogController::class, 'editArticle'])->name('save-article-changes');
        Route::post('/delete-article', [App\Http\Controllers\BlogController::class, 'deleteArticle'])->name('delete-article');
        Route::get('/read-article/{slug}', [App\Http\Controllers\BlogController::class, 'readArticle'])->name('read-article');
        Route::post('/action-article-comment', [App\Http\Controllers\BlogController::class, 'actionArticleComment'])->name('action-article-comment');


        Route::get('/add-slider', [App\Http\Controllers\CloudStorageController::class, 'showAddNewSlider'])->name('add-new-slider');
        Route::post('/add-slider', [App\Http\Controllers\CloudStorageController::class, 'storeSlider']);
        Route::get('/sliders', [App\Http\Controllers\CloudStorageController::class, 'showSliders'])->name('show-sliders');
        Route::post('/edit-slide', [App\Http\Controllers\CloudStorageController::class, 'editSlider'])->name('edit-slide');


        Route::get('/app-modules', [App\Http\Controllers\Admin\AccessControl::class, 'showModules'])->name('show-app-modules');
        Route::post('/app-modules', [App\Http\Controllers\Admin\AccessControl::class, 'storeModule']);
        Route::post('/edit-app-modules', [App\Http\Controllers\Admin\AccessControl::class, 'editModule'])->name('edit-app-module');

        Route::get('/app-permissions', [App\Http\Controllers\Admin\AccessControl::class, 'showPermissions'])->name('show-app-permissions');
        Route::post('/app-permissions', [App\Http\Controllers\Admin\AccessControl::class, 'storePermission']);
        Route::post('/edit-app-permissions', [App\Http\Controllers\Admin\AccessControl::class, 'editPermission'])->name('edit-app-permission');
    });

});
