const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/*.antlers.html',
        './resources/views/**/*.antlers.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                regular: ['Libre Caslon Text', 'regular', ...defaultTheme.fontFamily.sans],
                sans: ['Work Sans', 'sans-serif', ...defaultTheme.fontFamily.sans],
                serif: ['Libre Caslon Text', 'serif', ...defaultTheme.fontFamily.serif],
            },
             colors: {
              'ok-gray':        '#707070',
              'ok-dark-gray':   '#575757',
              'ok-beige':       '#E8E7E2',
              'ok-light-beige': '#EFEFEF',
              'ok-yellow':      '#FCF0BD',
              'ok-orange':      '#F4E8D7',
              'ok-blue':        '#AFCEE2',
              'ok-red':         '#E06C56',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
