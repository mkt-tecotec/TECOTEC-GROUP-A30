document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    
    gsap.registerPlugin(ScrollTrigger);

    const wrapper = document.getElementById('hp-overview');
    if (!wrapper) return;

    const sections = wrapper.querySelectorAll('.hp-overview-section');

    // Create a master timeline pinned to the wrapper
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: wrapper,
            start: "top top",
            end: "+=300%", // Scroll distance corresponds to 3 sections
            pin: true,
            scrub: 1
        }
    });

    sections.forEach((section, index) => {
        const text = section.querySelector('.hp-overview-text');
        const highlights = section.querySelectorAll('.highlight-word');

        // Cinematic reveal of the section
        tl.fromTo(section,
            { autoAlpha: 0 },
            { autoAlpha: 1, duration: 0.1 }
        );

        // Overdrive text reveal: scale up slightly, fade in, un-blur, and rotate in 3D
        tl.fromTo(text, 
            { autoAlpha: 0, y: 80, scale: 0.9, filter: "blur(15px)", rotationX: -15 }, 
            { autoAlpha: 1, y: 0, scale: 1, filter: "blur(0px)", rotationX: 0, duration: 1.4, ease: "power3.out" },
            "<" // start simultaneously with section visibility
        );

        // Animate highlight and underline if present
        if (highlights.length > 0) {
            tl.to(highlights, {
                color: "#ff9900",
                backgroundSize: "100% 100%",
                textShadow: "0px 0px 30px rgba(255, 153, 0, 0.45)", // Glow effect matching #ff9900
                duration: 1.2,
                stagger: 0.25, // Cascade animation
                ease: "power2.inOut"
            }, "-=0.6"); // Overlap with text reveal
        }

        // Add a slight pause for reading
        tl.to({}, { duration: 0.8 });

        // Fade out with a cinematic exit
        if (index < sections.length - 1) {
            tl.to(text, { 
                autoAlpha: 0, 
                y: -60, 
                scale: 1.05, 
                filter: "blur(10px)", 
                duration: 1.2, 
                ease: "power2.in" 
            });
            tl.to(section, { autoAlpha: 0, duration: 0.1 });
        }
    });
});
