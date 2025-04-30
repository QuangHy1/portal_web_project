<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\Admin\EmployeeApplicationController;
use App\Http\Controllers\Admin\EmployeeBookmarkController;
use App\Http\Controllers\Admin\EmployeeController; // Có thể gây nhầm lẫn
use App\Http\Controllers\Admin\EmployerController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FooterContentController;
use App\Http\Controllers\Admin\HiringController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\JobCategoryController as AdminJobCategoryController;
use App\Http\Controllers\Admin\JobTypeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PageHomeItemController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalaryRangeController;
use App\Http\Controllers\Admin\TopBarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserTestimonialController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Auth\EmployeeAuthController; // Đặt ở đây cho rõ ràng
use App\Http\Controllers\Frontend\EmployerDetailsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\JobSearchController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\JobCategoryController as FrontendJobCategoryController;
use App\Http\Controllers\Frontend\TermsController;
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
        Route::resource('employers', EmployerController::class, ['names' => 'admin.employers']);
        Route::resource('resumes', ResumeController::class, ['names' => 'admin.resumes']);
        Route::resource('employee_applications', EmployeeApplicationController::class, ['names' => 'admin.employee_applications']);
        Route::resource('employee_bookmarks', EmployeeBookmarkController::class, ['names' => 'admin.employee_bookmarks']);
        Route::resource('employees', EmployeeController::class, ['names' => 'admin.employees']); // Có thể gây nhầm lẫn
    });
});

// Route cho Employee
Route::prefix('employee')->group(function () {
    Route::get('/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
    Route::post('/login', [EmployeeAuthController::class, 'login'])->name('employee.login.submit');
    Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
    Route::get('/dashboard', function () {
        // Kiểm tra xem user đã đăng nhập chưa.
        if (Auth::guard('employee')->check()) {
            return view('employee.dashboard'); // Tạo view này
        } else {
            return redirect()->route('employee.login'); // Chuyển hướng nếu chưa đăng nhập
        }
    })->name('employee.dashboard');
});
