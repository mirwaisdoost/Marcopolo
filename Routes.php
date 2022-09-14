<?php
    Route::set('Home',function(){
        account::home();
    });

    Route::set('login',function(){
        account::view();
    });

    Route::set('Login_creditional',function(){
        account::Login();
    });

    Route::set('Dashboard',function(){
        account::dashboard();
    });

    Route::set('Logout',function(){
        account::Logout();
    });

    Route::set('user_list',function(){
        account::list();
    });

    Route::set('user_profile',function(){
        account::profile();
    });

    Route::set('delete_user',function(){
        account::delete();
    });

    Route::set('create_user',function(){
        account::create_user();
    });

    Route::set('create_user_data',function(){
        account::insert();
    });

    Route::set('update_user',function(){
        account::update_user();
    });

    Route::set('update_user_data',function(){
        account::update();
    });

    Route::set('changePassword',function(){
        account::changePassword_view();
    });

    Route::set('changePassword_data',function(){
        account::changePassword();
    });

    Route::set('Reset',function(){
        account::reset();
    });

    Route::set('guest_list',function(){
        guestController::list();
    });

    Route::set('guest_profile',function(){
        guestController::profile();
    });

    Route::set('delete_guest',function(){
        guestController::delete();
    });

    Route::set('create_guest',function(){
        guestController::create_guest();
    });

    Route::set('create_guest_data',function(){
        guestController::insert();
    });
    
    Route::set('update_guest',function(){
        guestController::update_guest();
    });

    Route::set('update_guest_data',function(){
        guestController::update();
    });

    Route::set('room_list',function(){
        roomController::list();
    });

    Route::set('create_room',function(){
        roomController::create_room();
    });

    Route::set('create_room_data',function(){
        roomController::insert();
    });

    Route::set('room_profile',function(){
        roomController::profile();
    });

    Route::set('update_room',function(){
        roomController::update_room();
    });

    Route::set('update_room_data',function(){
        roomController::update();
    });

    Route::set('delete_room',function(){
        roomController::delete();
    });

    Route::set('company_list',function(){
        companyController::list();
    });

    Route::set('create_company',function(){
        companyController::create_company();
    });

    Route::set('create_company_data',function(){
        companyController::insert();
    });

    Route::set('company_profile',function(){
        companyController::profile();
    });

    Route::set('update_company',function(){
        companyController::update_company();
    });

    Route::set('update_company_data',function(){
        companyController::update();
    });

    Route::set('delete_company',function(){
        companyController::delete();
    });

    Route::set('service_list',function(){
        serviceController::list();
    });

    Route::set('create_service',function(){
        serviceController::create_service();
    });

    Route::set('create_service_data',function(){
        serviceController::insert();
    });

    Route::set('service_profile',function(){
        serviceController::profile();
    });

    Route::set('update_service',function(){
        serviceController::update_service();
    });

    Route::set('update_service_data',function(){
        serviceController::update();
    });

    Route::set('delete_service',function(){
        serviceController::delete();
    });

    Route::set('reservedDates',function(){
        reservation::reserved_dates();
    });
?>