//const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    darkMode: 'class',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
            colors: {
                main: {
                    light: "#1974D2",
                    DEFAULT: '#094074',
                },
                green: {
                    DEFAULT: '#008F93',
                    light: '#30BFBF',
                },
                dark: {
                    bg: "#151823",
                    "eval-1": "#222738",
                    "eval-2": "#2A2F42",
                    "eval-3": "#2C3142",
                },
                'light-blue': '#caf0f8',
                //'jet': '#343434',
                'jet': '#222222',
            },
            backgroundImage: {
                'main-swimmer': "url('/images/main-swimmer.png')",
                'wave-1': "url('/images/waves11.svg')",
                'wave-2': "url('/images/waves22.svg')",
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
