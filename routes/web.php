<?php

use App\Http\Controllers\AspectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\GradeRangeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportAdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeTableController;
use App\Models\Document;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Testing
// Route::get('/test-email', function () {
//     return view('emails.unsubscribe-confirm');
// });

// API Routes
Route::get('api/interns', [DocumentController::class, 'getInterns'])->name('api.interns');
Route::get('/api/tags', [TagController::class, 'getTagList'])->name('api.tags');
Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('upload.image');
Route::post('/api/check-late', [ReportController::class, 'checkLate'])->name('api.check.late');
Route::get('/api/tasks/{task_id}/data', [EvaluationController::class, 'getTaskData'])->name('api.task.data');
Route::get('/api/fetchIntern{internId}', [CertificateController::class, 'fetchIntern'])->name('api.intern.data');
Route::get('/get-positions/{periode_id}', [InternController::class, 'getAvailablePositions'])->name('available.position');
Route::get('/get-positions/{periode_id}/{current_position_id?}', [InternController::class, 'getAvailablePositionsAndCurrentPosition'])->name('available.current.position');


// Registration
Route::resource('/register', RegistrationController::class);
Route::get('/{locale}/apply/{slug}', [RegistrationController::class, 'showBySlug'])->name('register.showBySlug');

// Subscription
// Route::resource('subscriptions', SubscriptionController::class);
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
Route::get('/unsubscribe/{email}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/unsubscribe/{email}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/re-subscribe', [SubscriptionController::class, 'reSubscribe'])->name('re-subscribe');

// Comments & Replies
Route::post('comment-reply', [CommentController::class, 'commentAndReply'])->name('comment.reply');


