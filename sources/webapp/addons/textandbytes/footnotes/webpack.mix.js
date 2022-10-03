const mix = require('laravel-mix')

mix.js('resources/js/bard.js', 'dist/js/footnotes.js')
  .vue({ version: 2 })
  .postCss('resources/css/footnotes.css', 'dist/css', [
    require('postcss-import'),
    require('postcss-nested'),
    require('tailwindcss'),
  ])
  .webpackConfig(require('./webpack.config'))