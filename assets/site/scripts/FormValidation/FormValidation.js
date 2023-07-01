function FormValidation () {
  function fieldHasError (field) {
    for (const error in field.validity) {
      if (field.validity[error] && !field.validity.valid) {
        return error
      }
    }

    return false
  }

  function getErrorMessage (field, errorType) {
    const valueMissing = 'Campo obrigatório'
    const tooShort = `Campo deve ter pelo menos ${field.minLength} caracteres`
    const messages = {
      text: {
        valueMissing,
        tooShort
      },
      number: {
        valueMissing,
        tooShort,
        rangeUnderflow: `Número abaixo do limite (${field.min})`,
        rangeOverflow: `Número acima do limite (${field.max})`
      },
      email: {
        valueMissing,
        typeMismatch: 'Digite um e-mail válido',
        tooShort
      },
      'select-one': {
        valueMissing
      },
      textarea: {
        valueMissing
      },
      password: {
        valueMissing
      },
      date: {
        valueMissing
      },
      month: {
        valueMissing
      },
      checkbox: {
        valueMissing
      },
      file: {
        valueMissing
      }
    }
    return messages[field.type][errorType]
  }

  function showErrorOnField (field, message) {
    const validationComponent = field.parentNode.querySelector('label.input-label--error')

    if (validationComponent) {
      validationComponent.innerHTML = message
    }

    field.classList.add('border-yellow-600')
  }

  function hideErrorOnField (field) {
    const validationComponent = field.parentNode.querySelector('label.input-label--error')

    if (validationComponent) {
      validationComponent.innerHTML = ''
    }

    field.classList.remove('border-yellow-600')
  }

  function setValidationMessage (field) {
    const hasError = fieldHasError(field)

    if (hasError) {
      const message = getErrorMessage(field, hasError)
      showErrorOnField(field, message)
    } else {
      hideErrorOnField(field)
    }
  }

  function handleInvalidField (event) {
    const field = event.target
    setValidationMessage(field)
  }

  function handleResetValidation (fields) {
    for (const field of fields) {
      hideErrorOnField(field)
    }
  }

  function validateForms () {
    const forms = document.querySelectorAll('form')

    if (!forms) return false

    forms.forEach(form => {
      form.addEventListener('reset', () => {
        handleResetValidation(fields)
      })

      const fields = form.querySelectorAll('[name]')

      for (const field of fields) {
        field.addEventListener('invalid', (event) => {
          event.preventDefault()
          handleInvalidField(event)
        })

        field.addEventListener('blur', handleInvalidField)
      }
    })
  }

  function start () {
    validateForms()
  }

  return {
    start
  }
}

export { FormValidation }
