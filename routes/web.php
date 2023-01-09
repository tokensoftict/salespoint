<?php

use Illuminate\Support\Facades\Route;

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

Route::match(['post','get'],'/', "HomeController@index")->name('home');

Route::get('/login','HomeController@index')->name('login');
Route::post('/login','HomeController@process_login')->name('process_login');
Route::get('/logout','HomeController@logout')->name('logout');

Route::match(['post','get'],'/myprofile','HomeController@myprofile')->name('myprofile');
//'CheckSubscriptionStatus',
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard','Dashboard@index')->name('dashboard');

    Route::prefix('ajax')->namespace('Ajax')->group(function () {
        Route::get('/findstock', ['as' => 'findstock', 'uses' => 'AjaxController@findstock']);
        Route::get('/findemployee', ['as' => 'findemployee', 'uses' => 'AjaxController@findemployee']);
        Route::get('/findanystock', ['as' => 'findanystock', 'uses' => 'AjaxController@findanystock']);
        Route::get('/findselectstock', ['as' => 'findselectstock', 'uses' => 'AjaxController@findselectstock']);
        Route::get('/findimage', ['as' => 'findimage', 'uses' => 'AjaxController@findimage']);
        Route::get('/findpurchaseorderstock', ['as' => 'findpurchaseorderstock', 'uses' => 'AjaxController@findpurchaseorderstock']);
    });

    Route::middleware(['permit.task'])->group(function () {
        Route::prefix('access-control')->namespace('AccessControl')->group(function () {

            Route::prefix('user-group')->as('user.group.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'GroupController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'GroupController@list_all']);
                Route::get('create', ['as' => 'create', 'uses' => 'GroupController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'GroupController@store']);
                Route::match(['get', 'post'], '{id}/permission', ['as' => 'permission', 'uses' => 'GroupController@permission']);
                Route::get('{id}/fetch_task', ['as' => 'task', 'uses' => 'GroupController@fetch_task']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'GroupController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'GroupController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'GroupController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'GroupController@update']);
                Route::get('{id}', ['as' => 'destroy', 'uses' => 'GroupController@destroy']);
            });

            Route::prefix('user')->as('user.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'UserController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'UserController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'UserController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'UserController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'UserController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'UserController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'UserController@update']);
                Route::get('{id}', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
            });

            Route::prefix('audit')->as('audit.')->group(function () {
                Route::match(['get','post'],'', ['as' => 'index', 'uses' => 'AuditsController@index', 'visible' => true, 'custom_label'=>'Audit Logs']);
            });

        });

        Route::prefix('settings')->namespace('Settings')->group(function () {

            Route::prefix('bank')->as('bank.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'BankController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'BankController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'BankController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'BankController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'BankController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'BankController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'BankController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'BankController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'BankController@destroy']);
            });

            Route::prefix('category')->as('category.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'CategoryController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'CategoryController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'CategoryController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'CategoryController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'CategoryController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'CategoryController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'CategoryController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'CategoryController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'CategoryController@destroy']);
            });


            Route::prefix('manufacturer')->as('manufacturer.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'ManufacturerController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'ManufacturerController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'ManufacturerController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'ManufacturerController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'ManufacturerController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ManufacturerController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'ManufacturerController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'ManufacturerController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'ManufacturerController@destroy']);
            });

            Route::prefix('payment_method')->as('payment_method.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'PaymentMethodController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'PaymentMethodController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'PaymentMethodController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'PaymentMethodController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'PaymentMethodController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'PaymentMethodController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'PaymentMethodController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'PaymentMethodController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'PaymentMethodController@destroy']);
            });

            Route::prefix('supplier')->as('supplier.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'SupplierController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'SupplierController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'SupplierController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'SupplierController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'SupplierController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'SupplierController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'SupplierController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'SupplierController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'SupplierController@destroy']);
            });

            Route::prefix('expenses_type')->as('expenses_type.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'ExpensesTypeController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'ExpensesTypeController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'ExpensesTypeController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'ExpensesTypeController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'ExpensesTypeController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ExpensesTypeController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'ExpensesTypeController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'ExpensesTypeController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'ExpensesTypeController@destroy']);
            });

            Route::prefix('sales_representative')->as('sales_representative.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'SalesRepresentativeController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'SalesRepresentativeController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'SalesRepresentativeController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'SalesRepresentativeController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'SalesRepresentativeController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'SalesRepresentativeController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'SalesRepresentativeController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'SalesRepresentativeController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'SalesRepresentativeController@destroy']);
            });


            if (config('app.store') == "hotel")
            {

                Route::prefix('room_type')->as('room_type.')->group(function () {
                    Route::get('', ['as' => 'index', 'uses' => 'RoomTypeController@index', 'visible' => true]);
                    Route::get('list', ['as' => 'list', 'uses' => 'RoomTypeController@listAll']);
                    Route::get('create', ['as' => 'create', 'uses' => 'RoomTypeController@create']);
                    Route::post('', ['as' => 'store', 'uses' => 'RoomTypeController@store']);
                    Route::get('{id}', ['as' => 'show', 'uses' => 'RoomTypeController@show']);
                    Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'RoomTypeController@edit']);
                    Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'RoomTypeController@toggle']);
                    Route::put('{id}', ['as' => 'update', 'uses' => 'RoomTypeController@update']);
                    Route::delete('{id}', ['as' => 'destroy', 'uses' => 'RoomTypeController@destroy']);
                });

            }

            Route::prefix('warehouse_and_shop')->as('warehouse_and_shop.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'WarehouseAndShopController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'WarehouseAndShopController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'WarehouseAndShopController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'WarehouseAndShopController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'WarehouseAndShopController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'WarehouseAndShopController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'WarehouseAndShopController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'WarehouseAndShopController@update']);
                Route::get('{id}/set_as_default', ['as' => 'set_as_default', 'uses' => 'WarehouseAndShopController@set_as_default']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'WarehouseAndShopController@destroy']);
            });

            Route::prefix('store_settings')->as('store_settings.')->group(function () {
                Route::get('', ['as' => 'view', 'uses' => 'StoreSettings@show', 'visible' => true]);
                Route::put('update', ['as' => 'update', 'uses' => 'StoreSettings@update']);
                Route::get('backup', ['as' => 'backup', 'uses' => 'StoreSettings@backup', 'visible' => true,'custom_label'=>"Back Up Database"]);
            });

        });

        Route::prefix('CustomerManager')->namespace('CustomerManager')->group(function () {

            Route::prefix('customer')->as('customer.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'CustomerController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'CustomerController@list_all']);
                Route::get('create', ['as' => 'create', 'uses' => 'CustomerController@create', 'visible' => true]);
                Route::post('', ['as' => 'store', 'uses' => 'CustomerController@store']);
                Route::get('{id}/show', ['as' => 'show', 'uses' => 'CustomerController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'CustomerController@edit']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'CustomerController@update']);
                Route::match(['get','post'],'/credit_report', ['as' => 'credit_report', 'uses' => 'CustomerController@credit_report', 'custom_label'=>"Customer Credit Report" ,'visible' => true]);
                Route::match(['get','post'],'/payment_report', ['as' => 'payment_report', 'uses' => 'CustomerController@payment_report', 'custom_label'=>"Customer Payment Report" ,'visible' => true]);
                Route::match(['get','post'],'/balance_sheet', ['as' => 'balance_sheet', 'uses' => 'CustomerController@balance_sheet', 'custom_label'=>"Customer Balance Sheet" ,'visible' => true]);
                Route::match(['get','post'],'/add_payment', ['as' => 'add_payment', 'uses' => 'CustomerController@add_payment', 'custom_label'=>"Add Credit Payment" ,'visible' => true]);
                Route::match(['get','post'],'{id}/delete_payment', ['as' => 'delete_payment', 'uses' => 'CustomerController@delete_payment', 'custom_label'=>"Delete Credit Payment"]);
            });

        });


        Route::prefix('stockmanager')->namespace('StockManager')->group(function () {

            Route::prefix('stock')->as('stock.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'StockController@index', 'visible' => true]);
                Route::get('available', ['as' => 'available', 'uses' => 'StockController@available','visible' => true]);
                Route::get('expired', ['as' => 'expired', 'uses' => 'StockController@expired','visible' => true]);
                Route::get('disable', ['as' => 'disable', 'uses' => 'StockController@disabled','visible' => true]);
                Route::match(['post','get'],'conversion', ['as' => 'convert', 'uses' => 'StockController@conversion_of','visible' => true]);
                Route::get('export', ['as' => 'export', 'uses' => 'StockController@export']);
                Route::get('create', ['as' => 'create', 'uses' => 'StockController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'StockController@store']);
                Route::get('{id}/show', ['as' => 'show', 'uses' => 'StockController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'StockController@edit']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'StockController@update']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'StockController@toggle']);
                Route::match(['get','post'],'{id}/stock_report', ['as' => 'stock_report', 'uses' => 'StockController@stock_report', 'custom_label'=>'Stock Report']);
                Route::match(['post','get'],'quick', ['as' => 'convert', 'uses' => 'StockController@conversion_of','visible' => true,'custom_label'=>'Quick Adjust Stock Quantity']);
                Route::match(['get','post'], 'quick',['as' => 'quick', 'uses' => 'StockController@quick', 'visible' => true,'custom_label'=>'Quick Adjust Stock Quantity']);

                Route::match(['get','post'], 'export_stock',['as' => 'export_stock', 'uses' => 'StockController@export_stock', 'visible' => true,'custom_label'=>'Export Stock Excel']);
                Route::match(['get','post'], 'import_current_stock',['as' => 'import_current_stock', 'uses' => 'StockController@import_current_stock', 'visible' => true,'custom_label'=>'Import/Existing Stock']);
                Route::match(['get','post'], 'import_new_stock',['as' => 'import_new_stock', 'uses' => 'StockController@import_new_stock', 'visible' => true,'custom_label'=>'Import New Stock']);
                Route::match(['get','post'], 'export_current_stock',['as' => 'export_current_stock', 'uses' => 'StockController@export_current_stock', 'visible' => true,'custom_label'=>'Export Current Stock']);
            });

            Route::prefix('stocklog')->as('stocklog.')->group(function () {
                Route::match(['post','get'],'add_log', ['as' => 'add_log', 'uses' => 'StockController@add_log', 'visible'=>true,'custom_label'=>'Add Stock Log']);
                Route::match(['post','get'],'usage_log_report', ['as' => 'usage_log_report', 'uses' => 'StockController@usage_log_report', 'visible'=>true,'custom_label'=>'Stock Log Report']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'StockController@edit_log']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'StockController@update_log']);
                Route::get('{id}/delete_log', ['as' => 'delete_log', 'uses' => 'StockController@delete_log']);
            });

            Route::prefix('stocktransfer')->as('stocktransfer.')->group(function () {
                Route::match(['post','get'],'add_transfer', ['as' => 'add_transfer', 'uses' => 'StockTransferController@add_transfer', 'visible'=>true,'custom_label'=>'New Stock Transfer']);
                Route::match(['post','get'],'transfer_report', ['as' => 'transfer_report', 'uses' => 'StockTransferController@transfer_report', 'visible'=>true,'custom_label'=>'Stock Transfer Report']);
                Route::get('{id}/delete_transfer', ['as' => 'delete_transfer', 'uses' => 'StockTransferController@delete_transfer']);
                Route::get('{id}/show', ['as' => 'show', 'uses' => 'StockTransferController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'StockTransferController@edit_transfer']);
                Route::get('{id}/complete', ['as' => 'complete', 'uses' => 'StockTransferController@complete']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'StockTransferController@update'] );
                Route::get('{id}/print_afour', ['as' => 'print_afour', 'uses' => 'StockTransferController@print_afour']);
            });


        });

        Route::prefix('invoiceandsales')->namespace('InvoiceAndSales')->group(function () {

            Route::prefix('invoiceandsales')->as('invoiceandsales.')->group(function () {
                Route::get('', ['as' => 'new', 'uses' => 'InvoiceController@new', 'visible' => true]);
                Route::post('create', ['as' => 'create', 'uses' => 'InvoiceController@create']);
                Route::get('draft', ['as' => 'draft', 'uses' => 'InvoiceController@draft', 'visible' => true]);
                Route::get('paid', ['as' => 'paid', 'uses' => 'InvoiceController@paid', 'visible' => true]);
                Route::get('{id}/pos_print', ['as' => 'pos_print', 'uses' => 'InvoiceController@print_pos' ]);
                Route::get('{id}/print_afour', ['as' => 'print_afour', 'uses' => 'InvoiceController@print_afour']);
                Route::get('{id}/print_way_bill', ['as' => 'print_way_bill', 'uses' => 'InvoiceController@print_way_bill']);
                Route::get('{id}/view', ['as' => 'view', 'uses' => 'InvoiceController@view']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'InvoiceController@edit']);
                Route::get('{id}/destroy', ['as' => 'destroy', 'uses' => 'InvoiceController@destroy']);
                Route::put('{id}/update', ['as' => 'update', 'uses' => 'InvoiceController@update']);
                /*
                Route::get('/return_invoice', ['as' => 'return_invoice', 'uses' => 'InvoiceController@return_invoice', 'visible' => true, 'custom_label'=>'Return Invoice']);
                */
                Route::post('/add_return_invoice', ['as' => 'add_return_invoice', 'uses' => 'InvoiceController@add_return_invoice',  'custom_label'=>'Create Return Invoice']);

                Route::get('draft_invoice', ['as' => 'draft_invoice', 'uses' => 'InvoiceController@draft_invoice','custom_label'=>'Save Invoice to Draft']);
                Route::get('complete_invoice', ['as' => 'complete_invoice', 'uses' => 'InvoiceController@complete_invoice','custom_label'=>'Save Invoice to Complete']);
                Route::post('{id}/complete_invoice_no_edit', ['as' => 'complete_invoice_no_edit', 'uses' => 'InvoiceController@complete_invoice_no_edit','custom_label'=>'Complete / Pay Invoice from view invoice page']);
            });

            Route::prefix('cashbook')->as('cashbook.')->group(function () {
                Route::match(['get','post'],'', ['as' => 'index', 'uses' => 'CashBookController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'CashBookController@list_all']);
                Route::get('create', ['as' => 'create', 'uses' => 'CashBookController@create', 'visible' => true,'custom_label'=>'Add Cashbook Entry']);
                Route::post('/store', ['as' => 'store', 'uses' => 'CashBookController@store']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'CashBookController@edit']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'CashBookController@update']);
                Route::get('{id}/remove', ['as' => 'destroy', 'uses' => 'CashBookController@destroy']);
            });

        });

        Route::prefix('expenses')->namespace('Expenses')->group(function () {
            Route::prefix('expenses')->as('expenses.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'ExpensesController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'ExpensesController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'ExpensesController@create', 'visible' => true, "custom_label"=>"New Expenses"]);
                Route::post('', ['as' => 'store', 'uses' => 'ExpensesController@store']);
                Route::get('{id}/show', ['as' => 'show', 'uses' => 'ExpensesController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ExpensesController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'ExpensesController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'ExpensesController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'ExpensesController@destroy']);
                Route::match(['get','post'],'/expenses_report_by_type', ['as' => 'expenses_report_by_type', 'uses' => 'ExpensesController@expenses_report_by_type', 'visible' => true, "custom_label"=>"Expenses By Type"]);
                Route::match(['get','post'],'/expenses_report_by_department', ['as' => 'expenses_report_by_department', 'uses' => 'ExpensesController@expenses_report_by_department', 'visible' => true, "custom_label"=>"Expenses By Department"]);
            });
        });

        Route::prefix('deposits')->namespace('Deposits')->group(function () {
            Route::prefix('deposits')->as('deposits.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'CustomerDepositController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'CustomerDepositController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'CustomerDepositController@create', 'visible' => true, "custom_label"=>"New Deposit"]);
                Route::post('', ['as' => 'store', 'uses' => 'CustomerDepositController@store']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'CustomerDepositController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'CustomerDepositController@toggle']);
                Route::put('{id}/update', ['as' => 'update', 'uses' => 'CustomerDepositController@update']);
                Route::get('{id}/destroy', ['as' => 'destroy', 'uses' => 'CustomerDepositController@destroy']);
                Route::get('{id}/print_afour', ['as' => 'print_afour', 'uses' => 'CustomerDepositController@print_afour']);

                Route::match(['get','post'],'/depositreport', ['as' => 'depositreport', 'uses' => 'CustomerDepositController@monthly_report', 'visible' => true, "custom_label"=>"Deposit Report"]);

                Route::match(['get','post'],'/depositreportbycustomer', ['as' => 'depositreportbycustomer', 'uses' => 'CustomerDepositController@monthly_report_by_customer', 'visible' => true, "custom_label"=>"Deposit Report By Customer"]);
            });
        });


        Route::prefix('payment')->namespace('PaymentReport')->group(function () {
            Route::match(['get','post'],'daily_payment_reports', ['as' => 'daily_payment_reports', 'uses' => 'PaymentReportController@daily_payment_reports', 'visible' => true,'custom_label'=>'Daily Report']);
            Route::match(['get','post'],'monthly_payment_reports', ['as' => 'monthly_payment_reports', 'uses' => 'PaymentReportController@monthly_payment_reports', 'visible' => true,'custom_label'=>'Monthly Report']);
            Route::match(['get','post'],'monthly_payment_report_by_method', ['as' => 'monthly_payment_report_by_method', 'uses' => 'PaymentReportController@monthly_payment_report_by_method', 'visible' => true,'custom_label'=>'Monthly Report By Method']);

            Route::match(['get','post'],'payment_analysis_by_user', ['as' => 'payment_analysis_by_user', 'uses' => 'PaymentReportController@payment_analysis_by_user', 'visible' => true,'custom_label'=>'Payment Analysis By  System user']);

            Route::match(['get','post'],'payment_analysis', ['as' => 'payment_analysis', 'uses' => 'PaymentReportController@payment_analysis', 'visible' => true,'custom_label'=>'Payment Analysis']);

            Route::match(['get','post'],'income_analysis', ['as' => 'income_analysis', 'uses' => 'PaymentReportController@income_analysis', 'visible' => true,'custom_label'=>'Income Analysis']);
            Route::match(['get','post'],'income_analysis_by_department', ['as' => 'income_analysis_by_department', 'uses' => 'PaymentReportController@income_analysis_by_department', 'visible' => true,'custom_label'=>'Income Analysis By Depart.']);
            Route::match(['get','post'],'monthly_payment_reports_by_customer', ['as' => 'monthly_payment_reports_by_customer', 'uses' => 'PaymentReportController@monthly_payment_reports_by_customer', 'visible' => true,'custom_label'=>'Monthly Report By Customer']);
            Route::match(['get','post'],'monthly_payment_report_by_method_by_customer', ['as' => 'monthly_payment_report_by_method_by_customer', 'uses' => 'PaymentReportController@monthly_payment_report_by_method_by_customer', 'visible' => true,'custom_label'=>'Monthly Report By Customer and Method']);

        });
        if(config('app.store') == "hotel") {
            Route::prefix('receptionist')->namespace('Receptionist')->group(function () {

                Route::prefix('room')->as('room.')->group(function () {
                    Route::get('', ['as' => 'index', 'uses' => 'RoomController@index', 'visible' => true]);
                    Route::get('list', ['as' => 'list', 'uses' => 'RoomController@listAll']);
                    Route::get('create', ['as' => 'create', 'uses' => 'RoomController@create']);
                    Route::post('', ['as' => 'store', 'uses' => 'RoomController@store']);
                    Route::get('{id}', ['as' => 'show', 'uses' => 'RoomController@show']);
                    Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'RoomController@edit']);
                    Route::put('{id}', ['as' => 'update', 'uses' => 'RoomController@update']);
                    Route::get('{id}/delete', ['as' => 'destroy', 'uses' => 'RoomController@destroy']);
                });

                Route::prefix('bookings_and_reservation')->as('bookings_and_reservation.')->group(function () {
                    Route::get('', ['as' => 'index', 'uses' => 'BookingsController@index', 'visible' => true, 'custom_label' => "Bookings and Reservation"]);
                    Route::get('list', ['as' => 'list', 'uses' => 'BookingsController@listAll']);
                    Route::get('create', ['as' => 'create', 'uses' => 'BookingsController@create', 'visible' => true, 'custom_label' => "New Booking / Reservation"]);
                    Route::post('', ['as' => 'store', 'uses' => 'BookingsController@store']);
                    Route::get('{id}/show', ['as' => 'show', 'uses' => 'BookingsController@show']);
                    Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'BookingsController@edit']);
                    Route::put('{id}', ['as' => 'update', 'uses' => 'BookingsController@update']);
                    Route::get('{id}/delete', ['as' => 'destroy', 'uses' => 'BookingsController@destroy']);
                    Route::match(['get', 'post'], '{id}/make_payment', ['as' => 'make_payment', 'uses' => 'BookingsController@make_payment', 'custom_label' => "Add Reservation Payment"]);
                    Route::match(['get', 'post'], '{id}/check_out', ['as' => 'check_out', 'uses' => 'BookingsController@check_out', 'custom_label' => "Check Out Guest"]);

                    Route::match(['get', 'post'], 'daily_report', ['as' => 'daily_report', 'uses' => 'BookingsController@daily_report', 'visible' => true, 'custom_label' => "Booking and Reservation Daily Report"]);
                    Route::match(['get', 'post'], 'monthly_report', ['as' => 'monthly_report', 'uses' => 'BookingsController@monthly_report', 'visible' => true, 'custom_label' => "Booking and Reservation Monthly Report"]);

                });


            });
        }
        Route::prefix('purchaseorders')->namespace('PurchaseOrders')->group(function () {
            Route::prefix('purchaseorders')->as('purchaseorders.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'PurchaseOrder@index', 'visible' => true]);
                Route::get('{id}/show', ['as' => 'show', 'uses' => 'PurchaseOrder@show']);
                Route::get('create', ['as' => 'create', 'uses' => 'PurchaseOrder@create','visible' => true]);
                Route::post('store', ['as' => 'store', 'uses' => 'PurchaseOrder@store']);
                Route::get('{id}/remove', ['as' => 'destroy', 'uses' => 'PurchaseOrder@destroy']);
                Route::match(['post','get'],'/daily', ['as' => 'daily', 'uses' => 'PurchaseOrder@daily', 'visible' => true]);
                Route::match(['post','get'],'/monthly', ['as' => 'monthly', 'uses' => 'PurchaseOrder@monthly', 'visible' => true]);

                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'PurchaseOrder@edit']);
                Route::get('{id}/markAsComplete', ['as' => 'markAsComplete', 'uses' => 'PurchaseOrder@markAsComplete', 'custom_label'=>'Complete Purchase Order']);
                Route::put('{id}/update', ['as' => 'update', 'uses' => 'PurchaseOrder@update']);


                Route::match(['get','post'],'/credit_report', ['as' => 'credit_report', 'uses' => 'PurchaseOrder@credit_report', 'custom_label'=>"Supplier Credit Report" ,'visible' => true]);
                Route::match(['get','post'],'/payment_report', ['as' => 'payment_report', 'uses' => 'PurchaseOrder@payment_report', 'custom_label'=>"Supplier Payment Report" ,'visible' => true]);
                Route::match(['get','post'],'/balance_sheet', ['as' => 'balance_sheet', 'uses' => 'PurchaseOrder@balance_sheet', 'custom_label'=>"Supplier Balance Sheet" ,'visible' => true]);
                Route::match(['get','post'],'/add_payment', ['as' => 'add_payment', 'uses' => 'PurchaseOrder@add_payment', 'custom_label'=>"Add Payment" ,'visible' => true]);
            });
        });

        Route::prefix('invoicereport')->namespace('InvoiceReport')->group(function () {
            Route::prefix('invoicereport')->as('invoicereport.')->group(function () {
                Route::match(['post','get'],'', ['as' => 'index', 'uses' => 'InvoiceReportController@daily', 'visible' => true]);
                Route::match(['post','get'],'/monthly', ['as' => 'monthly', 'uses' => 'InvoiceReportController@monthly', 'visible' => true]);
                Route::match(['post','get'],'/customer_monthly', ['as' => 'customer_monthly', 'uses' => 'InvoiceReportController@customer_monthly', 'visible' => true]);
                Route::match(['post','get'],'/user_monthly', ['as' => 'user_monthly', 'uses' => 'InvoiceReportController@user_monthly', 'visible' => true,'User Monthly Invoice Report']);


                Route::match(['post','get'],'/sales_rep_monthly', ['as' => 'sales_rep_monthly', 'uses' => 'InvoiceReportController@sales_rep_monthly', 'visible' => true,'Sales Rep Invoice Report']);

                Route::match(['post','get'],'/product_monthly', ['as' => 'product_monthly', 'uses' => 'InvoiceReportController@product_monthly', 'visible' => true]);
                Route::match(['post','get'],'/sales_analysis', ['as' => 'sales_analysis', 'uses' => 'InvoiceReportController@sales_analysis','custom_label'=>'Sales Analysis' ,'visible' => true]);
               /*
                Route::match(['post','get'],'/return_logs', ['as' => 'return_logs', 'uses' => 'InvoiceReportController@return_logs','custom_label'=>'Sales Return' ,'visible' => true]);
                   */
                Route::match(['post','get'],'/full_invoice_report', ['as' => 'full_invoice_report', 'uses' => 'InvoiceReportController@full_invoice_report','custom_label'=>'Complete Invoice Report' ,'visible' => true]);
            });
        });

        /*

        Route::prefix('stockcounting')->namespace('StockCounting')->group(function () {

            Route::prefix('counting')->as('counting.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'StockCountingController@index', 'visible' => true, 'custom_label'=>'List Stock Counting']);
                Route::get('create', ['as' => 'create', 'uses' => 'StockCountingController@create', 'visible' => true, 'custom_label'=>'New Stock Counting']);
                Route::post('', ['as' => 'store', 'uses' => 'StockCountingController@store']);
                Route::get('{id}/show', ['as' => 'show', 'uses' => 'StockCountingController@show']);
                Route::get('{id}/delete', ['as' => 'destroy', 'uses' => 'StockCountingController@destroy']);
                Route::get('{id}/export_excel', ['as' => 'export_excel', 'uses' => 'StockCountingController@export_excel']);
                Route::match(['get','post'],'{id}/import_excel', ['as' => 'import_excel', 'uses' => 'StockCountingController@import_excel']);
            });

        });

        */

        Route::prefix('hr')->namespace('HR')->group(function () {

            Route::prefix('employee')->as('employee.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'EmployeeController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'EmployeeController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'EmployeeController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'EmployeeController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'EmployeeController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'EmployeeController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'EmployeeController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'EmployeeController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'EmployeeController@destroy']);
            });

            Route::prefix('department')->as('department.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'DepartmentController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'DepartmentController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'DepartmentController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'DepartmentController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'DepartmentController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'DepartmentController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'DepartmentController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'DepartmentController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'DepartmentController@destroy']);
            });


            Route::prefix('designation')->as('designation.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'DesignationController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'DesignationController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'DesignationController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'DesignationController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'DesignationController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'DesignationController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'DesignationController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'DesignationController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'DesignationController@destroy']);
            });


            Route::prefix('rank')->as('rank.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'RankController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'RankController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'RankController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'RankController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'RankController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'RankController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'RankController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'RankController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'RankController@destroy']);
            });


            Route::prefix('scale')->as('scale.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'ScaleController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'ScaleController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'ScaleController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'ScaleController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'ScaleController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'ScaleController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'ScaleController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'ScaleController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'ScaleController@destroy']);
            });



        });


        Route::prefix('payroll')->namespace('Payroll')->group(function () {

            Route::prefix('periods')->as('periods.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'SalaryPeriodController@index', 'visible' => true]);

                Route::match(['post','get'],'list_deduction', ['as' => 'list_deduction', 'uses' => 'SalaryPeriodController@list_deduction', 'custom_label'=>'List Extra Deduction','visible' => true]);

                Route::match(['post','get'],'list_allowance', ['as' => 'list_allowance', 'uses' => 'SalaryPeriodController@list_allowance', 'custom_label'=>'List Extra Allowance','visible' => true]);


                Route::get('{payrollPeriod}/run', ['as' => 'run', 'uses' => 'SalaryPeriodController@run_payroll', 'custom_label'=>'Run Payroll']);
                Route::get('{payrollPeriod}/close', ['as' => 'close', 'uses' => 'SalaryPeriodController@close_payroll', 'custom_label'=>'Close Payroll']);
                Route::get('{payrollPeriod}/approve', ['as' => 'approve', 'uses' => 'SalaryPeriodController@approve_payroll', 'custom_label'=>'Approve Payroll']);
                Route::get('{payrollPeriod}/beneficiary', ['as' => 'beneficiary', 'uses' => 'SalaryPeriodController@beneficiary', 'custom_label'=>'Show Payroll Beneficiary']);
                Route::get('{payrollPeriod}/xls', ['as' => 'xls', 'uses' => 'SalaryPeriodController@export_xls', 'custom_label'=>'Export Beneficiary to Excel']);
                Route::get('{payrollPeriod}/pdf', ['as' => 'pdf', 'uses' => 'SalaryPeriodController@export_pdf', 'custom_label'=>'Export Beneficiary to PDF']);

                Route::match(['post','get'],'extra_deductions', ['as' => 'extra_deductions', 'uses' => 'SalaryPeriodController@extra_deductions', 'custom_label'=>'Add Extra Deduction','visible' => true]);
                Route::match(['post','get'],'extra_allowance', ['as' => 'extra_allowance', 'uses' => 'SalaryPeriodController@extra_allowance', 'custom_label'=>'Add Extra Allowance','visible' => true]);

                Route::get('{employeeExtraAllowance}/stop_running_allowance', ['as' => 'stop_running_allowance', 'uses' => 'SalaryPeriodController@stop_running_allowance', 'custom_label'=>'Stop Running Extra Allowance']);

                Route::get('{employeeExtraDeduction}/stop_running_deduction', ['as' => 'stop_running_deduction', 'uses' => 'SalaryPeriodController@stop_running_deduction', 'custom_label'=>'Stop Running Extra Deduction']);

            });


            Route::prefix('allowance')->as('allowance.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'AllowanceController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'AllowanceController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'AllowanceController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'AllowanceController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'AllowanceController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'AllowanceController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'AllowanceController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'AllowanceController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'AllowanceController@destroy']);
            });

            Route::prefix('deduction')->as('deduction.')->group(function () {
                Route::get('', ['as' => 'index', 'uses' => 'DeductionController@index', 'visible' => true]);
                Route::get('list', ['as' => 'list', 'uses' => 'DeductionController@listAll']);
                Route::get('create', ['as' => 'create', 'uses' => 'DeductionController@create']);
                Route::post('', ['as' => 'store', 'uses' => 'DeductionController@store']);
                Route::get('{id}', ['as' => 'show', 'uses' => 'DeductionController@show']);
                Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'DeductionController@edit']);
                Route::get('{id}/toggle', ['as' => 'toggle', 'uses' => 'DeductionController@toggle']);
                Route::put('{id}', ['as' => 'update', 'uses' => 'DeductionController@update']);
                Route::delete('{id}', ['as' => 'destroy', 'uses' => 'DeductionController@destroy']);
            });

        });

    });

});
