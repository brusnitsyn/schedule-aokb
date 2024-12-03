import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Liberation Serif'],
            },
            colors: {
                primary: '#5b9bd5',
                secondary: '#9bc2e6'
            },
            fontSize: {
                custom: '38px'
            }
        },
    },
    plugins: [],
};
