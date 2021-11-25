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

            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        backgroundColor: theme('colors.white'),
                        color: theme('colors.gray.900'),
                        a: {
                            color: theme('colors.green.DEFAULT'),
                            '&:hover': {
                                color: theme('colors.green.light'),
                            },
                        },
                        pre: {
                            color: theme('colors.gray.900'),
                            backgroundColor: theme('colors.white'),
                        }
                    },
                },
                dark: {
                    css: {
                        color: theme('colors.gray.100'),
                        backgroundColor: theme('colors.gray.600'),
                        '[class~="lead"]': {
                            color: theme('colors.gray.100'),
                        },
                        a: {
                            color: theme('colors.green.light'),
                            '&:hover': {
                                color: theme('colors.green.DEFAULT'),
                            },
                        },
                        strong: {
                            color: theme('colors.white'),
                        },
                        'ol > li::before': {
                            color: theme('colors.gray.200'),
                        },
                        'ul > li::before': {
                            backgroundColor: theme('colors.gray.600'),
                        },
                        hr: {
                            borderColor: theme('colors.gray.200'),
                        },
                        blockquote: {
                            color: theme('colors.gray.200'),
                            borderLeftColor: theme('colors.gray.600'),
                        },
                        h1: {
                            color: theme('colors.white'),
                        },
                        h2: {
                            color: theme('colors.white'),
                        },
                        h3: {
                            color: theme('colors.white'),
                        },
                        h4: {
                            color: theme('colors.white'),
                        },
                        'figure figcaption': {
                            color: theme('colors.gray.200'),
                        },
                        pre: {
                            color: theme('colors.gray.100'),
                            backgroundColor: theme('colors.gray.600'),
                        },
                        thead: {
                            color: theme('colors.white'),
                            borderBottomColor: theme('colors.gray.200'),
                        },
                        'tbody tr': {
                            borderBottomColor: theme('colors.gray.600'),
                        },
                    },
                },
            }),
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
