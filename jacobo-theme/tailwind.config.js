module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './src/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        azulNoche: '#0A0C1F',
        cianElectrico: '#00F6FF',
        violetaNeon: '#C000FF',
        blancoPuro: '#FFFFFF',
        grisClaro: '#E0E0E0',
        // ... mantener otros colores existentes si los hay y son necesarios
      },
      fontFamily: {
        sora: ['Sora', 'sans-serif'],
        clashDisplay: ['"Clash Display"', 'sans-serif'], // Comillas necesarias si el nombre tiene espacios
        inter: ['Inter', 'sans-serif'],
        satoshi: ['Satoshi', 'sans-serif'],
        // ... mantener otras fuentes existentes si las hay y son necesarias
      }
    },
  },
  plugins: [],
}
