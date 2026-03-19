<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RelevanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Exports\AnimalsChartExport;
use App\Exports\AdocoesChartExport;
use App\Exports\AdoptionsChartExport;
use App\Exports\MicrochipsChartExport;
use App\Exports\EntradasChartExport;
use App\Http\Controllers\FormsController;
use Illuminate\Container\Attributes\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

Route::get('/', [HomeController::class, 'show']);

Route::get('/about', [AboutController::class, 'show']);

Route::get('/gallery', [GalleryController::class, 'show']);

Route::get('/animal/{id}', [DetailsController::class, 'show']);

Route::post('/animal/{id}/store', [DetailsController::class, 'store']);

Route::get('/form-adoption/{id}', [FormsController::class, 'showAdoptionForm']);

Route::post('/form-adoption/{id}', [FormsController::class, 'sendAdoptionForm']);

Route::get('/donate', function () {return view('pages.donate');});

Route::get('/volunteer', function () {return view('pages.volunteer');});

Route::get('/form-volunteer', [FormsController::class, 'showVolunteerForm']);

Route::post('/form-volunteer', [FormsController::class,'sendVolunteerForm']);

Route::get('/form-fat', [FormsController::class, 'showFatForm']);

Route::post('/form-fat', [FormsController::class, 'sendFatForm']);

Route::get('/relevance', [RelevanceController::class, 'show']);

Route::get('/contact', [ContactController::class, 'show']);

Route::post('/contact', [ContactController::class, 'sendContactForm']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::get('/register', [AuthController::class, 'showRegister']);
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('/profile', [UserController::class, 'showProfile']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');;

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword']);

Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->middleware('guest')
    ->name('password.reset');
    
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::post('/profile/edit/{id}', [UserController::class, 'update']);

Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'pt',])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
});

Route::get('/blog', [PostController::class, 'show']);

Route::get('/blog/new_post', [PostController::class, 'showAdd']);

Route::post('/blog/new_post/{id}', [PostController::class, 'add']);

Route::get('/blog/post/{id}', [PostController::class, 'showPost']);

Route::post('/delete/{id}', [PostController::class, 'delete']);

Route::get('/blog/edit/{id}', [PostController::class, 'showEdit']);

Route::post('/blog/edit/{id}', [PostController::class, 'edit']);

Route::post('/livewire/upload-image', [PostController::class, 'uploadImage'])->name('livewire.upload-image');

Route::middleware('admin')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard']);

        Route::get('/animais-pdf', [AnimalController::class, 'generatePdfAnimalsChart']);
        Route::get('/adocoes-pdf', [AnimalController::class, 'generatePdfAdocoesChart']);
        Route::get('/microchips-pdf', [AnimalController::class, 'generatePdfMicrochipsChart']);
        Route::get('/entradas-pdf', [AnimalController::class, 'generatePdfEntradasChart']);
        Route::get('/adoptions-pdf', [AnimalController::class, 'generatePdfAdoptionsChart']);

        Route::get('/animais-excel', function () {
            return Excel::download(new AnimalsChartExport, 'relatorio-animais.xlsx');
        });
        Route::get('/adocoes-excel', function () {
            return Excel::download(new AdocoesChartExport, 'relatorio-adocoes-e-entradas.xlsx');
        });
        Route::get('/microchips-excel', function () {
            return Excel::download(new MicrochipsChartExport, 'relatorio-microchipagem.xlsx');
        });
        Route::get('/entradas-excel', function () {
            return Excel::download(new EntradasChartExport, 'relatorio-entradas.xlsx');
        });
         Route::get('/adoptions-excel', function () {
            return Excel::download(new AdoptionsChartExport, 'relatorio-adocoes.xlsx');
        });



        Route::prefix('users')->group(function () {
            Route::get('/list', [UserController::class, 'showList']);
            Route::get('/add', [UserController::class, 'showAdd']);
            Route::post('/add', [UserController::class, 'add']);
            Route::get('/edit/{id}', [UserController::class, 'showEdit']);
            Route::post('/edit/{id}', [UserController::class, 'update']);
            Route::post('/delete/{id}', [UserController::class, 'delete']);
        });

        Route::prefix('animal')->group(function () {
            Route::get('/list', [AnimalController::class, 'show']);
            Route::get('/edit/{id}', [AnimalController::class, 'showEdit']);
            Route::post('/edit/{id}', [AnimalController::class, 'update']);
            Route::get('/add', [AnimalController::class, 'showAdd']);
            Route::post('/add', [AnimalController::class, 'add']);
            Route::post('/delete/{id}', [AnimalController::class, 'delete']);
            Route::get('/list/export', [AnimalController::class, 'exportExcel']);
            Route::get('/list/animais-pdf', [AnimalController::class, 'generatePdf']);
        });
    });
});
