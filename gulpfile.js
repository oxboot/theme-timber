const gulp = require('gulp');
const elixir = require('laravel-elixir');

elixir.extend('vendor', function() {
  new elixir.Task('vendor', function() {
    return gulp.src('./node_modules/font-awesome/fonts/*').pipe(gulp.dest('./public/fonts'));
  });
});

elixir(function(mix) {
  mix.vendor().sass('./assets/scss/main.scss').sass('./assets/scss/admin.scss').webpack('./assets/js/main.js');
});
