# Design System: TECOTEC Group

## 1. Visual Theme & Atmosphere
A highly professional, precise, and authoritative B2B interface. The atmosphere is clinical, reliable, and engineering-focused — reflecting 25+ years of expertise in measurement, calibration, and technology solutions. Layouts are structured, predictable, and symmetrical, designed for clarity, trust, and function over playful experimentation.

## 2. Color Palette & Roles
- **Canvas Off-White** (#F4F6F8) — Primary background surface, providing breathing room and a clean technical canvas.
- **Pure Surface** (#FFFFFF) — Card, table, and container fill.
- **Deep Blue** (#146EB4) — Secondary text, headers, links, and trust indicators (CMYK: 89, 39, 0, 29).
- **Charcoal Ink** (#18181B) — Primary body text for maximum readability.
- **Muted Steel** (#71717A) — Metadata, descriptions, and minor details.
- **Whisper Border** (rgba(226,232,240,0.5)) — Card borders, data table lines, 1px structural lines.
- **Highlight Orange** (#FF9900) — Single high-contrast accent for primary CTAs, active states, and critical headlines (CMYK: 0, 40, 100, 0).

## 3. Typography Rules
- **Display:** Geist — Track-tight, controlled scale, weight-driven hierarchy. Conveys modern engineering.
- **Body:** Geist — Relaxed leading, 65ch max-width for optimal reading of technical documentation.
- **Mono:** Geist Mono — Mandatory for technical data, specifications, timestamps, product codes, and measurement metrics.
- **Banned:** Inter, generic system fonts (Times New Roman, Arial). No serif fonts in technical dashboards, documentation, or software UIs.

## 4. Component Stylings
* **Buttons:** Flat, precise, no outer glow. Tactile -1px translate on active state. Highlight Orange fill for primary CTAs, ghost/outline in Deep Blue for secondary actions.
* **Cards:** Mildly rounded corners (0.25rem - 0.5rem) to maintain a sharp, engineering feel. Diffused whisper shadow. For high-density data areas, replace cards with clean border-top dividers.
* **Inputs:** Label above, error text below in Deep Blue or a dedicated semantic error color. Focus ring in Highlight Orange. Structured, clear, and high-contrast.
* **Loaders:** Skeletal shimmer matching exact layout dimensions. No generic circular spinners.
* **Empty States:** Composed, professional illustrations or structured guides on how to populate data — not just "No data".

## 5. Layout Principles
- Grid-first responsive architecture tailored for B2B data density. 
- Symmetrical and structured sections. 
- Strict single-column collapse below 768px viewports. 
- Max-width containment (e.g., 1400px centered). 
- No flexbox percentage math; rely on CSS Grid.
- Generous internal padding to prevent technical information from feeling overwhelming.
- Every element occupies its own clear spatial zone — absolutely no overlapping text or images.

## 6. Motion & Interaction
Restrained, purposeful motion. Spring physics for interactive elements (stiffness: 100, damping: 20) for a premium, weighty feel. Subtle stagger cascades for data lists. No bouncy or excessive animations — motion must convey precision and reliability. Hardware-accelerated transforms only (opacity and transform).

## 7. Content & Voice Guardrails
- **Tone:** Authoritative, Reliable, Precise, Progressive, Partner-Oriented.
- **Vocabulary:** Use precise measurement terms (e.g., "hiệu chuẩn", "kiểm định"). Call users "đối tác" (partners), offer "giải pháp" (solutions).
- **Evidence:** Always anchor claims in real data (e.g., "25 năm kinh nghiệm", "ISO 9001", "200+ nhân sự").
- **Anti-patterns (Banned):** 
  - No emojis anywhere.
  - No pure black (#000000).
  - No neon glows or oversaturated gradients.
  - No 3-column equal card layouts (use asymmetric, 2-column zig-zag, or list formats).
  - No generic AI copywriting ("Elevate", "Seamless", "Next-Gen", "Revolutionary").
  - No superlative claims without proof ("số 1", "tốt nhất").
  - No fake metrics or placeholder numbers in mockups (never invent data).
  - No "Lorem Ipsum" or fake names ("John Doe", "Acme").
