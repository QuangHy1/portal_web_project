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
use App\Http\Controllers\Employee\EmployeeResumeController;
use App\Http\Controllers\Employer\EmployerHiringController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Employer\PaymentController;
use App\Http\Controllers\Frontend\EmployerDetailsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\JobSearchController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\JobCategoryController as FrontendJobCategoryController;
use App\Http\Controllers\Frontend\RecoverController;
use App\Http\Controllers\Frontend\SigninController;
use App\Http\Controllers\Frontend\SignupController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Employer\EmployerController as EmployerEmployerController;
use App\Http\Controllers\Employee\EmployeeController as EmployeeEmployeeController;
use Illuminate\Support\Facades\Route;



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
// Giao diện nhập email
    Route::get('/admin/password/recover', [AuthController::class, 'recoverAdmin'])->name('admin.recover');
// Gửi OTP qua email
    Route::post('/admin/password/recover/submit', [AuthController::class, 'recoverAdminSubmit'])->name('admin.recover.submit');
// Giao diện nhập OTP
    Route::get('/admin/password/otp', [AuthController::class, 'otpAdminView'])->name('admin.otp');
// Xác thực OTP
    Route::post('/admin/password/verify-otp', [AuthController::class, 'verifyOtpAdmin'])->name('admin.otp.verify');
// Giao diện đặt lại mật khẩu mới
    Route::get('/admin/password/reset', [AuthController::class, 'resetPasswordAdminView'])->name('admin.reset.password.view');
// Gửi mật khẩu mới
    Route::post('/admin/password/reset', [AuthController::class, 'resetPasswordAdminSubmit'])->name('admin.reset.password.submit');

    Route::middleware(['auth', 'admin', 'shareAdminData'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('resumes/{resume}/download', [ResumeController::class, 'download'])->name('admin.resumes.download');

        Route::get('employee_applications/review', [EmployeeApplicationController::class, 'review'])->name('admin.employee_applications.review');
        Route::patch('employee_applications/{employeeApplication}/approve', [EmployeeApplicationController::class, 'approve'])->name('admin.employee_applications.approve');
        Route::patch('employee_applications/{employeeApplication}/reject', [EmployeeApplicationController::class, 'reject'])->name('admin.employee_applications.reject');
        // Các route admin khác
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::post('/admins/update', [AdminController::class, 'update'])->name('admin.admins.update');

        // Các route tùy chỉnh cho duyệt và từ chối
        Route::get('/users/approve', [UserController::class, 'showApprovalList'])->name('admin.users.approve.list');
        Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
        Route::delete('/users/{user}/reject', [UserController::class, 'reject'])->name('admin.users.reject');

        Route::get('/admin/employers/verify-list', [AdminEmployerController::class, 'showVerificationList'])->name('admin.employers.verify_list');
        Route::patch('/admin/employers/{employer}/verify', [AdminEmployerController::class, 'verifyEmail'])->name('admin.employers.verify');

        Route::get('/boost_orders/approve', [BoostOrderController::class, 'showApprovalList'])->name('admin.boost_order.approve.list');
        Route::patch('/boost_orders/{boost_orders}/approve', [BoostOrderController::class, 'approve'])->name('admin.boost_orders.approve');
        Route::delete('/boost_orders/{boost_orders}/reject', [BoostOrderController::class, 'reject'])->name('admin.boost_orders.reject');


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

// Đăng nhập Employer
Route::get('/employer/signin', [SigninController::class, 'index'])->name('employer.signin');
Route::post('/employer/signin-submit', [SigninController::class, 'signinSubmit'])->name('employer.signin.submit');
Route::get('/employer/logout', [SigninController::class, 'employerLogout'])->name('employer.logout');
// Đăng kí Employer
Route::get('/register/employer', [SignupController::class, 'showEmployerForm'])->name('employer.register');
Route::post('/register/employer', [SignupController::class, 'registerEmployer'])->name('employer.register.submit');
// Xác minh email (dùng chung cho cả Employee và Employer)
Route::get('/verify-email', [SignupController::class, 'verifyEmail'])->name('verify.email');

// Giao diện nhập email
Route::get('/employer/password/recover', [RecoverController::class, 'recoverEmployer'])->name('employer.recover');
// Gửi OTP qua email
Route::post('/employer/password/recover/submit', [RecoverController::class, 'recoverEmployerSubmit'])->name('employer.recover.submit');
// Giao diện nhập OTP
Route::get('/employer/password/otp', [RecoverController::class, 'otpEmployerView'])->name('employer.otp');
// Xác thực OTP
Route::post('/employer/password/verify-otp', [RecoverController::class, 'verifyOtpEmployer'])->name('employer.otp.verify');
// Giao diện đặt lại mật khẩu mới
Route::get('/employer/password/reset', [RecoverController::class, 'resetPasswordEmployerView'])->name('employer.reset.password.view');
// Gửi mật khẩu mới
Route::post('/employer/password/reset', [RecoverController::class, 'resetPasswordEmployerSubmit'])->name('employer.reset.password.submit');

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
    Route::delete('/employer/hiring/{id}', [EmployerHiringController::class, 'destroy'])->name('employer.hiring.destroy');


    Route::get('/employer/hiring/applications', [EmployerEmployerController::class, 'viewApplications'])->name('employer.hiring.applications');
    Route::get('/employer/applicants/job/{id}', [EmployerEmployerController::class, 'viewApplicants'])->name('employer.hiring.applicants');
    Route::get('/employer/applications/view-cv/{id}', [EmployerEmployerController::class, 'viewCV'])->name('employer.applications.viewCV');
    //    Route::get('/employer/applicants', CreateChat::class)->name('manage.applications');

    Route::get('/employer/hiring/approve/{id}', [EmployerHiringController::class, 'ApproveJob'])->name('employer.hiring.applicant.approve');
    Route::get('/employer/hiring/reject/{id}', [EmployerHiringController::class, 'RejectJob'])->name('employer.hiring.applicant.reject');

    Route::get('/employer/boost', [EmployerHiringController::class, 'viewDatas'])->name('employer.employee.boost');
    Route::get('/employer/boost/purchase', [EmployerHiringController::class, 'boostPurchase'])->name('employer.boost.purchase');
    Route::post('/employer/boost-now/{id}', [EmployerHiringController::class, 'boostNow'])->name('employer.employee.boost.now');
    Route::post('employer/hiring/boost/revert/{id}', [EmployerHiringController::class, 'revertBoost'])->name('employer.hiring.boost.revert');


    Route::get('/employer/boost/vietqr', [PaymentController::class, 'generateVietQR'])->name('employer.vietqr');
    Route::post('/employer/boost/order', [PaymentController::class, 'storeBoostOrder'])->name('employer.boost.order');
    Route::get('/employer/boost/{id}', [EmployerHiringController::class, 'boostData'])->name('employer.employee.boost.submit');
    Route::post('/employer/boost/confirm-payment', [PaymentController::class, 'confirmPayment'])->name('employer.boost.confirmPayment');

    Route::get('/employer/password/change', [SigninController::class, 'changePasswordEmployer'])->name('employer.password.change');
    Route::post('/employer/password/change/confirm', [SigninController::class, 'changePasswordEmployerConfirm'])->name('employer.password.change.confirm');
});


