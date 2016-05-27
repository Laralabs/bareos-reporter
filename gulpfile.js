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

    /* ION Icons CSS and Fonts */
    mix.sass('./node_modules/ionicons/scss/ionicons.scss');
    mix.copy('node_modules/ionicons/fonts', 'public/fonts');

    /* Glyphicons */
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap');

    /* jQuery 2.2.0 */
    mix.copy('node_modules/jquery/dist/jquery.js', 'public/js');

    /* Bootstrap JS */
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/js');

    /* Bootstrap Select, Dropdown Replacement */
    mix.copy('node_modules/bootstrap-select/dist/css/bootstrap-select.css', 'public/css');
    mix.copy('node_modules/bootstrap-select/js/bootstrap-select.js', 'public/js');
    
    /* AdminLTE by Almsaeed Studio */
    mix.less('./vendor/almasaeed2010/adminlte/build/less/AdminLTE.less');
    mix.less('./vendor/almasaeed2010/adminlte/build/less/skins/skin-black.less');
    mix.copy('./vendor/almasaeed2010/adminlte/dist/js/app.js', 'public/js/adminlte.js');

    /* DataTables Tasks */
    elixir(function(mix) {
        mix.scripts([
            '../../../node_modules/datatables.net/js/jquery.dataTables.js',
            '../../../node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
            '../../../node_modules/datatables.net-autofill/js/dataTables.autoFill.js',
            '../../../node_modules/datatables.net-autofill-bs/js/autoFill.bootstrap.js',
            '../../../node_modules/datatables.net-buttons/js/dataTables.buttons.js',
            '../../../node_modules/datatables.net-buttons/js/buttons.colVis.js',
            '../../../node_modules/datatables.net-buttons/js/buttons.html5.js',
            '../../../node_modules/datatables.net-buttons-bs/js/buttons.bootstrap.js',
            '../../../node_modules/datatables.net-fixedheader/js/dataTables.fixedHeader.js',
            '../../../node_modules/datatables.net-responsive/js/dataTables.responsive.js',
            '../../../node_modules/datatables.net-responsive-bs/js/responsive.bootstrap.js'
        ], 'public/js/dataTables.js');
    });

    elixir(function(mix) {
        mix.styles([
            '../../../node_modules/datatables.net-bs/css/dataTables.bootstrap.css',
            '../../../node_modules/datatables.net-autofill-bs/css/autoFill.bootstrap.css',
            '../../../node_modules/datatables.net-buttons-bs/css/buttons.bootstrap.css',
            '../../../node_modules/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.css',
            '../../../node_modules/datatables.net-responsive-bs/css/responsive.bootstrap.css'
        ], 'public/css/dataTables.css');
    })
});
