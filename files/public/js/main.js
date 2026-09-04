/*
    Folio — the motion system.

    Layered so nothing ever breaks: without JavaScript the CSS shows
    everything; with JavaScript the header measures itself, the reveal system
    runs, and the nav indicator tracks the current page; with GSAP (loaded from
    the CDN in the layout head) the load choreography and the scrubbed header
    morph come alive. Reduced-motion users get content instantly.

    Pages change in place (instant navigation swaps <main> and keeps the
    header): the header wires itself once, while everything that touches page
    content — reveals, the hero entrance, parallax — lives in setUp(root),
    run on load and again for each new <main> after the old one's observers
    and scroll triggers are torn down.
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

        /*
            Without GSAP, --nav-p is transitioned in CSS — so forcing it to 1
            here would ease toward the compact state rather than land on it,
            and we would measure a half-collapsed bar. Pin the transition off
            for the duration of the probe.
        */
        header.style.transition = 'none'

        header.style.setProperty('--nav-p', '0')

        /*
            The availability line's natural width, so CSS can close it to zero
            as the pill shuts. It stretches to its parent, so its own box is no
            guide — max-content is.
        */
        var badge = navBar.querySelector('[data-nav-badge]')

        if (badge) {
            badge.style.maxWidth = 'none'
            badge.style.width = 'max-content'
            navBar.style.setProperty('--nav-badge-w', badge.getBoundingClientRect().width + 'px')
            badge.style.width = ''
            badge.style.maxWidth = ''
        }

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

        /* Settle the restored value before the transition is armed again. */
        void navBar.offsetWidth
        header.style.transition = ''
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

    /*
        Which link is the current page is read from the address, so it is
        recomputed after every in-place page change (the runtime resets the
        header links to their server-rendered attributes first).
    */
    function markActive() {
        var here = window.location.pathname.replace(/\/+$/, '') || '/'

        activeLink = null

        navLinks.forEach(function (link) {
            var path = (link.getAttribute('href') || '').replace(/\/+$/, '') || '/'
            if (path === '/' ? here === '/' : here === path || here.indexOf(path + '/') === 0) {
                activeLink = link
                link.setAttribute('data-active', '')
                link.setAttribute('aria-current', 'page')
            } else {
                link.removeAttribute('data-active')
                link.removeAttribute('aria-current')
            }
        })
    }

    markActive()

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
        var travel = docEl.scrollHeight - docEl.clientHeight
        var progress = travel > 0 ? Math.min(1, Math.max(0, top / travel)) : 0

        /*
            Under browser zoom or on a fractional-DPR display these two
            heights round against each other, so the last couple of pixels of
            scroll never arrive and the bar stops a sliver short of full.
            Anything within 2px of the end counts as the end.
        */
        if (travel > 0 && travel - top <= 2) {
            progress = 1
        }

        docEl.style.setProperty('--scroll-progress', progress.toFixed(4))

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

    function closeMenu() {
        docEl.classList.remove('menu-open')
        if (menuButton) menuButton.setAttribute('aria-expanded', 'false')
    }

    if (menuButton) {
        menuButton.addEventListener('click', function () {
            var open = docEl.classList.toggle('menu-open')
            menuButton.setAttribute('aria-expanded', open ? 'true' : 'false')
        })

        document.querySelectorAll('[data-mobile-panel] a').forEach(function (link) {
            link.addEventListener('click', closeMenu)
        })

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape' || !docEl.classList.contains('menu-open')) return
            closeMenu()
        })
    }

    /*
        The reveal system: flip .is-visible as each element enters the
        viewport. One observer serves the whole visit; the targets that belong
        to the current <main> are remembered so they can be released when the
        page changes underneath them.
    */
    var io = null
    var watched = []

    function setUpReveals(root) {
        var reveals = Array.prototype.slice.call(root.querySelectorAll('[data-reveal]'))

        if (reduced || !('IntersectionObserver' in window)) {
            reveals.forEach(function (el) { el.classList.add('is-visible') })
            return
        }

        if (!io) {
            io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible')
                        io.unobserve(entry.target)
                    }
                })
            }, { rootMargin: '0px 0px -10% 0px', threshold: 0.05 })
        }

        reveals.forEach(function (el) {
            io.observe(el)
            watched.push(el)
        })
    }

    /* GSAP choreography — the load sequence, the header morph, and parallax. */
    var motion = !reduced && !!window.gsap

    if (motion) {
        docEl.classList.add('gsap')

        if (window.ScrollTrigger) {
            gsap.registerPlugin(ScrollTrigger)
        }
    }

    /*
        The load sequence. The header settles first, its pieces follow, and the
        headline starts rising while they are still arriving — the overlap is
        what makes the page feel like one movement instead of a queue.

        That entrance only earns its length where there is a hero to accompany
        it. On the inner pages the header is simply there from the first paint
        — no fade, no slide — and the content's own reveals carry the page.

        The header's half runs once, on load; the hero's half is per page.
    */
    if (motion) {
        var navItems = gsap.utils.toArray('[data-nav-item]')
        var hasHero = document.querySelector('[data-hero-line]') !== null

        if (hasHero) {
            var headerIntro = gsap.timeline({ defaults: { ease: 'power3.out' } })

            if (navBar) {
                headerIntro.fromTo(navBar,
                    { y: -16, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.9, ease: 'power4.out' },
                    0
                )
            }

            if (navItems.length) {
                headerIntro.fromTo(navItems,
                    { y: -8, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.7, stagger: 0.08 },
                    0.12
                )
            }
        } else {
            var shown = navItems.slice()

            if (navBar) {
                shown.push(navBar)
            }

            /* Opacity only — nothing here is ever moved, so leave transform alone. */
            gsap.set(shown, { opacity: 1 })
        }
    }

    var heroIntro = null

    /*
        Going back or forward restores a page the visitor has already seen,
        so its hero lands in its settled state instead of entering again. A
        page change that a link click started is the only kind that plays it.
    */
    var clicked = false

    document.addEventListener('click', function (event) {
        clicked = !!(event.target && event.target.closest && event.target.closest('a[href]'))
    }, true)

    function setUpHero(root, settled) {
        if (!motion) return

        var lead = gsap.utils.toArray('[data-hero-lead]', root)
        var lines = gsap.utils.toArray('[data-hero-line]', root)
        var fades = gsap.utils.toArray('[data-hero-fade]', root)

        if (!lead.length && !lines.length && !fades.length) return

        heroIntro = gsap.timeline({ defaults: { ease: 'power3.out' } })

        if (lead.length) {
            heroIntro.fromTo(lead,
                { y: 10, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.7 },
                0.2
            )
        }

        if (lines.length) {
            heroIntro.set(lines, { yPercent: 115, opacity: 1 }, 0)
            heroIntro.to(lines, { yPercent: 0, duration: 1.2, stagger: 0.11, ease: 'power4.out' }, 0.34)
        }

        if (fades.length) {
            heroIntro.fromTo(fades,
                { y: 18, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.95, stagger: 0.09 },
                lines.length ? 0.72 : 0.15
            )
        }

        if (settled) {
            heroIntro.progress(1)
        }
    }

    /*
        The header morph: one scrubbed number drives the whole collapse. The
        slight scrub lag is deliberate — the pill keeps moving for a beat after
        the scroll stops, which is what makes it feel weighted rather than
        switched. It lives for the whole visit, so its trigger carries an id
        that the per-page teardown leaves alone.
    */
    if (motion && window.ScrollTrigger && header) {
        gsap.fromTo(header,
            { '--nav-p': 0 },
            {
                '--nav-p': 1,
                ease: 'none',
                scrollTrigger: {
                    id: 'nav-morph',
                    start: 0,
                    end: 200,
                    scrub: 0.5,
                    invalidateOnRefresh: true,
                },
            }
        )
    }

    /* Imagery drifts inside its clipped frame as it crosses the viewport. The
       media hangs 6% past each end of the frame, which is 5.35% of its own
       height — so it scrubs edge to edge without ever exposing the frame. */
    function setUpParallax(root) {
        if (!motion || !window.ScrollTrigger) return

        gsap.utils.toArray('[data-parallax] > .parallax-media, [data-parallax] > img', root).forEach(function (media) {
            gsap.fromTo(media,
                { yPercent: -5.35 },
                {
                    yPercent: 5.35,
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

    /*
        Everything the previous <main> owned goes before the next one is
        wired: its reveal targets, its hero entrance, and every scroll trigger
        except the header morph.
    */
    function tearDown() {
        if (io) {
            watched.forEach(function (el) { io.unobserve(el) })
        }
        watched = []

        if (heroIntro) {
            heroIntro.kill()
            heroIntro = null
        }

        if (window.ScrollTrigger) {
            ScrollTrigger.getAll().forEach(function (trigger) {
                if (trigger.vars.id === 'nav-morph') return
                if (trigger.animation) trigger.animation.kill()
                trigger.kill()
            })
        }
    }

    function setUp(root, settled) {
        tearDown()
        setUpReveals(root)
        setUpHero(root, settled)
        setUpParallax(root)
    }

    setUp(document)

    /*
        A page changed in place: close the menu so the visitor lands clean,
        point the header at the new address, then wire the new <main>.
    */
    document.addEventListener('instant:navigated', function (event) {
        closeMenu()
        markActive()
        placeIndicator(activeLink, false)
        onScroll()
        setUp(event.detail.main, !clicked)
        clicked = false
        if (window.ScrollTrigger) ScrollTrigger.refresh()
    })
})()
