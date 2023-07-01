function ImagePreview ({ input, preview, toggle }) {
  function onInputChange (event) {
    const [file] = event.target.files
    const [fileType] = file.type.split('/')

    if (fileType !== 'image') {
      throw new Error('You should choose only images')
    }

    const previewElements = document.querySelectorAll(preview)
    previewElements.forEach(previewElement => {
      setPreviewInfo(previewElement, file)
    })
  }

  function setPreviewInfo (previewElement, file) {
    previewElement.src = URL.createObjectURL(file)
    previewElement.addEventListener('load', () => URL.revokeObjectURL(previewElement.src))
  }

  function startPreview () {
    if (input) input.addEventListener('change', onInputChange)
  }

  function startInput () {
    if (toggle) toggle.addEventListener('click', () => input.click())
  }

  function start () {
    startPreview()
    startInput()
  }

  return {
    start
  }
}

export { ImagePreview }
