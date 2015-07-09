var elixir = require('laravel-elixir');
require('laravel-elixir-cachebust');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');

	mix.scripts([
		"lib/bootstrap.min.js",
		"lib/jquery.placeholder.min.js",
		"lib/ZeroClipboard.js",
		"app.js"
	]);

	mix.cachebust(["css/app.css", "js/all.js"],
		{
			file: "hashmap.json"
		}
	);
});
