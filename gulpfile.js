var elixir = require('laravel-elixir');
var gutils = require('gulp-util');
var browserify = elixir.config.js.browserify;

browserify.transformers.push({
    name: "vueify",
    options : {}
});

elixir(function(mix) {
    mix.sass([
        'app.scss'
    ], 'public/css/app.css');
    mix.less([
        'inspinia/style.less'
    ], 'public/css/inspinia.css');
});
