<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource("devices","Api\DeviceController");
Route::resource("brands","Api\BrandController");
Route::resource("types","Api\TypeController");
Route::resource("users","Api\UserController");
Route::resource("baskets","Api\BasketController");
Route::delete('baskets', 'Api\BasketController@destroy');
Route::resource("basket_devices","Api\BasketdeviceController");
Route::delete('basket_devices', 'Api\BasketdeviceController@destroy');
Route::resource("get_many","Api\GetManyDevicesController");
