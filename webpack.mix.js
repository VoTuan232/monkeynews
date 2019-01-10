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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/like_post.js', 'public/js/like_post.js');
mix.js('resources/js/save_post.js', 'public/js/save_post.js');
mix.js('resources/js/delete_comment.js', 'public/js/delete_comment.js');
mix.js('resources/js/custom_comment.js', 'public/js/custom_comment.js');
mix.js('resources/js/show_image.js', 'public/js/show_image.js');
mix.js('resources/js/edit_profile.js', 'public/js/edit_profile.js');