function importAll(r) {
  const files = {}
  r.keys().map(file => {
    files[file.replace('./', '')] = r(file)
  })
  return files
}

importAll(require.context('../images', false, /\.(png|jpe?g|svg)$/))
importAll(require.context('../images/avatars', false, /\.(png|jpe?g|svg)$/))
importAll(require.context('../images/categories', false, /\.(png|jpe?g|svg)$/))
importAll(require.context('../images/pets', false, /\.(png|jpe?g|svg)$/))

document.addEventListener('DOMContentLoaded', () => {
  const $navbarBurgers = Array.prototype.slice.call(
    document.querySelectorAll('.navbar-burger'),
    0,
  )

  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach($el => {
      $el.addEventListener('click', () => {
        const target = $el.dataset.target
        const $target = document.getElementById(target)
        $el.classList.toggle('is-active')
        $target.classList.toggle('is-active')
      })
    })
  }
})
