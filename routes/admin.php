<?php

use App\Http\Controllers\About_settingController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\About_settingController as AdminAbout_settingController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AffgalleryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BottomBannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategorygalleryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\InformationflightController;
use App\Http\Controllers\Admin\InformationhotelController;
use App\Http\Controllers\Admin\InformationtourController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderRateController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageRequestController;
use App\Http\Controllers\Admin\PlacecatController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\ProviderServiceController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceSubCategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserPackageController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\BrancheController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\CategorycolidController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\InformationuserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PaintscategoryController;
use App\Http\Controllers\Admin\PaymentpictureController;
use App\Http\Controllers\Admin\PointssettingController;
use App\Http\Controllers\Admin\PrivacypolicyController;
use App\Http\Controllers\Admin\ProductcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProgrammeBookingsController;
use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\ProgrammeRateController;
use App\Http\Controllers\Admin\TermsandconditionController;
use App\Http\Controllers\Admin\TourTypeController;
use App\Http\Controllers\Admin\VoucherspageController;
use App\Models\About_setting;
use App\Models\ProgrammeBooking;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

Route::group([
//    'prefix' => LaravelLocalization::setLocale().'/admin/',
    'middleware' => [
       'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',
        'AdminCheck',
    ],'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {

//    /****************************** Assets **********************************/
//    Route::post('get-sub-categories-from-category', [CategoryController::class, 'getSubsFromMain'])->name('getSubCategoriesFromCategory');
//    Route::post('get-group-fields', [GroupController::class, 'getGroupFields'])->name('getGroupFields');

    /****************************** Dashboard **********************************/
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    /************************************ Roles & Permissions ************************************************/
//    permission:roles.permissions.control
    /****************************** Roles **********************************/
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::get('/table/show', [RoleController::class, 'table'])->name('role.table');
    });

    Route::get('/addPermissionsToRole/{role}', [RoleController::class, 'assignPermissionsPage'])->name('role.addPermissionsToRole');
    Route::post('/role/{role}/permissions', [RoleController::class, 'givePermissions'])->name('role.permissions');

    /****************************** Admins **********************************/
   Route::group(['prefix' => 'admin'], function () {
       Route::get('/', [AdminController::class, 'index'])->name('admin.index');
       Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
       Route::post('/', [AdminController::class, 'store'])->name('admin.store');
       Route::get('/{admin}', [AdminController::class, 'show'])->name('admin.show');
       Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
       Route::put('/{admin}', [AdminController::class, 'update'])->name('admin.update');
       Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
       Route::get('/table/show', [AdminController::class, 'table'])->name('admin.table');
   });



    /****************************** Users **********************************/
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UsersController@index')->name('site.home')->middleware('permission:Users List');
        Route::get('/create', 'UsersController@create')->name('user.create')->middleware('permission:Users Create');
        Route::post('/', 'UsersController@store')->name('user.store')->middleware('permission:Users Create');
        Route::get('/{user}', 'UsersController@show')->name('user.show')->middleware('permission:Users Show');
        Route::get('/{user}/edit', 'UsersController@edit')->name('user.edit')->middleware('permission:Users Edit');
        Route::put('/{user}', 'UsersController@update')->name('user.update')->middleware('permission:Users Edit');
        Route::delete('/{user}', 'UsersController@destroy')->name('user.destroy')->middleware('permission:Users Delete');
    });



            /****************************** Clients **********************************/
                Route::group(['prefix' => 'client'], function () {
                Route::get('/', [ClientController::class, 'index'])->name('client.index');
                Route::get('/create', [ClientController::class, 'create'])->name('client.create');
                Route::post('/', [ClientController::class, 'store'])->name('client.store');
                // مسار الحظر
                Route::post('/ban', [ClientController::class, 'ban'])->name('client.ban');
                Route::get('/{client}', [ClientController::class, 'show'])->name('client.show');
                // Route::get('/{client}/create', [ClientController::class, 'createpoints'])->name('client.create.points');
                Route::get('/{client}/create', [ClientController::class, 'createpoints'])->name('client.create.points');
                Route::post('/{client}/store-points', [ClientController::class, 'storePoints'])->name('client.store.points');
                Route::post('/admin/client/toggle-active-status', [ClientController::class, 'toggleActiveStatus'])->name('client.toggleActiveStatus');
                Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('client.edit');
                Route::put('/{client}', [ClientController::class, 'update'])->name('client.update');
                Route::delete('/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
                Route::get('/table/show', [ClientController::class, 'table'])->name('client.table');
                Route::post('/change-active/{client}', [ClientController::class, 'changeActive'])->name('client.changeActive');
                Route::post('/change-verify/{client}', [ClientController::class, 'changeVerify'])->name('client.changeVerify');
                Route::get('/get-regions/{city}', [ClientController::class, 'getRegions'])->name('get-regions');
            });




    /****************************** Service **********************************/
    Route::group(['prefix' => 'service'], function () {
        Route::get('/', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/{service}', [ServiceController::class, 'show'])->name('service.show');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
        Route::put('/{service}', [ServiceController::class, 'update'])->name('service.update');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
        Route::get('/reorder/service', [ServiceController::class, 'reorder'])->name('service.reorder');
        Route::post('/reorder/save', [ServiceController::class, 'saveReorder'])->name('service.reorder.save');
        Route::get('/table/show', [ServiceController::class, 'table'])->name('service.table');
        Route::post('/change-pay-cash-status/{service}', [ServiceController::class, 'changePayCashStatus'])->name('service.changePayCashStatus');
        Route::post('/change-pay-card-status/{service}', [ServiceController::class, 'changePayCardStatus'])->name('service.changePayCardStatus');

    });

    /****************************** Category **********************************/
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/reorder/category', [CategoryController::class, 'reorder'])->name('category.reorder');
        Route::post('/reorder/save', [CategoryController::class, 'saveReorder'])->name('category.reorder.save');
        Route::get('/table/show', [CategoryController::class, 'table'])->name('category.table');
    });


    /****************************** blog **********************************/
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/{blog}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('/reorder/blog', [BlogController::class, 'reorder'])->name('blog.reorder');
        Route::post('/reorder/save', [BlogController::class, 'saveReorder'])->name('blog.reorder.save');
        Route::get('/table/show', [BlogController::class, 'table'])->name('blog.table');
    });


            Route::group(['prefix' => 'client'], function () {
                Route::get('/', [ClientController::class, 'index'])->name('client.index');
                Route::get('/create', [ClientController::class, 'create'])->name('client.create');
                Route::post('/', [ClientController::class, 'store'])->name('client.store');

                // Route لعرض تفاصيل العميل
                Route::get('/{client}', [ClientController::class, 'show'])->name('client.show');

                // Route لعرض سجل النقاط الخاصة بالعميل
                Route::get('/client/{client}/points', [ClientController::class, 'showPoints'])->name('client.showpoints');

                Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('client.edit');
                Route::put('/{client}', [ClientController::class, 'update'])->name('client.update');
                Route::delete('/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
                Route::get('/reorder/client', [ClientController::class, 'reorder'])->name('client.reorder');
                Route::post('/reorder/save', [ClientController::class, 'saveReorder'])->name('client.reorder.save');
                Route::get('/table/show', [ClientController::class, 'table'])->name('client.table');
            });

            /****************************** product  المنتجات **********************************/
            Route::group(['prefix' => 'product'], function () {
                Route::get('/', [ProductController::class, 'index'])->name('product.index');
                Route::get('/create', [ProductController::class, 'create'])->name('product.create');
                Route::post('/', [ProductController::class, 'store'])->name('product.store');
                Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
                Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
                Route::put('/{product}', [ProductController::class, 'update'])->name('product.update');
                Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
                Route::get('/reorder/product', [ProductController::class, 'reorder'])->name('product.reorder');
                Route::post('/reorder/save', [ProductController::class, 'saveReorder'])->name('product.reorder.save');
                Route::get('/table/show', [ProductController::class, 'table'])->name('product.table');
                Route::delete('/product/media/{id}', [ProductController::class, 'deleteMedia'])->name('product.media.delete');
            });

                        /****************************** product category  اقسام المنتجات **********************************/
            Route::group(['prefix' => 'productcategory'], function () {
                Route::get('/', [ProductcategoryController::class, 'index'])->name('productcategory.index');
                Route::get('/create', [ProductcategoryController::class, 'create'])->name('productcategory.create');
                Route::post('/', [ProductcategoryController::class, 'store'])->name('productcategory.store');
                Route::get('/{productcategory}', [ProductcategoryController::class, 'show'])->name('productcategory.show');
                Route::get('/{productcategory}/edit', [ProductcategoryController::class, 'edit'])->name('productcategory.edit');
                Route::put('/{productcategory}', [ProductcategoryController::class, 'update'])->name('productcategory.update');
                Route::delete('/{productcategory}', [ProductcategoryController::class, 'destroy'])->name('productcategory.destroy');
                Route::get('/reorder/productcategory', [ProductcategoryController::class, 'reorder'])->name('productcategory.reorder');
                Route::post('/reorder/save', [ProductcategoryController::class, 'saveReorder'])->name('productcategory.reorder.save');
                Route::get('/table/show', [ProductcategoryController::class, 'table'])->name('productcategory.table');
            });



            /****************************** shop  متجر **********************************/
            Route::group(['prefix' => 'shop'], function () {
                Route::get('/', [BlogController::class, 'index'])->name('shop.index');
                Route::get('/create', [BlogController::class, 'create'])->name('shop.create');
                Route::post('/', [BlogController::class, 'store'])->name('shop.store');
                Route::get('/{shop}', [BlogController::class, 'show'])->name('shop.show');
                Route::get('/{shop}/edit', [BlogController::class, 'edit'])->name('shop.edit');
                Route::put('/{shop}', [BlogController::class, 'update'])->name('shop.update');
                Route::delete('/{shop}', [BlogController::class, 'destroy'])->name('shop.destroy');
                Route::get('/reorder/shop', [BlogController::class, 'reorder'])->name('shop.reorder');
                Route::post('/reorder/save', [BlogController::class, 'saveReorder'])->name('shop.reorder.save');
                Route::get('/table/show', [BlogController::class, 'table'])->name('shop.table');
            });


            /****************************** banner  البانر **********************************/
            Route::group(['prefix' => 'banner'], function () {
                Route::get('/', [BlogController::class,'index'])->name('banner.index');
                Route::get('/create', [BlogController::class, 'create'])->name('banner.create');
                Route::post('/', [BlogController::class, 'store'])->name('banner.store');
                Route::get('/{banner}', [BlogController::class, 'show'])->name('banner.show');
                Route::get('/{banner}/edit', [BlogController::class, 'edit'])->name('banner.edit');
                Route::put('/{banner}', [BlogController::class, 'update'])->name('banner.update');
                Route::delete('/{banner}', [BlogController::class, 'destroy'])->name('banner.destroy');
                Route::get('/reorder/banner', [BlogController::class, 'reorder'])->name('banner.reorder');
                Route::post('/reorder/save', [BlogController::class, 'saveReorder'])->name('banner.reorder.save');
                Route::get('/table/show', [BlogController::class, 'table'])->name('banner.table');
            });





    /****************************** testimonial **********************************/
    Route::group(['prefix' => 'testimonial'], function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
        Route::post('/', [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::get('/{testimonial}', [TestimonialController::class, 'show'])->name('testimonial.show');
        Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('testimonial.update');
        Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
        Route::get('/reorder/testimonial', [TestimonialController::class, 'reorder'])->name('testimonial.reorder');
        Route::post('/reorder/save', [TestimonialController::class, 'saveReorder'])->name('testimonial.reorder.save');
        Route::get('/table/show', [TestimonialController::class, 'table'])->name('testimonial.table');
    });


            /****************************** privacypolicy **********************************/
    Route::group(['prefix' => 'privacypolicy'], function () {
        Route::get('/', [PrivacypolicyController::class, 'index'])->name('privacypolicy.index');
        Route::get('/create', [PrivacypolicyController::class, 'create'])->name('privacypolicy.create');
        Route::post('/', [PrivacypolicyController::class, 'store'])->name('privacypolicy.store');
        Route::get('/{privacypolicy}', [PrivacypolicyController::class, 'show'])->name('privacypolicy.show');
        Route::get('/{privacypolicy}/edit', [PrivacypolicyController::class, 'edit'])->name('privacypolicy.edit');
        Route::put('/{privacypolicy}', [PrivacypolicyController::class, 'update'])->name('privacypolicy.update');
        Route::delete('/{privacypolicy}', [PrivacypolicyController::class, 'destroy'])->name('privacypolicy.destroy');
        Route::get('/reorder/privacypolicy', [PrivacypolicyController::class, 'reorder'])->name('privacypolicy.reorder');
        Route::post('/reorder/save', [PrivacypolicyController::class, 'saveReorder'])->name('privacypolicy.reorder.save');
        Route::get('/table/show', [PrivacypolicyController::class, 'table'])->name('privacypolicy.table');
    });

            /******************************termsandcondition **********************************/
            Route::group(['prefix' => 'termsandcondition'], function () {
                Route::get('/', [TermsandconditionController::class, 'index'])->name('termsandcondition.index');
                Route::get('/create', [TermsandconditionController::class, 'create'])->name('termsandcondition.create');
                Route::post('/', [TermsandconditionController::class, 'store'])->name('termsandcondition.store');
                Route::get('/{termsandcondition}', [TermsandconditionController::class, 'show'])->name('termsandcondition.show');
                Route::get('/{termsandcondition}/edit', [TermsandconditionController::class, 'edit'])->name('termsandcondition.edit');
                Route::put('/{termsandcondition}', [TermsandconditionController::class, 'update'])->name('termsandcondition.update');
                Route::delete('/{termsandcondition}', [TermsandconditionController::class, 'destroy'])->name('termsandcondition.destroy');
                Route::get('/reorder/termsandcondition', [TermsandconditionController::class, 'reorder'])->name('termsandcondition.reorder');
                Route::post('/reorder/save', [TermsandconditionController::class, 'saveReorder'])->name('termsandcondition.reorder.save');
                Route::get('/table/show', [TermsandconditionController::class, 'table'])->name('termsandcondition.table');
            });
         /****************************** card **********************************/
    Route::group(['prefix' => 'card'], function () {
        Route::get('/', [CardController::class, 'index'])->name('card.index');
        Route::get('/create', [CardController::class, 'create'])->name('card.create');
        Route::post('/', [CardController::class, 'store'])->name('card.store');
        Route::get('/{card}', [CardController::class, 'show'])->name('card.show');
        Route::get('/{card}/edit', [CardController::class, 'edit'])->name('card.edit');
        Route::put('/{card}', [CardController::class, 'update'])->name('card.update');
        Route::delete('/{card}', [CardController::class, 'destroy'])->name('card.destroy');
        Route::get('/reorder/card', [CardController::class, 'reorder'])->name('card.reorder');
        Route::post('/reorder/save', [CardController::class, 'saveReorder'])->name('card.reorder.save');
        Route::get('/table/show', [CardController::class, 'table'])->name('card.table');

         Route::get('/get-categorycolid/{categoryId}', [CardController::class, 'getCategoryColid'])->name('get.categorycolid');

    });

            /****************************** news **********************************/
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/', [NewsController::class, 'store'])->name('news.store');
        Route::get('/{news}', [NewsController::class, 'show'])->name('news.show');
        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::get('/reorder/news', [NewsController::class, 'reorder'])->name('news.reorder');
        Route::post('/reorder/save', [NewsController::class, 'saveReorder'])->name('news.reorder.save');
        Route::get('/table/show', [NewsController::class, 'table'])->name('news.table');
    });


    /****************************** about **********************************/
    Route::group(['prefix' => 'about'], function () {
        Route::get('/', [AboutController::class, 'index'])->name('about.index');
        Route::get('/create', [AboutController::class, 'create'])->name('about.create');
        Route::post('/', [AboutController::class, 'store'])->name('about.store');
        Route::get('/{about}', [AboutController::class, 'show'])->name('about.show');
        Route::get('/{about}/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('/{about}', [AboutController::class, 'update'])->name('about.update');
        Route::delete('/{about}', [AboutController::class, 'destroy'])->name('about.destroy');
        Route::get('/reorder/about', [AboutController::class, 'reorder'])->name('about.reorder');
        Route::post('/reorder/save', [AboutController::class, 'saveReorder'])->name('about.reorder.save');
        Route::get('/table/show', [AboutController::class, 'table'])->name('about.table');
    });

    /****************************** contact **********************************/
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/create', [ContactController::class, 'create'])->name('contact.create');
        Route::post('/', [ContactController::class, 'store'])->name('contact.store');
        Route::get('/{contact}', [ContactController::class, 'show'])->name('contact.show');
        Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
        Route::get('/reorder/contact', [ContactController::class, 'reorder'])->name('contact.reorder');
        Route::post('/reorder/save', [ContactController::class, 'saveReorder'])->name('contact.reorder.save');
        Route::get('/table/show', [ContactController::class, 'table'])->name('contact.table');
    });


    /****************************** Message **********************************/
    Route::group(['prefix' => 'message'], function () {
        Route::get('/', [MessageController::class, 'index'])->name('message.index');
        Route::get('/{message}', [MessageController::class, 'show'])->name('message.show');
        Route::delete('/{message}', [MessageController::class, 'destroy'])->name('message.destroy');
        Route::get('/table/show', [MessageController::class, 'table'])->name('message.table');
    });


    /****************************** Place **********************************/
    // Route::group(['prefix' => 'place'], function () {
    //     Route::get('/', [PlaceController::class, 'index'])->name('place.index');
    //     Route::get('/create', [PlaceController::class, 'create'])->name('place.create');
    //     Route::post('/', [PlaceController::class, 'store'])->name('place.store');
    //     Route::get('/{place}', [PlaceController::class, 'show'])->name('place.show');
    //     Route::get('/{place}/edit', [PlaceController::class, 'edit'])->name('place.edit');
    //     Route::put('/{place}', [PlaceController::class, 'update'])->name('place.update');
    //     Route::delete('/{place}', [PlaceController::class, 'destroy'])->name('place.destroy');
    //     Route::get('/reorder/place', [PlaceController::class, 'reorder'])->name('place.reorder');
    //     Route::post('/reorder/save', [PlaceController::class, 'saveReorder'])->name('place.reorder.save');
    //     Route::get('/table/show', [PlaceController::class, 'table'])->name('place.table');
    // });
    //         Route::group(['prefix' => 'placecat'], function () {
    //             Route::get('/', [PlacecatController::class, 'index'])->name('placecat.index');
    //             Route::get('/create', [PlacecatController::class, 'create'])->name('placecat.create');
    //             Route::post('/', [PlacecatController::class, 'store'])->name('placecat.store');
    //             Route::get('/{placecat}', [PlacecatController::class, 'show'])->name('placecat.show');
    //             Route::get('/{placecat}/edit', [PlacecatController::class, 'edit'])->name('placecat.edit');
    //             Route::put('/{placecat}', [PlacecatController::class, 'update'])->name('placecat.update');
    //             Route::delete('/{placecat}', [PlacecatController::class, 'destroy'])->name('placecat.destroy');
    //             Route::get('/reorder/placecat', [PlacecatController::class, 'reorder'])->name('placecat.reorder');
    //             Route::post('/reorder/save', [PlacecatController::class, 'saveReorder'])->name('placecat.reorder.save');
    //             Route::get('/table/show', [PlacecatController::class, 'table'])->name('placecat.table');

    // });
    /****************************** Package **********************************/
    Route::group(['prefix' => 'package'], function () {
        Route::get('/', [PackageController::class, 'index'])->name('package.index');
        Route::get('/create', [PackageController::class, 'create'])->name('package.create');
        Route::post('/', [PackageController::class, 'store'])->name('package.store');
        Route::get('/{package}', [PackageController::class, 'show'])->name('package.show');
        Route::get('/{package}/edit', [PackageController::class, 'edit'])->name('package.edit');
        Route::put('/{package}', [PackageController::class, 'update'])->name('package.update');
        Route::delete('/{package}', [PackageController::class, 'destroy'])->name('package.destroy');
        Route::get('/reorder/package', [PackageController::class, 'reorder'])->name('package.reorder');
        Route::post('/reorder/save', [PackageController::class, 'saveReorder'])->name('package.reorder.save');
        Route::get('/table/show', [PackageController::class, 'table'])->name('package.table');
        Route::post('/change-status/{package}', [PackageController::class, 'changeStatus'])->name('package.changeStatus');

    });
    /****************************** package_request **********************************/
    Route::group(['prefix' => 'package_request'], function () {
        Route::get('/', [PackageRequestController::class, 'index'])->name('package_request.index');
        Route::get('/{package_request}', [PackageRequestController::class, 'show'])->name('package_request.show');
        Route::get('/table/show', [PackageRequestController::class, 'table'])->name('package_request.table');
        Route::post('/change-status/{package_request}', [PackageRequestController::class, 'changeStatus'])->name('package_request.changeStatus');
    });
    /****************************** user_package **********************************/
    Route::group(['prefix' => 'user_package'], function () {
        Route::get('/', [UserPackageController::class, 'index'])->name('user_package.index');
        Route::get('/table/show', [UserPackageController::class, 'table'])->name('user_package.table');

    });
    /****************************** Document **********************************/
    Route::group(['prefix' => 'document'], function () {
        Route::get('/', [DocumentController::class, 'index'])->name('document.index');
        Route::get('/create', [DocumentController::class, 'create'])->name('document.create');
        Route::post('/', [DocumentController::class, 'store'])->name('document.store');
        Route::get('/{document}', [DocumentController::class, 'show'])->name('document.show');
        Route::get('/{document}/edit', [DocumentController::class, 'edit'])->name('document.edit');
        Route::put('/{document}', [DocumentController::class, 'update'])->name('document.update');
        Route::delete('/{document}', [DocumentController::class, 'destroy'])->name('document.destroy');
        Route::get('/reorder/document', [DocumentController::class, 'reorder'])->name('document.reorder');
        Route::post('/reorder/save', [DocumentController::class, 'saveReorder'])->name('document.reorder.save');
        Route::get('/table/show', [DocumentController::class, 'table'])->name('document.table');
        Route::post('/change-status/{document}', [DocumentController::class, 'changeStatus'])->name('document.changeStatus');
        Route::post('/change-required-status/{document}', [DocumentController::class, 'changeRequiredStatus'])->name('document.changeRequiredStatus');

    });

    /****************************** Country **********************************/
    Route::group(['prefix' => 'country'], function () {
        Route::get('/', [CountryController::class, 'index'])->name('country.index');
        Route::get('/create', [CountryController::class, 'create'])->name('country.create');
        Route::post('/', [CountryController::class, 'store'])->name('country.store');
        Route::get('/{country}', [CountryController::class, 'show'])->name('country.show');
        Route::get('/{country}/edit', [CountryController::class, 'edit'])->name('country.edit');
        Route::put('/{country}', [CountryController::class, 'update'])->name('country.update');
        Route::delete('/{country}', [CountryController::class, 'destroy'])->name('country.destroy');
        Route::get('/reorder/country', [CountryController::class, 'reorder'])->name('country.reorder');
        Route::post('/reorder/save', [CountryController::class, 'saveReorder'])->name('country.reorder.save');
        Route::get('/table/show', [CountryController::class, 'table'])->name('country.table');
    });
    /****************************** City **********************************/
    Route::group(['prefix' => 'city'], function () {
        Route::get('/', [CityController::class, 'index'])->name('city.index');
        Route::get('/getCityByCountry/{country}', [CityController::class, 'getCityByCountry']);
         Route::get('/getRegionsByCity/{city}', [CityController::class, 'getRegionsByCity']);
        Route::get('/create', [CityController::class, 'create'])->name('city.create');
        Route::post('/', [CityController::class, 'store'])->name('city.store');
        Route::get('/{city}', [CityController::class, 'show'])->name('city.show');
        Route::get('/{city}/edit', [CityController::class, 'edit'])->name('city.edit');
        Route::put('/{city}', [CityController::class, 'update'])->name('city.update');
        Route::delete('/{city}', [CityController::class, 'destroy'])->name('city.destroy');
        Route::get('/reorder/city', [CityController::class, 'reorder'])->name('city.reorder');
        Route::post('/reorder/save', [CityController::class, 'saveReorder'])->name('city.reorder.save');
        Route::get('/table/show', [CityController::class, 'table'])->name('city.table');



    });

    /****************************** Region **********************************/
    Route::group(['prefix' => 'region'], function () {
        Route::get('/', [RegionController::class, 'index'])->name('region.index');
        Route::get('/create', [RegionController::class, 'create'])->name('region.create');
        Route::post('/', [RegionController::class, 'store'])->name('region.store');
        Route::get('/{region}', [RegionController::class, 'show'])->name('region.show');
        Route::get('/{region}/edit', [RegionController::class, 'edit'])->name('region.edit');
        Route::put('/{region}', [RegionController::class, 'update'])->name('region.update');
        Route::delete('/{region}', [RegionController::class, 'destroy'])->name('region.destroy');
        Route::get('/reorder/region', [RegionController::class, 'reorder'])->name('region.reorder');
        Route::post('/reorder/save', [RegionController::class, 'saveReorder'])->name('region.reorder.save');
        Route::get('/table/show', [RegionController::class, 'table'])->name('region.table');

    });

            /****************************** information_flight **********************************/
    Route::group(['prefix' => 'informationflight'], function () {
        Route::get('/', [InformationflightController::class, 'index'])->name('informationflight.index');
        Route::get('/create', [InformationflightController::class, 'create'])->name('informationflight.create');
        Route::post('/', [InformationflightController::class, 'store'])->name('informationflight.store');
        Route::get('/{informationflight}', [InformationflightController::class, 'show'])->name('informationflight.show');
        Route::get('/{informationflight}/edit', [InformationflightController::class, 'edit'])->name('informationflight.edit');
        Route::put('/{informationflight}', [InformationflightController::class, 'update'])->name('informationflight.update');
        Route::delete('/{informationflight}', [InformationflightController::class, 'destroy'])->name('informationflight.destroy');
        Route::get('/reorder/informationflight', [InformationflightController::class, 'reorder'])->name('informationflight.reorder');
        Route::post('/reorder/save', [InformationflightController::class, 'saveReorder'])->name('informationflight.reorder.save');
        Route::get('/table/show', [InformationflightController::class, 'table'])->name('informationflight.table');
    });
            /****************************** information_hotel **********************************/
    Route::group(['prefix' => 'informationhotel'], function () {
        Route::get('/', [InformationhotelController::class, 'index'])->name('informationhotel.index');
        Route::get('/create', [InformationhotelController::class, 'create'])->name('informationhotel.create');
        Route::post('/', [InformationhotelController::class, 'store'])->name('informationhotel.store');
        Route::get('/{informationhotel}', [InformationhotelController::class, 'show'])->name('informationhotel.show');
        Route::get('/{informationhotel}/edit', [InformationhotelController::class, 'edit'])->name('informationhotel.edit');
        Route::put('/{informationhotel}', [InformationhotelController::class, 'update'])->name('informationhotel.update');
        Route::delete('/{informationhotel}', [InformationhotelController::class, 'destroy'])->name('informationhotel.destroy');
        Route::get('/reorder/informationhotel', [InformationhotelController::class, 'reorder'])->name('informationhotel.reorder');
        Route::post('/reorder/save', [InformationhotelController::class, 'saveReorder'])->name('informationhotel.reorder.save');
        Route::get('/table/show', [InformationhotelController::class, 'table'])->name('informationhotel.table');

    });
            /****************************** information_tour **********************************/
            Route::group(['prefix' => 'informationtour'], function () {
                Route::get('/', [InformationtourController::class, 'index'])->name('informationtour.index');
                Route::get('/create', [InformationtourController::class, 'create'])->name('informationtour.create');
                Route::post('/', [InformationtourController::class, 'store'])->name('informationtour.store');
                Route::get('/{informationtour}', [InformationtourController::class, 'show'])->name('informationtour.show');
                Route::get('/{informationtour}/edit', [InformationtourController::class, 'edit'])->name('informationtour.edit');
                Route::put('/{informationtour}', [InformationtourController::class, 'update'])->name('informationtour.update');
                Route::delete('/{informationtour}', [InformationtourController::class, 'destroy'])->name('informationtour.destroy');
                Route::get('/reorder/informationtour', [InformationtourController::class, 'reorder'])->name('informationtour.reorder');
                Route::post('/reorder/save', [InformationtourController::class, 'saveReorder'])->name('informationtour.reorder.save');
                Route::get('/table/show', [InformationtourController::class, 'table'])->name('informationtour.table');
            });



    /****************************** categorygallery **********************************/
    Route::group(['prefix' => 'categorygallery'], function () {
        Route::get('/', [categorygalleryController::class, 'index'])->name('categorygallery.index');
        Route::get('/create', [categorygalleryController::class, 'create'])->name('categorygallery.create');
        Route::post('/', [categorygalleryController::class, 'store'])->name('categorygallery.store');
        Route::get('/{categorygallery}', [categorygalleryController::class, 'show'])->name('categorygallery.show');
        Route::get('/{categorygallery}/edit', [categorygalleryController::class, 'edit'])->name('categorygallery.edit');
        Route::put('/{categorygallery}', [categorygalleryController::class, 'update'])->name('categorygallery.update');
        Route::delete('/{categorygallery}', [categorygalleryController::class, 'destroy'])->name('categorygallery.destroy');
        Route::get('/reorder/categorygallery', [categorygalleryController::class, 'reorder'])->name('categorygallery.reorder');
        Route::post('/reorder/save', [categorygalleryController::class, 'saveReorder'])->name('categorygallery.reorder.save');
        Route::get('/table/show', [CategorygalleryController::class, 'table'])->name('categorygallery.table');
    });

    /****************************** gallery **********************************/
    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/create', [galleryController::class, 'create'])->name('gallery.create');
        Route::post('/', [galleryController::class, 'store'])->name('gallery.store');
        Route::get('/{gallery}', [galleryController::class, 'show'])->name('gallery.show');
        Route::get('/{gallery}/edit', [galleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/{gallery}', [galleryController::class, 'update'])->name('gallery.update');
        Route::delete('/{gallery}', [galleryController::class, 'destroy'])->name('gallery.destroy');
        Route::get('/reorder/gallery', [galleryController::class, 'reorder'])->name('gallery.reorder');
        Route::post('/reorder/save', [galleryController::class, 'saveReorder'])->name('gallery.reorder.save');
        Route::get('/table/show', [galleryController::class, 'table'])->name('gallery.table');
    });

            /******************************   paymentpicture **********************************/
    Route::group(['prefix' => 'paymentpicture'], function () {
        Route::get('/', [PaymentpictureController::class, 'index'])->name('paymentpicture.index');
        Route::get('/create', [PaymentpictureController::class, 'create'])->name('paymentpicture.create');
        Route::post('/', [PaymentpictureController::class, 'store'])->name('paymentpicture.store');
        Route::get('/{paymentpicture}', [PaymentpictureController::class, 'show'])->name('paymentpicture.show');
        Route::get('/{paymentpicture}/edit', [PaymentpictureController::class, 'edit'])->name('paymentpicture.edit');
        Route::put('/{paymentpicture}', [PaymentpictureController::class, 'update'])->name('paymentpicture.update');
        Route::delete('/{paymentpicture}', [PaymentpictureController::class, 'destroy'])->name('paymentpicture.destroy');
        Route::get('/reorder/  paymentpicture', [PaymentpictureController::class, 'reorder'])->name('paymentpicture.reorder');
        Route::post('/reorder/save', [PaymentpictureController::class, 'saveReorder'])->name('paymentpicture.reorder.save');
        Route::get('/table/show', [PaymentpictureController::class, 'table'])->name('paymentpicture.table');
    });


                /****************************** stare programme **********************************/
                Route::prefix('programme')->name('programme.')->group(function () {
                    Route::get('/', [ProgrammeController::class, 'index'])->name('index');
                    //        Route::get('/{programme}', [ProgrammeController::class, 'show'])->name('show');
                    Route::get('/create', [ProgrammeController::class, 'create'])->name('create');
                    Route::put('/update/{programme}', [ProgrammeController::class, 'update'])->name('update');
                    Route::post('/store', [ProgrammeController::class, 'store'])->name('store');
                    Route::get('/delete/{programme}', [ProgrammeController::class, 'destroy'])->name('destroy');
                    Route::get('/{programme}/edit', [ProgrammeController::class, 'edit'])->name('edit');
                    Route::get('/update-status/{programme}', [ProgrammeController::class, 'updateStatus']);
                    Route::get('/update-is-featured/{programme}', [ProgrammeController::class, 'updateFeatured']);
                });

                Route::prefix('programme_rate')->name('programme_rate.')->group(function () {
                    Route::get('/', [ProgrammeRateController::class, 'index'])->name('index');
                    Route::post('/change-status', [ProgrammeRateController::class, 'changeStatus'])->name('change-status');
                    Route::get('/delete/{programme_rates}', [ProgrammeRateController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('bookings')->name('bookings.')->group(function () {
                Route::get('/', [BookingsController::class, 'index'])->name('index');
                Route::get('/{booking}', [BookingsController::class, 'show'])->name('show');
                Route::get('/delete/{booking}', [BookingsController::class, 'destroy'])->name('destroy');
                Route::post('/change-status', [BookingsController::class, 'changeStatus'])->name('change-status');
            });

            Route::prefix('programme_booking')->name('programme_booking.')->group(function () {
                Route::get('/', [ProgrammeBookingsController::class, 'index'])->name('index');
                Route::get('/{programmeBooking}', [ProgrammeBookingsController::class, 'show'])->name('show');
                Route::get('/delete/{programmeBooking}', [ProgrammeBookingsController::class, 'destroy'])->name('destroy');
            });


            Route::prefix('informationuser')->name('informationuser.')->group(function () {
                Route::get('/', [InformationuserController::class, 'index'])->name('index');
                Route::get('/{informationuser}', [InformationuserController::class, 'show'])->name('show');
                Route::get('/delete/{informationuser}', [InformationuserController::class, 'destroy'])->name('destroy');
            });


            Route::prefix('tour_type')->name('tour_type.')->group(function () {
                Route::get('/', [TourTypeController::class, 'index'])->name('index');
                Route::get('/create', [TourTypeController::class, 'create'])->name('create');
                Route::put('/update/{tour_type}', [TourTypeController::class, 'update'])->name('update');
                Route::post('/store', [TourTypeController::class, 'store'])->name('store');
                Route::get('/delete/{tour_type}', [TourTypeController::class, 'destroy'])->name('destroy');
                Route::get('/{tour_type}/edit', [TourTypeController::class, 'edit'])->name('edit');
            });



    Route::prefix('regions')->name('regions.')->group(function(){
        Route::get('/', [RegionController::class, 'index'])->name('index');
        Route::get('/create', [RegionController::class, 'create'])->name('create');
        Route::put('/update/{region}', [RegionController::class, 'update'])->name('update');
        Route::post('/store', [RegionController::class, 'store'])->name('store');
        Route::get('/delete/{region}', [RegionController::class, 'destroy'])->name('destroy');
        Route::get('/{region}/edit', [RegionController::class, 'edit'])->name('edit');
    });


                /****************************** Rate **********************************/
    Route::group(['prefix' => 'rate'], function () {
        Route::get('/', [RateController::class, 'index'])->name('rate.index');
        Route::get('/create', [RateController::class, 'create'])->name('rate.create');
        Route::post('/', [RateController::class, 'store'])->name('rate.store');
        Route::get('/{rate}', [RateController::class, 'show'])->name('rate.show');
        Route::get('/{rate}/edit', [RateController::class, 'edit'])->name('rate.edit');
        Route::put('/{rate}', [RateController::class, 'update'])->name('rate.update');
        Route::delete('/{rate}', [RateController::class, 'destroy'])->name('rate.destroy');
        Route::get('/table/show', [RateController::class, 'table'])->name('rate.table');
    });


     Route::group(['prefix' => 'banner'], function () {
    Route::get('/', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/{banner}', [BannerController::class, 'show'])->name('banner.show');
    Route::get('/{banner}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/{banner}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy');
    Route::get('/table/show', [BannerController::class, 'table'])->name('banner.table');
    Route::post('/image/{image}', [BannerController::class, 'deleteImage'])->name('banner.image.delete');
});


    /****************************** Bottom Banner **********************************/
    Route::group(['prefix' => 'bottom_banner'], function () {
        Route::get('/', [BottomBannerController::class, 'index'])->name('bottom_banner.index');
        Route::get('/create', [BottomBannerController::class, 'create'])->name('bottom_banner.create');
        Route::post('/', [BottomBannerController::class, 'store'])->name('bottom_banner.store');
        Route::get('/{bottom_banner}/edit', [BottomBannerController::class, 'edit'])->name('bottom_banner.edit');
        Route::put('/{bottom_banner}', [BottomBannerController::class, 'update'])->name('bottom_banner.update');
        Route::delete('/{bottom_banner}', [BottomBannerController::class, 'destroy'])->name('bottom_banner.destroy');
        Route::get('/table/show', [BottomBannerController::class, 'table'])->name('bottom_banner.table');
        Route::post('/change-active/{bottom_banner}', [BottomBannerController::class, 'changeActive'])->name('bottom_banner.changeActive');
    });


    Route::resource('faqs', 'FaqController')->except('show');
    Route::get('faqs/show', 'FaqController@show')->name('faqs.show');

    Route::get('all-settings', [SettingController::class, 'all_settings'])->name('all_settings.index');

    /************************************ setting ************************************************/

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {

        Route::get('setting-news', [SettingController::class, 'newsSetting'])->name('news.index');
        Route::get('setting-news/edit', [SettingController::class, 'newsSettingEdit'])->name('news.edit');
        Route::put('setting-news/update', [SettingController::class, 'newsSettingUpdate'])->name('news.update');


        Route::get('setting-home-couronne', [SettingController::class, 'homecouronneSetting'])->name('homecouronnesetting.index');
        Route::get('setting-home-couronne/edit', [SettingController::class, 'homecouronneSettingEdit'])->name('homecouronnesetting.edit');
        Route::put('setting-home-couronne/update', [SettingController::class, 'homecouronneSettingUpdate'])->name('homecouronnesetting.update');


     Route::get('setting-ourcardssetting', [SettingController::class, 'ourcardssetting'])->name('ourcardssetting.index');
        Route::get('setting-ourcardssetting/edit', [SettingController::class, 'ourcardssettingEdit'])->name('ourcardssetting.edit');
        Route::put('setting-ourcardssetting/update', [SettingController::class, 'ourcardssettingUpdate'])->name('ourcardssetting.update');


        Route::get('setting-bottom-banner', [SettingController::class, 'bottomBannerSetting'])->name('bottomBanner.index');
        Route::get('setting-bottom-banner/edit', [SettingController::class, 'bottomBannerSettingEdit'])->name('bottomBanner.edit');
        Route::put('setting-bottom-banner/update', [SettingController::class, 'bottomBannerSettingUpdate'])->name('bottomBanner.update');


        Route::get('setting-main-setting', [SettingController::class, 'mainSetting'])->name('main.index');
        Route::get('setting-main-setting/edit', [SettingController::class, 'mainSettingEdit'])->name('main.edit');
        Route::put('setting-main-setting/update', [SettingController::class, 'mainSettingUpdate'])->name('main.update');



        Route::get('setting-app-setting', [SettingController::class, 'appSetting'])->name('app.index');
        Route::get('setting-app-setting/edit', [SettingController::class, 'appSettingEdit'])->name('app.edit');
        Route::put('setting-app-setting/update', [SettingController::class, 'appSettingUpdate'])->name('app.update');
        Route::post('setting-app-setting/change-status', [SettingController::class, 'appSettingSplashChangeStatus'])->name('app.splashChangeStatus');


        Route::get('privacy-policy-setting', [SettingController::class, 'privacyPolicySetting'])->name('privacy_policy.index');
        Route::get('privacy-policy-setting/edit', [SettingController::class, 'privacyPolicyEdit'])->name('privacy_policy.edit');
        Route::put('privacy-policy-setting/update', [SettingController::class, 'privacyPolicyUpdate'])->name('privacy_policy.update');


        Route::get('use-terms-setting', [SettingController::class, 'useTermsSetting'])->name('use_terms.index');
        Route::get('use-terms-setting/edit', [SettingController::class, 'useTermsEdit'])->name('use_terms.edit');
        Route::put('use-terms-setting/update', [SettingController::class, 'useTermsUpdate'])->name('use_terms.update');


        Route::get('setting-about-us', [SettingController::class, 'AboutShowSetting'])->name('aboutUs.index');
        Route::get('setting-about-us/edit', [SettingController::class, 'aboutUsSettingEdit'])->name('aboutUs.edit');
        Route::put('setting-about-us/update', [SettingController::class, 'aboutUsSettingUpdate'])->name('aboutUs.update');

         Route::get('setting-aboutUs_ClientsSay', [SettingController::class, 'aboutUs_ClientsSayShowSetting'])->name('aboutUs_ClientsSay.index');
        Route::get('setting-aboutUs_ClientsSay/edit', [SettingController::class, 'aboutUs_ClientsSayEdit'])->name('aboutUs_ClientsSay.edit');
        Route::put('setting-aboutUs_ClientsSay/update', [SettingController::class, 'aboutUs_ClientsSayUpdate'])->name('aboutUs_ClientsSay.update');


        Route::get('setting-aboutUs_Popular_Destinations', [SettingController::class, 'aboutUs_Popular_DestinationsShowSetting'])->name('aboutUs_Popular_Destinations.index');
        Route::get('setting-aboutUs_Popular_Destinations/edit', [SettingController::class, 'aboutUs_Popular_DestinationsEdit'])->name('aboutUs_Popular_Destinations.edit');
        Route::put('setting-aboutUs_Popular_Destinations/update', [SettingController::class, 'aboutUs_Popular_DestinationsUpdate'])->name('aboutUs_Popular_Destinations.update');

        Route::get('setting-aboutUs_Subscribeto_get', [SettingController::class, 'aboutUs_Subscribeto_getShowSetting'])->name('aboutUs_Subscribeto_get.index');
        Route::get('setting-aboutUs_Subscribeto_get/edit', [SettingController::class, 'aboutUs_Subscribeto_getEdit'])->name('aboutUs_Subscribeto_get.edit');
        Route::put('setting-aboutUs_Subscribeto_get/update', [SettingController::class, 'aboutUs_Subscribeto_getUpdate'])->name('aboutUs_Subscribeto_get.update');

        Route::get('setting-aboutUs_information', [SettingController::class, 'aboutUs_information'])->name('aboutUs_information.index');
        Route::get('setting-aboutUs_information/edit', [SettingController::class, 'aboutUs_information_getEdit'])->name('aboutUs_information.edit');
        Route::put('setting-aboutUs_information/update', [SettingController::class, 'aboutUs_information_getUpdate'])->name('aboutUs_information.update');

        Route::get('setting-setting_blog_details', [SettingController::class, 'setting_blog_details'])->name('setting_blog_details.index');
        Route::get('setting-setting_blog_details/edit', [SettingController::class, 'setting_blog_details_getEdit'])->name('setting_blog_details.edit');
        Route::put('setting-setting_blog_details/update', [SettingController::class, 'setting_blog_details_getUpdate'])->name('setting_blog_details.update');


        Route::get('setting-setting_index', [SettingController::class, 'setting_index'])->name('setting_index.index');
        Route::get('setting-setting_index/edit', [SettingController::class, 'setting_index_getEdit'])->name('setting_index.edit');
        Route::put('setting-setting_index/update', [SettingController::class, 'setting_index_getUpdate'])->name('setting_index.update');

         Route::get('setting-Why_Choose_index', [SettingController::class, 'Why_Choose_index'])->name('Why_Choose_index.index');
        Route::get('setting-Why_Choose_index/edit', [SettingController::class, 'Why_Choose_index_getEdit'])->name('Why_Choose_index.edit');
        Route::put('setting-Why_Choose_index/update', [SettingController::class, 'Why_Choose_index_getUpdate'])->name('Why_Choose_index.update');


        Route::get('setting-Find_best_places_index', [SettingController::class, 'Find_best_places_index'])->name('Find_best_places_index.index');
        Route::get('setting-Find_best_places_index/edit', [SettingController::class, 'Find_best_places_index_getEdit'])->name('Find_best_places_index.edit');
        Route::put('setting-Find_best_places_index/update', [SettingController::class, 'Find_best_places_index_getUpdate'])->name('Find_best_places_index.update');

        Route::get('setting-Your_gateway_to_amazing_index', [SettingController::class, 'Your_gateway_to_amazing_index'])->name('Your_gateway_to_amazing_index.index');
        Route::get('setting-Your_gateway_to_amazing_index/edit', [SettingController::class, 'Your_gateway_to_amazing_index_getEdit'])->name('Your_gateway_to_amazing_index.edit');
        Route::put('setting-Your_gateway_to_amazing_index/update', [SettingController::class, 'Your_gateway_to_amazing_index_getUpdate'])->name('Your_gateway_to_amazing_index.update');


        Route::get('setting-trip_bestseller_index', [SettingController::class, 'trip_bestseller_index'])->name('trip_bestseller.index');
        Route::get('setting-trip_bestseller/edit', [SettingController::class, 'trip_bestseller_getEdit'])->name('trip_bestseller.edit');
        Route::put('setting-trip_bestseller/update', [SettingController::class, 'trip_bestseller_getUpdate'])->name('trip_bestseller.update');


        Route::get('setting-trip_title_ad_image_index', [SettingController::class, 'trip_title_ad_image_index'])->name('trip_title_ad_image.index');
        Route::get('setting-trip_title_ad_image/edit', [SettingController::class, 'trip_title_ad_image_getEdit'])->name('trip_title_ad_image.edit');
        Route::put('setting-trip_title_ad_image/update', [SettingController::class, 'trip_title_ad_image_getUpdate'])->name('trip_title_ad_image.update');


        Route::get('setting-setting_infomation_index', [SettingController::class, 'setting_infomation_index'])->name('setting_infomation.index');
        Route::get('setting-setting_infomation/edit', [SettingController::class, 'setting_infomation_getEdit'])->name('setting_infomation.edit');
        Route::put('setting-setting_infomation/update', [SettingController::class, 'setting_infomation_getUpdate'])->name('setting_infomation.update');


    });

            Route::get('/user/{userId}/bookings', function ($userId) {
                $user = User::findOrFail($userId);

                $bookings = ProgrammeBooking::where('user_id', $userId)
                    ->join('programmes', 'programme_bookings.programme_id', '=', 'programmes.id')
                    ->select('programme_bookings.*', 'programmes.name as programme_name', 'programme_bookings.check_in', 'programmes.duration as programme_duration')
                    ->get();

                return response()->json([
                    'bookings' => $bookings
                ]);
            });


    Route::get('login-to-landing-dashboard', [DashboardController::class, 'landing_cms'])->name('loginToLandingDashboard');
});
    }
);
