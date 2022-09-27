const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/cp.js', 'public/vendor/app/js')
    .extract()
    .vue(3)
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss/nesting'),
        require('tailwindcss'),
    ])
    .alias({
        '@': 'resources/js',
    })
    .webpackConfig({ 
        output: { chunkFilename: "js/app/[name].js?id=[chunkhash]" },
        module: {
            rules: [
              {
                test: /\.(postcss)$/,
                use: [
                  'vue-style-loader',
                  { loader: 'css-loader', options: { importLoaders: 1 } },
                  'postcss-loader'
                ]
              }
            ],
          },
    })
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
