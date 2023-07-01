function ProgressBar () {
  function start () {
    try {
      const progressBar = document.querySelector('.progress-bar')
      const progressBarPercentageElement = progressBar.querySelector('.progress-bar__percentage')

      const { percentage } = progressBarPercentageElement.dataset

      progressBarPercentageElement.style.width = `${percentage}%`
    } catch (error) {
      return null
    }
  }

  return {
    start
  }
}

export { ProgressBar }
