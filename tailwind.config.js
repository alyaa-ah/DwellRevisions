/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'lightest-green': '#C9F9C0',
        'light-green': '#1ABC02',
        'medium-green': '#149A03',
        'dark-green': '#0E7A03',
        'light-white': '#FFFFFF',
        'dark-white': '#EAEAEA',
      },

      extend: {
        textColor: ['hover', 'focus'],
        backgroundColor: ['hover', 'focus'],
      },
    },
  },
  plugins: [],
}


