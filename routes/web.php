<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\Front\FeaturedPortfolioController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\SectionFiveController;
use App\Http\Controllers\Front\SectionThreeController;
use App\Http\Controllers\Front\SectionFourController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\SubscriptionPricingPlanController;
use App\Http\Controllers\SuperAdmin\CityController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HireRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanCurrencyController;
use App\Http\Controllers\PricingPlanController;
use App\Http\Controllers\RecentWorkController;
use App\Http\Controllers\RecentWorkTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SuperAdmin\CountryController;
use App\Http\Controllers\SuperAdmin\StateController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdmin\UserController as AdminUserController;
use App\Http\Controllers\VCardsController;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['xss']], function () {
    Route::get('/login', function () {
        return view('auth.login');
    });

    // front routes
    Route::get('/', [FrontController::class, 'showLandingScreen'])->name('front');
    Route::get('terms-and-conditions', [FrontController::class, 'termsAndConditions'])->name('terms.conditions');
    Route::get('privacy-policy', [FrontController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::post('send-enquiry', [EnquiryController::class, 'store'])->name('admin.send.enquiry');

    // featured Portfolio
    Route::get('portfolio', [FrontController::class, 'featuredPortfolio'])->name('front.portfolio.index');
    Route::get('show-portfolio', [FrontController::class, 'showMorePortfolio'])->name('front.show.more.portfolio');
    Route::get('vcard/{uniqueId}', [VCardsController::class, 'vCardsTemplate'])->name('vcard');
    Route::get('vcard-service/{id}', [VCardsController::class, 'vCardsServiceDetails'])->name('vcard.service');
    Route::get('follow-portfolio', [FrontController::class, 'followPortfolio'])->name('front.follow.portfolio');

    Route::get('register', [WebController::class, 'registerUser'])->name('user.register');
    Route::get('check-register-username', [WebController::class, 'checkUserName'])->name('user.check.username');
    Route::post('user-register', [UserController::class, 'store'])->name('user.store');
    Route::get('resend-verification-email',
        [UserController::class, 'resendVerificationEmail'])->name('resend.verification.email');

    Route::get('/home', function () {
        return redirect()->back();
    });

    // Impersonate routes
    Route::get('/impersonate/{userId}', [UserController::class, 'impersonate'])->name('impersonate');
    Route::get('/impersonate-leave', [UserController::class, 'impersonateLeave'])->name('impersonate.leave');
    Route::get('p-logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    // pricing plans routes
    Route::get('pricing', [FrontController::class, 'showPricingPlans'])->name('front.pricing');
    Route::get('pricing/payment-method/{id}', [FrontController::class, 'paymentMethod'])->name('front.payment.method');
});


Auth::routes(['verify' => true, 'register' => false]);

// super admin routes
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth', 'xss', 'check_impersonate_user', 'role:super_admin']], function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

        //Settings route
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update');
        Route::put('settings/social',
            [SettingController::class, 'updateSocialSetting'])->name('admin.settings.update.social');

        // Users routes
        Route::resource('users', AdminUserController::class)->names([
            'edit'   => 'admin.users.edit',
            'update' => 'admin.users.update',
        ]);

        // Countries routes
        Route::get('countries', [CountryController::class, 'index'])->name('countries.index');
        Route::post('countries', [CountryController::class, 'store'])->name('countries.store');
        Route::get('countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
        Route::put('countries/{country}', [CountryController::class, 'update'])->name('countries.update');
        Route::delete('countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');

        // State routes
        Route::get('states', [StateController::class, 'index'])->name('states.index');
        Route::post('states', [StateController::class, 'store'])->name('states.store');
        Route::get('states/{state}/edit', [StateController::class, 'edit'])->name('states.edit');
        Route::put('states/{state}', [StateController::class, 'update'])->name('states.update');
        Route::delete('states/{state}', [StateController::class, 'destroy'])->name('states.destroy');

        // City routes
        Route::get('cities', [CityController::class, 'index'])->name('cities.index');
        Route::post('cities', [CityController::class, 'store'])->name('cities.store');
        Route::get('cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('cities/{city}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');
        Route::get('change-status/{user}', [UserController::class, 'changeStatus'])->name('change.status');
        Route::get('check-username', [UserController::class, 'checkUserName'])->name('check.username');
        Route::get('email-verified/{user}', [UserController::class, 'emailVerified'])->name('change.email');

        //Enquiry route
        Route::get('enquiries', [EnquiryController::class, 'index'])->name('admin.enquiries.index');
        Route::delete('enquiries/{id}', [EnquiryController::class, 'destroy'])->name('admin.enquiries.destroy');
        Route::get('enquiries/{id}', [EnquiryController::class, 'show'])->name('admin.enquiries.show');

        // front cms routes
        Route::get('section-one', [FrontController::class, 'index'])->name('cms.section.one.index');
        Route::get('section-two', [FrontController::class, 'index'])->name('cms.section.two.index');
        Route::resource('section-three', SectionThreeController::class);
        Route::resource('section-five', SectionFiveController::class);
        Route::post('section-five/{id}', [SectionFiveController::class, 'update']);
        Route::resource('section-four', SectionFourController::class);
        Route::put('section-update', [FrontController::class, 'update'])->name('cms.section.update');

        // featured Portfolio routes
        Route::get('featured-portfolio',
            [FeaturedPortfolioController::class, 'index'])->name('featured.portfolio.index');
        Route::get('change-featured/{user}',
            [FeaturedPortfolioController::class, 'changePortfolioFeatured'])->name('change.featured.portfolio');

        // Subscription plan routes
        Route::get('subscription-plans',
            [SubscriptionPlanController::class, 'index'])->name('subscription.plans.index');
        Route::post('subscription-plans',
            [SubscriptionPlanController::class, 'store'])->name('subscription.plans.store');
        Route::get('subscription-plans/{subscriptionPlan}/edit',
            [SubscriptionPlanController::class, 'edit'])->name('subscription.plans.edit');
        Route::put('subscription-plans/{subscriptionPlan}',
            [SubscriptionPlanController::class, 'update'])->name('subscription.plans.update');
        Route::delete('subscription-plans/{subscriptionPlan}',
            [SubscriptionPlanController::class, 'destroy'])->name('subscription.plans.destroy');

        //logs
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    });
});

