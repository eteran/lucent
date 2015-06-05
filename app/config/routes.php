<?php namespace Lucent;

//------------------------------------------------------------------------------
// Route: /
// Method: GET
//------------------------------------------------------------------------------
Route::Get('/', [
	function($req, $res) {
		// a before filter
	},
	function($req, $res) {
		return View::make('index');
	}
]);

//------------------------------------------------------------------------------
// Route: /hello
// Method: Post
//------------------------------------------------------------------------------
Route::Get('/hello/:id', function($req, $res) {
	return View::make('hello', ['name' => $req['id']]);
});
