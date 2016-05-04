var elixir = require('laravel-elixir');
var gutils = require('gulp-util');
var browserify = elixir.config.js.browserify;

browserify.transformers.push({
    name: "vueify",
    options : {}
});

elixir(function(mix) {

    /*
    //Define your paths here
    var Tasks= [
        // ["example/example.js",  "public/js/example.js"],
    ];
    var MoreTasks=[];

//Helpers functions
    function broMix(task)
    {
        mix.browserify(task[0], task[1]);
    }
    function BundleAll(array)
    {
        array.forEach(function(task){ broMix(task);});
    }
    function hotReload(task)
    {
        browserify.plugins.push({ name : "browserify-hmr", options: {} });
        broMix(task);
    }

    //If we run gulp watch we hotReload one Task ...
    if(gutils.env._.indexOf('watch') > -1){
        //Reloading the last task in Tasks
        hotReload(Tasks[Tasks.length - 1]);
    }
    //If we run gulp alone we bundle everything...
    else{
        BundleAll(Tasks);
        BundleAll(MoreTasks);
    } */

    mix.less([
        'inspinia/style.less'
    ], 'public/css/style.css');
});