Route::post('update-language', [UserController::class, 'updateLanguage'])->middleware('auth',
    'xss')->name('update.language');

// Admin Portfolio routes
Route::prefix('p/{username}')->group(function () {
    Route::group(['middleware' => ['xss', 'setTenantFromUsername']], function () {
        Route::get('/', [WebController::class, 'index'])->name('portfolio.front');
        Route::post('send-enquiry', [EnquiryController::class, 'store'])->name('send.enquiry');
        Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog.details');
        Route::get('blog-lists', [BlogController::class, 'getBlogLists'])->name('blog.lists');
        Route::get('blog-category/{slug}', [BlogController::class, 'getCategoryBlogs'])->name('category.blogs');
        Route::get('search-blog', [BlogController::class, 'searchBlog'])->name('search.blog');
        Route::post('hire-request', [HireRequestController::class, 'store'])->name('hire.request');
    });
});

Route::group([
    'middleware' => [
        'auth', 'xss', 'multi_tenant', 'check_user_status', 'check_super_admin_role', 'role:admin',
    ],
], function () {
    //Subscription Pricing Plans
    Route::get('subscription-plans',
        [SubscriptionPricingPlanController::class, 'index'])->name('subscription.pricing.plans.index');
    Route::get('payment-method/{id}',
        [SubscriptionPricingPlanController::class, 'paymentMethod'])->name('payment.method');
    // subscription transaction
    Route::post('purchase-subscription',
        [SubscriptionController::class, 'purchaseSubscription'])->name('purchase-subscription');
    Route::get('payment-success', [SubscriptionController::class, 'paymentSuccess'])->name('payment-success');
    Route::get('failed-payment', [SubscriptionController::class, 'handleFailedPayment'])->name('failed-payment');

    // Paypal Routes
    Route::get('paypal-purchase-subscription',
        [PaypalController::class, 'paypalPurchaseSubscription'])->name('paypal.purchase.subscription');
    Route::get('paypal-payment-success',
        [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal.payment.success');
    Route::get('paypal-payment-failed',
        [PaypalController::class, 'paypalPaymentFailed'])->name('paypal.payment.failed');
});

// Admin User Routes 
Route::group([
    'middleware' => [
        'auth', 'xss', 'multi_tenant', 'check_user_status', 'check_super_admin_role', 'check_subscription',
        'role:admin',
    ],
], function () {
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/update-profile-image', [UserController::class, 'updateProfileImage'])->name('update.profile.image');

    Route::get('states-list', [UserController::class, 'getStates'])->name('states-list');
    Route::get('cities-list', [UserController::class, 'getCities'])->name('cities-list');

    //Experience route
    Route::resource('experiences', ExperienceController::class);
    Route::post('experiences/{id}/work-here',
        [ExperienceController::class, 'experienceWorkHere'])->name('experience.work.here');

    //Education route
    Route::resource('educations', EducationController::class);
    Route::post('educations/{id}/study-here',
        [EducationController::class, 'educationStudyHere'])->name('educations.study.here');

    // Vcards route
    Route::resource('vcards', VCardsController::class);

    //Testimonial route
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{id}/update',
        [TestimonialController::class, 'update'])->name('testimonial.update');


    //Skills route
    Route::resource('skills', SkillController::class);

    //Pricing plan route
    Route::resource('pricing-plans', PricingPlanController::class);

    //Plan Currency route
    Route::resource('plan-currencies', PlanCurrencyController::class);

    //Recent work Type route
    Route::resource('recent-work-types', RecentWorkTypeController::class);

    //Recent work route
    Route::resource('recent-works', RecentWorkController::class);
    Route::post('recent-works/{id}/update',
        [RecentWorkController::class, 'update'])->name('recent.work.update');
    Route::delete('recent-works/{media}/attachments-delete',
        [RecentWorkController::class, 'attachmentDelete'])->name('recent.work.attachments-delete');
    Route::get('recent-works/{media}/attachments-download',
        [RecentWorkController::class, 'attachmentDownload'])->name('recent.work.attachments-download');
    Route::get('/recent-works/{id}/all-attachments-download',
        [RecentWorkController::class, 'allAttachmentDownload'])->name('recent.work.all.attachments-download');

    //Services route
    Route::resource('services', ServiceController::class);
    Route::post('services/{id}/update', [ServiceController::class, 'update'])->name('service.update');

    //about_me route
    Route::resource('achievements', AchievementController::class);
    Route::post('achievements/{id}/update', [AchievementController::class, 'update'])->name('achievement-update');

    //Settings route
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::put('settings/social', [SettingController::class, 'updateSocialSetting'])->name('settings.update.social');
    Route::put('settings/theme', [SettingController::class, 'updateTheme'])->name('settings.updateTheme');

    //Enquiry route
    Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::delete('enquiries/{id}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');
    Route::get('enquiries/{id}', [EnquiryController::class, 'show'])->name('enquiries.show');

    //Hire me route
    Route::resource('hire-me', HireRequestController::class);

    //Blogs route
    Route::resource('blogs', BlogController::class);

    //Categories route
    Route::resource('categories', CategoryController::class );
    Route::post('categories-get', [CategoryController::class, 'getCategory'])->name('category.get');

    //followers route
    Route::get('followers', [FollowerController::class, 'index'])->name('followers.index');
    Route::get('following', [FollowingController::class, 'index'])->name('following.index');
    Route::get('unfollow-user', [FollowingController::class, 'unfollowUser'])->name('following.unfollowUser');

    //QR Codes route
    Route::resource('qrcodes', QRCodeController::class);
    Route::get('qrcode-generate', [QRCodeController::class, 'QRCodeGenerator'])->name('qrcodes.generate');
    Route::get('qrcode-download/{id}', [QRCodeController::class, 'qrCodeDownload'])->name('qrcodes.download');
});

Route::group(['middleware' => ['auth', 'xss', 'role:super_admin|admin', 'check_user_status']], function () {
    Route::get('profile/{id}/edit', [UserController::class, 'editProfile'])->name('edit-profile');
    Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password');
});

Route::get('/home', function () {
    return view('web.portfolio');
});
