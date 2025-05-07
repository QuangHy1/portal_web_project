<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BoostOrderController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\Admin\EmployeeApplicationController;
use App\Http\Controllers\Admin\EmployeeBookmarkController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController; // Có thể gây nhầm lẫn
use App\Http\Controllers\Admin\EmployerController as AdminEmployerController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FooterContentController;
use App\Http\Controllers\Admin\HiringController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\JobCategoryController as AdminJobCategoryController;
use App\Http\Controllers\Admin\JobTypeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PageHomeItemController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalaryRangeController;
use App\Http\Controllers\Admin\TopBarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserTestimonialController;
use App\Http\Controllers\Admin\VacancyController;
//use App\Http\Controllers\Auth\EmployeeAuthController; // Đặt ở đây cho rõ ràng
use App\Http\Controllers\Employer\EmployerHiringController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Frontend\EmployerDetailsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\JobSearchController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\JobCategoryController as FrontendJobCategoryController;
use App\Http\Controllers\Frontend\SigninController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Employer\EmployerController as EmployerEmployerController;
use App\Http\Livewire\Chat\CreateChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [TermsController::class, 'index'])->name('terms');
Route::get('/categories', [FrontendJobCategoryController::class, 'categories'])->name('category');
Route::get('/post/{slug}', [FrontendPostController::class, 'postDetails'])->name('post');
Route::get('/job/{id}', [JobController::class, 'jobDetails'])->name('jobs');
Route::get('/jobs', [JobSearchController::class, 'index'])->name('job.search');
Route::get('/employer/details/{id}', [EmployerDetailsController::class, 'employerDetails'])->name('employer.details');
Route::get('/employer/browse', [EmployerDetailsController::class, 'browseEmployer'])->name('employer.browse');

// Route cho Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'admin', 'shareAdminData'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('resumes/{resume}/download', [ResumeController::class, 'download'])->name('admin.resumes.download');

        Route::get('employee_applications/review', [EmployeeApplicationController::class, 'review'])->name('admin.employee_applications.review');
        Route::patch('employee_applications/{employeeApplication}/approve', [EmployeeApplicationController::class, 'approve'])->name('admin.employee_applications.approve');
        Route::patch('employee_applications/{employeeApplication}/reject', [EmployeeApplicationController::class, 'reject'])->name('admin.employee_applications.reject');
        // Các route admin khác
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::post('/admins/update', [AdminController::class, 'update'])->name('admin.admins.update');

        // Các route tùy chỉnh cho duyệt và từ chối người dùng
        Route::get('/users/approve', [UserController::class, 'showApprovalList'])->name('admin.users.approve.list');
        Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
        Route::delete('/users/{user}/reject', [UserController::class, 'reject'])->name('admin.users.reject');

        // Route resource cho users (định nghĩa SAU các route tùy chỉnh)
        Route::resource('users', UserController::class, ['names' => 'admin.users']);
        Route::resource('roles', RoleController::class, ['names' => 'admin.roles']);
        Route::resource('companies', CompanyController::class, ['names' => 'admin.companies']);
        Route::resource('editors', EditorController::class, ['names' => 'admin.editors']);
        Route::resource('posts', AdminPostController::class, ['names' => 'admin.posts']);
        Route::resource('top_bars', TopBarController::class, ['names' => 'admin.top_bars']);
        Route::resource('page_home_items', PageHomeItemController::class, ['names' => 'admin.page_home_items']);
        Route::resource('footer_contents', FooterContentController::class, ['names' => 'admin.footer_contents']);
        Route::resource('user_testimonials', UserTestimonialController::class, ['names' => 'admin.user_testimonials']);
        Route::resource('job_categories', AdminJobCategoryController::class, ['names' => 'admin.job_categories']);
        Route::resource('job_types', JobTypeController::class, ['names' => 'admin.job_types']);
        Route::resource('experiences', ExperienceController::class, ['names' => 'admin.experiences']);
        Route::resource('salary_ranges', SalaryRangeController::class, ['names' => 'admin.salary_ranges']);
        Route::resource('vacancies', VacancyController::class, ['names' => 'admin.vacancies']);
        Route::resource('locations', LocationController::class, ['names' => 'admin.locations']);
        Route::resource('hirings', HiringController::class, ['names' => 'admin.hirings']);
        Route::resource('industries', IndustryController::class, ['names' => 'admin.industries']);
        Route::resource('employers', AdminEmployerController::class, ['names' => 'admin.employers']);
        Route::resource('resumes', ResumeController::class, ['names' => 'admin.resumes']);
        Route::resource('employee_applications', EmployeeApplicationController::class, ['names' => 'admin.employee_applications']);
        Route::resource('employee_bookmarks', EmployeeBookmarkController::class, ['names' => 'admin.employee_bookmarks']);
        Route::resource('employees', AdminEmployeeController::class, ['names' => 'admin.employees']);
        Route::resource('packages', PackageController::class, ['names' => 'admin.packages']);
        Route::resource('boost_orders', BoostOrderController::class, ['names' => 'admin.boost_orders']);
    });
});

