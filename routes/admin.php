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
            'middleware' => [
                'AdminCheck',
            ],
            'namespace' => 'Admin',
            'prefix' => 'admin'
        ], function () {



            /****************************** Dashboard **********************************/
            Route::get('/', [DashboardController::class, 'index'])->name('index');

            /************************************ Roles & Permissions ************************************************/
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
                Route::post('/ban', [ClientController::class, 'ban'])->name('client.ban');
                Route::get('/{client}', [ClientController::class, 'show'])->name('client.show');
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





            /****************************** banner   **********************************/
            Route::group(['prefix' => 'banner'], function () {
                Route::get('/', [BlogController::class, 'index'])->name('banner.index');
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




            /****************************** Message **********************************/
            Route::group(['prefix' => 'message'], function () {
                Route::get('/', [MessageController::class, 'index'])->name('message.index');
                Route::get('/{message}', [MessageController::class, 'show'])->name('message.show');
                Route::delete('/{message}', [MessageController::class, 'destroy'])->name('message.destroy');
                Route::get('/table/show', [MessageController::class, 'table'])->name('message.table');
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




            Route::resource('faqs', 'FaqController')->except('show');
            Route::get('faqs/show', 'FaqController@show')->name('faqs.show');

            Route::get('all-settings', [SettingController::class, 'all_settings'])->name('all_settings.index');

            /************************************ setting ************************************************/

            Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {

                Route::get('setting-news', [SettingController::class, 'newsSetting'])->name('news.index');
                Route::get('setting-news/edit', [SettingController::class, 'newsSettingEdit'])->name('news.edit');
                Route::put('setting-news/update', [SettingController::class, 'newsSettingUpdate'])->name('news.update');
            });



            Route::get('login-to-landing-dashboard', [DashboardController::class, 'landing_cms'])->name('loginToLandingDashboard');
        });
    }
);
