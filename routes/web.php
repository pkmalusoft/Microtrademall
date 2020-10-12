<?php



use Illuminate\Support\Facades\Route;



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



Route::get('/', 'FrontController@welcome')->name('frontInvestor');

 

Route::get('/investors', 'FrontController@frontInvestor')->name('frontInvestor');



Route::Post('/investees', 'FrontController@filteredInvesteesOrLoan')->name('filterInvestee');

Route::Post('/loanseekers', 'FrontController@filteredInvesteesOrLoan')->name('filterLoanSeeker');

Route::Post('/franchisers', 'FrontController@filteredInvesteesOrLoan')->name('filterFranchisers');

Route::Post('/franchisee-seeker', 'FrontController@filteredInvesteesOrLoan')->name('filterFranchisee.seeker');

Route::get('/investees', 'FrontController@frontInvestee')->name('frontInvestee');

Route::get('/loan-providers', 'FrontController@loanProviders')->name('loanProviders');

Route::get('/reregister', 'FrontController@reregister')->name('reregister');





Route::get('/pricing', 'FrontController@frontPricing')->name('frontPricing');



Route::get('/contact', 'FrontController@contact')->name('contact');
Route::post('/contact', 'FrontController@contactForm')->name('contactForm');

Route::get('/terms-conditions', 'FrontController@terms');

Route::get('/about-us', 'FrontController@about');

Route::get('/serviceproviders', 'FrontController@frontServiceAll')->name('all.Service');
Route::Post('/serviceproviders', 'FrontController@allFilteredServices')->name('all.Service.Filter');



Route::get('/service/{service}', 'FrontController@frontService')->name('singleService');

Route::Post('/service/{service}', 'FrontController@filteredServices')->name('filterService');

Route::Post('/investors', 'FrontController@filteredInvestors')->name('filterInvestor');

Route::Post('/', 'FrontController@homeSearchbar');

//blog
Route::get('/blog/{id}', 'FrontController@blogSingle')->name('blog');

//  Franchiser 

Route::get('/franchisers', 'FrontController@franchiser')->name('all.franchisers');

Route::get('/franchisee-seeker', 'FrontController@franchiseeSeeker')->name('all.franchiseeSeeker');

// Route::get('/test', 'FrontController@ttt');



//  LoanSeeker

Route::get('/loanseekers', 'FrontController@loanSeeker')->name('all.loanSeekers');

Route::get('/profile/{id}', 'FrontController@profile')->name('all.profile');

Route::post('/profile/{id}', 'WishlistController@store')->name('all.saveProfile');

Route::put('/profile/{id}', 'WishlistController@destroy')->name('all.removeProfile');





Auth::routes();

 

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::post('/user-verification', 'HomeController@userVerify')->name('verifyManualUser');

Route::get('/home', 'HomeController@index');

Route::get('/otp', 'HomeController@otp')->name('ddq');







// PAYMENT ROUTES



Route::group(['middleware' => ['nonAdminCheck','verifiedUserCheck'] ], function () {

    Route::get('/buy-plan/{plan}', 'PaymentController@buyPlan')->name('buyPlan');

    Route::get('/free-plan/{plan}', 'PaymentController@freePlan')->name('freePlan');

    Route::post('/buy-plan/', 'PaymentController@proceedPayment')->name('proceedPayment');

    Route::get('/activeplan', 'HomeController@activeplan');

    Route::get('/wishlist', 'HomeController@wishlist');

    Route::get('/invitation/{id}', 'ChatController@invitation')->name('chatinvite');


    // CHAT ROUTES
    Route::get('/chats', 'ChatController@index')->name('chats');
    // Route::get('/messages', 'ChatController@fetchAllMessages');
    Route::get('/messages/{id}', 'ChatController@fetchChat');
    Route::get('/contacts', 'ChatController@fetchAllContacts');
    Route::post('/messages', 'ChatController@sendMessage');
    Route::get('/read/{id}', 'ChatController@updateMsgStatus');
    Route::get('/delete/{id}', 'ChatController@deleteChat');

    // Route::get('/test', 'ChatController@fetchAllContacts');
    // Route::get('/fetch/{id}', 'ChatController@fetchChat');
});





Route::group(['middleware' => ['editorCheck'] ], function () {
    Route::get('/hello', function(){
        dd('s');
    });
    Route::get('/users', 'adminController@listusers');
    Route::get('/addusers', 'adminController@addusers');
    Route::post('/addusers', 'adminController@createuser')->name('createuser');
});






