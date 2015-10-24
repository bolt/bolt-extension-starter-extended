var elixir = require('laravel-elixir');

require('laravel-elixir-stylus');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your application. By default, we are compiling the Sass
 | file for our application, but you can switch to stylus if you want.
 |
 | Read more about Laravel Elixir here:
 | http://laravel.com/docs/5.1/elixir
 */

elixir(function(mix) {
    mix.sass('app.scss', 'assets/extension.css');
    //mix.stylus('app.styl', 'assets/extension.css');
});
