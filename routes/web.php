<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\Admin\EmployeeApplicationController;
use App\Http\Controllers\Admin\EmployeeBookmarkController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployerController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FooterContentController;
use App\Http\Controllers\Admin\HiringController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\JobTypeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PageHomeItemController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalaryRangeController;
use App\Http\Controllers\Admin\TopBarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserTestimonialController;
use App\Http\Controllers\Admin\VacancyController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth', 'admin','shareAdminData'])->group(function () {
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
    Route::resource('posts', PostController::class, ['names' => 'admin.posts']);
    Route::resource('top_bars', TopBarController::class, ['names' => 'admin.top_bars']);
    Route::resource('page_home_items', PageHomeItemController::class, ['names' => 'admin.page_home_items']);
    Route::resource('footer_contents', FooterContentController::class, ['names' => 'admin.footer_contents']);
    Route::resource('user_testimonials', UserTestimonialController::class, ['names' => 'admin.user_testimonials']);
    Route::resource('job_categories', JobCategoryController::class, ['names' => 'admin.job_categories']);
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
    Route::resource('employees', EmployeeController::class, ['names' => 'admin.employees']);
});
