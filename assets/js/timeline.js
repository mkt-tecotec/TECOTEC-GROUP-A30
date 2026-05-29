// Timeline rotation — 1:1 port from 25.hgcapital.com scripts.js
// - step = 15° per year, transform-origin: 0% 50% on .timelinecircle
// - Rotation interpolates with easing factor 0.2 per frame
// - Snaps to nearest year 800ms after user stops scrolling
// - Pre/post 200px buffer in section before/after rotation starts

(function () {
  const section = document.getElementById('history');
  if (!section) return;

  const circle = section.querySelector('.timelinecircle');
  if (!circle) return;

  const STEP = 15;                       // deg per year
  const ROT_START_OFFSET = 200;          // px buffer at top
  const BASE_ROT_END_OFFSET = 600;       // px dwell zone at last year
  const getRotEndOffset = () => window.innerHeight + BASE_ROT_END_OFFSET;
  const EASE = 0.2;                      // per-frame easing
  const SNAP_DELAY = 800;                // ms idle before snap

  let lastRotation = 0;       // target rotation from scroll
  let smoothedRotation = 0;   // currently rendered rotation
  let lastAppliedIndex = -1;

  const years = Array.from(circle.querySelectorAll('.year-wrap'));
  const images = Array.from(section.querySelectorAll('.year-image'));

  const TOTAL_ROTATION = -STEP * (years.length - 1);

  // Click vào năm/dấu chấm để cuộn tới năm đó
  years.forEach((year, index) => {
    year.addEventListener('click', () => {
      const rect = section.getBoundingClientRect();
      const sectionTop = window.scrollY + rect.top;
      const stickyTravel = rect.height - window.innerHeight;
      const scrollRange = stickyTravel - ROT_START_OFFSET - getRotEndOffset();

      const progress = years.length > 1 ? index / (years.length - 1) : 0;
      const targetScrollY = sectionTop + ROT_START_OFFSET + progress * scrollRange;

      if (window.lenis && typeof window.lenis.scrollTo === 'function') {
        window.lenis.scrollTo(targetScrollY);
      } else {
        window.scrollTo({ top: targetScrollY, behavior: 'smooth' });
      }
    });
  });

  function applyYearClasses(rotation) {
    const exactIndex = Math.abs(rotation / STEP);
    const activeIndex = Math.round(exactIndex);

    if (activeIndex === lastAppliedIndex) return;
    lastAppliedIndex = activeIndex;

    years.forEach((year, idx) => {
      year.classList.remove('active', 'nearby', 'far');
      const diff = Math.abs(idx - activeIndex);
      if (diff === 0) year.classList.add('active');
      else if (diff === 1) year.classList.add('nearby');
      else if (diff === 2) year.classList.add('far');
    });

    images.forEach((img, idx) => {
      img.classList.toggle('active', idx === activeIndex);
    });
  }

  function updateTimelineRotation() {
    const rect = section.getBoundingClientRect();
    // Sticky travel = how far -rect.top moves while .timeline-stage stays pinned
    const stickyTravel = rect.height - window.innerHeight;
    const scrollRange = stickyTravel - ROT_START_OFFSET - getRotEndOffset();
    const scrollOffset = Math.min(
      Math.max(-rect.top - ROT_START_OFFSET, 0),
      Math.max(scrollRange, 0)
    );
    const progress = scrollRange > 0 ? scrollOffset / scrollRange : 0;
    const currentRotation = TOTAL_ROTATION * progress;

    // Step to the nearest year exactly
    lastRotation = Math.round(currentRotation / -STEP) * -STEP;
  }

  function smoothRender() {
    smoothedRotation += (lastRotation - smoothedRotation) * EASE;
    circle.style.transform = `rotate(${smoothedRotation}deg)`;
    applyYearClasses(smoothedRotation);
    requestAnimationFrame(smoothRender);
  }

  function onScroll() {
    updateTimelineRotation();
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', updateTimelineRotation);

  updateTimelineRotation();
  applyYearClasses(0);
  requestAnimationFrame(smoothRender);

  // --- Setup GSAP ScrollTriggers for Zoom In/Out effects ---
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    const stageInner = section.querySelector('.timeline-stage-inner');
    if (stageInner) {
      // Zoom In on Enter
      gsap.fromTo(stageInner,
        { scale: 0.5, opacity: 0 },
        {
          scale: 1,
          opacity: 1,
          duration: 1,
          ease: "back.out(1.5)",
          scrollTrigger: {
            trigger: section,
            start: "top top",
            toggleActions: "play none none reverse"
          }
        }
      );

      // Zoom Out on Exit
      gsap.to(stageInner,
        {
          scale: 0.7,
          opacity: 0,
          ease: "none",
          scrollTrigger: {
            trigger: section,
            start: "bottom 100%", // When bottom of section hits bottom of viewport
            end: "bottom top",    // When bottom of section leaves top of viewport
            scrub: true
          }
        }
      );
    }
  }

})();
