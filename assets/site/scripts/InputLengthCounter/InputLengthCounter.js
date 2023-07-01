function InputLengthCounter (selector) {
  function init () {
    const counters = document.querySelectorAll(selector)

    counters.forEach(counter => {
      const inputSelector = counter.dataset.input
      const input = document.querySelector(inputSelector)
      if (!input) return false

      const inputMaxLength = input.maxLength
      if (!inputMaxLength) return false

      const labelSelector = counter.dataset.label
      const label = counter.querySelector(labelSelector)
      label.innerText = `${input.value.length}/${inputMaxLength}`

      input.addEventListener('keydown', () => {
        label.innerText = `${input.value.length}/${inputMaxLength}`
      })
    })
  }

  return {
    init
  }
}

export { InputLengthCounter }
