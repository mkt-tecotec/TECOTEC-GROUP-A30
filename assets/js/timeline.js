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
  let isSnapping = false;
  let snapTimer = null;
  let lastAppliedIndex = -1;
  let preventScrollSync = false;

  const years = Array.from(circle.querySelectorAll('.year-wrap'));
  const images = Array.from(section.querySelectorAll('.year-image'));

  const TOTAL_ROTATION = -STEP * (years.length - 1);

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

    if (!isSnapping) {
      lastRotation = currentRotation;
    }
  }

  function smoothRender() {
    smoothedRotation += (lastRotation - smoothedRotation) * EASE;
    circle.style.transform = `rotate(${smoothedRotation}deg)`;
    applyYearClasses(smoothedRotation);
    requestAnimationFrame(smoothRender);
  }

  function snapToNearestYear() {
    const rect = section.getBoundingClientRect();
    const stickyTravel = rect.height - window.innerHeight;
    const scrollRange = stickyTravel - ROT_START_OFFSET - getRotEndOffset();
    const currentOffset = -rect.top - ROT_START_OFFSET;

    // Chỉ snap khi đang ở trong vùng xoay (rotation zone)
    if (currentOffset < 0 || currentOffset > scrollRange) return;

    isSnapping = true;
    const startRotation = smoothedRotation;
    let targetRotation = Math.round(startRotation / -STEP) * -STEP;
    // Clamp to valid range
    targetRotation = Math.max(TOTAL_ROTATION, Math.min(0, targetRotation));

    const duration = 800;
    const t0 = performance.now();
    const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

    function step(now) {
      const t = Math.min((now - t0) / duration, 1);
      const eased = easeOutCubic(t);
      lastRotation = startRotation + (targetRotation - startRotation) * eased;
      if (t < 1) {
        requestAnimationFrame(step);
      } else {
        lastRotation = targetRotation;
        smoothedRotation = targetRotation;
        isSnapping = false;

        // Sync window.scrollY tới vị trí khớp với targetRotation
        // để wheel tick kế tiếp không kéo rotation lệch khỏi năm
        const rect2 = section.getBoundingClientRect();
        const stickyTravel2 = rect2.height - window.innerHeight;
        const scrollRange2 = stickyTravel2 - ROT_START_OFFSET - getRotEndOffset();
        const progress = TOTAL_ROTATION !== 0 ? targetRotation / TOTAL_ROTATION : 0;
        const scrollOffset = progress * scrollRange2;
        const scrollY = window.scrollY + rect2.top + ROT_START_OFFSET + scrollOffset;
        preventScrollSync = true;
        if (window.lenis && typeof window.lenis.scrollTo === 'function') {
          window.lenis.scrollTo(scrollY, { immediate: true });
        } else {
          window.scrollTo({ top: scrollY, behavior: 'auto' });
        }
        requestAnimationFrame(() => { preventScrollSync = false; });
      }
    }
    requestAnimationFrame(step);
  }

  function onScroll() {
    if (preventScrollSync) return;
    updateTimelineRotation();
    if (snapTimer) clearTimeout(snapTimer);
    snapTimer = setTimeout(snapToNearestYear, SNAP_DELAY);
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
            start: "top 90%",
            toggleActions: "play none none reverse"
          }
        }
      );

      // Zoom Out on Exit
      gsap.fromTo(stageInner,
        { scale: 1, opacity: 1 },
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