// Route cho Employee

// Đăng nhập Employee
Route::get('/employee/signin', [SigninController::class, 'employee'])->name('employee.signin');
Route::post('/employee/signin-submit', [SigninController::class, 'signinSubmitEmployee'])->name('employee.signin.submit');
Route::get('/employee/logout', [SigninController::class, 'employeeLogout'])->name('employee.logout');
// Đăng kí Employee
Route::get('/register/employee', [SignupController::class, 'showEmployeeForm'])->name('employee.register');
Route::post('/register/employee', [SignupController::class, 'registerEmployee'])->name('employee.register.submit');


// Giao diện nhập email
Route::get('/employee/password/recover', [RecoverController::class, 'recoverEmployee'])->name('employee.recover');
// Gửi OTP qua email
Route::post('/employee/password/recover/submit', [RecoverController::class, 'recoverEmployeeSubmit'])->name('employee.recover.submit');
// Giao diện nhập OTP
Route::get('/employee/password/otp', [RecoverController::class, 'otpEmployeeView'])->name('employee.otp');
// Xác thực OTP
Route::post('/employee/password/verify-otp', [RecoverController::class, 'verifyOtpEmployee'])->name('employee.otp.verify');
// Giao diện đặt lại mật khẩu mới
Route::get('/employee/password/reset', [RecoverController::class, 'resetPasswordEmployeeView'])->name('employee.reset.password.view');
// Gửi mật khẩu mới
Route::post('/employee/password/reset', [RecoverController::class, 'resetPasswordEmployeeSubmit'])->name('employee.reset.password.submit');


Route::prefix('employee')->middleware(['employee'])->group(function () {
    Route::get('/dashboard', [EmployeeEmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('/employee/job/applied', [JobController::class, 'getApplied'])->name('employee.job.applied');

    // Trang quản lý và upload CV
    Route::get('/resumes', [EmployeeResumeController::class, 'create'])->name('employee.resumes.create');
    Route::post('/resumes', [EmployeeResumeController::class, 'store'])->name('employee.resumes.store');
    Route::delete('/resumes/{id}', [EmployeeResumeController::class, 'destroy'])->name('employee.resumes.destroy');
    Route::get('/resumes/download/{id}', [EmployeeResumeController::class, 'download'])->name('employee.resumes.download');


    Route::get('/employee/profile', [EmployeeEmployeeController::class, 'updateProfile'])->name('employee.profile');
    Route::post('/employee/profile/edit', [EmployeeEmployeeController::class, 'updateProfileConfirm'])->name('employee.profile.edit');
    Route::post('/employee/profile/social/edit', [EmployeeEmployeeController::class, 'updateProfileSocial'])->name('employee.profile.social.edit');

    Route::get('/employee/password/change', [SigninController::class, 'changePasswordEmployee'])->name('employee.password.change');
    Route::post('/employee/password/change/confirm', [SigninController::class, 'changePasswordEmployeeConfirm'])->name('employee.password.change.confirm');

    Route::get('/employee/apply/{id}', [EmployeeEmployeeController::class, 'apply'])->name('employee.apply');
    Route::post('/employee/apply/confirm/{id}', [EmployeeEmployeeController::class, 'applyConfirm'])->name('employee.apply.confirm');

    Route::get('/employee/job/bookmark/{id}', [EmployeeEmployeeController::class, 'addBookmark'])->name('employee.job.bookmark');
    Route::get('/employee/job/bookmarks', [EmployeeEmployeeController::class, 'checkBookmark'])->name('employee.job.bookmarks');
    Route::get('/employee/job/bookmark/delete/{id}', [EmployeeEmployeeController::class, 'deleteBookmark'])->name('bookmark.delete');
    Route::get('/employee/delete', function () {return view('employee.deleteaccount');})->name('employee.delete');

    //    Route::get('/admin/employee/delete/{id}', [EmployeeEmployeeController::class, 'terminateEmployee'])->name('admin.employee.delete');
    Route::post('/admin/employee/delete/{id}', [EmployeeEmployeeController::class, 'terminateEmployee'])->name('admin.employee.delete');

});
