**TROOPERS SPORTS – FULL DESIGN SYSTEM v2.1 (As-Implemented in index.html)**  
**“Premium Factory-Direct B2B Experience”**  
Built exclusively for the homepage structure in **HOMEPAGE_CONTENT.md**  
Goal: Beat every competitor in visual premium feel + conversion speed.

---

### 1. BRAND FOUNDATIONS
- **Voice**: Confident, direct, factory-authentic, energetic sports.
- **Tone**: No fluff. Clear benefits. Speed + quality = profit.
- **Personality**: Sharp, geometric, black-and-white industrial vibe. Trustworthy Pakistani factory that feels highly modern and structural.
- **Key Differentiator**: Every screen screams “Direct from Sialkot → 2 weeks → Your margins protected”.

---

### 2. COLOR SYSTEM (Tailwind-ready, as implemented)

The visual direction is grayscale with a token base and controlled use of Tailwind gray scale utilities for depth, overlays, and state contrast.

```css
--color-dark: #111111;
--color-neutral-dark: #333333;
--color-light: #F8F9FA;
--color-gray: #E5E5E5;
```

**Core Tailwind Palette (configured in page)**

```js
colors: {
  dark: '#111111',
  'neutral-dark': '#333333',
  light: '#F8F9FA',
  gray: '#E5E5E5',
}
```

**Extended grayscale utilities used in components**:
- `bg-gray-100`, `bg-gray-200`, `bg-gray-500`, `bg-gray-600`, `bg-gray-700`, `bg-gray-800`
- `text-gray-300`, `text-gray-400`, `text-gray-500`
- `border-gray-800`
- Alpha overlays: `bg-black/60`, `text-white/50`

**Backgrounds**:
- Hero slides and product/image placeholders use gray blocks with centered placeholder labels.
- Dark sections use `bg-black` / `bg-neutral-dark`; light sections use `bg-white` / `bg-light`.

---

### 3. TYPOGRAPHY SYSTEM

**Body Font**: **Outfit** (Google Fonts) – Clean, geometric sans-serif loaded with `font-sans`.
**Heading Font**: **Bebas Neue** (Google Fonts) – Tall, all-caps, sporty font loaded with `font-heading`.

*Rule: Bebas Neue (`font-heading`) is ONLY applied to text where the size is larger than 24px (e.g., `text-3xl`, `text-4xl`, `text-5xl`, etc.). All other text defaults to Outfit.*

| Element                  | Desktop                  | Mobile     | Weight     | Line-height | Tracking     |
|--------------------------|--------------------------|------------|------------|-------------|--------------|
| Hero Headline            | 60px (6rem)              | 36px       | Extrabold  | 1.1         | -0.02em      |
| Hero Sub-headline        | 20px (1.25rem)           | 18px       | Medium     | 1.4         | 0            |
| Section Headline         | 48px (3rem)              | 36px       | Bold       | 1.2         | -0.02em      |
| Section Sub-headline     | 24px (1.5rem)            | 20px       | Medium     | 1.4         | 0            |
| Card Title               | 22px                     | 20px       | Semibold   | 1.3         | 0            |
| Body / Product Title     | 18px                     | 16px       | Regular    | 1.6         | 0            |
| Button Text              | 18px                     | 16px       | Bold       | 1.4         | 0.02em       |
| Stats / Small            | 16px                     | 14px       | Medium     | 1.4         | 0            |

---

### 4. SPACING & GRID SYSTEM (8px base)

**Container**: `max-w-[1440px] mx-auto px-6 lg:px-12`

**Section padding**: `py-20 lg:py-24` (default)  
**Trust Bar**: `py-6`  
**Final CTA**: `py-24`

**Hero Constraints**:
- Maximum height capped to prevent overflowing on large screens: `h-[60vh] max-h-[600px] min-h-[450px]`

**Grid System**:
- 12-column grid (Tailwind default)
- Product grid: `grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 lg:gap-8`
- Benefit/Capability cards: `grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8`

