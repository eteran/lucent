<?php namespace Lucent;

//------------------------------------------------------------------------------
// Route: /
// Method: GET
//------------------------------------------------------------------------------
Route::Get('/', [
	function($req, $res) {
		// a before filter, if you return anything, that's terminates the chain
	},
	function($req, $res) {
		return View::make('index');
	}
]);

//------------------------------------------------------------------------------
// Route: /hello
// Method: Post
//------------------------------------------------------------------------------
Route::Get('/hello/:name', function($req, $res) {
	return View::make('hello', ['name' => $req['name']]);
});
