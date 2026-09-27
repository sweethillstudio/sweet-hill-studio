/**
 * Sweet Hill Studio - 3D Hero Parallax & ScrollTrigger Animations
 *
 * Implements multi-layered depth for the Contemporary Editorial Wonder experience.
 */

document.addEventListener('DOMContentLoaded', function () {
  // Graceful exit if GSAP or ScrollTrigger are not loaded.
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  const heroSection = document.querySelector('.sweethill-hero-3d');
  if (!heroSection) {
    return;
  }

  // Check for reduced motion preference (WCAG 2.2 AA compliance).
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReducedMotion) {
    return;
  }

  const bgLayer = heroSection.querySelector('.hero-layer-bg');
  const midLayer = heroSection.querySelector('.hero-layer-mid');
  const fgLayer = heroSection.querySelector('.hero-layer-fg');
  const contentOverlay = heroSection.querySelector('.hero-content-overlay');
  const scrollIndicator = heroSection.querySelector('.hero-scroll-indicator');

  // Initial reveal animation on page load.
  const introTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

  introTl
    .fromTo(
      [bgLayer, midLayer, fgLayer],
      { scale: 1.15, opacity: 0 },
      { scale: 1.02, opacity: 1, duration: 1.8, stagger: 0.15 }
    )
    .fromTo(
      contentOverlay,
      { y: 40, opacity: 0 },
      { y: 0, opacity: 1, duration: 1.4 },
      '-=1.2'
    )
    .fromTo(
      scrollIndicator,
      { opacity: 0 },
      { opacity: 0.85, duration: 1 },
      '-=0.6'
    );

  // Parallax Scroll Timeline tied directly to user scroll position.
  const scrollTl = gsap.timeline({
    scrollTrigger: {
      trigger: heroSection,
      start: 'top top',
      end: 'bottom top',
      scrub: 1.2, // Smooth interpolation
      invalidateOnRefresh: true,
    },
  });

  // Background moves slowly downward / maintains atmosphere.
  if (bgLayer) {
    scrollTl.to(bgLayer, { yPercent: 22, ease: 'none' }, 0);
  }

  // Midground characters layer moves at standard negative parallax rate.
  if (midLayer) {
    scrollTl.to(midLayer, { yPercent: -20, scale: 1.05, ease: 'none' }, 0);
  }

  // Foreground decorative framing moves faster for exaggerated depth.
  if (fgLayer) {
    scrollTl.to(fgLayer, { yPercent: -42, scale: 1.12, ease: 'none' }, 0);
  }

  // Content overlay floats upward and dissolves softly into the next section.
  if (contentOverlay) {
    scrollTl.to(
      contentOverlay,
      { y: -90, opacity: 0, ease: 'power1.in' },
      0
    );
  }

  // Fade scroll indicator out immediately upon scroll onset.
  if (scrollIndicator) {
    gsap.to(scrollIndicator, {
      opacity: 0,
      ease: 'power1.out',
      scrollTrigger: {
        trigger: heroSection,
        start: 'top top',
        end: '15% top',
        scrub: true,
      },
    });
  }

  // Desktop subtle mouse-tracking 3D tilt.
  if (window.innerWidth >= 1024) {
    let mouseX = 0;
    let mouseY = 0;
    let currentX = 0;
    let currentY = 0;

    heroSection.addEventListener('mousemove', function (e) {
      const rect = heroSection.getBoundingClientRect();
      // Normalize mouse coordinates from -1 to 1 around center.
      mouseX = ((e.clientX - rect.left) / rect.width - 0.5) * 2;
      mouseY = ((e.clientY - rect.top) / rect.height - 0.5) * 2;
    });

    heroSection.addEventListener('mouseleave', function () {
      mouseX = 0;
      mouseY = 0;
    });

    // Smooth render ticker for lag-free cursor parallax.
    gsap.ticker.add(function () {
      currentX += (mouseX - currentX) * 0.05;
      currentY += (mouseY - currentY) * 0.05;

      if (bgLayer) {
        gsap.set(bgLayer, { x: currentX * 10, y: currentY * 8, rotateY: currentX * 1 });
      }
      if (midLayer) {
        gsap.set(midLayer, { x: currentX * 22, y: currentY * 16, rotateY: currentX * 1.8 });
      }
      if (fgLayer) {
        gsap.set(fgLayer, { x: currentX * 38, y: currentY * 26, rotateY: currentX * 2.5 });
      }
    });
  }
});
