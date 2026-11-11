<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\API\AboutusController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BranchesController;
use App\Http\Controllers\API\CityController as APICityController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\FavoritebranchesController;
use App\Http\Controllers\API\FavoriteoffersController;
use App\Http\Controllers\API\FavoriteproductsController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\PaintscategoryController;
use App\Http\Controllers\API\PointssettingController;
use App\Http\Controllers\API\PrivacypolicyController;
use App\Http\Controllers\API\ProductcategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SearchbranchesController;
use App\Http\Controllers\API\SearchofferController;
use App\Http\Controllers\API\SearchproductsController;
use App\Http\Controllers\API\TermsandconditionController;
use App\Http\Controllers\API\VoucherspageController;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//TODO register  and login
Route::prefix('auth')->group(function () {
    Route::post('send-otp', [ClientController::class, 'sendOtp']); //finish
    Route::post('check-otp', [ClientController::class, 'checkOtp']); //finish
    Route::post('register', [ClientController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('log-out', [LoginController::class, 'LogOut']);
   
});

Route::middleware('CheckAuthApi' )->group(function() {
    // , 'sanctum'
    Route::prefix('profile')->group(function () {
        Route::get('get-my-profile', [ClientController::class, 'getMyProfile']);

        Route::post('update-my-profile', [ClientController::class, 'updateMyProfile']);

        Route::post('updateImage', [ClientController::class, 'updateImage']);

        Route::post('update-fcm-token', [ClientController::class, 'updateFcmToken']);

        Route::post('change-password', [LoginController::class, 'ChangePassword']);

        Route::post('delete-account', [LoginController::class, 'DeleteAccount']);
        
        
    });
});

//TODO Route all

Route::get('/notification', [NotificationController::class, 'index']);
Route::get('/banner', [BannerController::class, 'index']);
Route::get('/country', [CountryController::class, 'index']);
 Route::get('/cities', [APICityController::class, 'index']);
 Route::get('/branches', [BranchesController::class, 'index']);


Route::get('/offer', [OfferController::class, 'index']);
Route::post('/add-code-offer', [OfferController::class, 'AddCodeOffer']);
Route::get('/get-code-offer', [OfferController::class, 'CodeOperations']);

Route::post('/message', [MessageController::class, 'CreateMessage']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/voucherspage', [VoucherspageController::class, 'index']);
Route::post('/client-points', [ClientController::class, 'clientPoints']);

Route::post('/search-products', [SearchproductsController::class, 'SearchProducts']);
Route::post('/search-branches', [SearchbranchesController::class, 'searchBranches']);

Route::post('/search-offer', [SearchofferController::class, 'searchOffer']);

//TODO Route pointssetting
Route::get('/points-setting', [PointssettingController::class, 'index']);
Route::post('/add-invite-friend', [PointssettingController::class, 'add_invite_friend']);
Route::post('/add-points-new-registration', [PointssettingController::class, 'add_points_new_registration']);
Route::post('/add-points-product-code', [PointssettingController::class, 'add_points_product_code']);

Route::post('/add-coupon', [PointssettingController::class, 'add_coupon']);

Route::get('/group', [GroupController::class, 'index']);

//TODO Route Favorite Branches
Route::post('/favorite-branches', [FavoritebranchesController::class, 'addFavoriteBranch']);
Route::get('/get-Favorite-Branches', [FavoritebranchesController::class, 'getFavoriteBranches']);
Route::post('/remove-Favorite-Branch', [FavoritebranchesController::class, 'removeFavoriteBranch']);
//TODO Route Favorite Products
Route::post('/favorite-products', [FavoriteproductsController::class, 'addFavoriteProduct']);
Route::get('/get-favorite-products', [FavoriteproductsController::class, 'getFavoriteProducts']);
Route::post ('/remove-favorite-products', [FavoriteproductsController::class, 'removeFavoriteProducts']);

//TODO Route Favorite offers
Route::post('/favorite-offers', [FavoriteoffersController::class, 'addFavoriteOffers']);
Route::get('/get-favorite-offers', [FavoriteoffersController::class, 'getFavoriteOffers']);
Route::post('/remove-favorite-offers', [FavoriteoffersController::class, 'removeFavoriteOffers']);

Route::get('/privacypolicy', [PrivacypolicyController::class, 'index']);
Route::get('/termsandcondition', [TermsandconditionController::class, 'index']);
Route::get('/aboutus', [AboutusController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/paintscategory', [PaintscategoryController::class, 'index']);

Route::get('/productcategory', [ProductcategoryController::class, 'index']);



