<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d0b08">
    <title>El Precio del Placer</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Syne:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --crimson: #c0392b;
            --amber:   #e8a020;
            --smoke:   #1a1410;
            --ash:     #0d0b08;
            --bone:    #d4c5a9;
            --ghost:   rgba(212, 197, 169, 0.08);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        ::selection {
            background: rgba(192, 57, 43, 0.35);
            color: #fff;
        }
        *:focus-visible {
            outline: 1px solid rgba(232, 160, 32, 0.65);
            outline-offset: 3px;
        }
        html {
            scrollbar-color: rgba(192, 57, 43, 0.45) #0d0b08;
            scrollbar-width: thin;
        }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0d0b08; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, rgba(192, 57, 43, 0.55), rgba(232, 160, 32, 0.35));
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #c0392b, rgba(232, 160, 32, 0.5));
        }

        body {
            font-family: 'Syne', sans-serif;
            background-color: var(--ash);
            color: var(--bone);
            overflow-x: hidden;
            cursor: crosshair;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.4;
        }

        /* ── VEIN CANVAS ── */
        #vein-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: 0.18;
        }

        /* ── SMOKE BLOBS ── */
        .smoke-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            z-index: 0;
            animation: drift 25s infinite alternate ease-in-out;
        }
        .smoke-blob-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(192,57,43,0.2) 0%, transparent 70%);
            top: -100px; left: -100px;
            animation-duration: 22s;
        }
        .smoke-blob-2 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(232,160,32,0.15) 0%, transparent 70%);
            bottom: -100px; right: -100px;
            animation-duration: 30s;
            animation-direction: alternate-reverse;
        }
        .smoke-blob-3 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(192,57,43,0.1) 0%, transparent 70%);
            top: 40%; left: 50%;
            animation-duration: 18s;
        }
        @keyframes drift {
            from { transform: translate(0,0) scale(1); }
            to   { transform: translate(60px, 40px) scale(1.1); }
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; width: 100%;
            padding: 28px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: linear-gradient(to bottom, rgba(13,11,8,0.9) 0%, transparent 100%);
            backdrop-filter: blur(2px);
        }
        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 13px;
            letter-spacing: 0.15em;
            color: var(--crimson);
            text-transform: uppercase;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }
        .nav-link {
            font-size: 9px;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: rgba(212,197,169,0.3);
            text-decoration: none;
            transition: color 0.35s, letter-spacing 0.35s ease;
            position: relative;
            padding-bottom: 4px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0; bottom: 0;
            width: 0;
            height: 1px;
            background: linear-gradient(90deg, var(--crimson), var(--amber));
            transition: width 0.35s ease;
        }
        .nav-link:hover {
            color: var(--bone);
            letter-spacing: 0.45em;
        }
        .nav-link:hover::after { width: 100%; }

        /* ── HERO ── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 120px 24px 80px;
            text-align: center;
            z-index: 1;
        }
        .hero-corner {
            position: absolute;
            width: min(100px, 18vw);
            height: min(100px, 18vw);
            pointer-events: none;
            opacity: 0.4;
            z-index: 0;
        }
        .hero-corner--tl {
            top: 88px;
            left: clamp(12px, 4vw, 48px);
            border-top: 1px solid rgba(232, 160, 32, 0.55);
            border-left: 1px solid rgba(192, 57, 43, 0.4);
        }
        .hero-corner--br {
            bottom: 48px;
            right: clamp(12px, 4vw, 48px);
            border-bottom: 1px solid rgba(192, 57, 43, 0.5);
            border-right: 1px solid rgba(232, 160, 32, 0.35);
        }

        .hero-eyebrow {
            font-size: 9px;
            letter-spacing: 0.6em;
            text-transform: uppercase;
            color: var(--crimson);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .hero-eyebrow::before,
        .hero-eyebrow::after {
            content: '';
            width: 40px; height: 1px;
            background: var(--crimson);
            opacity: 0.5;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(52px, 9vw, 110px);
            font-weight: 900;
            line-height: 0.9;
            color: #fff;
            margin-bottom: 12px;
        }
        .hero-title em {
            font-style: italic;
            color: var(--crimson);
            display: block;
        }
        .hero-title .sub {
            font-size: clamp(28px, 4vw, 52px);
            font-weight: 700;
            color: var(--amber);
            display: block;
            opacity: 0.9;
        }

        .hero-sub {
            font-size: 13px;
            font-weight: 300;
            color: rgba(212,197,169,0.45);
            letter-spacing: 0.08em;
            margin-top: 28px;
            max-width: 380px;
        }

        /* Mensaje de prevención — hero */
        .hero-manifesto {
            margin-top: 32px;
            max-width: 420px;
            text-align: center;
            padding: 22px 26px;
            border-radius: 16px;
            border: 1px solid rgba(192, 57, 43, 0.22);
            background: linear-gradient(145deg, rgba(192, 57, 43, 0.08) 0%, rgba(13, 11, 8, 0.6) 100%);
            border-left: 3px solid var(--crimson);
        }
        .hero-manifesto > strong {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.05rem, 2.5vw, 1.35rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.35;
            margin-bottom: 10px;
        }
        .hero-manifesto > strong em {
            font-style: italic;
            color: var(--amber);
        }
        .hero-manifesto p {
            font-size: 12px;
            font-weight: 300;
            color: rgba(212, 197, 169, 0.55);
            letter-spacing: 0.04em;
            line-height: 1.65;
        }
        .hero-manifesto .manifesto-em {
            color: var(--bone);
            font-weight: 600;
        }
        .hero-cta {
            display: inline-block;
            margin-top: 22px;
            padding: 12px 18px;
            border-radius: 999px;
            border: 1px solid rgba(232, 160, 32, 0.4);
            color: var(--bone);
            font-size: 10px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.25s, transform 0.25s;
        }
        .hero-cta:hover {
            background: rgba(232, 160, 32, 0.12);
            transform: translateY(-2px);
        }

        /* ── DIVIDER ── */
        .divider {
            width: 100%;
            max-width: min(920px, 92%);
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 24px;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212,197,169,0.14), transparent);
        }
        .divider-ornament {
            flex-shrink: 0;
            width: 10px;
            height: 10px;
            border: 1px solid rgba(232, 160, 32, 0.45);
            transform: rotate(45deg);
            box-shadow: 0 0 20px rgba(192, 57, 43, 0.15);
            background: radial-gradient(circle at 30% 30%, rgba(232, 160, 32, 0.2), transparent 70%);
        }

        /* ── FORM SECTION ── */
        .form-section {
            position: relative;
            z-index: 1;
            max-width: 560px;
            margin: 0 auto;
            padding: 80px 24px;
        }

        .section-label {
            font-size: 9px;
            letter-spacing: 0.5em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 16px;
            display: inline-flex;
            align-items: center;
            gap: 14px;
        }
        .section-label::before {
            content: '';
            width: 28px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--crimson));
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 5vw, 44px);
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
            line-height: 1.1;
        }
        .section-title em {
            font-style: italic;
            color: var(--crimson);
        }
        .section-desc {
            font-size: 13px;
            color: rgba(212,197,169,0.35);
            font-weight: 300;
            margin-bottom: 36px;
        }

        /* Flash message */
        .flash {
            margin-bottom: 24px;
            padding: 16px 20px;
            background: rgba(192,57,43,0.08);
            border: 1px solid rgba(192,57,43,0.2);
            border-radius: 12px;
            color: var(--crimson);
            font-size: 13px;
            text-align: center;
        }
        .flash--success {
            text-align: left;
            padding: 22px 24px;
            background: linear-gradient(145deg, rgba(232, 160, 32, 0.09) 0%, rgba(192, 57, 43, 0.07) 50%, rgba(13, 11, 8, 0.5) 100%);
            border: 1px solid rgba(232, 160, 32, 0.28);
            border-left: 3px solid var(--amber);
            color: var(--bone);
        }
        .flash-title {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.05rem, 2.2vw, 1.25rem);
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: 0.02em;
        }
        .flash-body {
            display: block;
            font-size: 12px;
            line-height: 1.75;
            color: rgba(212, 197, 169, 0.72);
            font-weight: 300;
            letter-spacing: 0.03em;
        }
        .celebration-at-voces {
            margin: 0 0 36px;
            animation: celebration-in 0.75s ease-out;
        }
        @keyframes celebration-in {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .validation-errors {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(232, 160, 32, 0.35);
            background: rgba(232, 160, 32, 0.08);
            color: #ffd79a;
            font-size: 12px;
            line-height: 1.6;
        }
        .validation-errors:empty {
            display: none;
        }

        /* Inputs */
        .field {
            position: relative;
            margin-bottom: 16px;
        }
        .field input,
        .field textarea {
            width: 100%;
            background: rgba(255,255,255,0.025);
            border: 1px solid rgba(212,197,169,0.08);
            border-radius: 14px;
            padding: 18px 22px;
            color: var(--bone);
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.35s, background 0.35s, box-shadow 0.35s;
        }
        .field input::placeholder,
        .field textarea::placeholder {
            color: rgba(212,197,169,0.2);
        }
        .field input:focus,
        .field textarea:focus {
            background: rgba(255,255,255,0.05);
            border-color: rgba(192,57,43,0.5);
            box-shadow: 0 0 24px rgba(192,57,43,0.12), inset 0 0 12px rgba(192,57,43,0.04);
        }
        .field textarea {
            min-height: 150px;
            resize: none;
        }

        /* Submit button */
        .submit-btn {
            width: 100%;
            padding: 20px;
            background: var(--crimson);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: 'Syne', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            cursor: crosshair;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.3s;
        }
        .submit-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
        }
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(192,57,43,0.45);
        }
        .submit-btn:active { transform: scale(0.98); }

        /* ── STATS STRIP ── */
        .stats-strip {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-top: 1px solid rgba(212,197,169,0.06);
            border-bottom: 1px solid rgba(212,197,169,0.06);
        }
        .stat-item {
            padding: 48px 24px;
            text-align: center;
            border-right: 1px solid rgba(212,197,169,0.06);
        }
        .stat-item:last-child { border-right: none; }
        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 56px);
            font-weight: 900;
            color: var(--crimson);
            line-height: 1;
            display: block;
        }
        .stat-label {
            font-size: 10px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(212,197,169,0.3);
            margin-top: 10px;
            display: block;
        }

        /* ── IMPACT LIST ── */
        .impact-section {
            position: relative;
            z-index: 1;
            max-width: 960px;
            margin: 0 auto;
            padding: 100px 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        @media(max-width: 720px) {
            .impact-section { grid-template-columns: 1fr; gap: 48px; }
            .stats-strip { grid-template-columns: 1fr; }
            .stat-item { border-right: none; border-bottom: 1px solid rgba(212,197,169,0.06); }
        }

        .impact-list { list-style: none; }
        .impact-list li {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            padding: 22px 0;
            border-bottom: 1px solid rgba(212,197,169,0.05);
        }
        .impact-list li:last-child { border-bottom: none; }
        .impact-num {
            font-family: 'Playfair Display', serif;
            font-size: 11px;
            color: var(--crimson);
            font-weight: 700;
            min-width: 24px;
            margin-top: 2px;
        }
        .impact-text {
            font-size: 14px;
            color: rgba(212,197,169,0.6);
            font-weight: 300;
            line-height: 1.6;
        }
        .impact-text strong {
            color: var(--bone);
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
            font-size: 15px;
        }

        /* Drug visual card */
        .drug-visual {
            position: relative;
        }
        .drug-visual-inner {
            aspect-ratio: 3/4;
            border-radius: 28px;
            overflow: hidden;
            position: relative;
        }
        .drug-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(60%) sepia(20%) brightness(0.55);
            transition: filter 1.2s ease;
        }
        .drug-visual:hover img {
            filter: grayscale(0%) sepia(30%) brightness(0.65) contrast(1.1);
        }
        .drug-visual-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(13,11,8,0.95) 0%, transparent 50%);
        }
        .drug-visual-text {
            position: absolute;
            bottom: 28px; left: 28px; right: 28px;
        }
        .drug-visual-quote {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 16px;
            color: rgba(212,197,169,0.7);
            line-height: 1.5;
        }
        .drug-visual-author {
            margin-top: 10px;
            font-size: 10px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--crimson);
        }
        .drug-visual-border {
            position: absolute;
            inset: -1px;
            border-radius: 29px;
            border: 1px solid rgba(192,57,43,0.2);
            pointer-events: none;
        }

        /* ── TESTIMONIALS ── */
        .testimonials-section {
            position: relative;
            z-index: 1;
            padding: 80px 24px 120px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .testimonials-header {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 52px;
        }
        .testimonials-header h3 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(24px, 4vw, 38px);
            color: #fff;
        }
        .testimonials-header h3 em {
            font-style: italic;
            color: var(--amber);
        }
        .testimonials-line {
            flex: 1;
            height: 1px;
            background: rgba(212,197,169,0.08);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .pagination-wrap {
            margin-top: 28px;
            display: flex;
            justify-content: center;
        }
        .pagination {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid rgba(212, 197, 169, 0.07);
            background: rgba(255, 255, 255, 0.02);
        }
        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 34px;
            padding: 0 10px;
            border-radius: 10px;
            font-size: 10px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            text-decoration: none;
            border: 1px solid rgba(212, 197, 169, 0.08);
            color: rgba(212, 197, 169, 0.55);
            transition: border-color 0.25s, background 0.25s, color 0.25s, transform 0.2s;
        }
        .pagination a:hover {
            color: var(--bone);
            border-color: rgba(232, 160, 32, 0.35);
            background: rgba(232, 160, 32, 0.08);
            transform: translateY(-1px);
        }
        .pagination .active {
            color: #fff;
            border-color: rgba(192, 57, 43, 0.5);
            background: rgba(192, 57, 43, 0.12);
        }
        .pagination .disabled {
            opacity: 0.35;
            pointer-events: none;
        }
        .testimonial-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(212,197,169,0.07);
            border-radius: 20px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.4s, transform 0.3s;
        }
        .testimonial-card::before {
            content: '\201C';
            position: absolute;
            top: -10px; right: 20px;
            font-family: 'Playfair Display', serif;
            font-size: 100px;
            color: rgba(192,57,43,0.07);
            line-height: 1;
            pointer-events: none;
        }
        .testimonial-card:hover {
            border-color: rgba(192,57,43,0.2);
            transform: translateY(-4px);
        }
        .testimonial-msg {
            font-size: 14px;
            color: rgba(212,197,169,0.65);
            font-weight: 300;
            line-height: 1.7;
            font-style: italic;
            margin-bottom: 20px;
        }
        .testimonial-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(212,197,169,0.06);
            padding-top: 16px;
        }
        .testimonial-name {
            font-size: 11px;
            font-weight: 600;
            color: var(--crimson);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .testimonial-date {
            font-size: 9px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(212,197,169,0.2);
        }

        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            padding: 80px 24px;
            border: 1px dashed rgba(212,197,169,0.07);
            border-radius: 20px;
        }
        .empty-state p {
            font-size: 13px;
            color: rgba(212,197,169,0.2);
        }

        /* ── FOOTER ── */
        footer {
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(212,197,169,0.06);
            padding: 36px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 12px;
            color: rgba(212,197,169,0.2);
        }
        .footer-copy {
            font-size: 9px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(212,197,169,0.15);
        }
        .footer-ornament {
            width: 6px;
            height: 6px;
            background: var(--crimson);
            opacity: 0.35;
            transform: rotate(45deg);
            flex-shrink: 0;
        }
        @media (max-width: 560px) {
            .nav-links { gap: 16px; }
            .nav-link { letter-spacing: 0.25em; }
            .nav-link:hover { letter-spacing: 0.3em; }
        }
    </style>
