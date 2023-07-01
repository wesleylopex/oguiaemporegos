import { ProgressBar } from '../ProgressBar/ProgressBar.js'
import { Header } from '../Header/Header.js'
import { FormValidation } from '../FormValidation/FormValidation.js'

function Utils () {
  function initProgressBar () {
    const progressBar = ProgressBar()
    progressBar.start()
  }

  function initHeader () {
    const header = Header()
    header.start()
  }

  function initMasks () {
    if (!$.prototype.mask) return false

    $('.cpf').mask('000.000.000-00')
    $('.rg').mask('0000000000')
    $('.phone').mask('(00) 000000000')
    $('.zip-code').mask('00000-000')
    $('.money').mask('000.000.000.000.000,00', { reverse: true })
    $('.date').mask('00/00/0000')
  }

  function initFeatherIcons () {
    feather.replace()
  }

  function hideLoader () {
    const loader = document.querySelector('#loader')

    if (!loader) return false

    loader.remove()
  }

  function initFormValidation () {
    const formValidation = FormValidation()
    formValidation.start()
  }

  function initDropdown () {
    const dropdowns = document.querySelectorAll('.dropdown')

    dropdowns.forEach(dropdown => {
      const toggle = dropdown.querySelector('.dropdown__toggle')
      const content = dropdown.querySelector('.dropdown__content')

      toggle.addEventListener('click', () => {
        content.classList.toggle('hidden')
      })

      const items = content.querySelectorAll('.dropdown__item')

      items.forEach(item => {
        item.addEventListener('click', () => {
          content.classList.add('hidden')
        })
      })

      window.addEventListener('click', event => {
        if (!dropdown.contains(event.target)) {
          content.classList.add('hidden')
        }
      })
    })
  }

  function start () {
    initProgressBar()
    initHeader()
    initMasks()
    initFeatherIcons()
    hideLoader()
    initFormValidation()
    initDropdown()
  }

  return {
    start
  }
}

export { Utils }
