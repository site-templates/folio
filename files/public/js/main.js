/*
    Folio — the motion system.

    Layered so nothing ever breaks: without JavaScript the CSS shows
    everything; with JavaScript the header measures itself, the reveal system
    runs, and the nav indicator tracks the current page; with GSAP (loaded from
    the CDN in the layout head) the load choreography and the scrubbed header
    morph come alive. Reduced-motion users get content instantly.
*/
(function () {
    var docEl = document.documentElement
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

    var header = document.getElementById('header')
    var navBar = document.querySelector('[data-nav-bar]')
    var linksWrap = document.querySelector('[data-nav-links]')
    var indicator = document.querySelector('[data-nav-indicator]')
    var navLinks = Array.prototype.slice.call(document.querySelectorAll('[data-nav-link]'))

    /*
        The header collapse is a single interpolation between two widths, so
        both ends have to be measured from the real markup: the resting
        measure, and the width the bar wants once everything inside it has
        shrunk (--nav-p: 1). Measuring beats hard-coding — the pill then fits
        whatever brand name and links the site actually carries.
    */
    function measureNav() {
        if (!header || !navBar) return

        var held = header.style.getPropertyValue('--nav-p')

        header.style.setProperty('--nav-p', '0')
        navBar.style.width = 'auto'
        var restWidth = navBar.getBoundingClientRect().width

        header.style.setProperty('--nav-p', '1')
        navBar.style.width = 'max-content'
        var compactWidth = Math.min(navBar.getBoundingClientRect().width, restWidth)

        navBar.style.width = ''
        if (held) {
            header.style.setProperty('--nav-p', held)
        } else {
            header.style.removeProperty('--nav-p')
        }

        navBar.style.setProperty('--nav-rest-w', restWidth + 'px')
        navBar.style.setProperty('--nav-compact-w', compactWidth + 'px')
    }

    function remeasure() {
        measureNav()
        placeIndicator(activeLink, false)
        if (window.ScrollTrigger) ScrollTrigger.refresh()
    }

    measureNav()

    /*
        Web fonts land after first paint and change every measurement. Both
        hooks matter: fonts.ready can resolve before the stylesheet has even
        asked for the face, so the load event is the one that is always late
        enough to trust.
    */
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(remeasure)
    }

    window.addEventListener('load', remeasure)

    /*
        The indicator: a pill that rests behind the current page's link and
        follows the pointer across the others.
    */
    var activeLink = null
    var here = window.location.pathname.replace(/\/+$/, '') || '/'

    navLinks.forEach(function (link) {
        var path = (link.getAttribute('href') || '').replace(/\/+$/, '') || '/'
        if (path === '/' ? here === '/' : here === path || here.indexOf(path + '/') === 0) {
            activeLink = link
            link.setAttribute('data-active', '')
            link.setAttribute('aria-current', 'page')
        }
    })

    function placeIndicator(link, animate) {
        if (!indicator || !linksWrap) return

        if (!link) {
            indicator.style.opacity = '0'
            return
        }

        var origin = linksWrap.getBoundingClientRect()
        var box = link.getBoundingClientRect()
        var x = box.left - origin.left

        if (animate && window.gsap && !reduced) {
            gsap.to(indicator, {
                x: x,
                width: box.width,
                opacity: 1,
                duration: 0.42,
                ease: 'power3.out',
                overwrite: 'auto',
            })
        } else {
            if (window.gsap) gsap.set(indicator, { x: x, width: box.width })
            else indicator.style.transform = 'translateX(' + x + 'px)'
            indicator.style.width = box.width + 'px'
            indicator.style.opacity = '1'
        }
    }

    navLinks.forEach(function (link) {
        link.addEventListener('pointerenter', function () { placeIndicator(link, true) })
        link.addEventListener('focus', function () { placeIndicator(link, true) })
    })

    if (linksWrap) {
        linksWrap.addEventListener('pointerleave', function () { placeIndicator(activeLink, true) })
    }

    placeIndicator(activeLink, false)

    /* Scroll state: the fallback morph trigger, plus the reading progress. */
    function onScroll() {
        var top = window.scrollY || window.pageYOffset || 0
        var travel = docEl.scrollHeight - window.innerHeight

        docEl.style.setProperty(
            '--scroll-progress',
            travel > 0 ? Math.min(1, Math.max(0, top / travel)).toFixed(4) : '0'
        )

        if (!header) return
        if (top > 8) header.setAttribute('data-scrolled', '')
        else header.removeAttribute('data-scrolled')
    }

    onScroll()
    window.addEventListener('scroll', onScroll, { passive: true })

    var resizeTimer
    window.addEventListener('resize', function () {
        window.clearTimeout(resizeTimer)
        resizeTimer = window.setTimeout(function () {
            measureNav()
            placeIndicator(activeLink, false)
            onScroll()
            if (window.ScrollTrigger) ScrollTrigger.refresh()
        }, 120)
    })

    /* The mobile menu toggles .menu-open on the html element. */
    var menuButton = document.querySelector('[data-menu-button]')

    if (menuButton) {
        menuButton.addEventListener('click', function () {
            var open = docEl.classList.toggle('menu-open')
            menuButton.setAttribute('aria-expanded', open ? 'true' : 'false')
        })

        document.querySelectorAll('[data-mobile-panel] a').forEach(function (link) {
            link.addEventListener('click', function () {
                docEl.classList.remove('menu-open')
                menuButton.setAttribute('aria-expanded', 'false')
            })
        })

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape' || !docEl.classList.contains('menu-open')) return
            docEl.classList.remove('menu-open')
            menuButton.setAttribute('aria-expanded', 'false')
        })
    }

    /* The reveal system: flip .is-visible as each element enters the viewport. */
    var reveals = document.querySelectorAll('[data-reveal]')

    if (reduced || !('IntersectionObserver' in window)) {
        reveals.forEach(function (el) { el.classList.add('is-visible') })
    } else {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible')
                    io.unobserve(entry.target)
                }
            })
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.05 })

        reveals.forEach(function (el) { io.observe(el) })
    }

    /* GSAP choreography — the load sequence, the header morph, and parallax. */
    if (reduced || !window.gsap) return

    docEl.classList.add('gsap')

    if (window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger)
    }

    /*
        The load sequence. The header settles first, its pieces follow, and the
        headline starts rising while they are still arriving — the overlap is
        what makes the page feel like one movement instead of a queue.
    */
    var navItems = gsap.utils.toArray('[data-nav-item]')
    var lead = gsap.utils.toArray('[data-hero-lead]')
    var lines = gsap.utils.toArray('[data-hero-line]')
    var fades = gsap.utils.toArray('[data-hero-fade]')

    var intro = gsap.timeline({ defaults: { ease: 'power3.out' } })

    if (navBar) {
        intro.fromTo(navBar,
            { y: -16, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.9, ease: 'power4.out' },
            0
        )
    }

    if (navItems.length) {
        intro.fromTo(navItems,
            { y: -8, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.7, stagger: 0.08 },
            0.12
        )
    }

    if (lead.length) {
        intro.fromTo(lead,
            { y: 10, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.7 },
            0.2
        )
    }

    if (lines.length) {
        intro.set(lines, { yPercent: 115, opacity: 1 }, 0)
        intro.to(lines, { yPercent: 0, duration: 1.2, stagger: 0.11, ease: 'power4.out' }, 0.34)
    }

    if (fades.length) {
        intro.fromTo(fades,
            { y: 18, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.95, stagger: 0.09 },
            0.72
        )
    }

    if (!window.ScrollTrigger) return

    /*
        The header morph: one scrubbed number drives the whole collapse. The
        slight scrub lag is deliberate — the pill keeps moving for a beat after
        the scroll stops, which is what makes it feel weighted rather than
        switched.
    */
    if (header) {
        gsap.fromTo(header,
            { '--nav-p': 0 },
            {
                '--nav-p': 1,
                ease: 'none',
                scrollTrigger: {
                    start: 0,
                    end: 200,
                    scrub: 0.5,
                    invalidateOnRefresh: true,
                },
            }
        )
    }

    /* Imagery drifts inside its clipped frame as it crosses the viewport.
       The media wrapper is 112% tall, so the safe travel is about 10.7% of
       its own height — GSAP scrubs it edge to edge. */
    gsap.utils.toArray('[data-parallax] > .parallax-media, [data-parallax] > img').forEach(function (media) {
        gsap.fromTo(media,
            { yPercent: -10.7 },
            {
                yPercent: 0,
                ease: 'none',
                scrollTrigger: {
                    trigger: media.parentElement,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true,
                },
            }
        )
    })
})()
