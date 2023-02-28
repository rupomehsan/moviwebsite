<?php

use App\Http\Controllers\Api\AdsMobileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryContentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CelebrityController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\HomeContentController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PackageSubscriberController;
use App\Http\Controllers\Api\PaymentGatewayController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\SponsorController;
//use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\TvChannelController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix("v1")->middleware(['installationCheck'])->group(function () {
    Route::post('send-notification', [NotificationController::class, "sendNotification"]);

    //User Registration
    Route::post('auth/register', [AuthController::class, "register"]);
    Route::patch('auth/resend-code-verification', [AuthController::class, "resendCodeVerification"]);
    Route::post('auth/phone-verification', [AuthController::class, "phoneVerification"]);
    Route::post('auth/login', [AuthController::class, "login"]);
    Route::post('auth/forgot-password', [AuthController::class, "forgotPassword"]);
    Route::post('auth/user-verify', [AuthController::class, "UserVerify"]);
    Route::patch('auth/change-password', [AuthController::class, "changePassword"]);
    Route::patch('auth/resend-code', [AuthController::class, "resendCode"]);
    Route::post('auth/social-login', [AuthController::class, "socialLogin"]);

    //advertisements
    Route::get('ads-mobile', [AdsMobileController::class, "index"]);

    //banner
    Route::get('banner', [BannerController::class, "index"]);

    //sponsor
    Route::get('sponsor', [SponsorController::class, "index"]);

    //home content
    Route::get('home-content', [HomeContentController::class, "index"]);

    //category content
    Route::post('category-content', [CategoryContentController::class, "index"]);

    //category content
    Route::get('category-content', [CategoryContentController::class, "index"]);

    //category
    Route::get('category', [CategoryController::class, "index"]);

    //sub category
    Route::get('category/sub-category', [CategoryController::class, "subCategory"]);

    //all videos
    Route::get('video', [VideoController::class, "index"]);
    Route::post('searched-video', [VideoController::class, "searchedVideo"]);
    Route::post('country-video', [VideoController::class, "countryVideo"]);
    Route::post('year-video', [VideoController::class, "yearVideo"]);
    Route::post('celebrity-video', [VideoController::class, "celebrityVideo"]);
    Route::post('genre-video', [VideoController::class, "genreVideo"]);
    Route::post('season-wise-episode', [VideoController::class, "seasonWiseEpisode"]);

    //show Video
    Route::get('video/{id}/show', [VideoController::class, "show"]);

    //get year
    Route::get('years', [VideoController::class, "years"]);

    //country
    Route::get('country', [CountryController::class, "index"]);

    //country
    Route::get('celebrity', [CelebrityController::class, "index"]);

    //country
    Route::get('genre', [GenreController::class, "index"]);

    //tv
    Route::get('tv-channel', [TvChannelController::class, "index"]);
    Route::get('tv-channel/{id}/show', [TvChannelController::class, "show"]);

    //series
    Route::get('series', [SeriesController::class, "index"]);

    //notification
    Route::get('notification', [NotificationController::class, "index"]);
    Route::get('notification/mobile-keys', [NotificationController::class, "mobileNotificationKeys"]);

    //settings
    Route::get('basic-settings', [SettingsController::class, "basicSettings"]);
    Route::get('video-settings', [SettingsController::class, "videoSettings"]);
    Route::get('setting/smtp', [SettingsController::class, "smtpIndex"]);

    // package
    Route::get('package', [PackageController::class, "index"]);

    //payment-gateway
    Route::get('payment-gateway', [PaymentGatewayController::class, "index"]);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // user
        Route::post('auth/logout', [AuthController::class, "logout"]);
        //videos
        Route::get('favorite-video', [VideoController::class, "favoriteVideo"]);
        Route::post('add-favorite-video', [VideoController::class, "addFavoriteVideo"]);
        Route::get('history-video', [VideoController::class, "historyVideo"]);

        //report
        Route::post('report', [ReportController::class, "store"]);

        //comment
        Route::post('comment', [CommentController::class, "store"]);

        //user
        Route::get('profile', [UserController::class, "profile"]);
        Route::post('update-profile', [UserController::class, "updateProfile"]);

        //setting
        Route::post('setting/smtp-update', [SettingsController::class, "smtpUpdate"]);
        //payment-gateway
        Route::post('payment-sheet', [PaymentGatewayController::class, "paymentSheet"]);

        //package-subscriber
        Route::get('/package-subscriber/my-subscription', [PackageSubscriberController::class, "mySubscription"]);
        Route::get('package-subscriber', [PackageSubscriberController::class, "index"]);
        Route::post('package-subscriber', [PackageSubscriberController::class, "packageSubscriber"]);

    });

    // Route::group(['middleware' => 'auth:sanctum'], function () {
    //     //user role
    //     Route::get('user-role', [UserRoleController::class, "index"]);
    //     Route::post('user-role', [UserRoleController::class, "store"]);
    //     Route::get('user-role/{id}', [UserRoleController::class, "show"]);
    //     Route::patch('user-role/{id}', [UserRoleController::class, "update"]);
    //     Route::delete('user-role/{id}', [UserRoleController::class, "destroy"]);

    //     //user
    //     Route::get('user', [UserController::class, "index"]);
    //     Route::post('user', [UserController::class, "store"]);
    //     Route::get('user/{id}', [UserController::class, "show"]);
    //     Route::patch('user/{id}', [UserController::class, "update"]);
    //     Route::delete('user/{id}', [UserController::class, "destroy"]);

    //     //country
    //     Route::get('country', [CountryController::class, "index"]);
    //     Route::post('country', [CountryController::class, "store"]);
    //     Route::get('country/{id}', [CountryController::class, "show"]);
    //     Route::patch('country/{id}', [CountryController::class, "update"]);
    //     Route::delete('country/{id}', [CountryController::class, "destroy"]);

    //     //genre
    //     Route::get('genre', [GenreController::class, "index"]);
    //     Route::post('genre', [GenreController::class, "store"]);
    //     Route::get('genre/{id}', [GenreController::class, "show"]);
    //     Route::patch('genre/{id}', [GenreController::class, "update"]);
    //     Route::delete('genre/{id}', [GenreController::class, "destroy"]);

    //     Route::prefix("category")->group(function () {
    //         //category
    //         Route::get('', [CategoryController::class, "index"]);
    //         Route::post('', [CategoryController::class, "store"]);
    //         Route::get('/{id}/show', [CategoryController::class, "show"]);
    //         Route::patch('/{id}/update', [CategoryController::class, "update"]);
    //         Route::delete('/{id}/destroy', [CategoryController::class, "destroy"]);

    //         //sub-category
    //         Route::get('sub-category', [SubCategoryController::class, "index"]);
    //         Route::post('sub-category', [SubCategoryController::class, "store"]);
    //         Route::get('sub-category/{id}/show', [SubCategoryController::class, "show"]);
    //         Route::patch('sub-category/{id}/update', [SubCategoryController::class, "update"]);
    //         Route::delete('sub-category/{id}/destroy', [SubCategoryController::class, "destroy"]);

    //         //series
    //         Route::get('series', [SeriesController::class, "index"]);
    //         Route::post('series', [SeriesController::class, "store"]);
    //         Route::get('series/{id}/show', [SeriesController::class, "show"]);
    //         Route::patch('series/{id}/update', [SeriesController::class, "update"]);
    //         Route::delete('series/{id}/destroy', [SeriesController::class, "destroy"]);

    //         //TV Channel
    //         Route::get('tv-channel', [TvChannelController::class, "index"]);
    //         Route::post('tv-channel', [TvChannelController::class, "store"]);
    //         Route::get('tv-channel/{id}/show', [TvChannelController::class, "show"]);
    //         Route::patch('tv-channel/{id}/update', [TvChannelController::class, "update"]);
    //         Route::delete('tv-channel/{id}/destroy', [TvChannelController::class, "destroy"]);
    //     });

    //     //video
    //     Route::get('video', [VideoController::class, "index"]);
    //     Route::post('video', [VideoController::class, "store"]);
    //     Route::get('video/{id}', [VideoController::class, "show"]);
    //     Route::patch('video/{id}', [VideoController::class, "update"]);
    //     Route::delete('video/{id}', [VideoController::class, "destroy"]);

    //     //top-feature
    //     Route::get('top-feature', [TopFeatureController::class, "index"]);
    //     Route::post('top-feature', [TopFeatureController::class, "store"]);
    //     Route::delete('top-feature/{id}', [TopFeatureController::class, "destroy"]);

    //     //notification
    //     Route::get('notification', [NotificationController::class, "index"]);
    //     Route::post('notification', [NotificationController::class, "store"]);
    //     Route::delete('notification/{id}', [NotificationController::class, "destroy"]);

    //     //user profile
    //     // Route::get('user-profile', [UserProfileController::class, "profileDashboard"]);
    //     // Route::patch('user-profile/update-profile', [UserProfileController::class, "updateProfile"]);
    //     // Route::patch('user-profile/change-password', [UserProfileController::class, "changePassword"]);
    //     // Route::post('user-profile/member-profile', [UserProfileController::class, "memberProfile"]);

    // });

    // //Comments
    // Route::get('comments', [CommentsController::class, "index"]);
    // Route::post('comments', [CommentsController::class, "store"]);
    // Route::get('comments/{id}', [CommentsController::class, "show"]);
    // Route::patch('comments/{id}', [CommentsController::class, "update"]);
    // Route::delete('comments/{id}', [CommentsController::class, "destroy"]);

    // //report
    // Route::get('report', [ReportController::class, "index"]);
    // Route::post('report', [ReportController::class, "store"]);
    // Route::get('report/{id}', [ReportController::class, "show"]);
    // Route::patch('report/{id}', [ReportController::class, "update"]);
    // Route::delete('report/{id}', [ReportController::class, "destroy"]);

    //support
    Route::get('support', [SupportController::class, "index"]);
    Route::post('support', [SupportController::class, "store"]);
    Route::get('support/{id}', [SupportController::class, "show"]);
    Route::patch('support/{id}', [SupportController::class, "update"]);
    Route::delete('support/{id}', [SupportController::class, "destroy"]);

});
