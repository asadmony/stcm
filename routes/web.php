<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware([ 'auth','admin'])->prefix('admin')->group(function () {
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.home');
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users');
    Route::get('/admins', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.admins');
    Route::get('/districts', [App\Http\Controllers\DistrictController::class, 'index'])->name('admin.districts');
    Route::post('/districts', [App\Http\Controllers\DistrictController::class, 'store'])->name('admin.districts.store');
    Route::get('/thanas', [App\Http\Controllers\ThanaController::class, 'index'])->name('admin.thanas');
    Route::post('/thanas', [App\Http\Controllers\ThanaController::class, 'store'])->name('admin.thanas.store');
    Route::get('/get-thanas-by-district/{district}', [App\Http\Controllers\ThanaController::class, 'getThanasByDistrict'])->name('admin.getThanasByDistrict');
    Route::get('/zones', [App\Http\Controllers\ZoneController::class, 'index'])->name('admin.zones');
    Route::post('/zones', [App\Http\Controllers\ZoneController::class, 'store'])->name('admin.zones.store');
    Route::get('/get-zones-by-thana/{thana}', [App\Http\Controllers\ZoneController::class, 'getZonesByThana'])->name('admin.getZonesByThana');
    Route::get('/points', [App\Http\Controllers\TrafficPointController::class, 'index'])->name('admin.trafficPoints');
    Route::post('/points', [App\Http\Controllers\TrafficPointController::class, 'store'])->name('admin.trafficPoints.store');
    Route::get('/shifts', [App\Http\Controllers\ShiftController::class, 'index'])->name('admin.shifts');
    Route::post('/shifts', [App\Http\Controllers\ShiftController::class, 'store'])->name('admin.shifts.store');
    Route::get('/zone-shift-slots', [App\Http\Controllers\ShiftSlotController::class, 'index'])->name('admin.shiftSlots');
    Route::post('/zone-shift-slots', [App\Http\Controllers\ShiftSlotController::class, 'show'])->name('admin.shiftSlots.show');
    Route::post('/zone-shift-slots/{shiftSlot}/update', [App\Http\Controllers\ShiftSlotController::class, 'update'])->name('admin.shiftSlots.update');
    Route::get('/zone-shift-slots/{shiftSlot}/updateStatus', [App\Http\Controllers\ShiftSlotController::class, 'updateStatus'])->name('admin.shiftSlots.updateStatus');
    Route::get('/get-points-by-zone/{zone}', [App\Http\Controllers\ShiftSlotController::class, 'getPointsByZone'])->name('admin.getPointsByZone');
    Route::get('/slot-bookings', [App\Http\Controllers\SlotBookingController::class, 'index'])->name('admin.slotBookings');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/complete-profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('completeProfile');
    Route::post('/complete-profile', [App\Http\Controllers\UserProfileController::class, 'store'])->name('completeProfile.store');
});

Route::middleware(['auth', 'user', 'profile'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/shift-booking', [App\Http\Controllers\HomeController::class, 'bookShift'])->name('bookShift');
    Route::get('/zone-shift-slots', [App\Http\Controllers\HomeController::class, 'showShifts'])->name('shiftSlots.show');
    Route::get('/get-thanas-by-district/{district}', [App\Http\Controllers\HomeController::class, 'getThanasByDistrict'])->name('getThanasByDistrict');
    Route::get('/get-zones-by-thana/{thana}', [App\Http\Controllers\HomeController::class, 'getZonesByThana'])->name('getZonesByThana');
    Route::get('/get-points-by-zone/{zone}', [App\Http\Controllers\HomeController::class, 'getPointsByZone'])->name('getPointsByZone');
    Route::post('/shift-booking/save', [App\Http\Controllers\HomeController::class, 'store'])->name('bookShift.store');
    Route::post('/zone-shift-slots/{shiftSlot}/update', [App\Http\Controllers\HomeController::class, 'update'])->name('shiftSlots.update');
    Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'show'])->name('userProfile.show');
    Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'show'])->name('cancelSchedule');
});


// require __DIR__ . '/admin-auth.php';
