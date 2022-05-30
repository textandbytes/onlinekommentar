const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Work Sans', 'sans-serif', ...defaultTheme.fontFamily.sans],
                serif: ['Libre Caslon Text', 'serif', ...defaultTheme.fontFamily.serif],
            },
             colors: {
              'ok-gray':'#707070',
              'ok-beige':'#E8E7E2',
              'ok-yellow':'#FCF0BD',
              'ok-orange':'#F4E8D7',
              'ok-blue':'#AFCEE2',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
