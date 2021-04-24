const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
var libJs = [
	'resources/lib/jquery/jquery3.4.1.min.js',
	'resources/lib/bootstrap/js/bootstrap.min.js',
 ];

var helperJs = [
 	'resources/js/script.js',
	'resources/js/helper/button.js',
	'resources/js/helper/toast.js',
	'resources/js/helper/url.js',
	'resources/js/helper/preload.js',
	'resources/js/helper/div.js',
	'resources/js/helper/modal.js',
	'resources/js/helper/form.js',
];

var appJs = [
	'resources/js/auth/auth.js',
	'resources/js/problem/problem_dashboard.js',
	'resources/js/problem/problem_details_editor.js'
];

var scripts = [].concat(libJs,helperJs,appJs);

mix.scripts(scripts, 'public/js/app.js').version();
