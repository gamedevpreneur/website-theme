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
   .js('resources/assets/js/theme.js', 'public/js')
   .combine(['public/js/theme.js', 'resources/assets/js/prism.js'], 'public/js/theme.js')
   .minify('public/js/theme.js')
   .sass('resources/assets/sass/theme.scss', 'public/css')
   .minify('public/css/theme.css')
   .copy('resources/assets/img', 'public/img')

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
