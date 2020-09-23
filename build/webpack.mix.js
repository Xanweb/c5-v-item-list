let mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        symlinks: false
    },
    externals: {
        jquery: 'jQuery',
        vue: 'Vue'
    }
})

mix.setPublicPath('..');

mix.js('assets/js/index.js', 'js/c5-item-list.js')
    .disableNotifications();

// Disable mix-manifest.json
// @see https://github.com/JeffreyWay/laravel-mix/issues/580
Mix.manifest.refresh = _ => void 0;