// Authentication
Route::prefix('/{locale}')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Front - Blog
Route::prefix('/{locale}/blog')->group(function () {
    Route::get('/', [HomeController::class, 'blog'])->name('home.blog');
    Route::get('/{slug}', [HomeController::class, 'detail'])->name('home.blog.detail');
    Route::get('/category/{slug}', [HomeController::class, 'detailCategory'])->name('home.blog.category');
    Route::get('/tag/{slug}', [HomeController::class, 'detailTag'])->name('home.blog.tag');
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resources([
        'users' => UserController::class,
        'intern' => InternController::class,
        'position' => PositionController::class,
        'periode' => PeriodeController::class,
        'blog-categories' => BlogCategoryController::class,
        'tags' => TagController::class,
        'documents' => DocumentController::class,
        'subscriptions' => SubscriptionController::class,
        'log-activities' => LogActivityController::class,
        'time-tables' => TimeTableController::class,
        'aspects' => AspectController::class,
        'tasks' => TaskController::class,
        'evaluations' => EvaluationController::class,
        'evaluators' => EvaluatorController::class,
        'grade-ranges' => GradeRangeController::class,
        'certificates' => CertificateController::class
    ]);

    Route::post('/check-position', [PeriodeController::class, 'checkPosition'])->name('check.position');
    Route::get('/admin/profile', [ProfileController::class, 'admin'])->name('admin.profile');
    Route::put('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::prefix('intern')->group(function () {
        Route::get('/download/{id}', [InternController::class, 'download'])->name('intern.download');
        Route::post('/restore/{id}', [InternController::class, 'restore'])->name('intern.restore');
        Route::delete('/force-delete/{id}', [InternController::class, 'forceDelete'])->name('intern.forceDelete');
    });

    Route::get('/getPeriodeId/{positionId}', [InternController::class, 'getPeriodeId'])->name('get.periode.id');

    Route::prefix('position')->group(function () {
        Route::post('/restore/{id}', [PositionController::class, 'restore'])->name('position.restore');
        Route::delete('/force-delete/{id}', [PositionController::class, 'forceDelete'])->name('position.forceDelete');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportAdminController::class, 'index'])->name('reports.index');
        Route::get('/{id}', [ReportAdminController::class, 'getInternsByPeriode'])->name('reports.periode.interns');
        Route::get('/intern/{id}', [ReportAdminController::class, 'getReportByIntern'])->name('reports.intern.daily');
        Route::get('/lateness/{id}', [ReportAdminController::class, 'getLatenessDetails'])->name('report.intern.lateness');
        Route::post('/verify/{id}', [ReportAdminController::class, 'verifyReport'])->name('report.intern.verify');
        Route::post('/reject/{id}', [ReportAdminController::class, 'rejectReport'])->name('report.intern.reject');
    });

    Route::prefix('admin/export')->group(function () {
        Route::get('/internByPeriode/{periodeId}', [ReportAdminController::class, 'exportPDFIntern'])->name('export.pdf.intern');
        Route::get('/reportByIntern/{internId}', [ReportAdminController::class, 'exportPDFReport'])->name('export.pdf.report');
    });

    Route::prefix('technical-aspects')->group(function () {
        Route::get('/', [AspectController::class, 'indexTechnical'])->name('technical-aspects.index');
        Route::get('/create', [AspectController::class, 'createTechnical'])->name('technical-aspects.create');
        Route::post('/store', [AspectController::class, 'storeTechnical'])->name('technical-aspects.store');
        Route::get('/{id}', [AspectController::class, 'showTechnical'])->name('technical-aspects.show');
        Route::get('/{id}/edit', [AspectController::class, 'editTechnical'])->name('technical-aspects.edit');
        Route::put('/{id}', [AspectController::class, 'updateTechnical'])->name('technical-aspects.update');
        Route::delete('/{id}', [AspectController::class, 'destroyTechnical'])->name('technical-aspects.destroy');
        Route::post('/positions/swap', [AspectController::class, 'swapPositions'])->name('techincal-aspects.positions.swap');
    });

    Route::prefix('non-technical-aspects')->group(function () {
        Route::get('/', [AspectController::class, 'indexNonTechnical'])->name('non-technical-aspects.index');
        Route::get('/create', [AspectController::class, 'createNonTechnical'])->name('non-technical-aspects.create');
        Route::post('/store', [AspectController::class, 'storeNonTechnical'])->name('non-technical-aspects.store');
        Route::get('/{id}', [AspectController::class, 'showNonTechnical'])->name('non-technical-aspects.show');
        Route::get('/{id}/edit', [AspectController::class, 'editNonTechnical'])->name('non-technical-aspects.edit');
        Route::put('/{id}', [AspectController::class, 'updateNonTechnical'])->name('non-technical-aspects.update');
        Route::delete('/{id}', [AspectController::class, 'destroyNonTechnical'])->name('non-technical-aspects.destroy');
    });

    Route::prefix('evaluations')->group(function () {
        Route::get('/{internId}/task/{taskId}', [EvaluationController::class, 'showTask'])->name('evaluations.detail.task');
        Route::get('/{internId}/final-score', [EvaluationController::class, 'finalScore'])->name('evaluations.final.score');
        Route::get('/{internId}/export/final-score', [EvaluationController::class, 'exportFinalScorePDF'])->name('evaluations.final.score.export');
        Route::get('/{internId}/task/{taskId}/export/evaluation-task', [EvaluationController::class, 'exportEvaluationTaskPDF'])->name('evaluations.task.score.export');
    });

    Route::prefix('certificates')->group(function () {
        Route::get('/certificate-pdf/{internId}', [CertificateController::class, 'generateCertificatePDF'])->name('certificate.pdf');
        Route::get('/export-pdf/{internId}', [CertificateController::class, 'exportCertificatePDF'])->name('export.certificate');
        Route::post('/send-pdf/{internId}', [CertificateController::class, 'sendCertificate'])->name('send.certificate');

    });

});

