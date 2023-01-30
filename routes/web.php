<?php

use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/About', function () {
    return view('pages.about');
})->name('public_about');







// Route::get('/HotelMe', function(){
//     return view('pages.loginRegister');
// })->name('public_LogReg');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('public_laniding');

Route::get('/contact', [App\Http\Controllers\ContactUsController::class, 'create'])->name('public_contact');
Route::post('/contact/store', [App\Http\Controllers\ContactUsController::class, 'store'])->name('contact.store');


Route::get('/destination', [App\Http\Controllers\DestinationController::class, 'index'])->name('public_destination');

Route::get('/hotels', [App\Http\Controllers\HotelsController::class, 'index'])->name('public_hotels');
Route::get('/hotel/{id}', [App\Http\Controllers\HotelsController::class, 'show'])->name('hotel');

Route::get('/menu', [App\Http\Controllers\HotelMenuController::class, 'index'])->name('public_menu');

Route::get('/activity', [App\Http\Controllers\ActivityController::class, 'index'])->name('public_activity');

Route::get('/vendor/create', [App\Http\Controllers\VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor/store', [App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');

// Check if the user is logged in.
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/contact-requests', [App\Http\Controllers\ContactUsController::class, 'index'])->name('contact.search');
    Route::get('/contact-requests/{id}', [App\Http\Controllers\ContactUsController::class, 'show'])->name('contact.show');

    Route::get('/vendor', [App\Http\Controllers\VendorController::class, 'index'])->name('vendor');
    Route::get('/vendor/{id}', [App\Http\Controllers\VendorController::class, 'show'])->name('vendor.show');
    Route::post('/vendor/apr-or-rej', [App\Http\Controllers\VendorController::class, 'apr_or_rej'])->name('vendor.apr_or_rej');
    Route::get('/vendor/delete', [App\Http\Controllers\VendorController::class, 'delete'])->name('vendor.delete');

    Route::get('/hotels/search', [App\Http\Controllers\HotelsController::class, 'search'])->name('hotels.search');
    Route::get('/hotels/create', [App\Http\Controllers\HotelsController::class, 'create'])->name('hotels.create');
    Route::post('/hotels/store', [App\Http\Controllers\HotelsController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/edit/{id}', [App\Http\Controllers\HotelsController::class, 'edit'])->name('hotels.edit');
    Route::post('/hotels/update', [App\Http\Controllers\HotelsController::class, 'update'])->name('hotels.update');

    Route::get('/hotel/{hotel_id}/activity/search', [App\Http\Controllers\ActivityController::class, 'search'])->name('hotel_acts.search');
    Route::get('/hotel/{hotel_id}/activity/create', [App\Http\Controllers\ActivityController::class, 'create'])->name('hotel_acts.create');
    Route::post('/hotel/activity/store', [App\Http\Controllers\ActivityController::class, 'store'])->name('hotel_acts.store');
    Route::get('/hotel/{hotel_id}/activity/edit/{id}', [App\Http\Controllers\ActivityController::class, 'edit'])->name('hotel_acts.edit');
    Route::post('/hotel/activity/update', [App\Http\Controllers\ActivityController::class, 'update'])->name('hotel_acts.update');

    Route::get('/hotel/{hotel_id}/availability/search', [App\Http\Controllers\HotelAvailabilityController::class, 'search'])->name('hotel_avl.search');
    Route::get('/hotel/{hotel_id}/availability/create', [App\Http\Controllers\HotelAvailabilityController::class, 'create'])->name('hotel_avl.create');
    Route::post('/hotel/availability/store', [App\Http\Controllers\HotelAvailabilityController::class, 'store'])->name('hotel_avl.store');
    Route::get('/hotel/availability/delete', [App\Http\Controllers\HotelAvailabilityController::class, 'destroy'])->name('hotel_avl.delete');

    Route::get('/hotel/{hotel_id}/menu/search', [App\Http\Controllers\HotelMenuController::class, 'search'])->name('hotel_menu.search');
    Route::get('/hotel/{hotel_id}/menu/create', [App\Http\Controllers\HotelMenuController::class, 'create'])->name('hotel_menu.create');
    Route::post('/hotel/menu/store', [App\Http\Controllers\HotelMenuController::class, 'store'])->name('hotel_menu.store');
    Route::get('/hotel/{hotel_id}/menu/edit/{id}', [App\Http\Controllers\HotelMenuController::class, 'edit'])->name('hotel_menu.edit');
    Route::post('/hotel/menu/update', [App\Http\Controllers\HotelMenuController::class, 'update'])->name('hotel_menu.update');

    Route::get('/destination/search', [App\Http\Controllers\DestinationController::class, 'search'])->name('destn.search');
    Route::get('/destination/create', [App\Http\Controllers\DestinationController::class, 'create'])->name('destn.create');
    Route::post('/destination/store', [App\Http\Controllers\DestinationController::class, 'store'])->name('destn.store');
    Route::get('/destination/edit/{id}', [App\Http\Controllers\DestinationController::class, 'edit'])->name('destn.edit');
    Route::post('/destination/update', [App\Http\Controllers\DestinationController::class, 'update'])->name('destn.update');

    Route::get('/hotels/wishlist', [App\Http\Controllers\HotelWishListController::class, 'index'])->name('hotel_wishlist.index');
    Route::post('/hotel/wishlist/store', [App\Http\Controllers\HotelWishListController::class, 'store'])->name('hotel_wishlist.store');
    Route::post('/hotel/wishlist/delete', [App\Http\Controllers\HotelWishListController::class, 'destroy'])->name('hotel_wishlist.destroy');
    
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('user_profile.edit');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('user_profile.update');

    Route::post('/hotel/review/store', [App\Http\Controllers\HotelReviewController::class, 'store'])->name('hotel_review.store');
    Route::get('/hotel/review/search', [App\Http\Controllers\HotelReviewController::class, 'index'])->name('hotel_review.search');
    Route::get('/hotel/review/show/{id}', [App\Http\Controllers\HotelReviewController::class, 'show'])->name('hotel_review.show');
    Route::post('/hotel/review/report', [App\Http\Controllers\HotelReviewController::class, 'report'])->name('hotel_review.report');
    
    Route::get('/hotel/review/report/review', [App\Http\Controllers\HotelReviewReportsController::class, 'index'])->name('hotel_review.report.search');
    Route::get('/hotel/review/report/show/{id}', [App\Http\Controllers\HotelReviewReportsController::class, 'show'])->name('hotel_review.report.show');
    Route::post('/hotel/review/report/action', [App\Http\Controllers\HotelReviewReportsController::class, 'destroy'])->name('hotel_review.report.destroy');

    Route::post('/hotel/booking/store', [App\Http\Controllers\BookingsController::class, 'store'])->name('hotel_booking.store');
    Route::get('/hotels/bookings', [App\Http\Controllers\BookingsController::class, 'index'])->name('hotel_booking.index');
    Route::get('/hotel/booking/{id}/payment', [App\Http\Controllers\BookingsController::class, 'show'])->name('hotel_booking.show');
    Route::get('/hotel/booking/paid', [App\Http\Controllers\BookingsController::class, 'paid'])->name('hotel_booking.paid');

    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/show/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employee/update/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/employee/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.delete');
    
    
    Route::get('/province', [App\Http\Controllers\ProvinceController::class, 'index'])->name('province');
    Route::get('/province/show/{id}', [App\Http\Controllers\ProvinceController::class, 'show'])->name('province.show');
    Route::get('/province/create', [App\Http\Controllers\ProvinceController::class, 'create'])->name('province.create');
    Route::post('/province/store', [App\Http\Controllers\ProvinceController::class, 'store'])->name('province.store');
    Route::get('/province/edit/{id}', [App\Http\Controllers\ProvinceController::class, 'edit'])->name('province.edit');
    Route::post('/province/update/{id}', [App\Http\Controllers\ProvinceController::class, 'update'])->name('province.update');
    Route::post('/province/delete/{id}', [App\Http\Controllers\ProvinceController::class, 'destroy'])->name('province.delete');
    
    Route::get('/district', [App\Http\Controllers\DistrictController::class, 'index'])->name('district');
    Route::get('/district/show/{id}', [App\Http\Controllers\DistrictController::class, 'show'])->name('district.show');
    Route::get('/district/create', [App\Http\Controllers\DistrictController::class, 'create'])->name('district.create');
    Route::post('/district/store', [App\Http\Controllers\DistrictController::class, 'store'])->name('district.store');
    Route::get('/district/edit/{id}', [App\Http\Controllers\DistrictController::class, 'edit'])->name('district.edit');
    Route::post('/district/update/{id}', [App\Http\Controllers\DistrictController::class, 'update'])->name('district.update');
    Route::post('/district/delete/{id}', [App\Http\Controllers\DistrictController::class, 'destroy'])->name('district.delete');

    Route::get('/city', [App\Http\Controllers\CityController::class, 'index'])->name('city');
    Route::get('/city/show/{id}', [App\Http\Controllers\CityController::class, 'show'])->name('city.show');
    Route::get('/city/create', [App\Http\Controllers\CityController::class, 'create'])->name('city.create');
    Route::post('/city/store', [App\Http\Controllers\CityController::class, 'store'])->name('city.store');
    Route::get('/city/edit/{id}', [App\Http\Controllers\CityController::class, 'edit'])->name('city.edit');
    Route::post('/city/update/{id}', [App\Http\Controllers\CityController::class, 'update'])->name('city.update');
    Route::post('/city/delete/{id}', [App\Http\Controllers\CityController::class, 'destroy'])->name('city.delete');

    Route::get('/reports', [App\Http\Controllers\ReportsController::class, 'index'])->name('reports.bookings');

    Route::get('/payment-gateway', [App\Http\Controllers\PaymentController::class, 'index'])->name('pay_test');
});

Route::post('/closest-city', [App\Http\Controllers\CityController::class, 'closest'])->name('city.closest_show');

