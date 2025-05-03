/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class', // 🔥 Ini wajib untuk toggle class-based dark mode
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'hidden',
    'flex',
    'fixed',
    'inset-0',
    'z-50',
    'bg-black',
    'bg-opacity-50'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
