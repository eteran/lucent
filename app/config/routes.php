<?php namespace Lucent;

//------------------------------------------------------------------------------
// Route: /
// Method: Get
//------------------------------------------------------------------------------
Route::Get('/', [
	function($req) {
		// a before filter, if you return anything, that's terminates the chain
	},
	function($req) {
		return View::make('index');
	}
]);

//------------------------------------------------------------------------------
// Route: /hello
// Method: Get
//------------------------------------------------------------------------------
Route::Get('/hello/:name', function($req) {
	return View::make('hello', ['name' => $req['name']]);
});
