function FormValidation () {
  function fieldHasError (field) {
    for (const error in field.validity) {
      if (field.validity[error] && !field.validity.valid) return error
    }

    return false
  }

  function getCustomMessage (field, errorType) {
    const valueMissing = 'Campo obrigatório'

    const messages = {
      text: {
        valueMissing
      },
      email: {
        valueMissing,
        typeMismatch: 'Digite um e-mail válido'
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
      number: {
        valueMissing,
        stepMismatch: 'Insira uma valor válido'
      },
      month: {
        valueMissing
      },
      url: {
        valueMissing,
        typeMismatch: 'Insire um URL válido'
      }
    }

    return messages[field.type][errorType] || ''
  }

  function setFieldRed (field) {
    field.classList.add('border-red-700')
    // field.classList.add("placeholder-red-700");
  }

  function setFieldDefault (field) {
    field.classList.remove('border-red-700')
    // field.classList.remove("placeholder-red-700");
  }

  function setValidationMessage (field) {
    const validationComponent = field.parentNode.querySelector(
      'label.error-label'
    )

    const hasError = fieldHasError(field)

    if (hasError) {
      const message = getCustomMessage(field, hasError)
      setFieldRed(field)
      validationComponent.innerHTML = message
    } else {
      setFieldDefault(field)
      validationComponent.innerHTML = ''
    }
  }

  function handleInvalidField (event) {
    const field = event.target

    setValidationMessage(field)
  }

  function validateForm () {
    const fields = document.querySelectorAll('form [name]')

    for (const field of fields) {
      field.addEventListener('invalid', (event) => {
        event.preventDefault()
        handleInvalidField(event)
      })
      field.addEventListener('blur', handleInvalidField)
    }
  }

  function init () {
    validateForm()
  }

  return {
    init
  }
}

window.addEventListener('load', () => {
  const formValidation = FormValidation()
  formValidation.init()
})
