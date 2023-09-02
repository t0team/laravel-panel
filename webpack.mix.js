let mix = require('laravel-mix');

mix.options({
    processCssUrls: false,
});

mix.js('resources/js/app.js', 'resources/dist/js/app.js')
    .css('resources/css/app.css', 'resources/dist/css/app.css')

    .css('resources/css/typographies/dana.css', 'resources/dist/css/typographies')
    .css('resources/css/typographies/nunito.css', 'resources/dist/css/typographies')

    .css('resources/css/ltr.css', 'resources/dist/css/ltr.css')
    .css('resources/css/rtl.css', 'resources/dist/css/rtl.css');
