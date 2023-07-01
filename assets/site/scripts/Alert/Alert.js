function Alert () {
  function show (selector, message, hideAfter = 4000) {
    const alert = document.querySelector(selector)
    if (!alert) return false

    const alertMessageElement = alert.querySelector('.alert__message')
    if (!alertMessageElement) return false

    alertMessageElement.innerText = message
    alert.classList.add('alert--active')

    hide(alert, hideAfter)
  }

  function hide (alert, hideAfter) {
    const timeout = setTimeout(() => {
      alert.classList.remove('alert--active')
    }, hideAfter)

    alert.addEventListener('click', () => {
      clearTimeout(timeout)
      alert.classList.remove('alert--active')
    })
  }

  function add (settings) {
    const { el, message, openClass, hideAfter = 2000 } = settings

    const openingElements = document.querySelectorAll(`.${openClass}`)
    if (!openingElements) return false

    openingElements.forEach(element => {
      element.addEventListener('click', () => {
        show(el, message, hideAfter)
      })
    })
  }

  return {
    show,
    add
  }
}

export { Alert }
