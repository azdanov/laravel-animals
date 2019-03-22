const mix = require('laravel-mix')

mix
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/admin.js', 'public/js')
  .js('resources/js/user.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .version()

if (process.env.NODE_ENV === 'development') {
  mix.browserSync({
    proxy: 'animals.test',
    host: 'animals.test',
    open: 'external',
  })
}
