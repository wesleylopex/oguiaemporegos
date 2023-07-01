function Header () {
  const elements = {
    header: document.querySelector('header'),
    nav: document.querySelector('#nav'),
    burger: document.querySelector('#burger')
  }

  function initNavbar () {
    if (!elements.burger) return false

    elements.burger.addEventListener('click', function () {
      this.classList.toggle('active')
      document.body.classList.toggle('overflow-y-hidden')
    })
  }

  function hideHeaderOnScrollDown () {
    let prevScrollPos = window.pageYOffset

    window.addEventListener('scroll', function () {
      if (!elements.header) return false

      const currentScrollPos = window.pageYOffset
      const headerHeight = elements.header.clientHeight

      if (prevScrollPos > currentScrollPos || currentScrollPos < headerHeight) {
        elements.header.style.top = '0'
      } else {
        elements.header.style.top = `-${headerHeight}px`
      }

      prevScrollPos = currentScrollPos
    })
  }

  function setHeaderSpace () {
    if (!elements.header || !elements.nav) return false

    const { width } = window.screen

    const headerHeight = elements.header.clientHeight

    if (width < 1024) {
      elements.nav.style.top = `${headerHeight}px`
      elements.nav.style.height = `calc(100vh - ${headerHeight}px)`
    } else {
      elements.nav.style.top = '0px'
      elements.nav.style.height = 'auto'
    }

    const underHeaderElement = elements.header.nextElementSibling
    if (underHeaderElement) {
      underHeaderElement.style.marginTop = `${headerHeight}px`
    }
  }

  function onResize () {
    function onDocumentResize () {
      setTimeout(setHeaderSpace, 100)
    }

    window.addEventListener('resize', onDocumentResize)
  }

  function start () {
    initNavbar()
    hideHeaderOnScrollDown()
    setHeaderSpace()
    onResize()
  }

  return {
    start
  }
}

export { Header }
