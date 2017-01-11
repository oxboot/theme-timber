const elixir = require('laravel-elixir');

elixir(function(mix) {
  mix.sass('./assets/scss/main.scss').webpack('./assets/js/main.js');
});
