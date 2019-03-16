const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/admin.js', 'public/js')

mix.sass('resources/sass/app.scss', 'public/css')

if (process.env.NODE_ENV === 'development') {
  mix.browserSync({
    proxy: 'animals.test',
    host: 'animals.test',
    open: 'external',
  })
}
