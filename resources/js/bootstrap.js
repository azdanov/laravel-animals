function importAll(r) {
  const images = {}
  r.keys().map(item => {
    images[item.replace('./', '')] = r(item)
  })
  return images
}

const images = importAll(require.context('../images', false, /\.(png|jpe?g|svg)$/))

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
