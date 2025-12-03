<?php

use App\Http\Controllers\adminviewerController;
use App\Http\Controllers\BatteryController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InverterController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvideController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\SolarController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
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

Route::get("/", [HomeController::class,'home']);

//Admin Middleware /*****************************************************************/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/index', function () {
        return view('admin.index');
    })->name('index');

//Admin Viewer Product/***************************************************************************/

Route::get('/getCompanyData/{companyId}', [ProductController::class, 'getCompanyData']);

Route::get('/View_All', [ProductController::class, 'AllProduct']);

Route::get("/View_Battery", [BatteryController::class,'View_Battery']);

Route::get("/View_Inverter", [InverterController::class,'View_Inverter']);

Route::get("/View_Solar", [SolarController::class,'View_Solar']);

Route::get("/View_Categories", [CategoriesController::class,'View_Categories']);

//Contact /***************************************************************************/

Route::get("/View_Provider", [ProviderController::class,'View_Provider']);

Route::get("/Delete_Provider/{id}", [ProviderController::class,'Delete_Provider']);

Route::get("/Accept_Provider/{id}", [ProviderController::class, 'Accept_Provider']);

//Messages /***************************************************************************/

Route::get("/View_Messages", [MessagesController::class,'View_Messages']);

Route::get("/Delete_Messages/{id}", [MessagesController::class,'Delete_Messages']);

//Companies /***************************************************************************/

Route::get("/View_Companies", [CompanyController::class,'View_Companies']);

//User /***************************************************************************/

Route::get("/View_User", [UserController::class,'View_User']);

Route::get("/activate_user/{id}", [UserController::class,'activate_user']);

Route::get("/deactivate_user/{id}", [UserController::class,'deactivate_user']);

//Technician*********************************************************************************** */

Route::get("/Admin_Tech", [UserController::class,'Admin_Tech']);

});
/**User///*************************************************************************/
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/company', [CompanyController::class, 'showcompanyPage'])->name('company');

Route::get('/SPanel', [SolarController::class, 'showSolarPage'])->name('SPanel');

Route::get('/Invertr', [InverterController::class, 'showInverterPage'])->name('Inverter');

Route::get('/Batter', [BatteryController::class, 'showBatteryPage'])->name('Battery');

Route::get('/Categorie', [CategoriesController::class, 'showCategoriesPage'])->name('Categorie');

Route::get('/Product', [ShowController::class, 'AllProduct'])->name('Product');

Route::get('/Tech', [TechnicianController::class, 'showTechnicianPage'])->name('Technician');

Route::get('/showSolar', [SolarController::class, 'showWelcome'])->name('welcome');

Route::get('/', [ShowController::class, 'showProduct']);

Route::get('/results', [SearchController::class, 'search'])->name('search');

Route::get('/company/{companyId}/products', [ShowController::class, 'showCompanyProducts'])->name('home.Details');

Route::get('/SPanel/{id}', [SolarController::class, 'showSolarDetails'])->name('solar.details');

Route::get('/Inverter/{id}', [InverterController::class, 'showInverterDetails'])->name('inverter.details');

Route::get('/Batter/{id}', [BatteryController::class, 'showBatteryDetails'])->name('battery.details');

Route::get('/Categorie/{id}', [CategoriesController::class, 'showCategoryDetails'])->name('category.details');

Route::get('/Tech/{id}', [TechnicianController::class, 'showTechDetails'])->name('tech.details');


/*****Shopping **************************************************8888*/

Route::get('/shopping',[ShoppingController::class,'view'])->name('shopping');

Route::get('/solar/{id}', [ShoppingController::class, 'cartsolar'])->name('cart.solar');

Route::delete('/remove_solar/{id}', [ShoppingController::class, 'deletesolar'])->name('remove_solar');

Route::get('/inverter/{id}', [ShoppingController::class, 'cartinverter'])->name('cart.inverter');

Route::delete('/remove_inverter/{id}', [ShoppingController::class, 'deleteinverter'])->name('remove_inverter');

Route::get('/battery/{id}', [ShoppingController::class, 'cartbattery'])->name('cart.battery');

