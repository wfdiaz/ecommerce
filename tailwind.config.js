const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                orange: colors.orange,
                greenLime: colors.lime,
                pantone: {
                    1255: '#BC831A',
                    1245: '#D1A32C',
                    7404: '#F9D73F',
                    393: '#F9E675',
                }
            }       
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