Route::group(['middleware' => ['adminCheck'] ], function () {

    // Route::get('/users', 'adminController@listusers');

    // Route::get('/addusers', 'adminController@addusers');

    // Route::post('/addusers', 'adminController@createuser')->name('createuser');

    Route::get('admin/terms', 'adminController@terms');

    Route::post('admin/terms', 'adminController@saveTerms');



    Route::group([

        'prefix' => 'roles',

    ], function () {

        Route::get('/', 'RolesController@index')

             ->name('roles.role.index');

        Route::get('/create','RolesController@create')

             ->name('roles.role.create');

        Route::get('/show/{role}','RolesController@show')

             ->name('roles.role.show')->where('id', '[0-9]+');

        Route::get('/{role}/edit','RolesController@edit')

             ->name('roles.role.edit')->where('id', '[0-9]+');

        Route::post('/', 'RolesController@store')

             ->name('roles.role.store');

        Route::put('role/{role}', 'RolesController@update')

             ->name('roles.role.update')->where('id', '[0-9]+');

        Route::delete('/role/{role}','RolesController@destroy')

             ->name('roles.role.destroy')->where('id', '[0-9]+');

    });

    Route::group([

        'prefix' => 'plans',

    ], function () {

        Route::get('/', 'PlansController@index')

             ->name('plans.plan.index');

        Route::get('/create','PlansController@create')

             ->name('plans.plan.create');

        Route::get('/show/{plan}','PlansController@show')

             ->name('plans.plan.show')->where('id', '[0-9]+');

        Route::get('/{plan}/edit','PlansController@edit')

             ->name('plans.plan.edit')->where('id', '[0-9]+');

        Route::post('/', 'PlansController@store')

             ->name('plans.plan.store');

        Route::put('plan/{plan}', 'PlansController@update')

             ->name('plans.plan.update')->where('id', '[0-9]+');

        Route::delete('/plan/{plan}','PlansController@destroy')

             ->name('plans.plan.destroy')->where('id', '[0-9]+');

    });


    Route::group([
    'prefix' => 'admin/blogs',
        ], function () {
            Route::get('/', 'BlogsController@index')
                 ->name('blogs.blog.index');
            Route::get('/create','BlogsController@create')
                 ->name('blogs.blog.create');
            Route::get('/show/{blog}','BlogsController@show')
                 ->name('blogs.blog.show')->where('id', '[0-9]+');
            Route::get('/{blog}/edit','BlogsController@edit')
                 ->name('blogs.blog.edit')->where('id', '[0-9]+');
            Route::post('/', 'BlogsController@store')
                 ->name('blogs.blog.store');
            Route::put('blog/{blog}', 'BlogsController@update')
                 ->name('blogs.blog.update')->where('id', '[0-9]+');
            Route::delete('/blog/{blog}','BlogsController@destroy')
                 ->name('blogs.blog.destroy')->where('id', '[0-9]+');
        });




    Route::group([

        'prefix' => 'admin/services',

    ], function () {

        Route::get('/', 'ServicesController@index')

             ->name('services.service.index');

        Route::get('/create','ServicesController@create')

             ->name('services.service.create');

        Route::get('/show/{service}','ServicesController@show')

             ->name('services.service.show')->where('id', '[0-9]+');

        Route::get('/{service}/edit','ServicesController@edit')

             ->name('services.service.edit')->where('id', '[0-9]+');

        Route::post('/', 'ServicesController@store')

             ->name('services.service.store');

        Route::put('service/{service}', 'ServicesController@update')

             ->name('services.service.update')->where('id', '[0-9]+');

        Route::delete('/service/{service}','ServicesController@destroy')

             ->name('services.service.destroy')->where('id', '[0-9]+');

    });

    

});



//USER ROUTES

Route::group([ 'prefix' => 'user',

'middleware' => ['userCheck','verifiedUserCheck'] ], function () {

    Route::get('/edit-profile', 'UserController@editProfile')->name('user.editprofile');

    Route::post('/edit-profile', 'UserController@updateProfile')->name('user.updateprofile');

    // Route::get('/activeplan', 'HomeController@activeplan');

});



Route::group(['prefix' => 'investor','middleware' => ['investorCheck','verifiedUserCheck'] ], function () {

    Route::get('/edit-profile', 'InvestorController@editProfile')->name('investor.editprofile');

    Route::post('/edit-profile', 'InvestorController@updateProfile')->name('investor.updateprofile');

    // Route::get('/activeplan', 'HomeController@activeplan');

});



Route::group(['prefix' => 'serviceprovider','middleware' => ['serviceProviderCheck','verifiedUserCheck'] ], function () {

    Route::get('/edit-profile', 'ServiceProviderController@editProfile')->name('serviceprovider.editprofile');

    Route::post('/edit-profile', 'ServiceProviderController@updateProfile')->name('serviceprovider.updateprofile');

    Route::get('/activeplan', 'HomeController@activeplan');

});




//google login

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('/social/verify', 'FrontController@socialverify');
Route::post('/social/register', 'FrontController@socialregister')->name('social.register');

//facebook

Route::get('/facebook/redirect', 'SocialAuthController@redirect');
Route::get('/facebook/callback', 'SocialAuthController@callback');

//support
Route::get('/support', function(){
    return view('front.support');
})->name('support');
















