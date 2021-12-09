<?php

namespace App\Providers;

use App\Http\Controllers\AnouncementsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProjectCenterController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
/*    protected $namespace = 'App\Http\Controllers';*/

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            Route::group([
                'middleware' => ['api', 'cors'],
                'namespace' => $this->namespace,
                'prefix' => 'api/auth/',
            ], function ($router) {
                //users
                Route::get('/user/{id}', [UserController::class, 'user']);
                Route::post('/login', [AuthController::class, 'login'])->name('login');;
                Route::post('/register', [AuthController::class, 'register']);
                Route::post('/logout', [AuthController::class, 'logout']);
                Route::post('/refresh', [AuthController::class, 'refresh']);
              
              
              
                //subscribers

                //I have to group this route later  SUBSCRIBERS
                Route::get('/profile/{id}', [ProfileController::class, 'profile']);
                Route::put('/profile/update/{id}', [ProfileController::class, 'update']);
                Route::post('/profile/password/update/{id}', [ProfileController::class, 'updatePassword']);
                Route::post('/profile/forgot/}', [ProfileController::class, 'forgotPassword']);
              
              
              
            // //   //Password Reset
            //   Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm']);
            //   Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']); 
            //   Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm']);
            //   Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);

              
              
              
                //anouncements ROLE ANOUNCER
              
                Route::get('/myanouncements', [AnouncementsController::class ,'myAnouncements']);
                Route::post('/myanouncements/favorite', [AnouncementsController::class ,'favorite']);
                Route::post('/anouncements/create', [AnouncementsController::class ,'create']);
                Route::put('/anouncements/update/{id}', [AnouncementsController::class ,'update']);
                Route::get('/favorites/{user_id}' , [AnouncementsController::class , 'showFavorites']);
                Route::post('/favorites' , [AnouncementsController::class , 'createFavorites']);
                Route::delete('/favorites/{favorites_id}' , [AnouncementsController::class , 'deleteFavorites']);
                Route::get('/anouncements/applied' , [AnouncementsController::class , 'applied']);
                Route::get('/allanouncements', [AnouncementsController::class ,'allAnouncements']);
               
                ////
                
                //Admin routes //tested works 100%

                Route::get('anouncers/all' , [AdminController::class , 'allAnouncers']);
                Route::post('/anouncer/add', [AdminController::class , 'createAnouncer']);
                Route::put('/anouncer/update/{id}', [AdminController::class , 'updateAnouncer']);  
                Route::delete('/anouncer/delete/{id}', [AdminController::class , 'deleteAnouncer']);  
                Route::post('/projects/add', [ProjectsController::class , 'projects']); 
                
                   

                //projects_center
                Route::get('/projects_center' , [ProjectCenterController::class , 'showProjectsCenter']);
                Route::get('/projectcenter/projects/{id}' ,[ProjectsController::class ,'projects' ]);
                Route::post('/projects_center/create' , [ProjectCenterController::class , 'createProjectsCenter']);
                Route::put('/projects_center/update/{id}' , [ProjectCenterController::class , 'updateProjectsCenter']);
                Route::delete('/projects_center/delete/{id}' , [ProjectCenterController::class , 'deleteProjectsCenter']);
            

                //Projects have to ckeck  ROLE ADMIN
                Route::get('/projects/{id}' , [ProjectsController::class , 'showProjects']);
                Route::post('/projects/create' , [ProjectsController::class , 'createProjects']);
                Route::put('/projects/{projects_id}' , [ProjectsController::class , 'updateProjects']);
                Route::delete('/projects/{projects_id}' , [ProjectsController::class , 'deleteProjects']);


                 //Projects_center  haver to check role ADMIN
                
                

                //payments routes have to check
                Route::get('/payments/{id}' , [PaymentsController::class , 'showPayments']);
                Route::post('/payments' , [PaymentsController::class , 'createPayment']);
                Route::put('/payments' , [PaymentsController::class , 'updatePayments']);
                Route::delete('/payments/{id}' , [PaymentsController::class , 'deletePayments']);
                
             
               //Orders routes have to correct
                Route::post('/orders' , [OrdersController::class , 'myOrders']);
                Route::delete('/orders/delete/{id}' , [OrdersController::class , 'deleteOrders']);
               

                /* Route::get('/user' , [UserController::class , 'profile]);
                 });




             /*  Route::prefix('api')
                 ->middleware('api','cors')
                 ->namespace($this->namespace)
                 ->group(base_path('routes/api.php'));*/

                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/web.php'));
            });
        });}


    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

}
