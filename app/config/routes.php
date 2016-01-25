<?php namespace Lucent;

function session($req) {
	@session_start();
	Log::info('Started Session...');
}

function auth($req) {
	@session_start();
	//return response(View::make('error.401', ['request' => $req]), 401);\
	Log::debugs('Authorized!'); // not seen due to default threshold of INFO
}

Route::Filter('Lucent\session', function() {
Route::Filter('Lucent\auth', function() {

	//--------------------------------------------------------------------------
	// Route: /
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/', function($req) {
		return View::make('index');
	});

	//--------------------------------------------------------------------------
	// Route: /hello
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/hello/:name', function($req) {
		return View::make('hello', ['name' => $req['name']]);
	});

	//--------------------------------------------------------------------------
	// Route: /api/admin/
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/api/admin/', function($req) {
		return 'ADMIN API!';
	});

	//--------------------------------------------------------------------------
	// Route: /api/admin
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/api/admin', function($req) {
		return new Redirect('/api/admin/', 301);
	});

	//--------------------------------------------------------------------------
	// Route: /api/
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/api/', function($req) {
		return 'API/';
	});	

	//--------------------------------------------------------------------------
	// Route: /api
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/api', function($req) {
		return 'API';
	});		

	//--------------------------------------------------------------------------
	// Route: /test
	// Method: Post
	//--------------------------------------------------------------------------
	Route::Post('/test', function($req) {	
	
		if($req->isAjax()) {
			return json_encode([
				'input' => json_decode(Input::all()),
				'post'  => Input::post('test'),
				'has'   => Input::has('test') ? "true" : "false",				
				'type'  => $req->mediaType()
			]);
		} else {
			echo '<pre>';
			echo Input::all();
			echo "\n";
			echo Input::all();
			echo "\n";
			echo Input::post('test');
			echo "\n";
			echo Input::has('test') ? "true" : "false";
			echo "\n";
			print_r($req->mediaType());
		}
	});

	//--------------------------------------------------------------------------
	// Route: /test
	// Method: Get
	//--------------------------------------------------------------------------
	Route::Get('/test', function($req) {
		return View::make('test');
	});
});
});

