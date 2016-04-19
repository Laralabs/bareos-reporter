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

    /* Main Bootstrap and Application Styles */
    mix.sass('app.scss');

    /* Font Awesome CSS and Fonts */
    mix.sass('font-awesome.scss');
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

    /* Glyphicons */
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap');

    /* jQuery 2.2.0 */
    mix.copy('node_modules/jquery/dist/jquery.js', 'public/js');

    /* Bootstrap JS */
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/js');
});
