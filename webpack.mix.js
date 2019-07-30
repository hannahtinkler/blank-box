const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

let paths = {
  'npm': 'node_modules/'
};

mix.sass('resources/assets/sass/app.scss', 'public/css')
  .js([
    paths.npm + 'aos/dist/aos.js',
    'resources/assets/js/app.js',
  ], 'public/js/app.js').version()
  .browserSync({
    proxy: process.env.APP_URL
});
