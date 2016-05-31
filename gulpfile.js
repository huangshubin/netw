var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir(function(mix) {
  mix.styles([
	  'bootstrap/dist/css/bootstrap.css',
	  'bootstrap/dist/css/bootstrap-theme.css',
	  '../css/app.css'
  	],'public/css/built-all.css','public/vendor');


mix.scripts(
	[
		'jquery/dist/jquery.js',
		'bootstrap/dist/js/bootstrap.js'
	],
  	'public/js/built-all.js','public/vendor');

mix.copy('public/vendor/bootstrap/dist/fonts','public/fonts')

});
