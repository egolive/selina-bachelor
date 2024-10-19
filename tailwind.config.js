/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: 'rgb(0, 198, 178)',
                red: colors.red,
            },
        },
    },
  plugins: [],
}

