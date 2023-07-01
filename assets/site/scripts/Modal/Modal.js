function Modal () {
  function add (selector, settings) {
    const modal = $(selector).slickModals({
      overlayBg: true,
      overlayBgColor: 'rgba(0, 0, 0, 0.4)',
      overlayTransition: 'ease',
      overlayTransitionSpeed: '0.4',
      windowLocation: 'center',
      windowTransitionSpeed: '0.4',
      windowTransitionEffect: 'slideTop',
      ...settings
    })

    return modal
  }

  return {
    add
  }
}

export { Modal }
