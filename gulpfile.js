const gulp = require('gulp');
const elixir = require('laravel-elixir');

gulp.task("vendor", function() {
  return gulp.src('./node_modules/font-awesome/fonts/*').pipe(gulp.dest('./public/fonts'));
});

elixir(function(mix) {
  mix.sass('./assets/scss/main.scss').webpack('./assets/js/main.js');
});