// User
Route::middleware(['auth', 'user'])->group(function () {
    Route::resources([
        'daily-reports' => ReportController::class,
        'social-medias' => SocialMediaController::class,
    ]);

    Route::get('/profile', [ProfileController::class, 'user'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateUser'])->name('profile.update');
    Route::get('/intern/export/reportByIntern/{internId}', [ReportController::class, 'reportByInternPDF'])->name('intern.export.report.pdf');
    Route::get('document', [DocumentController::class, 'internDocument'])->name('document');
    Route::get('document/detail/{slug}', [DocumentController::class, 'internDocumentDetail'])->name('document.detail');
    Route::put('/daily-reports/late/{reportId}', [ReportController::class, 'updateIsLate'])->name('daily-reports.updateLate');
    Route::get('/report/detail/{id}', [ReportController::class, 'show'])->name('report.detail');

});

// Both
Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::resource('comments', CommentController::class);
    Route::get('/comments/{slug}', [CommentController::class, 'show'])->name('comments.show');
    Route::get('blogs/{locale}/{slug}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('blogs/{locale}/edit/{slug}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/update/{slug}', [BlogController::class, 'update'])->name('blogs.update');
    Route::put('blogs/publish/{slug}/', [BlogController::class, 'publish'])->name('blogs.publish');
    Route::delete('blogs/destroy/{slug}', [BlogController::class, 'destroy'])->name('blogs.destroy');

});

// Landing
Route::get('/{locale}', [HomeController::class, 'index'])->name('home');
Route::get('/', fn() => redirect('/id'))->name('default');

// Rute 404
Route::fallback(function () {
    return response()->view('components.error', [], 404);
});
// Admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('users', UserController::class);
//     Route::resource('intern', InternController::class);
//     Route::resource('position', PositionController::class);
//     Route::resource('periode', PeriodeController::class);
//     Route::post('/check-position', [PeriodeController::class, 'checkPosition'])->name('check.position');
//     Route::resource('blog-categories', BlogCategoryController::class);
//     Route::resource('tags', TagController::class);
//     Route::get('/admin/profile', [ProfileController::class, 'admin'])->name('admin.profile');
//     Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
//     Route::put('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');;
//     Route::get('/intern/download/{id}', [InternController::class, 'download'])->name('intern.download');
//     Route::post('/intern/restore/{id}', [InternController::class, 'restore'])->name('intern.restore');
//     Route::delete('/intern/force-delete/{id}', [InternController::class, 'forceDelete'])->name('intern.forceDelete');
//     Route::post('/position/restore/{id}', [PositionController::class, 'restore'])->name('position.restore');
//     Route::delete('/position/force-delete/{id}', [PositionController::class, 'forceDelete'])->name('position.forceDelete');

//     // Route::get('report/admin', [ReportAdminController::class, 'index'])->name('report.admin.index');
    //     Route::get('/getPeriodeId/{positionId}', [InternController::class, 'getPeriodeId'])->name('get.periode.id');

//     Route::get('/admin/report', [ReportAdminController::class, 'index'])->name('admin.report.index');
//     Route::get('/admin/intern/{id}', [ReportAdminController::class, 'getInternsByPeriode'])->name('admin.intern.periode');
//     Route::get('/admin/daily/{id}', [ReportAdminController::class, 'getReportByIntern'])->name('admin.report.intern');
//     Route::post('/admin/report/verify/{id}', [ReportAdminController::class, 'verifyReport'])->name('admin.report.verify');
//     Route::get('/admin/report/status',  [ReportAdminController::class, 'getStatus'])->name('admin.report.status');
//     Route::post('/admin/report/{id}/verify-all', [ReportAdminController::class, 'verifAll'])->name('report.verifyAll');
//     Route::get('/admin/intern/detail/{id}', [ReportAdminController::class, 'getInternDetail'])->name('admin.intern.detail');
//     Route::get('/admin/export/internByPeriode/{periodeId}', [ReportAdminController::class, 'internByPeriodePDF'])->name('admin.export.intern.pdf');
//     Route::get('/admin/export/reportByIntern/{internId}', [ReportAdminController::class, 'reportByInternPDF'])->name('admin.export.report.pdf');
//     Route::resource('evaluations', EvaluationController::class);
// });

// Both
// Route::resource('blogs', BlogController::class);
// Route::get('blogs/{locale}/{slug}', [BlogController::class, 'show'])->name('blogs.show');
// Route::get('blogs/{locale}/edit/{slug}', [BlogController::class, 'edit'])->name('blogs.edit');
// Route::put('blogs/update/{slug}', [BlogController::class, 'update'])->name('blogs.update');
// Route::put('blogs/{slug}/publish', [BlogController::class, 'publish'])->name('blogs.publish');
// Route::post('blogs/destroy/{slug}', [BlogController::class, 'destroy'])->name('blogs.destroy');

// User
// Route::middleware(['auth', 'user'])->group(function () {
//     Route::resource('reports', ReportController::class);
//     Route::resource('social-medias', SocialMediaController::class);
//     Route::get('/profile', [ProfileController::class, 'user'])->name('profile');
//     Route::put('/profile', [ProfileController::class, 'updateUser'])->name('profile.update');
//     Route::get('/intern/export/reportByIntern/{internId}', [ReportController::class, 'reportByInternPDF'])->name('intern.export.report.pdf');
//     Route::get('evaluation', [EvaluationController::class, 'InternEvaluation'])->name('evaluation');
//     Route::get('evaluation/detail/{slug}', [EvaluationController::class, 'InternEvaluationDetail'])->name('evaluation.detail');
// });

// Landing
// Route::get('/{locale}', function ($locale) {
//     session(['locale' => $locale]);
//     return redirect()->back();
// })->name('change.language');

// Route::get('/{locale}', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return redirect('/id');
// });
