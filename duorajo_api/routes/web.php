<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    //USERS
    $router->post('users/all', 'UserController@all');
    $router->post('users/insert', 'UserController@insert');
    $router->post('users/single/{id}', 'UserController@single');
    $router->post('users/delete', 'UserController@delete');
    $router->post('users/update', 'UserController@update');


    //PARENT
    $router->post('parents/all', 'ParentsController@all');
    $router->post('parents/insert', 'ParentsController@insert');
    $router->post('parents/single/{id}', 'ParentsController@single');
    $router->post('parents/delete', 'ParentsController@delete');
    $router->post('parents/update', 'ParentsController@update');
    

    //DEV_UNITS
    $router->post('dev_units/all', 'DevUnitsController@all');
    $router->post('dev_units/insert', 'DevUnitsController@insert');
    $router->post('dev_units/single/{id}', 'DevUnitsController@single');
    $router->post('dev_units/delete', 'DevUnitsController@delete');
    $router->post('dev_units/update', 'DevUnitsController@update');
    

    //UNIT_PARTS
    $router->post('unit_parts/all', 'UnitPartsController@all');
    $router->post('unit_parts/insert', 'UnitPartsController@insert');
    $router->post('unit_parts/single/{id}', 'UnitPartsController@single');
    $router->post('unit_parts/delete', 'UnitPartsController@delete');
    $router->post('unit_parts/update', 'UnitPartsController@update');
    

    //SPARE_PARTS
    $router->post('spare_parts/all', 'SparePartsController@all');
    $router->post('spare_parts/insert', 'SparePartsController@insert');
    $router->post('spare_parts/single/{id}', 'SparePartsController@single');
    $router->post('spare_parts/delete', 'SparePartsController@delete');
    $router->post('spare_parts/update', 'SparePartsController@update');
    

    //CAR_BRANDS
    $router->post('car_brands/all', 'CarBrandsController@all');
    $router->post('car_brands/insert', 'CarBrandsController@insert');
    $router->post('car_brands/single/{id}', 'CarBrandsController@single');
    $router->post('car_brands/delete', 'CarBrandsController@delete');
    $router->post('car_brands/update', 'CarBrandsController@update');
    

    //CAR_TYPES
    $router->post('car_types/all', 'CarTypesController@all');
    $router->post('car_types/insert', 'CarTypesController@insert');
    $router->post('car_types/single/{id}', 'CarTypesController@single');
    $router->post('car_types/delete', 'CarTypesController@delete');
    $router->post('car_types/update', 'CarTypesController@update');
    

    //SPARE_PARTS_REL_TYPES
    $router->post('spare_parts_rel_types/all', 'SparePartsRelTypesController@all');
    $router->post('spare_parts_rel_types/insert', 'SparePartsRelTypesController@insert');
    $router->post('spare_parts_rel_types/single/{id}', 'SparePartsRelTypesController@single');
    $router->post('spare_parts_rel_types/delete', 'SparePartsRelTypesController@delete');
    $router->post('spare_parts_rel_types/update', 'SparePartsRelTypesController@update');

    
    //CUSTOMERS
    $router->post('customers/all', 'CustomersController@all');
    $router->post('customers/insert', 'CustomersController@insert');
    $router->post('customers/single/{id}', 'CustomersController@single');
    $router->post('customers/delete', 'CustomersController@delete');
    $router->post('customers/update', 'CustomersController@update');
    
    
    //CUSTOMERS
    $router->post('customers_cars/all', 'CustomersCarsController@all');
    $router->post('customers_cars/insert', 'CustomersCarsController@insert');
    $router->post('customers_cars/single/{id}', 'CustomersCarsController@single');
    $router->post('customers_cars/delete', 'CustomersCarsController@delete');
    $router->post('customers_cars/update', 'CustomersCarsController@update');
    
    
    //CUSTOMERS
    $router->post('trans_services/all', 'TransServicesController@all');
    $router->post('trans_services/insert', 'TransServicesController@insert');
    $router->post('trans_services/single/{id}', 'TransServicesController@single');
    $router->post('trans_services/delete', 'TransServicesController@delete');
    $router->post('trans_services/update', 'TransServicesController@update');
    
    
    //CUSTOMERS
    $router->post('trans_services_details/all', 'TransServicesDetailsController@all');
    $router->post('trans_services_details/insert', 'TransServicesDetailsController@insert');
    $router->post('trans_services_details/single/{id}', 'TransServicesDetailsController@single');
    $router->post('trans_services_details/delete', 'TransServicesDetailsController@delete');
    $router->post('trans_services_details/update', 'TransServicesDetailsController@update');
});