</head>
<body>

    <!-- Smoke bg -->
    <div class="smoke-blob smoke-blob-1"></div>
    <div class="smoke-blob smoke-blob-2"></div>
    <div class="smoke-blob smoke-blob-3"></div>

    <!-- Vein canvas -->
    <canvas id="vein-canvas"></canvas>

    <!-- NAV -->
    <nav>
        <span class="nav-logo">El Precio del Placer</span>
        <div class="nav-links">
            <a href="#reflexion" class="nav-link">Reflexión</a>
            <a href="#voces" class="nav-link">Voces</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <span class="hero-corner hero-corner--tl" aria-hidden="true"></span>
        <span class="hero-corner hero-corner--br" aria-hidden="true"></span>
        <div class="hero-eyebrow" data-aos="fade-down" data-aos-duration="800">
            Proyecto de Concientización
        </div>
        <h1 class="hero-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            El Precio
            <em>del Placer</em>
            <span class="sub">¿Cuánto cuesta?</span>
        </h1>
        <p class="hero-sub" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
            Cada dosis tiene un costo invisible que la euforia no te deja ver hasta que es demasiado tarde.
        </p>
        <div class="hero-manifesto" data-aos="fade-up" data-aos-delay="400">
            <strong>No te drogues: <em>tu futuro no se negocia.</em></strong>
            <p>
                Decir <strong class="manifesto-em">no</strong> no te hace aburrido: te mantiene entero.
                Si alguien insiste, no es tu amigo — es presión. Busca ayuda, habla con alguien de confianza y recuerda:
                la primera vez puede parecer elección; la adicción, casi nunca.
            </p>
        </div>
        <a href="#reflexion" class="hero-cta" data-aos="fade-up" data-aos-delay="500">Contesta un formulario</a>
    </section>

    <div class="divider" aria-hidden="true"><span class="divider-ornament"></span></div>

    <!-- STATS STRIP -->
    <div class="stats-strip">
        <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
            <span class="stat-number" id="stat1">0</span>
            <span class="stat-label">Millones afectados / año</span>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
            <span class="stat-number" id="stat2">0</span>
            <span class="stat-label">Años de vida perdidos</span>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
            <span class="stat-number" id="stat3">0%</span>
            <span class="stat-label">Familias impactadas</span>
        </div>
    </div>

    <div class="divider" aria-hidden="true"><span class="divider-ornament"></span></div>

    <!-- FORM -->
    <section class="form-section" id="reflexion">
        <div data-aos="fade-up" data-aos-duration="900">
            <span class="section-label">Tu voz cuenta</span>
            <h2 class="section-title">¿Qué te <em>llevas</em>?</h2>
            <p class="section-desc">Comparte tu reflexión. Sin juicios, sin filtros — solo verdad.</p>
        </div>

        @if ($errors->any())
        <div class="validation-errors" id="form-errors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @else
        <div class="validation-errors" id="form-errors"></div>
        @endif

        <form id="comentario-form" action="{{ route('comentarios.store') }}" method="POST" data-aos="fade-up" data-aos-delay="100">
            @csrf
            <div class="field">
                <input type="text" name="nombre" placeholder="Nombre o pseudónimo" value="{{ old('nombre') }}" required>
            </div>
            <div class="field">
                <input type="email" name="correo" placeholder="Email (opcional)" value="{{ old('correo') }}">
            </div>
            <div class="field">
                <textarea name="mensaje" placeholder="¿Qué te llevas de esta charla?" required>{{ old('mensaje') }}</textarea>
            </div>
            <button type="submit" class="submit-btn" id="submit-btn">Enviar Reflexión</button>
        </form>
    </section>

    <div class="divider" aria-hidden="true"><span class="divider-ornament"></span></div>

    <!-- IMPACT -->
    <section class="impact-section">
        <div data-aos="fade-right" data-aos-duration="900">
            <span class="section-label">El costo real</span>
            <h2 class="section-title" style="margin-bottom:32px;">Lo que <em>nadie</em> te cuenta</h2>
            <ul class="impact-list">
                <li data-aos="fade-up" data-aos-delay="50">
                    <span class="impact-num">01</span>
                    <span class="impact-text">
                        <strong>Daño cerebral irreversible</strong>
                        El cerebro en desarrollo pierde conexiones que nunca se recuperan completamente.
                    </span>
                </li>
                <li data-aos="fade-up" data-aos-delay="100">
                    <span class="impact-num">02</span>
                    <span class="impact-text">
                        <strong>Colapso familiar silencioso</strong>
                        Los vínculos más cercanos son los primeros que la adicción destruye.
                    </span>
                </li>
                <li data-aos="fade-up" data-aos-delay="150">
                    <span class="impact-num">03</span>
                    <span class="impact-text">
                        <strong>Rendimiento en caída libre</strong>
                        La motivación, memoria y concentración se erosionan semana a semana.
                    </span>
                </li>
                <li data-aos="fade-up" data-aos-delay="200">
                    <span class="impact-num">04</span>
                    <span class="impact-text">
                        <strong>Deuda financiera y social</strong>
                        El costo económico y el aislamiento crecen de forma exponencial.
                    </span>
                </li>
            </ul>
        </div>

        <div class="drug-visual" data-aos="fade-left" data-aos-duration="1000">
            <div class="drug-visual-inner">
                <img src="https://images.unsplash.com/photo-1582719471384-894fbb16e074?q=80&w=800" alt="Sombra">
                <div class="drug-visual-overlay"></div>
                <div class="drug-visual-text">
                    <p class="drug-visual-quote">"La primera vez que dije no fue también la primera vez que me recuperé a mí mismo."</p>
                    <p class="drug-visual-author">— Sobreviviente anónimo</p>
                </div>
            </div>
            <div class="drug-visual-border"></div>
        </div>
    </section>

    <div class="divider" aria-hidden="true"><span class="divider-ornament"></span></div>

    <!-- TESTIMONIALS -->
    <section class="testimonials-section" id="voces">
        <div class="testimonials-header" data-aos="fade-up">
            <h3>Voces de la <em>comunidad</em></h3>
            <div class="testimonials-line"></div>
        </div>

        @if (session('celebration_title'))
        <div class="flash flash--success celebration-at-voces" id="celebration-flash-banner" role="status">
            <span class="flash-title">{{ session('celebration_title') }}</span>
            <span class="flash-body">{{ session('celebration_body') }}</span>
        </div>
        @endif

        <div class="testimonials-grid" id="testimonials-grid">
            @forelse ($comentarios as $comentario)
            <div class="testimonial-card" data-aos="fade-up">
                <p class="testimonial-msg">{{ $comentario->mensaje }}</p>
                <div class="testimonial-footer">
                    <span class="testimonial-name">{{ $comentario->nombre }}</span>
                    <span class="testimonial-date">{{ $comentario->created_at->format('d M') }}</span>
                </div>
            </div>
            @empty
            <div class="empty-state" data-aos="fade-up">
                <p>Aún no hay reflexiones. Sé la primera voz.</p>
            </div>
            @endforelse
        </div>

        @if (method_exists($comentarios, 'links'))
        <div class="pagination-wrap" data-aos="fade-up">
            <nav class="pagination" aria-label="Paginación de comentarios">
                @php
                    $prevUrl = $comentarios->previousPageUrl();
                    $nextUrl = $comentarios->nextPageUrl();
                    $fragment = '#voces';
                @endphp

                <a class="{{ $prevUrl ? '' : 'disabled' }}" href="{{ $prevUrl ? ($prevUrl . $fragment) : '#' }}">Anterior</a>

                @for ($i = 1; $i <= $comentarios->lastPage(); $i++)
                    @if ($i === $comentarios->currentPage())
                        <span class="active" aria-current="page">{{ $i }}</span>
                    @else
                        <a href="{{ $comentarios->url($i) . $fragment }}">{{ $i }}</a>
                    @endif
                @endfor

                <a class="{{ $nextUrl ? '' : 'disabled' }}" href="{{ $nextUrl ? ($nextUrl . $fragment) : '#' }}">Siguiente</a>
            </nav>
        </div>
        @endif
    </section>

    <!-- FOOTER -->
    <footer>
        <span class="footer-logo">El Precio del Placer</span>
        <span class="footer-ornament" aria-hidden="true"></span>
        <span class="footer-copy">© 2026 Proyecto Académico de Concientización</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, easing: 'ease-out-quart', duration: 900 });

        /** Confetti sobrio: paleta del sitio, poca velocidad, respeto a reduced-motion */
        function launchFormalConfetti() {
            if (typeof confetti !== 'function') return;
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            const palette = ['#c0392b', '#e8a020', '#d4c5a9', '#a67c52', '#f5ecd8', '#8b6914'];

            const burst = (opts) => {
                confetti(Object.assign({
                    colors: palette,
                    ticks: 400,
                    gravity: 0.5,
                    scalar: 0.7,
                    drift: 0.1,
                    particleCount: 40,
                    spread: 56,
                    startVelocity: 19,
                    disableForReducedMotion: true,
                    zIndex: 10050,
                }, opts));
            };

            burst({ origin: { x: 0.5, y: 0.3 } });
            window.setTimeout(() => {
                burst({ particleCount: 24, angle: 125, spread: 42, origin: { x: 0.97, y: 0.48 } });
                burst({ particleCount: 24, angle: 55, spread: 42, origin: { x: 0.03, y: 0.48 } });
            }, 140);
            window.setTimeout(() => {
                burst({ particleCount: 30, spread: 68, origin: { x: 0.5, y: 0.24 }, scalar: 0.55, startVelocity: 15 });
            }, 380);
        }

        // Tras envío clásico: confetti + ya estás en #voces. Sin celebración: bajar al formulario.
        window.addEventListener('load', () => {
            @if(session('celebration_title'))
            window.setTimeout(() => launchFormalConfetti(), 200);
            return;
            @endif
            const hasFragment = window.location.hash && window.location.hash.length > 1;
            if (!hasFragment) {
                const formSection = document.getElementById('reflexion');
                if (formSection) {
                    formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });

        // Envio del formulario sin recargar la pagina.
        const comentarioForm = document.getElementById('comentario-form');
        const submitBtn = document.getElementById('submit-btn');
        const errorsBox = document.getElementById('form-errors');
        const testimonialsGrid = document.getElementById('testimonials-grid');

        if (comentarioForm) {
            comentarioForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                errorsBox.innerHTML = '';
                submitBtn.disabled = true;
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Enviando...';

                try {
                    const formData = new FormData(comentarioForm);
                    const response = await fetch(comentarioForm.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    let data;
                    try {
                        data = await response.json();
                    } catch (e) {
                        throw new Error('No se pudo enviar el formulario.');
                    }

                    if (!response.ok) {
                        if (data.errors) {
                            Object.values(data.errors).flat().forEach((message) => {
                                const div = document.createElement('div');
                                div.textContent = message;
                                errorsBox.appendChild(div);
                            });
                            return;
                        }
                        throw new Error('No se pudo enviar el formulario.');
                    }

                    const emptyState = testimonialsGrid.querySelector('.empty-state');
                    if (emptyState) {
                        emptyState.remove();
                    }

                    const card = document.createElement('div');
                    card.className = 'testimonial-card';
                    card.innerHTML = `
                        <p class="testimonial-msg"></p>
                        <div class="testimonial-footer">
                            <span class="testimonial-name"></span>
                            <span class="testimonial-date"></span>
                        </div>
                    `;
                    card.querySelector('.testimonial-msg').textContent = data.comentario.mensaje;
                    card.querySelector('.testimonial-name').textContent = data.comentario.nombre;
                    card.querySelector('.testimonial-date').textContent = data.comentario.fecha;
                    testimonialsGrid.prepend(card);

                    comentarioForm.reset();

                    const vocesSection = document.getElementById('voces');
                    const gridEl = document.getElementById('testimonials-grid');
                    if (data.celebration && gridEl && gridEl.parentNode) {
                        let banner = document.getElementById('celebration-flash-banner');
                        if (!banner) {
                            banner = document.createElement('div');
                            banner.id = 'celebration-flash-banner';
                            banner.className = 'flash flash--success celebration-at-voces';
                            banner.setAttribute('role', 'status');
                            gridEl.parentNode.insertBefore(banner, gridEl);
                        }
                        banner.innerHTML =
                            '<span class="flash-title"></span><span class="flash-body"></span>';
                        banner.querySelector('.flash-title').textContent = data.celebration.title;
                        banner.querySelector('.flash-body').textContent = data.celebration.body;
                    }

                    launchFormalConfetti();

                    window.setTimeout(() => {
                        if (vocesSection) {
                            vocesSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }, 500);
                } catch (error) {
                    errorsBox.innerHTML = '<div>Ocurrio un error al enviar. Intenta nuevamente.</div>';
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            });
        }

        /* ── VEIN CANVAS ── */
        const canvas = document.getElementById('vein-canvas');
        const ctx = canvas.getContext('2d');
        let veins = [];

        function resize() {
            canvas.width  = window.innerWidth;
            canvas.height = document.body.scrollHeight;
        }
        resize();
        window.addEventListener('resize', () => { resize(); generateVeins(); });

        function generateVeins() {
            veins = [];
            const count = Math.floor(canvas.width / 80);
            for (let i = 0; i < count; i++) {
                veins.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height * 0.3,
                    angle: (Math.random() - 0.5) * 0.6 + Math.PI / 2,
                    length: 0,
                    maxLength: 200 + Math.random() * 400,
                    branches: [],
                    color: Math.random() > 0.6 ? '#c0392b' : '#e8a020',
                    alpha: 0.3 + Math.random() * 0.3,
                    speed: 0.8 + Math.random() * 1.2
                });
            }
        }
        generateVeins();

        function drawVein(v) {
            if (v.length >= v.maxLength) return;
            v.length += v.speed;
            ctx.save();
            ctx.strokeStyle = v.color;
            ctx.globalAlpha = v.alpha * (v.length / v.maxLength);
            ctx.lineWidth = 0.5;
            ctx.beginPath();
            ctx.moveTo(v.x, v.y);
            const ex = v.x + Math.cos(v.angle) * v.length;
            const ey = v.y + Math.sin(v.angle) * v.length;
            const cx1 = v.x + Math.cos(v.angle + 0.4) * v.length * 0.4;
            const cy1 = v.y + Math.sin(v.angle + 0.4) * v.length * 0.4;
            ctx.quadraticCurveTo(cx1, cy1, ex, ey);
            ctx.stroke();
            ctx.restore();

            // spawn branch occasionally
            if (v.length > v.maxLength * 0.4 && v.branches.length < 2 && Math.random() < 0.003) {
                v.branches.push({
                    x: ex, y: ey,
                    angle: v.angle + (Math.random() - 0.5) * 0.9,
                    length: 0,
                    maxLength: v.maxLength * 0.45,
                    branches: [],
                    color: v.color,
                    alpha: v.alpha * 0.6,
                    speed: v.speed * 0.8
                });
            }
            v.branches.forEach(drawVein);
        }

        function animateVeins() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            veins.forEach(drawVein);
            requestAnimationFrame(animateVeins);
        }
        animateVeins();

        /* ── COUNTER ANIMATION ── */
        function animateCount(el, target, suffix, duration) {
            let start = 0;
            const step = target / (duration / 16);
            const timer = setInterval(() => {
                start += step;
                if (start >= target) { el.textContent = target + suffix; clearInterval(timer); return; }
                el.textContent = Math.floor(start) + suffix;
            }, 16);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCount(document.getElementById('stat1'), 35,  'M',  1800);
                    animateCount(document.getElementById('stat2'), 12,  '',   2000);
                    animateCount(document.getElementById('stat3'), 78,  '%',  1600);
                    observer.disconnect();
                }
            });
        }, { threshold: 0.3 });
        observer.observe(document.querySelector('.stats-strip'));
    </script>
</body>
</html>