const mix = require('laravel-mix');
let ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;

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

mix.webpackConfig( {
    plugins: [
        new ImageminPlugin( {
            pngquant: {
                quality: '95-100',
            },
            test: /\.(jpe?g|png|gif|svg)$/i,
        } ),
    ],
} );

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/index.js', 'public/js/sisgec.app.js')
    .sass('resources/sass/index.scss', 'public/css/sisgec.app.css', {
        includePaths: ["node_modules/compass-mixins/lib"]
    })
    .sass('resources/sass/pdf.scss', 'public/css/pdf.css')
    .copy('resources/images', 'public/images', false )
    .copy('node_modules/fullcalendar/dist/locale-all.js', 'public/js/full-calendar/locale.js')
    .copy('node_modules/tippy.js/dist/tippy.standalone.js.map', 'public/js/tippy.standalone.js.map');