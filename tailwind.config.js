/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // usa 'class' para modo oscuro activado por clase
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#e63946',
        darkbg: '#0f0f0f',
        darkcard: '#1e1e1e',
        accent: '#ff6b6b',
      },
      fontFamily: {
        sans: ['Instrument Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
