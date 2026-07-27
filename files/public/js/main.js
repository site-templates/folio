/*
    Folio — the motion system.

    Layered so nothing ever breaks: without JavaScript the CSS shows
    everything; with JavaScript the IntersectionObserver reveal system runs;
    with GSAP (loaded from the CDN in the layout head) the hero entrance and
    scroll parallax come alive. Reduced-motion users get content instantly.
*/
(function () {
    var docEl = document.documentElement
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

    /* The header tightens into a glass bar once content scrolls under it. */
    var header = document.getElementById('header')

    function onScroll() {
        if (!header) return
        if (window.scrollY > 8) {
            header.setAttribute('data-scrolled', '')
        } else {
            header.removeAttribute('data-scrolled')
        }
    }

    onScroll()
    window.addEventListener('scroll', onScroll, { passive: true })

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

    /* GSAP choreography — hero entrance and scroll parallax. */
    if (reduced || !window.gsap) return

    docEl.classList.add('gsap')

    if (window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger)
    }

    /* The hero headline rises line by line out of its clip boxes, then the
       supporting pieces fade up in sequence. */
    var lines = gsap.utils.toArray('[data-hero-line]')
    var fades = gsap.utils.toArray('[data-hero-fade]')

    if (lines.length) {
        var intro = gsap.timeline({ defaults: { ease: 'power4.out' } })

        intro.set(lines, { yPercent: 110, opacity: 1 })
        intro.to(lines, { yPercent: 0, duration: 1.1, stagger: 0.12 }, 0.1)

        if (fades.length) {
            intro.fromTo(fades,
                { y: 14, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.9, stagger: 0.1, ease: 'power3.out' },
                0.55
            )
        }
    } else if (fades.length) {
        gsap.fromTo(fades,
            { y: 14, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.9, stagger: 0.1, ease: 'power3.out' }
        )
    }

    /* Imagery drifts inside its clipped frame as it crosses the viewport.
       The media wrapper is 112% tall, so the safe travel is about 10.7% of
       its own height — GSAP scrubs it edge to edge. */
    if (window.ScrollTrigger) {
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
    }
})()
