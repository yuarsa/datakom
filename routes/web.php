<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
/* Route::get('/clear-cache', function() {
    $exitCode = \Artisan::call('cache:cache');
    return '<h1>Cache facade value cleared</h1>';
});
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['dashboard-admin', 'permission:read-dashboard-admin']], function () {
        Route::get('/', 'Home\AdminController@index');

        Route::group(['prefix' => 'monitor', 'namespace' => 'Monitors'], function () {
            Route::resource('monitors', 'MonitorController');
            Route::get('monitor_data', 'MonitorController@datatables');
        });

        Route::group(['prefix' => 'agent', 'namespace' => 'Agent'], function () {
            Route::resource('groups', 'GroupAgentController');
            Route::get('group_data', 'GroupAgentController@datatables');

            Route::resource('agents', 'AgentController');
            Route::get('agent_data', 'AgentController@datatables');
        });

        Route::group(['prefix' => 'worksheet', 'namespace' => 'Worksheets'], function () {
            // Route::resource('worksheets', 'WorksheetController');
            Route::get('worksheet_data', 'WorksheetController@datatables');
            Route::get('worksheets/{id}/tindakan', 'WorksheetController@tindakan');
            Route::patch('worksheets/{id}', 'WorksheetController@update');
        });

        Route::group(['prefix' => 'order', 'namespace' => 'Order'], function () {
            Route::get('orders', 'OrderController@index');
            Route::get('order_analis_data', 'OrderController@analisTable');
            Route::get('order_agent_data', 'OrderController@agentTable');
            Route::get('list-to-assigns', 'OrderController@listToAssign');
            Route::get('list_to_assigns', 'OrderController@listToAssignTable');
            Route::post('list-to-assigns', 'OrderController@createToAssign');
            Route::put('orders/change-group', 'OrderController@changeGroup');
            Route::get('change-group', 'OrderController@listChangeGroup');
            Route::get('change_group', 'OrderController@listChangeGroupTable');
            Route::put('change-group', 'OrderController@updateChangeGroup');
        });
		
		Route::group(['prefix' => 'status', 'namespace' => 'Status'], function () {
            Route::resource('worksheets', 'StatusWorksheetController');
            Route::get('worksheet_status_data', 'StatusWorksheetController@datatables');
        });

        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::resource('roles', 'RoleController');
            Route::get('roles_data', 'RoleController@datatables');
            Route::resource('permissions', 'PermissionController');
            Route::get('permissions_data', 'PermissionController@datatables');
            Route::resource('users', 'UserController');
            Route::get('users_data', 'UserController@datatables');

            Route::get('change-password', 'UserController@showChangePasswordform');
            Route::put('change-password', 'UserController@changePassword');
        });
    });
});