// Route cho Employer
//Route::get('/employer/verify-email/{token}/{email}', [SignupController::class, 'verifyEmail'])->name('verify.email');
//Route::get('/employer/recover', [RecoverController::class, 'recoverEmployer'])->name('employer.recover');
//Route::get('/employer/recover/{token}/{email}', [RecoverController::class, 'resetPassword'])->name('employer.recover.password');
//Route::post('/employer/recoverSubmit', [RecoverController::class, 'recoverEmployerSubmit'])->name('employer.recover.submit');
//Route::post('/employer/recoverPasswordSubmit', [RecoverController::class, 'resetPasswordSubmit'])->name('employer.recover.password.submit');

Route::get('/employer/signin', [SigninController::class, 'index'])->name('employer.signin');
Route::post('/employer/signin-submit', [SigninController::class, 'signinSubmit'])->name('employer.signin.submit');
Route::get('/employer/logout', [SigninController::class, 'employerLogout'])->name('employer.logout');

Route::prefix('employer')->middleware(['employer'])->group(function () {
    Route::get('/dashboard', [EmployerEmployerController::class, 'index'])->name('employer.dashboard');
    Route::get('/employer/payment', [EmployerEmployerController::class, 'payment'])->name('employer.payment');

    Route::get('/change-password', [SigninController::class, 'changePasswordEmployer'])->name('employer.change_password');
    Route::post('/change-password', [SigninController::class, 'changePasswordEmployerConfirm'])->name('employer.change_password.confirm');

    Route::get('/employer/profile', [EmployerProfileController::class, 'index'])->name('employer.profile');
    Route::post('/employer/profile/edit', [EmployerProfileController::class, 'edit'])->name('employer.profile.edit');
    Route::post('/employer/profile/openinghour/edit', [EmployerProfileController::class, 'openingHours'])->name('employer.profile.openinghour.edit');
    Route::post('/employer/profile/sociallinks/edit', [EmployerProfileController::class, 'socialLinks'])->name('employer.profile.sociallink.edit');
    Route::post('/employer/profile/contact/edit', [EmployerProfileController::class, 'contact'])->name('employer.profile.contact.edit');

    Route::get('/employer/hiring/post', [EmployerHiringController::class, 'index'])->name('employer.hiring.view');
    Route::post('/employer/hiring/add', [EmployerHiringController::class, 'addData'])->name('employer.hiring.add');
    Route::get('/employer/hirings/', [EmployerHiringController::class, 'viewData'])->name('employer.hiring.list');
    Route::get('/employer/hiring/edit/{id}', [EmployerHiringController::class, 'editData'])->name('employer.hiring.edit');
    Route::post('/employer/hiring/update/{id}', [EmployerHiringController::class, 'updateData'])->name('employer.hiring.update');

    Route::get('/employer/hiring/applications', [EmployerEmployerController::class, 'viewApplications'])->name('employer.hiring.applications');
    Route::get('/employer/applicants/job/{id}', [EmployerEmployerController::class, 'viewApplicants'])->name('employer.hiring.applicants');
    Route::get('/employer/applications/view-cv/{id}', [EmployerEmployerController::class, 'viewCV'])->name('employer.applications.viewCV');
    //    Route::get('/employer/applicants', CreateChat::class)->name('manage.applications');

    Route::get('/employer/hiring/approve/{id}', [EmployerHiringController::class, 'ApproveJob'])->name('employer.hiring.applicant.approve');
    Route::get('/employer/hiring/reject/{id}', [EmployerHiringController::class, 'RejectJob'])->name('employer.hiring.applicant.reject');

    Route::get('/employer/boost', [EmployerHiringController::class, 'viewDatas'])->name('employer.employee.boost');
    Route::get('/employer/boost/{id}', [EmployerHiringController::class, 'boostData'])->name('employer.employee.boost.submit');

    Route::get('/employer/password/change', [SigninController::class, 'changePasswordEmployer'])->name('employer.password.change');
    Route::post('/employer/password/change/confirm', [SigninController::class, 'changePasswordEmployerConfirm'])->name('employer.password.change.confirm');
});


// Route cho Employee
Route::get('/employee/signin', [SigninController::class, 'employee'])->name('employee.signin');
Route::post('/employee/signin-submit', [SigninController::class, 'signinSubmitEmployee'])->name('employee.signin.submit');
Route::get('/employee/logout', [SigninController::class, 'employeeLogout'])->name('employee.logout');

Route::prefix('employee')->middleware(['employee'])->group(function () {
    Route::get('/dashboard', [EmployeeDController::class, 'index'])->name('employee.dashboard');
    Route::get('/change-password', [SigninController::class, 'changePasswordEmployee'])->name('employee.change_password');
    Route::post('/change-password', [SigninController::class, 'changePasswordEmployeeConfirm'])->name('employee.change_password.confirm');
});
