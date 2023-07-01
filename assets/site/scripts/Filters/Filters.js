function Filters () {
  const elements = {
    form: document.querySelector('#filters-form'),
    clear: document.querySelector('#clear-filters'),
    selects: $('.select2')
  }

  function start () {
    elements.clear.addEventListener('click', clearAll)
    elements.selects.select2()
  }

  function clearAll () {
    elements.form.reset()

    elements.form.querySelectorAll('[name]').forEach(input => {
      input.value = ''
      input.checked = false
    })

    elements.selects.select2().val('')
  }

  return {
    start
  }
}

export { Filters }
