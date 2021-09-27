//const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',

    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
            screens: {
                light: { raw: "(prefers-color-scheme: light)" },
                dark: { raw: "(prefers-color-scheme: dark)" }
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
                'light-blue': '#caf0f8',
                'jet': '#343434',
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
        function({ addBase, config }) {
            addBase({
                body: {
                    color: config("theme.colors.black"),
                    backgroundColor: config("theme.colors.white")
                },
                "@screen dark": {
                    body: {
                        color: config("theme.colors.white"),
                        backgroundColor: config("theme.colors.black")
                    }
                }
            });
        }
    ],
};
