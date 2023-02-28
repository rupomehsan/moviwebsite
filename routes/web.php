<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CelebrityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\MgtStatusController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageSubscriberController;
use App\Http\Controllers\PaymentSettingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TopFeatureController;
use App\Http\Controllers\TvChannelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix("installation")->group(function () {
    Route::view('/', 'installation.installer');
    Route::post('/env-update', [InstallerController::class, "envUpdate"]);
    Route::post('/db-check', [InstallerController::class, "dbCheck"]);
    Route::post('/finished', [InstallerController::class, "finished"]);
    Route::post('/license-checker', [InstallerController::class, "licenseChecker"]);
});

Route::group(['middleware' => 'installationCheck'], function () {
    // Route::prefix("frontend")->group(function () {
    Route::view('/emailcheck', 'emails.verificationCode');

    Route::get('/', [FrontendController::class, "index"]);
    Route::get('/category-index', [FrontendController::class, "categoryIndex"]);
    Route::get('/video', [FrontendController::class, "allVideo"]);
    Route::post('/watch-trailer', [FrontendController::class, "watchTrailer"]);
    Route::post('/video/filter', [FrontendController::class, "filter"]);
    Route::get('/videoshow/{id}', [FrontendController::class, "videoshow"]);
    Route::get('/live-tv/{id}', [FrontendController::class, "liveTv"]);
    Route::get('/tv-channel-show', [FrontendController::class, "tvChannelShow"]);
    Route::post('/tv-channel-show/channel', [FrontendController::class, "tvChannelRender"]);
    Route::post('/user/registration', [UserController::class, "registration"]);
    Route::post('/get-episod', [FrontendController::class, "getEpisod"]);
    Route::get('/category', [FrontendController::class, "category"]);

    Route::view('/legal-information', 'frontend.client.legalInformation');
    Route::view('/about-us', 'frontend.client.aboutUs');
    Route::view('/terms-conditions', 'frontend.client.termsConditions');
    Route::view('/privacy-policy', 'frontend.client.privacyPolicy');
    Route::view('/cookies-policy', 'frontend.client.cookiesPolicy');

    Route::view('/user/login', 'frontend.client.login');
    Route::view('/forgot-password', 'frontend.client.forgotPassword');
    Route::view('/forgot-password-email', 'frontend.client.forgotPasswordEmail');
    Route::view('/forgot-password-code', 'frontend.client.forgotPasswordCode');
    Route::view('/registration', 'frontend.client.registration');
    Route::view('/user-verification', 'frontend.client.userVerificationCode');
    Route::post('/parental-authentication', [FrontendController::class, "parentalAuthentication"]);
    Route::post('/tv-channel-parental-authentication', [FrontendController::class, "tvChannelParentalAuthentication"]);
    Route::post('/send-movie-request', [FrontendController::class, "sendMovieRequest"]);
    Route::post('/clear-history', [FrontendController::class, "clearHistory"]);
    Route::get('/get-package', [FrontendController::class, "getPackage"]);
    Route::post('/get-package/single', [FrontendController::class, "getSinglePackage"]);
    Route::post('/get-package/select-payment-method', [FrontendController::class, "selectPaymentMethod"]);
    // });
    Route::post('subscriber', [SubscriberController::class, "store"]);

    Route::get('stripe', [StripeController::class, 'stripePost']);

    Route::post('payment/transaction-initialise', [PaymentSettingsController::class, 'transactionInitialise']);
    Route::post('payment/paypal-transaction-data-store', [PaymentSettingsController::class, 'paypalTransactionDataStore']);
    Route::post('payment/stripe-transaction-data-store', [PaymentSettingsController::class, 'stripeTransactionDataStore']);
    Route::get('payment/stripe-success', [PaymentSettingsController::class, 'stripeSuccess']);

    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'adminSuperAdmin'], function () {
            Route::get('/admin', [DashboardController::class, "index"]);
            Route::get('/admin/dashboard', [DashboardController::class, "index"]);
            Route::post('/admin/dashboard/get-yearly-data', [DashboardController::class, "getYearlyData"]);
            Route::get('/admin/profile', [AdminController::class, "adminProfile"]);

            Route::group(['middleware' => 'adminManage'], function () {
                Route::prefix("admin")->group(function () {
                    // Category
                    Route::get('category', [CategoryController::class, "categoryIndex"]);
                    Route::post('category/category-create', [CategoryController::class, "categoryCreate"]);
                    Route::post('category/category-store', [CategoryController::class, "categoryStore"]);
                    Route::post('category/edit', [CategoryController::class, "categoryEdit"]);
                    Route::post('category/update', [CategoryController::class, "categoryUpdate"]);
                    Route::post('category/filter', [CategoryController::class, "categoryFilter"]);

                    Route::get('category/sub-category-view', [CategoryController::class, "subCategoryView"]);
                    Route::post('category/sub-category-create', [CategoryController::class, "subCategoryCreate"]);
                    Route::post('category/sub-category-store', [CategoryController::class, "subCategoryStore"]);
                    Route::post('category/sub-category-edit', [CategoryController::class, "subCategoryEdit"]);
                    Route::post('category/sub-category-update', [CategoryController::class, "subCategoryUpdate"]);
                    Route::post('category/sub-category-filter', [CategoryController::class, "subCategoryFilter"]);

                    Route::get('category/series-category-view', [CategoryController::class, "seriesCategoryView"]);
                    Route::post('category/series-category-create', [CategoryController::class, "seriesCategoryCreate"]);
                    Route::post('category/series-category-store', [CategoryController::class, "seriesCategoryStore"]);
                    Route::post('category/series-category-edit', [CategoryController::class, "seriesCategoryEdit"]);
                    Route::post('category/series-category-update', [CategoryController::class, "seriesCategoryUpdate"]);
                    Route::post('category/series-category-filter', [CategoryController::class, "seriesCategoryFilter"]);

                    Route::get('category/tv-category-view', [CategoryController::class, "tvCategoryView"]);
                    Route::post('category/tv-channel-category-create', [CategoryController::class, "tvCategoryCreate"]);
                    Route::post('category/tv-channel-category-store', [CategoryController::class, "tvCategoryStore"]);
                    Route::post('category/tv-category-edit', [CategoryController::class, "tvCategoryEdit"]);
                    Route::post('category/tv-category-update', [CategoryController::class, "tvCategoryUpdate"]);
                    Route::post('category/tv-category-filter', [CategoryController::class, "tvCategoryFilter"]);

                    Route::post('category/destroy/{model}', [CategoryController::class, "destroy"]);

                    //artist
                    Route::view('artist', 'artist.index');
                    Route::post('artist/create', [ArtistController::class, "create"]);

                    //celebrity
                    Route::get('celebrity', [CelebrityController::class, "index"]);
                    Route::get('celebrity/index-view', [CelebrityController::class, "indexView"]);
                    Route::post('celebrity/create', [CelebrityController::class, "create"]);
                    Route::post('celebrity/store', [CelebrityController::class, "store"]);
                    Route::post('celebrity/edit', [CelebrityController::class, "edit"]);
                    Route::post('celebrity/update', [CelebrityController::class, "update"]);
                    Route::post('celebrity/filter', [CelebrityController::class, "filter"]);
                    Route::post('celebrity/destroy', [CelebrityController::class, "destroy"]);

                    Route::post('celebrity/manage-celebrity-type', [CelebrityController::class, "manageCelebrityType"]);
                    Route::post('celebrity/celebrity-type-create', [CelebrityController::class, "celebrityTypeCreate"]);
                    Route::post('celebrity/celebrity-type-store', [CelebrityController::class, "celebrityTypeStore"]);
                    Route::post('celebrity/celebrity-type-edit', [CelebrityController::class, "celebrityTypeEdit"]);
                    Route::post('celebrity/celebrity-type-update', [CelebrityController::class, "celebrityTypeUpdate"]);
                    Route::post('celebrity/celebrity-type-filter', [CelebrityController::class, "celebrityTypeFilter"]);
                    Route::delete('celebrity/celebrity-type/{id}', [CelebrityController::class, "celebrityTypeDestroy"]);

                    //genres
                    Route::get('genres', [GenreController::class, "index"]);
                    Route::post('genres/create', [GenreController::class, "create"]);
                    Route::post('genres/store', [GenreController::class, "store"]);
                    Route::post('genres/edit', [GenreController::class, "edit"]);
                    Route::post('genres/update', [GenreController::class, "update"]);
                    Route::post('genres/filter', [GenreController::class, "filter"]);
                    Route::post('genres/destroy', [GenreController::class, "destroy"]);

                    //tv-channel
                    Route::get('tv-channel', [TvChannelController::class, "index"]);
                    Route::post('tv-channel/create', [TvChannelController::class, "create"]);
                    Route::post('tv-channel/store', [TvChannelController::class, "store"]);
                    Route::post('tv-channel/edit', [TvChannelController::class, "edit"]);
                    Route::post('tv-channel/update', [TvChannelController::class, "update"]);
                    Route::post('tv-channel/filter', [TvChannelController::class, "filter"]);
                    Route::post('tv-channel/destroy', [TvChannelController::class, "destroy"]);

                    //country
                    Route::get('country', [CountryController::class, "index"]);
                    Route::post('country/create', [CountryController::class, "create"]);
                    Route::post('country/store', [CountryController::class, "store"]);
                    Route::post('country/edit', [CountryController::class, "edit"]);
                    Route::post('country/update', [CountryController::class, "update"]);
                    Route::post('country/filter', [CountryController::class, "filter"]);
                    Route::post('country/destroy', [CountryController::class, "destroy"]);

                    //topFeature
                    Route::get('top-feature', [TopFeatureController::class, "index"]);
                    Route::post('top-feature/create', [TopFeatureController::class, "create"]);
                    Route::post('top-feature/get-video-image', [TopFeatureController::class, "getVideoImage"]);
                    Route::post('top-feature/store', [TopFeatureController::class, "store"]);
                    Route::post('top-feature/edit', [TopFeatureController::class, "edit"]);
                    Route::post('top-feature/update', [TopFeatureController::class, "update"]);
                    Route::post('top-feature/filter', [TopFeatureController::class, "filter"]);
                    Route::post('top-feature/destroy', [TopFeatureController::class, "destroy"]);

                    //sponsor banner
                    Route::get('sponsor', [SponsorController::class, "sponsorBannerIndex"]);
                    Route::post('sponsor/sponsor-banner-create', [SponsorController::class, "sponsorBannerCreate"]);
                    Route::post('sponsor/sponsor-banner-store', [SponsorController::class, "sponsorBannerStore"]);
                    Route::post('sponsor/sponsor-banner-edit', [SponsorController::class, "sponsorBannerEdit"]);
                    Route::post('sponsor/sponsor-banner-update', [SponsorController::class, "sponsorBannerUpdate"]);
                    Route::post('sponsor/sponsor-banner-filter', [SponsorController::class, "sponsorBannerFilter"]);

                    Route::get('sponsor/sponsor-video-index', [SponsorController::class, "sponsorVideoIndex"]);
                    Route::post('sponsor/sponsor-video-create', [SponsorController::class, "sponsorVideoCreate"]);
                    Route::post('sponsor/sponsor-video-store', [SponsorController::class, "sponsorVideoStore"]);
                    Route::post('sponsor/sponsor-video-edit', [SponsorController::class, "sponsorVideoEdit"]);
                    Route::post('sponsor/sponsor-video-update', [SponsorController::class, "sponsorVideoUpdate"]);
                    Route::post('sponsor/sponsor-video-filter', [SponsorController::class, "sponsorVideoFilter"]);
                    Route::post('sponsor/destroy/{posturl}', [SponsorController::class, "destroy"]);

                    //management status
                    Route::post('management-status', [MgtStatusController::class, "status"]);
                });
            });

            Route::group(['middleware' => 'adminVideo'], function () {
                Route::prefix("admin")->group(function () {
                    //video
                    Route::get('video', [VideoController::class, "index"]);
                    Route::get('request-movie', [VideoController::class, "requestMovie"]);
                    Route::get('video/create', [VideoController::class, "create"]);
                    Route::post('video/store-imdb-key', [VideoController::class, "storeImdbKey"]);
                    Route::post('video/store', [VideoController::class, "store"]);
                    Route::post('video/update', [VideoController::class, "update"]);
                    Route::post('video/filter', [VideoController::class, "filter"]);
                    Route::post('video/get-sub-category', [VideoController::class, "getSubCategory"]);
                    Route::post('video/get-series', [VideoController::class, "getSeries"]);
                    Route::post('video/get-season', [VideoController::class, "getSeason"]);
                    Route::post('video/get-episod', [VideoController::class, "getEpisod"]);
                    Route::get('video/edit/{id}', [VideoController::class, "edit"]);
                    Route::post('video/destroy', [VideoController::class, "destroy"]);
                    Route::post('video/tmdb-update', [VideoController::class, "tmdbUpdate"]);

                    // series

                    Route::get('series/series-category-view', [CategoryController::class, "seriesCategoryView"]);
                    Route::post('series/series-category-create', [CategoryController::class, "seriesCategoryCreate"]);
                    Route::post('series/series-category-store', [CategoryController::class, "seriesCategoryStore"]);
                    Route::post('series/series-category-edit', [CategoryController::class, "seriesCategoryEdit"]);
                    Route::post('series/series-category-update', [CategoryController::class, "seriesCategoryUpdate"]);
                    Route::post('series/series-category-filter', [CategoryController::class, "seriesCategoryFilter"]);

                    Route::get('series', [SeriesController::class, "seriesIndex"]);
                    Route::post('series/series-create', [SeriesController::class, "seriesCreate"]);
                    Route::post('series/series-store', [SeriesController::class, "seriesStore"]);
                    Route::post('series/edit', [SeriesController::class, "seriesEdit"]);
                    Route::post('series/update', [SeriesController::class, "seriesUpdate"]);
                    Route::post('series/filter', [SeriesController::class, "filter"]);

                    Route::get('series/season', [SeriesController::class, "seasonView"]);
                    Route::post('series/season-create', [SeriesController::class, "seasonCreate"]);
                    Route::post('series/season-store', [SeriesController::class, "seasonStore"]);
                    Route::post('series/season-edit', [SeriesController::class, "seasonEdit"]);
                    Route::post('series/season-update', [SeriesController::class, "seasonUpdate"]);
                    Route::post('series/season/filter', [SeriesController::class, "seasonFilter"]);

                    Route::get('series/episod', [SeriesController::class, "episodView"]);
                    Route::post('series/episod-create', [SeriesController::class, "episodCreate"]);
                    Route::post('series/episod-store', [SeriesController::class, "episodStore"]);
                    Route::post('series/episod-edit', [SeriesController::class, "episodEdit"]);
                    Route::post('series/get-season', [SeriesController::class, "getSeason"]);
                    Route::post('series/episod-update', [SeriesController::class, "episodUpdate"]);
                    Route::post('series/episod/filter', [SeriesController::class, "episodFilter"]);

                    Route::post('series/destroy/{model}', [SeriesController::class, "destroy"]);
                });
            });

            Route::group(['middleware' => 'adminUser'], function () {
                Route::prefix("admin")->group(function () {
                    //user management
                    Route::get('user', [UserController::class, "index"]);
                    Route::get('user/create', [UserController::class, "create"]);
                    Route::post('user/store', [UserController::class, "store"]);
                    Route::post('user/filter', [UserController::class, "filter"]);
                    Route::get('user/{id}/edit', [UserController::class, "edit"]);
                    Route::post('user/{id}/update', [UserController::class, "update"]);
                    Route::post('user/destroy', [UserController::class, "destroy"]);

                    //comment
                    Route::get('comment', [CommentController::class, "index"]);
                    Route::post('comment/status', [CommentController::class, "status"]);
                    Route::post('comment/filter', [CommentController::class, "filter"]);
                    Route::post('comment/destroy', [CommentController::class, "destroy"]);

                    //report
                    Route::get('report', [ReportController::class, "index"]);
                    Route::post('report/status', [ReportController::class, "status"]);
                    Route::post('report/filter', [ReportController::class, "filter"]);
                    Route::post('report/report-show', [ReportController::class, "reportShow"]);
                    Route::post('report/destroy', [ReportController::class, "destroy"]);

                    //subscriber
                    Route::get('subscriber', [SubscriberController::class, "index"]);
                });
            });

            Route::group(['middleware' => 'adminAdministration'], function () {
                Route::prefix("admin")->group(function () {
                    //admin management
                    Route::get('admin', [AdminController::class, "adminIndex"]);
                    Route::get('admin/super-admin', [AdminController::class, "superAdminIndex"]);
                    Route::get('admin/create', [AdminController::class, "create"]);
                    Route::post('admin/store', [AdminController::class, "store"]);
                    Route::post('admin/filter', [AdminController::class, "filter"]);
                    Route::post('admin/super-admin/filter', [AdminController::class, "superAdminFilter"]);
                    Route::get('admin/{id}/edit', [AdminController::class, "edit"]);
                    Route::post('admin/{id}/update', [AdminController::class, "update"]);
                    Route::post('admin/destroy', [AdminController::class, "destroy"]);

                    Route::view('admin-management', 'admin.index');
                    Route::view('admin-management/create', 'admin.create');
                });
            });

            Route::group(['middleware' => 'adminSettings'], function () {
                Route::prefix("admin")->group(function () {

                    //basic-settings
                    Route::get('basic-settings', [SettingsController::class, "basicSettings"]);
                    Route::post('basic-settings/add-social-account', [SettingsController::class, "addSocialAccount"]);
                    Route::post('basic-settings/add-social', [SettingsController::class, "addSocial"]);
                    Route::post('basic-settings/update', [SettingsController::class, "basicSettingsUpdate"]);
                    Route::post('basic-settings/change-password', [UserController::class, "changePassword"]);
                    Route::post('basic-settings/update-password', [UserController::class, "updatePassword"]);

                    Route::get('video-settings', [SettingsController::class, "videoSettings"]);
                    Route::post('video-settings/get-category-content', [SettingsController::class, "getCategoryContent"]);

                    //smtp Settings
                    Route::get('/smtp-settings', function () {
                        return view('settings.smtpSettings');
                    });
                    Route::post('smtp-settings/update', [SettingsController::class, "smtpUpdate"]);

                    Route::get('video-settings-category', [SettingsController::class, "videoSettingsCategory"]);
                    Route::post('video-settings-category/get-settings-category', [SettingsController::class, "getSettingsCategory"]);
                    Route::post('video-settings-category/get-sub-category-content', [SettingsController::class, "getSubCategoryContent"]);

                    Route::post('video-settings/update', [SettingsController::class, "videoSettingsUpdate"]);

                    //advertisement
                    Route::get('advertisement', [AdController::class, "mobileAd"]);
                    Route::post('advertisement/mobileAdUpdate', [AdController::class, "mobileAdUpdate"]);

                    Route::get('advertisement/web-ad', [AdController::class, "webAd"]);
                    Route::post('advertisement/webAdUpdate', [AdController::class, "webAdUpdate"]);

                    Route::view('advertisement/web', 'advertisement.web');

                    //notification
                    Route::get('notification', [NotificationController::class, "index"]);
                    Route::post('notification/create', [NotificationController::class, "create"]);
                    Route::post('notification/store', [NotificationController::class, "store"]);
                    Route::post('notification/filter', [NotificationController::class, "filter"]);
                    Route::post('notification/destroy', [NotificationController::class, "destroy"]);
                    Route::get('notification/manage-notification', [NotificationController::class, "manageNotification"]);
                    Route::post('notification/manage-notification-update', [NotificationController::class, "manageNotificationUpdate"]);
                    Route::post('notification/manage-notification/get-mobile-data', [NotificationController::class, "getMobileData"]);
                    Route::post('notification/manage-notification/get-web-data', [NotificationController::class, "getWebData"]);
                });
            });

            Route::group(['middleware' => 'adminSubscription'], function () {
                Route::prefix("admin")->group(function () {

                    //package
                    Route::get('package', [PackageController::class, "index"]);
                    Route::post('package/create', [PackageController::class, "create"]);
                    Route::post('package/store', [PackageController::class, "store"]);
                    Route::post('package/edit', [PackageController::class, "edit"]);
                    Route::post('package/update', [PackageController::class, "update"]);
                    Route::post('package/filter', [PackageController::class, "filter"]);
                    Route::post('package/destroy', [PackageController::class, "destroy"]);

                    //payment settings
                    Route::get('payment-settings', [PaymentSettingsController::class, "index"]);
                    Route::post('payment-settings/update', [PaymentSettingsController::class, "update"]);

                    //package subscriber
                    Route::get('package-subscriber', [PackageSubscriberController::class, "index"]);
                    Route::post('package-subscriber/store', [PackageSubscriberController::class, "store"]);

                    //Offline Payment
                    Route::get('offline-payment', [PackageSubscriberController::class, "offlineSubscriber"]);
                    Route::get('offline-payment/make-payment', [PackageSubscriberController::class, "offlineMakePayment"]);
                    Route::post('offline-payment/store', [PackageSubscriberController::class, "offlineMakePaymentStore"]);

                });
            });
        });
        //user access
        Route::post('video/add-favorite', [VideoController::class, "addFavorite"]);
        Route::post('comment/store', [CommentController::class, "store"]);
        Route::post('report/create', [ReportController::class, "create"]);
        Route::post('report/store', [ReportController::class, "store"]);
        Route::get('/profile', [UserController::class, "profile"]);
        Route::get('/edit-profile', [UserController::class, "editProfile"]);
        Route::post('/profile-update', [UserController::class, "profileUpdate"]);
    });

    Route::get('php-info', function () {
        echo phpInfo();
    });

    Auth::routes();

    Route::get('/share/{from}/{id}', function () {
        $settings = \App\Models\Setting::select('update_app')->first();
        if ($settings) {

            $url = $settings->update_app;
            header("Location: " . $url);
        } else {
            return response([
                'status'  => 'error',
                'message' => 'App is not published yet!',
            ], 404);
        }
    });

});
