<?php

Route::name('setting.')
    ->prefix('setting')
    ->middleware(['impersonate', 'auth'])
    ->group(
        function () {
            Route::get('/', 'SettingController')->name('index');

            Route::resource('users', 'UserController');
            Route::resource('user-type', 'UserTypeController');
            Route::resource('workflow', 'WorkflowController');
            Route::resource('calendar', 'CalendarController');
        }
    );
