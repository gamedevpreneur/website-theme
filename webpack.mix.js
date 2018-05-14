let mix = require('laravel-mix');

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

mix.setPublicPath('public')
   //.js('resources/assets/js/theme.js', 'public/js')
   //.js('resources/assets/js/admin.js', 'public/js')
   //.js('resources/assets/js/customizer.js', 'public/js')
   //.sass('resources/assets/sass/theme.scss', 'public/css')
   //.minify('public/css/theme.css')
   //.minify('public/js/theme.js')
   //.copy('resources/assets/img', 'public/img')
   //.sass('resources/assets/sass/admin.scss', 'public/css')
   //.minify('public/css/admin.css')
   //.minify('public/js/admin.js');

mix.options({
    postCss: [
        require('autoprefixer')({
            grid: true,
        }),
    ],
});

mix.browserSync({
    files: [
        './public/css/*.min.css',
        './public/js/*.min.js',
        './**/*.php',
    ],
    proxy: "localhost/rew/",
    notify: false,
})
