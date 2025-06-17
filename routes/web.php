<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('back-account')->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthenticationController::class, 'loginPage']);
        Route::post('/', [AuthenticationController::class, 'login']);
    });

    Route::prefix('register')->group(function () {
        Route::get('/', [AuthenticationController::class, 'registerPage']);
        Route::post('/', [AuthenticationController::class, 'register']);
        Route::get('/activation/{email}', [AuthenticationController::class, 'activateAccountPage']);
        Route::post('/activation/{email}', [AuthenticationController::class, 'activateAccount']);
    });

    Route::get('/forgot-password', [AuthenticationController::class, 'forgotPasswordPage']);
    Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('/check-verification', [AuthenticationController::class, 'checkVerification'])->name('check.verification');

    Route::prefix('reset-password')->group(function () {
        Route::get('/', [AuthenticationController::class, 'resetPasswordPage']);
        Route::post('/', [AuthenticationController::class, 'resetPassword']);
    });
});

Route::middleware('check-auth')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', [AuthenticationController::class, 'profile']);
        Route::post('/', [AuthenticationController::class, 'editProfile']);
    });

    Route::get('/home', [HomeController::class, 'homePage'])->middleware('regular-user');

    Route::prefix('edit-password')->group(function () {
        Route::get('/', [AuthenticationController::class, 'editPasswordPage']);
        Route::post('/', [AuthenticationController::class, 'editPassword']);
    });

    Route::get('/logout', [AuthenticationController::class, 'logout']);

    Route::prefix('sections')->group(function () {
        Route::get('/', [SectionController::class, 'getSectionsPage']);

        Route::prefix('add')->middleware('service-provider')->group(function () {
            Route::get('/', [SectionController::class, 'addSectionPage'])->middleware('service-provider');
            Route::post('/', [SectionController::class, 'addSection'])->middleware('service-provider');
        });

        Route::prefix('update')->middleware('multiple-auth')->group(function () {
            Route::get('/{section}', [SectionController::class, 'editSectionPage']);
            Route::post('/{section}', [SectionController::class, 'editSection']);
        });

        Route::get('delete/{section}', [SectionController::class, 'deleteSection'])->middleware('multiple-auth');
    });

    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'getServicesPage']);
        Route::get('/{section}', [ServiceController::class, 'getSectionServicesPage']);
        Route::get('/details/{service}', [ServiceController::class, 'getServiceInformationPage']);
        Route::prefix('add')->middleware('service-provider')->group(function () {
            Route::get('/{section}', [ServiceController::class, 'addServicePage']);
            Route::post('/{section}', [ServiceController::class, 'addService']);
        });
        Route::prefix('update')->middleware('multiple-auth')->group(function () {
            Route::get('/{service}', [ServiceController::class, 'editServicePage']);
            Route::post('/{service}', [ServiceController::class, 'editService']);
            Route::get('delete/{service_image}', [ServiceController::class, 'deleteServiceImage']);
        });
        Route::get('/delete/{service}', [ServiceController::class, 'deleteService'])->middleware('multiple-auth');
    });

    Route::prefix('service_types')->middleware('admin-auth')->group(function () {
        Route::get('/', [ServiceTypeController::class, 'getServiceTypesPage']);
        Route::prefix('add')->group(function () {
            Route::get('/', [ServiceTypeController::class, 'addServiceTypePage']);
            Route::post('/', [ServiceTypeController::class, 'addServiceType']);
        });
        Route::prefix('update')->group(function () {
            Route::get('/{service_type}', [ServiceTypeController::class, 'editServiceTypePage']);
            Route::post('/{service_type}', [ServiceTypeController::class, 'editServiceType']);
        });
        Route::get('/delete/{service_type}', [ServiceTypeController::class, 'deleteServiceType']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'getPostsPage']);
        Route::post('/', [PostController::class, 'addPost'])->middleware('service-provider');
        Route::post('/{post}', [PostController::class, 'editPost'])->middleware('multiple-auth');
        Route::get('/delete/{post}', [PostController::class, 'deletePost'])->middleware('multiple-auth');
    });

    Route::prefix('about_us')->group(function () {
        Route::get('/', [AboutUsController::class, 'getAboutUsPage']);
        Route::get('/edit', [AboutUsController::class, 'editAboutUsPage'])->middleware('admin-auth');
        Route::post('/edit', [AboutUsController::class, 'editAboutUs'])->middleware('admin-auth');
        Route::get('/delete/{image}', [AboutUsController::class, 'deleteAboutUsImage'])->middleware('admin-auth');
    });

    Route::prefix('users')->middleware('admin-auth')->group(function () {
        Route::get('/', [UserController::class, 'getUsersPage']);
        Route::get('/{user}', [UserController::class, 'setActivation']);
        Route::prefix('add')->group(function () {
            Route::get('/', [UserController::class, 'addUserPage']);
            Route::post('/', [UserController::class, 'addUser']);
        });
        Route::prefix('update')->group(function () {
            Route::get('/{user}', [UserController::class, 'editUserPage']);
            Route::post('/{user}', [UserController::class, 'editUser']);
        });
        Route::get('/delete/{user}', [UserController::class, 'deleteUser']);
    });

    Route::post('/rating/{service}', [RateController::class, 'rating'])->middleware('regular-user');
    Route::get('/rating/delete/{rate}', [RateController::class, 'deleteRate'])->middleware('multiple-auth');

    Route::prefix('notifications')->middleware('admin-auth')->group(function () {
        Route::get('/', [NotificationController::class, 'notificationsPage']);
        Route::get('/delete/{notification}', [NotificationController::class, 'deleteNotification']);
    });

    Route::prefix('comments')->middleware('regular-user')->group(function () {
        Route::post('/{post}', [CommentController::class, 'createComment']);
        Route::get('/{comment}', [CommentController::class, 'deleteComment']);
    });

    Route::prefix('reports')->group(function () {
        Route::middleware('admin-auth')->group(function () {
            Route::get('/', [ReportController::class, 'getReports']);
            Route::get('/{report}', [ReportController::class, 'deleteReport']);
        });
        Route::post('/{service}', [ReportController::class, 'reportingService'])->middleware('regular-user');
    });

    Route::prefix('supports')->group(function () {
        Route::middleware('support')->prefix('create')->group(function () {
            Route::get('/', [SupportController::class, 'createSupportPage']);
            Route::post('/', [SupportController::class, 'askingSupport']);
        });
        Route::get('/', [SupportController::class, 'getSupports'])->middleware('admin-auth');
    });

    Route::prefix('questions')->group(function () {
        Route::get('/', [QuestionController::class, 'getQuestions']);
        Route::middleware('regular-user')->group(function () {
            Route::post('/', [QuestionController::class, 'createQuestion']);
            Route::post('/{question}', [QuestionController::class, 'editQuestion']);
            Route::get('/delete/{question}', [QuestionController::class, 'deleteQuestion']);
        });
    });

    Route::prefix('answers')->group(function () {
        Route::get('/{question}', [AnswerController::class, 'getAnswers']);
        Route::middleware('service-provider')->group(function () {
            Route::post('/{question}', [AnswerController::class, 'answeringQuestion']);
            Route::get('/delete/{answer}', [AnswerController::class, 'deleteAnswer']);
        });
    });
});