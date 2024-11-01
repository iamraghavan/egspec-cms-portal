const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .css('resources/css/app.css', 'public/css')
   .options({
       processCssUrls: false,
       postCss: [
           require('cssnano')({
               preset: 'default',
           }),
       ],
   })
   .minify('public/js/app.js')
   .version();