---

### 5. EFFECTS & DECORATION (Current behavior)

- **Border radius**: NONE. Corners are sharp across layout, cards, buttons, and badges.
- **Shadows**: Minimal and utility-only (`shadow-sm`, `shadow-2xl`) in nav/trust bar/floating action to preserve hierarchy.
- **Borders**: Sharp 1px solid black borders used heavily around cards, buttons, and sections.
- **Hover Effects**:
  - Primary card pattern: `hover:bg-dark` + `group-hover:text-white` + `group-hover:border-white`.
  - Product and new-arrival cards use subtle motion: `hover:-translate-y-1` + `transition-transform`.
  - Overlay interactions for product actions use opacity transitions (`group-hover:opacity-100`).

---

### 6. COMPONENT LIBRARY (Copy-paste Tailwind classes)

#### A. Navigation Bar (Sticky)
```html
<nav class="sticky top-0 z-50 bg-white border-b border-gray shadow-sm">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-5 flex items-center justify-between">
    <!-- Logo -->
    <div class="flex items-center gap-2">
      <span class="font-heading text-3xl font-black tracking-[-0.04em] text-dark">TROOPERS</span>
      <span class="font-heading text-3xl font-bold text-dark">SPORTS</span>
    </div>

    <!-- Menu -->
    <ul class="hidden lg:flex items-center gap-x-8 text-neutral-dark font-medium">
      <li><a href="#" class="hover:text-black transition-colors">Home</a></li>
      <!-- ... -->
    </ul>
  </div>
</nav>
```

#### B. Buttons
**Solid variants currently used**:
- Dark primary: `bg-black text-white ... border border-black hover:bg-neutral-dark`
- Light-on-dark hero/action: `bg-white text-black ... border border-black hover:bg-gray-200`

**Outline variant**:
`border-2 border-white text-white hover:bg-white hover:text-dark ... transition-all`

#### C. Cards (Benefit / Capability / Product)
```css
class="group bg-white hover:bg-dark p-8 lg:p-10 border border-black transition-all duration-300"
```
- Icon at top: `w-16 h-16 bg-gray-200 border border-black flex items-center justify-center mb-6 text-black group-hover:bg-dark group-hover:border-white group-hover:text-white transition-all`
- Title: `text-[22px] font-semibold text-dark group-hover:text-white transition-colors`
- Description: `text-neutral-dark group-hover:text-white mt-3 transition-colors`

**Additional implemented card patterns**:
- Capability (dark section): `group bg-neutral-dark p-8 lg:p-10 border border-white hover:bg-gray-800 transition-all duration-300`
- Product/New arrival card shell: `group relative bg-light|bg-white border border-black hover:-translate-y-1 transition-transform duration-300`
- Product image overlay CTA: `absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity`

#### D. Hero Carousel
- Capped height: `h-[60vh] max-h-[600px] min-h-[450px]`
- Backgrounds: `bg-gray-500`, `bg-gray-600`, `bg-gray-700` with centered `font-heading text-white/50 uppercase` placeholder text plus `bg-black/60` overlay.
- Controls: bottom dot indicators with active-width state (`w-8`) and inactive (`w-3`) via Alpine class binding.

---

### 7. COMPLETE TAILWIND CONFIG SNIPPET

```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        dark: '#111111',
        'neutral-dark': '#333333',
        light: '#F8F9FA',
        gray: '#E5E5E5',
      },
      fontFamily: {
        sans: ['Outfit', 'system-ui', 'sans-serif'],
        heading: ['Bebas Neue', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
```

---

### 8. ACCESSIBILITY & PERFORMANCE (Current status)
- High-contrast grayscale hierarchy across dark/light sections.
- Keyboard focus styles are not yet standardized across all interactive elements in current page implementation.
- Mobile-first responsive structure implemented across nav, hero, trust bar, cards, and CTA sections.
- Performance-first static markup with CDN-delivered Tailwind/Alpine for rapid iteration.
