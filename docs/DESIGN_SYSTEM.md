# TROOPERS SPORTS DESIGN SYSTEM

Current version: `v3.0`  
Source of truth: `index.html`  
Design direction: Steel Blue industrial B2B, high contrast, sharp geometry, conversion focused.

---

## 1) Brand Direction

- Voice: confident, direct, factory-first, B2B outcome oriented
- Tone: no fluff, margin + speed + quality
- Positioning: factory-direct custom sportswear from Sialkot
- Personality: structural, modern, high-contrast, hard-edge interface language

Core message pillars:
- Fast turnaround
- Custom manufacturing depth
- Export reliability
- Repeat-order confidence

---

## 2) Color System (Implemented)

Tailwind extension tokens:

```js
colors: {
  dark: '#111827',
  'neutral-dark': '#1F2937',
  light: '#E5E7EB',
  gray: '#94A3B8',
}
```

Global enforced mapping in `index.html` CSS:
- `bg-black` / `bg-dark` => `#111827`
- `bg-neutral-dark` => `#1F2937`
- `bg-light` => `#E5E7EB`
- `bg-gray-200` => `#94A3B8`
- `text-dark` / `text-black` => `#0B1220`
- `text-neutral-dark` => `#334155`

Interaction color behavior:
- Card hover backgrounds -> steel dark
- On group hover, card content/icons become white
- Icon containers with `group-hover:border-white` switch to white border

---

## 3) Typography

- Body font: `Outfit`
- Display/heading font: `Bebas Neue`

Implemented usage:
- Large section headlines and hero lines use `font-heading`
- Body, labels, and utility copy use `font-sans`

Typical scale in use:
- Hero headline: `text-4xl md:text-5xl lg:text-6xl`
- Section headline: `text-4xl md:text-[48px]`
- Card titles: `text-[22px]` or `text-[24px]`
- Body copy: `text-[16px]` to `text-[24px]` depending on section context

---

## 4) Spacing and Layout

- Container: `max-w-[1440px] mx-auto px-6 lg:px-12`
- Section rhythm: `py-20 lg:py-24`
- Final inquiry block: `py-24`
- Grid patterns:
  - 3-column feature/capability blocks
  - 2/4/6 responsive trust and logo layouts
  - alternating timeline cards for process section

Hero constraints:
- `h-[60vh] max-h-[600px] min-h-[450px]`

---

## 5) Border, Radius, Shadow

- Radius: none (square geometry)
- Borders: heavy usage of `border border-black` and white borders in dark sections
- Shadows: minimal utility (`shadow-sm`, `shadow-2xl`) only where hierarchy benefits (sticky nav, floating WhatsApp)

---

## 6) Reusable Components

### 6.1 Button System (Custom CSS)

Defined in `index.html` style block:
- `.btn` (base)
- `.btn-sm`, `.btn-md`
- `.btn-primary`
- `.btn-light`
- `.btn-outline-light`
- `.btn-outline-dark`
- `.btn-fixed-on-group` (prevents CTA color mutation when parent card hover forces white text)

Rules:
- Use button classes for all CTAs and slider controls
- Do not reintroduce one-off inline button class stacks unless adding a new variant

### 6.2 Slider System (Swiper)

Library:
- `swiper@11` CDN CSS + JS

Implemented sliders:
- Hero slider: `.hero-swiper`
  - loop
  - fade transition
  - autoplay 5s
  - custom pagination (`.hero-pagination`)
- Testimonial slider: `.testimonial-swiper`
  - loop
  - autoplay 6s
  - pagination (`.testimonial-pagination`)
  - custom prev/next buttons (`.testimonial-prev`, `.testimonial-next`)

### 6.3 Mobile Navigation

Elements:
- Toggle button: `#mobileMenuToggle`
- Panel: `#mobileMenuPanel`

Behavior:
- Click toggle => open/close menu
- `aria-expanded` state updates
- Clicking any menu link closes panel

---

## 7) Hover and Interaction Rules

- On `.group:hover`, text and icons inside cards become white
- Icon border switches to white where `group-hover:border-white` exists
- Category card CTA buttons remain stable using `.btn-fixed-on-group`
- Primary hover transitions are fast and direct (`~0.2s`)

---

## 8) Page Section Contract (Homepage)

Section order implemented in `index.html`:
1. Sticky nav + desktop WhatsApp + mobile menu
2. Hero Swiper
3. Trust bar
4. Why buyers choose Troopers
5. What we build (category cards)
6. Manufacturing process timeline
7. Quality/compliance proof
8. Partner logos + KPI cards
9. Testimonial Swiper
10. Final inquiry form
11. Footer

---

## 9) Form Guidelines (Inquiry Section)

Current fields:
- Full name
- Company/club
- Email
- WhatsApp number
- Product type
- Estimated quantity
- Preferred contact option (email/whatsapp)
- Project details

Visual rules:
- Hard borders
- No rounded controls
- Strong label hierarchy
- Primary + secondary action buttons via reusable button classes

---

## 10) Implementation Notes

- This design system describes what is currently implemented, not speculative variants.
- If UI behavior changes in `index.html`, update this file in the same PR.
- Avoid reintroducing:
  - Alpine slider logic
  - theme preview toolbar
  - mixed non-system button styles

