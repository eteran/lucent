<?php

//------------------------------------------------------------------------------
// Route: /
// Method: GET
//------------------------------------------------------------------------------
Framework::Get('/', [
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
Framework::Get('/hello', function($req, $res) {
	return View::make('hello', ['name' => 'User!']);
});
