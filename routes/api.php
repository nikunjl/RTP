<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;



/*

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "api" middleware group. Make something great!

|

*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();

});



// Route::get('/',function(){

//   phpinfo();

// });

// Without login route list.

Route::get('/getLoginData', [UserController::class, 'getLoginData'])->name('getLoginData');

Route::post('/loginWithPassword', [UserController::class, 'loginWithPassword'])->name('loginWithPassword');	

Route::get('/no-auth', function () {

    return response()->json(['msg'=>'Unauthenticated', 'status' => 2]);

})->name('no-auth');



Route::group(['middleware' => 'auth:sanctum'], function() {
	
	Route::get('/checkFlag', [UserController::class, 'checkFlag'])->name('checkFlag');	

	Route::get('/acccessgrant', [UserController::class, 'acccessgrant'])->name('acccessgrant');	

	Route::post('/afterLoginUpdate', [UserController::class, 'afterLoginUpdate'])->name('afterLoginUpdate');	

	Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');	

	Route::get('/getUserDetail/{id}', [UserController::class, 'getUserDetail'])->name('getUserDetail');	

	Route::get('/getSortingData', [UserController::class, 'getSortingData'])->name('getSortingData');	

	Route::get('/getProductDetails', [UserController::class, 'getProductDetails'])->name('getProductDetails');	

	Route::post('/getUserDetailUpdate', [UserController::class, 'getUserDetailUpdate'])->name('getUserDetailUpdate');	

	Route::get('/productListByCategoryId/{id}', [UserController::class, 'productListByCategoryId'])->name('productListByCategoryId');	

	Route::get('/filter', [UserController::class, 'filter'])->name('filter');	

	Route::get('/search', [UserController::class, 'search'])->name('search');

	Route::post('/addtocart', [UserController::class, 'addtocart'])->name('search');	
	Route::post('/deletecart/{id}', [UserController::class, 'deletecart'])->name('search');	
	Route::get('/gettocart', [UserController::class, 'gettocart'])->name('search');	
	Route::post('/placeorder', [UserController::class, 'placeorder'])->name('placeorder');	
	Route::get('/orderdetail', [UserController::class, 'orderdetail'])->name('orderdetail');	
	Route::get('/orderlist', [UserController::class, 'orderlist'])->name('orderlist');	
	Route::get('/orderstatus', [UserController::class, 'orderstatus'])->name('orderstatus');	
	Route::post('/updatestatus', [UserController::class, 'updatestatus'])->name('updatestatus');	
	Route::post('/addtocartbyproductid', [UserController::class, 'addtocartbyproductid'])->name('addtocartbyproductid');	
	Route::get('/pendingOrderlist', [UserController::class, 'pendingOrderlist'])->name('pendingOrderlist');	
	Route::get('/notificationlist', [UserController::class, 'notificationlist'])->name('notificationlist');	
	Route::post('/sendmessage', [UserController::class, 'sendmessage'])->name('sendmessage');	


});