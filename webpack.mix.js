let mix = require('laravel-mix');

mix.options({
    processCssUrls: false,
});

mix.js('resources/js/app.js', 'resources/dist/js/app.js')
    .css('resources/css/app.css', 'resources/dist/css/app.css');