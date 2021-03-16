let mix = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        symlinks: false
    },
    externals: {
        jquery: 'jQuery',
        bootstrap: true,
        vue: 'Vue'
    }
})

mix.options({
    processCssUrls: false,
    clearConsole: false,
    // Disable extracting licenses from comments
    terser: {
        extractComments: false,
    }
})

mix.setPublicPath('..')

mix.sass('assets/sass/item-list.scss', 'css/v-item-list.css')
    .js('assets/js/index.js', 'js/v-item-list.js')

mix.disableNotifications()

// Disable mix-manifest.json
// @see https://github.com/JeffreyWay/laravel-mix/issues/580
Mix.manifest.refresh = _ => void 0;
