# lucent

A light and simple PHP5 framework. The goal of lucent is simple. To be a 
minimalistic yet useful light weight PHP framework.

Most frameworks that I see offer **a lot** of features. While they are often
very useful, they also create complexity, even when founded on simple ideas.

Lucent strives to stay simple, by focusing on the basics. Lucent will provide:

1. A simple, clean syntax for routes, supporting things like named parameters 
   and middleware.
2. Separation between code and HTML through views.
3. Helper classes to deal with common data conversions and error handling. 
   Including those which help implement RESTful APIs.

However, it will **not provide** any of the following. Not because I don't like
these features. But because everyone has a preference, and I'd rather let the
developer decide which (if any) they would like to use.

1. A database abstraction layer.
2. A templating language. PHP **is** a templating language, we don't need 
   another one on top by default.
3. "Automagical" routing or other features which are unexpected on by default.
   I want the developer to have full control of the behavior of the app, with 
   no surprises.
   
Lucent is somewhat inspired by many existing frameworks such as 
[Laravel](http://laravel.com/). Which is a wonderful framework, that I'd 
recommend people try. But even that has had a few automatic features which
caused me some grief.

Usage is **simple**. To create routes, open `app/config/routes.php` and write
easy to understand code like the following:


	Route::Get('/', function($req, $res) {
		return View::make('index');
	});

	Route::Get('/hello/:name', function($req, $res) {
		return View::make('hello', ['name' => $req['name']]);
	});

The second paramter can be **any** callable type, for small sites, lambdas 
work great! It can also be an array of callable types to support middleware. If 
any function returns data, then it stops the chain, making pre and post filters
trivial to implement.

As mentioned before, Lucent uses PHP as the templating system. So no new syntax 
to learn. Just place you views in `app/resources/views` and you're good to go.
The usage of views is very inspired by the effective syntax of 
[Laravel](http://laravel.com/). You can place views in a directory heirarchy, 
and access them with dot syntax. For example:

    return View::make('foo.bar');
	
will use the file `app/resources/views/foo/bar.php` as the template. It is 
still very much a work in progress, but already I'm finding it simple and easy
to work with.
