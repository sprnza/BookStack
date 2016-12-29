var elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');

elixir(mix => {
    mix.sass('styles.scss');
    mix.sass('print-styles.scss');
    mix.sass('export-styles.scss');
    mix.webpack('global.js');
});
