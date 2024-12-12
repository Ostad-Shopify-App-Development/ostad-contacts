const colors = require('tailwindcss/colors')

export default {
    content: [
        //...
        './vendor/combindma/dash-ui/resources/views/**/*.blade.php',
        './resources/**/*.js',
    ],
    darkMode: 'class',
    theme: {
        container: {
            center: true,
            "max-width": {
                DEFAULT: '1rem',
                sm: '640px',
                lg: '768px',
                xl: '1024px',
                '2xl': '1280px',
            },
        },
        fontFamily: {
            sans: ['Inter', 'system-ui'],
        },
        fontSize: {
            xs: '0.75rem',
            sm: '0.8125rem',
            base: '0.875rem',
            lg: '1.25rem',
            xl: '1.5rem',
            '2xl': '1.875rem',
            '3xl': '2.25rem',
            '4xl': '3.052rem',
        },
        extend: {
            colors: {
                primary: colors.stone,
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
        require("@tailwindcss/typography")
    ],
}
