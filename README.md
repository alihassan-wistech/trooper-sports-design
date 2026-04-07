# Troopers Sports Website

Homepage build for Troopers Sports (factory-direct custom sportswear, Sialkot) focused on B2B conversion, capability communication, and inquiry capture.

## Stack

- HTML (single-page structure in `index.html`)
- Tailwind CSS via CDN (`tailwindcss.com`)
- Swiper (`swiper@11`) for hero and testimonial sliders
- Vanilla JavaScript for mobile menu behavior and slider initialization
- Google Fonts: Outfit + Bebas Neue

## Project Structure

- `index.html` - complete homepage implementation
- `docs/DESIGN_SYSTEM.md` - implemented design guidelines and UI contract
- `images/` - static assets (includes `logo.png`)

## Design + UI Highlights

- Steel Blue industrial theme tokens:
  - `dark: #111827`
  - `neutral-dark: #1F2937`
  - `light: #E5E7EB`
  - `gray: #94A3B8`
- Reusable button system (`.btn`, variants, sizes)
- Swiper sliders:
  - Hero: fade + autoplay + custom pagination
  - Testimonials: autoplay + pagination + prev/next controls
- Responsive mobile navigation with hamburger toggle
- Final CTA replaced with structured inquiry form
- Group hover behavior:
  - card content/icons switch to white
  - icon borders switch to white
  - category CTA buttons remain visually stable

## Local Preview

Open `index.html` directly in browser, or serve via any static server.

Example:

```bash
python3 -m http.server 3000
```

Then open:

- `http://localhost:3000`

## Content Notes

- All homepage copy is currently in `index.html`.
- Dummy partner logos and testimonial entries are included for layout and can be replaced later.
- Category cards are wired to placeholder detail URLs:
  - `/product-detail.html?category=team-uniforms`
  - `/product-detail.html?category=team-apparel`
  - `/product-detail.html?category=club-merchandise`

## Next Recommended Steps

- Implement real product detail pages for each category route.
- Connect inquiry form to backend endpoint or form service.
- Replace placeholder hero visuals with production assets.
- Add analytics events for key CTAs and form submissions.

