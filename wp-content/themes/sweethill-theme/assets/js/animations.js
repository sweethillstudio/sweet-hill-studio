/**
 * Sweet Hill Studio - Immersive Scroll Engine & 3D Animations
 *
 * Modeled after the award-winning interactions of Oryzo.ai:
 * - Lenis Smooth Scrolling Engine
 * - GSAP ScrollTrigger Multi-layered Parallax (hero-bg, hero-mid, hero-fg)
 * - Massive Typography Reveals on Scroll
 * - Desktop Spatial 3D Depth
 *
 * @package SweetHill\Theme
 */

document.addEventListener('DOMContentLoaded', function () {
  // Check for reduced motion preference (WCAG 2.2 AA).
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // -------------------------------------------------------------
  // 1. Initialize Lenis Smooth Scrolling
  // -------------------------------------------------------------
  let lenis = null;
  if (typeof Lenis !== 'undefined' && !prefersReducedMotion) {
    lenis = new Lenis({
      duration: 1.25,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: 'vertical',
      gestureOrientation: 'vertical',
      smoothWheel: true,
      wheelMultiplier: 0.95,
      touchMultiplier: 1.8,
    });

    // Synchronize Lenis with GSAP ScrollTrigger.
    if (typeof ScrollTrigger !== 'undefined') {
      lenis.on('scroll', ScrollTrigger.update);
    }

    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);
  }

  // Graceful exit if GSAP or ScrollTrigger are not available.
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  const heroSection = document.querySelector('.sweethill-hero-3d');
  if (!heroSection) {
    return;
  }

  const bgLayer = heroSection.querySelector('.hero-layer-bg');
  const midLayer = heroSection.querySelector('.hero-layer-mid');
  const fgLayer = heroSection.querySelector('.hero-layer-fg');
  const contentOverlay = heroSection.querySelector('.hero-content-overlay');
  const eyebrowBadge = heroSection.querySelector('.hero-eyebrow-badge');
  const revealLines = heroSection.querySelectorAll('.reveal-line');
  const subtitle = heroSection.querySelector('.hero-massive-subtitle');
  const ctas = heroSection.querySelector('.hero-ctas');
  const scrollIndicator = heroSection.querySelector('.hero-scroll-indicator');

  // -------------------------------------------------------------
  // 2. Initial Page Load Reveal Timeline
  // -------------------------------------------------------------
  if (!prefersReducedMotion) {
    const introTl = gsap.timeline({ defaults: { ease: 'power4.out' } });

    // Initial scale and brightness entry for 3D layers
    introTl
      .fromTo(
        [bgLayer, midLayer, fgLayer],
        { scale: 1.18, opacity: 0 },
        { scale: 1.02, opacity: 1, duration: 2, stagger: 0.18, ease: 'power3.out' }
      )
      // Eyebrow badge pops in
      .fromTo(
        eyebrowBadge,
        { y: 25, opacity: 0, scale: 0.9 },
        { y: 0, opacity: 1, scale: 1, duration: 1 },
        '-=1.5'
      )
      // Massive typography lines slide up from behind mask
      .fromTo(
        revealLines,
        { yPercent: 110, opacity: 0 },
        { yPercent: 0, opacity: 1, duration: 1.4, stagger: 0.12 },
        '-=1.2'
      )
      // Subtitle and CTAs fade up
      .fromTo(
        [subtitle, ctas],
        { y: 30, opacity: 0 },
        { y: 0, opacity: 1, duration: 1.1, stagger: 0.15 },
        '-=0.8'
      )
      // Scroll indicator fades in
      .fromTo(
        scrollIndicator,
        { opacity: 0 },
        { opacity: 0.85, duration: 0.8 },
        '-=0.4'
      );
  }

  // -------------------------------------------------------------
  // 3. Multi-Layered 3D ScrollTrigger Parallax
  // -------------------------------------------------------------
  if (!prefersReducedMotion) {
    const heroScrollTl = gsap.timeline({
      scrollTrigger: {
        trigger: heroSection,
        start: 'top top',
        end: 'bottom top',
        scrub: 1.2, // Smooth interpolation matching Lenis
        invalidateOnRefresh: true,
      },
    });

    // Background Layer (hero-bg.webp): Deep atmosphere drifts downward
    if (bgLayer) {
      heroScrollTl.to(bgLayer, { yPercent: 24, scale: 1.06, ease: 'none' }, 0);
    }

    // Midground Layer (hero-mid.webp): Story characters move upward at moderate speed
    if (midLayer) {
      heroScrollTl.to(midLayer, { yPercent: -22, scale: 1.04, ease: 'none' }, 0);
    }

    // Foreground Layer (hero-fg.webp): Foreground elements move upward aggressively for exaggerated depth
    if (fgLayer) {
      heroScrollTl.to(fgLayer, { yPercent: -48, scale: 1.16, ease: 'none' }, 0);
    }

    // Massive Content Overlay: Zoom-through parallax effect
    if (contentOverlay) {
      heroScrollTl.to(
        contentOverlay,
        {
          yPercent: -40,
          scale: 1.05,
          opacity: 0,
          ease: 'power2.in',
        },
        0
      );
    }

    // Scroll indicator dismisses quickly on scroll onset
    if (scrollIndicator) {
      gsap.to(scrollIndicator, {
        opacity: 0,
        ease: 'power1.out',
        scrollTrigger: {
          trigger: heroSection,
          start: 'top top',
          end: '12% top',
          scrub: true,
        },
      });
    }

    // -------------------------------------------------------------
    // 4. Massive Typography Reveals on Down-Page Scroll
    // -------------------------------------------------------------
    const kineticHeadings = document.querySelectorAll('.kinetic-heading-reveal');
    kineticHeadings.forEach((heading) => {
      gsap.fromTo(
        heading,
        {
          y: 60,
          opacity: 0,
          scale: 0.94,
          letterSpacing: '-0.01em',
        },
        {
          y: 0,
          opacity: 1,
          scale: 1,
          letterSpacing: '-0.03em',
          duration: 1.2,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: heading,
            start: 'top 85%',
            end: 'top 45%',
            toggleActions: 'play none none reverse',
          },
        }
      );
    });

    // -------------------------------------------------------------
    // 5. Desktop Interactive 3D Cursor Depth
    // -------------------------------------------------------------
    if (window.innerWidth >= 1024) {
      let mouseX = 0;
      let mouseY = 0;
      let curX = 0;
      let curY = 0;

      heroSection.addEventListener('mousemove', function (e) {
        const rect = heroSection.getBoundingClientRect();
        // Normalized coordinate centered at 0 (-1 to 1)
        mouseX = ((e.clientX - rect.left) / rect.width - 0.5) * 2;
        mouseY = ((e.clientY - rect.top) / rect.height - 0.5) * 2;
      });

      heroSection.addEventListener('mouseleave', function () {
        mouseX = 0;
        mouseY = 0;
      });

      gsap.ticker.add(function () {
        curX += (mouseX - curX) * 0.045;
        curY += (mouseY - curY) * 0.045;

        if (bgLayer) {
          gsap.set(bgLayer, { x: curX * 12, y: curY * 10, rotateY: curX * 1.2 });
        }
        if (midLayer) {
          gsap.set(midLayer, { x: curX * 26, y: curY * 18, rotateY: curX * 2.2 });
        }
        if (fgLayer) {
          gsap.set(fgLayer, { x: curX * 45, y: curY * 30, rotateY: curX * 3.2 });
        }
      });
    }
  }
});
