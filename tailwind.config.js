// tailwind.config.js
const forms = require('@tailwindcss/forms');
const typography = require('@tailwindcss/typography');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                'manrope': ['Manrope', 'sans-serif'],
                'fraunces': ['Fraunces', 'serif'],
                'barlow': ['Barlow', 'sans-serif'],
            },
            colors: {
                'primary' : '#d87d4a',
                'primary_hover' : '#c16c30',
                'primary_color_hover' : '#000000'
            }
        },
    },

    plugins: [
        require('flowbite/plugin'),
        forms,
        typography({
            // Add this configuration for the fontVariantCaps plugin
            modifiers: [],
        }),
    ],
};