Route::delete('/remove_battery/{id}', [ShoppingController::class, 'deletebattery'])->name('remove_battery');

Route::get('/category/{id}', [ShoppingController::class, 'cartcategory'])->name('cart.category');

Route::delete('/remove_category/{id}', [ShoppingController::class, 'deletecategory'])->name('remove_category');

Route::post('/confirm-purchase', [ShoppingController::class, 'confirmPurchase'])->name('confirm_purchase');

Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order.history');

Route::post('/update-quantity/{id}', [ShoppingController::class, 'updateQuantity'])->name('update_quantity');



Route::get('/Design', function () {
    return view('home.Design Sys');
})->name('Design Sys');

Route::get('/contact', function () {
    return view('home.contact');
})->name('contact');

Route::get('/Provide', function () {
    return view('home.Provide');
})->name('Provide');

Route::post('/Provide',[HomeController::class , 'Provide']);

Route::post('/contacts',[HomeController::class , 'contact']);

/*Company//*************************************************************************/

Route::middleware(['auth', 'company'])->group(function () {

    Route::get('/indexx', function () {
        return view('company.indexx');
    })->name('indexx');

    Route::get('/View_All', [ProductController::class, 'AllProduct']);

    Route::get("/Add_Inverter", [InverterController::class,'Add_Inverter']);

    Route::post("/create_inverter", [InverterController::class,'create_inverter']);

    Route::get("/View_Inverter", [InverterController::class,'View_Inverter']);

    Route::get("/Delete_Inverter/{id}", [InverterController::class,'Delete_Inverter']);

    Route::get("/Update_Inverter/{id}", [InverterController::class,'Update_Inverter']);

    Route::post("/edit_inverter/{id}", [InverterController::class,'edit_inverter']);

    //SolarPanel /*****************************************************************/

    Route::get("/Add_Solar", [SolarController::class,'Add_Solar']);

    Route::post("/create_solar", [SolarController::class,'create_solar']);

    Route::get("/View_Solar", [SolarController::class,'View_Solar']);

    Route::get("/Delete_Solar/{id}", [SolarController::class,'Delete_Solar']);

    Route::get("/Update_Solar/{id}", [SolarController::class,'Update_Solar']);

    Route::post("/edit_solar/{id}", [SolarController::class,'edit_solar']);

    //Battery /*****************************************************************/

    Route::get("/Add_Battery", [BatteryController::class,'Add_Battery']);

    Route::post("/create_battery", [BatteryController::class,'create_battery']);

    Route::get("/View_Battery", [BatteryController::class,'View_Battery']);

    Route::get("/Delete_Battery/{id}", [BatteryController::class,'Delete_Battery']);

    Route::get("/Update_Battery/{id}", [BatteryController::class,'Update_Battery']);

    Route::post("/edit_battery/{id}", [BatteryController::class,'edit_battery']);

    //Categories /*****************************************************************/

    Route::get("/Add_Categories", [CategoriesController::class,'Add_Categories']);

    Route::post("/create_categories", [CategoriesController::class,'create_categories']);

    Route::get("/View_Categories", [CategoriesController::class,'View_Categories']);

    Route::get("/Delete_Categories/{id}", [CategoriesController::class,'Delete_Categories']);

    Route::get("/Update_Categories/{id}", [CategoriesController::class,'Update_Categories']);

    Route::post("/edit_categories/{id}", [CategoriesController::class,'edit_categories']);

    //Technician /*****************************************************************/

    Route::get("/Add_Technician", [TechnicianController::class,'Add_Technician']);

    Route::post("/create_technician", [TechnicianController::class,'create_technician']);

    Route::get("/View_Technician", [TechnicianController::class,'View_Technician']);

    Route::get("/Delete_Technician/{id}", [TechnicianController::class,'Delete_Technician']);

    Route::get("/Update_Technician/{id}", [TechnicianController::class,'Update_Technician']);

    Route::post("/edit_technician/{id}", [TechnicianController::class,'edit_technician']);

    //Bills /*****************************************************************/

    Route::get("/View_Bills", [OrderHistoryController::class,'View_Bills']);
});



