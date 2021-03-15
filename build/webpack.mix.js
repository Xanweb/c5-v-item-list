let mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        symlinks: false
    },
})

mix.options({
    terser: {
        extractComments: false,
    }
})

mix.setPublicPath('..');

mix .sass('assets/sass/item-list.scss', 'css/item-list.css')
    .js('assets/js/index.js', 'js/c5-item-list.js')
    .disableNotifications();

// Disable mix-manifest.json
// @see https://github.com/JeffreyWay/laravel-mix/issues/580
Mix.manifest.refresh = _ => void 0;
