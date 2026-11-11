<x-public-layout title="Cara Pencegahan" active="cara-pencegahan">
    <style>
        .cp-wrap {
            max-width: 1040px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .cp-hero {
            background: linear-gradient(180deg, #fff5f8 0%, #ffffff 100%);
            border-bottom: 1px solid #f3dce3;
            padding: 28px 0 34px;
        }
        .cp-hero-pills {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }
        .cp-pill-brand {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fde8ef;
            color: #9e1c47;
            border: 1px solid #f7c6d7;
            border-radius: 999px;
            padding: 5px 14px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .cp-pill-module {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #7c5c67;
            font-size: 12.5px;
            font-weight: 600;
        }
        .cp-hero-grid {
            display: grid;
            grid-template-columns: 1.35fr 0.95fr;
            gap: 28px;
            align-items: center;
        }
        .cp-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #9e1c47;
            margin-bottom: 8px;
        }
        .cp-title {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: clamp(25px, 3.6vw, 36px);
            line-height: 1.15;
            color: #2b121b;
            margin: 0 0 12px;
            font-weight: 800;
            letter-spacing: -0.6px;
        }
        .cp-title em {
            color: #9e1c47;
            font-style: italic;
            font-weight: 600;
        }
        .cp-lead {
            font-size: 15px;
            line-height: 1.7;
            color: #5f454e;
            margin: 0;
            max-width: 580px;
        }
        .cp-summary-card {
            background: #ffffff;
            border: 1px solid #f0d7df;
            border-radius: 18px;
            padding: 20px 22px;
            box-shadow: 0 8px 24px rgba(158, 28, 71, 0.06);
        }
        .cp-summary-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .cp-summary-label {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #8f6b77;
        }
        .cp-summary-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #fdf0f4;
            color: #9e1c47;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }
        .cp-summary-quote {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 16px;
            line-height: 1.45;
            font-weight: 700;
            color: #2b121b;
            margin: 0 0 10px;
        }
        .cp-summary-text {
            font-size: 12.5px;
            line-height: 1.6;
            color: #6b4f58;
            margin: 0;
        }

        /* Quick Jump Bar */
        .cp-jump-bar {
            background: #ffffff;
            border-bottom: 1px solid #f0dfe5;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .cp-jump-inner {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .cp-jump-inner::-webkit-scrollbar {
            display: none;
        }
        .cp-jump-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: #8f6b77;
            white-space: nowrap;
            margin-right: 4px;
        }
        .cp-jump-link {
            display: inline-flex;
            align-items: center;
            padding: 6px 13px;
            border-radius: 999px;
            background: #fdf6f8;
            border: 1px solid #eed7df;
            color: #5c3341;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s ease;
        }
        .cp-jump-link:hover {
            background: #9e1c47;
            border-color: #9e1c47;
            color: #ffffff;
        }

        /* Main Sections */
        .cp-main {
            padding: 36px 0 48px;
        }
        .cp-section {
            margin-bottom: 42px;
            scroll-margin-top: 72px;
        }
        .cp-sec-head {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }
        .cp-sec-kicker {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .cp-num-badge {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #9e1c47;
            color: #ffffff;
            font-size: 11.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cp-sec-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #9e1c47;
        }
        .cp-sec-title {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: clamp(19px, 2.6vw, 25px);
            font-weight: 800;
            color: #2b121b;
            margin: 0;
            line-height: 1.25;
            letter-spacing: -0.4px;
        }
        .cp-sec-sub {
            font-size: 13.5px;
            color: #6b4f58;
            margin: 6px 0 0;
            line-height: 1.6;
        }
        .cp-head-pill {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 999px;
            background: #fdf6f8;
            border: 1px solid #ead1da;
            font-size: 11.5px;
            font-weight: 600;
            color: #6b3b4b;
        }

        /* Section 1: 4-col grid */
        .cp-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 16px;
        }
        .cp-step-card {
            background: #ffffff;
            border: 1px solid #eedbe2;
            border-radius: 16px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 3px 12px rgba(43, 18, 27, 0.03);
        }
        .cp-step-card.is-danger {
            background: #fff8fa;
            border-color: #f3c4d3;
        }
        .cp-step-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .cp-step-num {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            background: #fdf0f4;
            color: #9e1c47;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .cp-step-card.is-danger .cp-step-num {
            background: #9e1c47;
            color: #ffffff;
        }
        .cp-step-ico {
            font-size: 16px;
            color: #9e1c47;
        }
        .cp-step-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #2b121b;
            margin: 0 0 8px;
        }
        .cp-step-desc {
            font-size: 12.5px;
            line-height: 1.6;
            color: #5f454e;
            margin: 0 0 14px;
        }
        .cp-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            background: #f3f9f5;
            color: #166534;
            border: 1px solid #cde8d5;
            width: fit-content;
        }
        .cp-chip.is-neutral {
            background: #fdf4f7;
            color: #8b2648;
            border-color: #f2d4de;
        }
        .cp-chip.is-danger {
            background: #fde8ef;
            color: #9e1c47;
            border-color: #f5bfd1;
        }
        .cp-callout {
            background: #fdf2f6;
            border: 1px solid #f2cfd9;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .cp-callout-ico {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #9e1c47;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .cp-callout-head {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }
        .cp-callout-title {
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: #9e1c47;
        }
        .cp-callout-badge {
            font-size: 10px;
            font-weight: 700;
            background: #ffffff;
            color: #9e1c47;
            border: 1px solid #eec5d3;
            padding: 2px 8px;
            border-radius: 999px;
        }
        .cp-callout-text {
            font-size: 13px;
            line-height: 1.6;
            color: #4f313b;
            margin: 0;
        }

        /* Section 2: 2-col */
        .cp-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .cp-avoid-box {
            background: #fff9fb;
            border: 1px solid #f3cad7;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 14px;
        }
        .cp-avoid-head {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #9e1c47;
            margin-bottom: 14px;
        }
        .cp-avoid-item {
            background: #ffffff;
            border: 1px solid #f2dce4;
            border-radius: 10px;
            padding: 11px 14px;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .cp-avoid-item:last-child {
            margin-bottom: 0;
        }
        .cp-avoid-x {
            color: #9e1c47;
            font-weight: 700;
            font-size: 13px;
            line-height: 1.4;
        }
        .cp-avoid-name {
            font-size: 13px;
            font-weight: 700;
            color: #2b121b;
            margin: 0 0 2px;
        }
        .cp-avoid-desc {
            font-size: 12px;
            color: #6b4f58;
            margin: 0;
            line-height: 1.5;
        }
        .cp-instead-box {
            background: #f6fbf8;
            border: 1px solid #cbe6d3;
            border-radius: 14px;
            padding: 16px 18px;
        }
        .cp-instead-head {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: #166534;
            margin-bottom: 6px;
        }
        .cp-instead-text {
            font-size: 12.5px;
            line-height: 1.6;
            color: #2c4a37;
            margin: 0;
        }
        .cp-impact-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .cp-impact-card {
            background: #ffffff;
            border: 1px solid #eedbe2;
            border-radius: 14px;
            padding: 15px 18px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .cp-impact-ico {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: #fdf0f4;
            color: #9e1c47;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        .cp-impact-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #2b121b;
            margin: 0 0 4px;
        }
        .cp-impact-desc {
            font-size: 12.5px;
            line-height: 1.55;
            color: #5f454e;
            margin: 0;
        }

        /* Section 3: 3-col */
        .cp-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .cp-card-3 {
            background: #ffffff;
            border: 1px solid #eedbe2;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cp-card-3.is-warn {
            background: #fff8fa;
            border-color: #f3c4d3;
        }
        .cp-card-3-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        .cp-circle-ico {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fdf0f4;
            color: #9e1c47;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }

        /* Section 4: Pantyliner */
        .cp-panty-stack {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .cp-panty-card {
            background: #ffffff;
            border: 1px solid #eedbe2;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .cp-fact-card {
            background: #fdf6f8;
            border: 1px solid #eed5de;
            border-radius: 16px;
            padding: 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cp-fact-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #2b121b;
            margin: 0 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cp-fact-text {
            font-size: 13px;
            line-height: 1.65;
            color: #5f454e;
            margin: 0 0 16px;
        }
        .cp-fact-tip {
            background: #ffffff;
            border: 1px solid #eedbe2;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 12.5px;
            line-height: 1.55;
            color: #4f313b;
        }

        /* Section 6: Handuk */
        .cp-towel-card {
            border-radius: 16px;
            padding: 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cp-towel-card.is-risk {
            background: #fff8fa;
            border: 1px solid #f3c4d3;
        }
        .cp-towel-card.is-safe {
            background: #f8fcf9;
            border: 1px solid #cce7d4;
        }
        .cp-towel-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .cp-towel-kicker {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }

        /* Interactive Checklist */
        .cp-checklist-box {
            background: #fdf6f8;
            border: 1px solid #eed5de;
            border-radius: 20px;
            padding: 26px 28px;
            margin-bottom: 36px;
        }
        .cp-check-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }
        .cp-score-pill {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #ffffff;
            border: 1px solid #ead1da;
            border-radius: 14px;
            padding: 10px 16px;
        }
        .cp-score-num {
            font-size: 20px;
            font-weight: 800;
            color: #9e1c47;
        }
        .cp-check-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .cp-check-item {
            background: #ffffff;
            border: 1px solid #eedbe2;
            border-radius: 12px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 13px;
            color: #3d222c;
            transition: border-color 0.15s ease, background 0.15s ease;
        }
        .cp-check-item:hover {
            border-color: #9e1c47;
        }
        .cp-check-item input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: #9e1c47;
            cursor: pointer;
            flex-shrink: 0;
        }
        .cp-check-item.is-checked {
            background: #fff5f8;
            border-color: #d9829f;
            font-weight: 600;
        }

        /* Bottom Banner */
        .cp-banner {
            background: linear-gradient(135deg, #681330 0%, #921b44 100%);
            color: #ffffff;
            border-radius: 22px;
            padding: clamp(24px, 4vw, 38px);
            display: grid;
            grid-template-columns: 1.4fr 0.85fr;
            gap: 24px;
            align-items: center;
            margin-bottom: 32px;
            box-shadow: 0 12px 30px rgba(104, 19, 48, 0.22);
        }
        .cp-banner-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 999px;
            padding: 4px 12px;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .cp-banner-title {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: clamp(22px, 3vw, 30px);
            font-weight: 800;
            margin: 0 0 10px;
            color: #ffffff;
            letter-spacing: -0.4px;
        }
        .cp-banner-text {
            font-size: 14px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.92);
            margin: 0 0 12px;
        }
        .cp-banner-quote {
            font-size: 14px;
            font-style: italic;
            font-weight: 600;
            color: #ffdce7;
            margin: 0;
        }
        .cp-banner-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
        }

        /* Bottom Nav */
        .cp-bottom-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            padding-top: 8px;
        }
        .cp-progress-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #8f6b77;
        }

        /* Ilustrasi Micro Cards */
        .cp-card-illus {
            border-radius: 12px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #fdf2f6 0%, #fce7ef 100%);
            border: 1px solid #f7d3e0;
        }
        .cp-card-illus.is-blue {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-color: #bae6fd;
        }
        .cp-card-illus.is-green {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-color: #bbf7d0;
        }
        .cp-card-illus.is-warn {
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
            border-color: #fed7aa;
        }
        .cp-card-illus.is-danger {
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
            border-color: #fecdd3;
        }
        .cp-card-illus.is-purple {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
            border-color: #e9d5ff;
        }

        /* Dark Mode support for Cara Pencegahan */
        html.dark .cp-hero {
            background: linear-gradient(180deg, var(--surface) 0%, var(--surface-2) 100%);
            border-bottom-color: var(--border);
        }
        html.dark .cp-pill-brand {
            background: rgba(244, 114, 182, 0.15);
            color: #f472b6;
            border-color: rgba(244, 114, 182, 0.3);
        }
        html.dark .cp-pill-module {
            color: var(--text-muted);
        }
        html.dark .cp-eyebrow {
            color: #f472b6;
        }
        html.dark .cp-title {
            color: var(--heading);
        }
        html.dark .cp-title em {
            color: #f472b6;
        }
        html.dark .cp-lead {
            color: var(--text);
        }
        html.dark .cp-summary-card {
            background: var(--surface);
            border-color: var(--border);
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
        }
        html.dark .cp-summary-label {
            color: var(--text-muted);
        }
        html.dark .cp-summary-icon {
            background: rgba(244, 114, 182, 0.2);
            color: #f472b6;
        }
        html.dark .cp-summary-quote {
            color: var(--heading);
        }
        html.dark .cp-summary-text {
            color: var(--text);
        }
        html.dark .cp-jump-bar {
            background: var(--surface);
            border-bottom-color: var(--border);
        }
        html.dark .cp-jump-label {
            color: var(--text-muted);
        }
        html.dark .cp-jump-link {
            background: var(--surface-2);
            border-color: var(--border);
            color: var(--text);
        }
        html.dark .cp-jump-link:hover {
            background: #9e1c47;
            border-color: #9e1c47;
            color: #ffffff;
        }
        html.dark .cp-sec-eyebrow {
            color: #f472b6;
        }
        html.dark .cp-sec-title {
            color: var(--heading);
        }
        html.dark .cp-sec-sub {
            color: var(--text-muted);
        }
        html.dark .cp-head-pill {
            background: var(--surface-2);
            border-color: var(--border);
            color: #f472b6;
        }
        html.dark .cp-step-card,
        html.dark .cp-card-3,
        html.dark .cp-panty-card,
        html.dark .cp-fact-card,
        html.dark .cp-fact-tip,
        html.dark .cp-check-item,
        html.dark .cp-score-pill {
            background: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }
        html.dark .cp-step-title,
        html.dark .cp-fact-title {
            color: var(--heading);
        }
        html.dark .cp-step-desc,
        html.dark .cp-fact-text {
            color: var(--text-muted);
        }
        html.dark .cp-step-num {
            background: rgba(244, 114, 182, 0.15);
            color: #f472b6;
        }
        html.dark .cp-circle-ico {
            background: rgba(244, 114, 182, 0.15);
            color: #f472b6;
        }
        html.dark .cp-step-card.is-danger {
            background: rgba(239, 68, 68, 0.08);
            border-color: rgba(239, 68, 68, 0.3);
        }
        html.dark .cp-card-3.is-warn {
            background: rgba(245, 158, 11, 0.08);
            border-color: rgba(245, 158, 11, 0.3);
        }
        html.dark .cp-avoid-box {
            background: rgba(239, 68, 68, 0.08);
            border-color: rgba(239, 68, 68, 0.3);
        }
        html.dark .cp-avoid-name {
            color: #fca5a5;
        }
        html.dark .cp-avoid-desc {
            color: var(--text-muted);
        }
        html.dark .cp-instead-box {
            background: rgba(16, 185, 129, 0.08);
            border-color: rgba(16, 185, 129, 0.3);
            color: #a7f3d0;
        }
        html.dark .cp-instead-text {
            color: var(--text);
        }
        html.dark .cp-callout {
            background: var(--surface-2);
            border-color: var(--border);
        }
        html.dark .cp-callout-title {
            color: #f472b6;
        }
        html.dark .cp-callout-text {
            color: var(--text);
        }
        html.dark .cp-impact-card {
            background: var(--surface);
            border-color: var(--border);
        }
        html.dark .cp-impact-title {
            color: var(--heading);
        }
        html.dark .cp-impact-desc {
            color: var(--text-muted);
        }
        html.dark .cp-towel-card.is-risk {
            background: rgba(239, 68, 68, 0.08);
            border-color: rgba(239, 68, 68, 0.3);
        }
        html.dark .cp-towel-card.is-safe {
            background: rgba(16, 185, 129, 0.08);
            border-color: rgba(16, 185, 129, 0.3);
        }
        html.dark .cp-checklist-box {
            background: var(--surface);
            border-color: var(--border);
        }
        html.dark .cp-card-illus {
            background: rgba(244, 114, 182, 0.1) !important;
            border-color: rgba(244, 114, 182, 0.25) !important;
        }
        html.dark .cp-card-illus.is-blue {
            background: rgba(56, 189, 248, 0.1) !important;
            border-color: rgba(56, 189, 248, 0.25) !important;
        }
        html.dark .cp-card-illus.is-green {
            background: rgba(52, 211, 153, 0.1) !important;
            border-color: rgba(52, 211, 153, 0.25) !important;
        }
        html.dark .cp-card-illus.is-warn {
            background: rgba(251, 146, 60, 0.1) !important;
            border-color: rgba(251, 146, 60, 0.25) !important;
        }
        html.dark .cp-card-illus.is-danger {
            background: rgba(248, 113, 113, 0.1) !important;
            border-color: rgba(248, 113, 113, 0.25) !important;
        }
        html.dark .cp-card-illus.is-purple {
            background: rgba(192, 132, 252, 0.1) !important;
            border-color: rgba(192, 132, 252, 0.25) !important;
        }

        @media (max-width: 900px) {
            .cp-hero-grid,
            .cp-grid-4,
            .cp-grid-3,
            .cp-grid-2,
            .cp-check-grid,
            .cp-banner {
                grid-template-columns: 1fr;
            }
        }
        @media (min-width: 600px) and (max-width: 900px) {
            .cp-grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <!-- Hero Section Sesuai Desain Modern Beranda -->
    <section class="public-hero" style="padding: 40px 0 50px; position: relative;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: clamp(36px, 5vw, 64px); align-items: center;">
                <!-- Left Content -->
                <div>
                    <!-- Breadcrumbs & Badges -->
                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-bottom: 16px;">
                        <nav style="font-size: 12.5px; color: var(--text-muted); display: inline-flex; align-items: center; gap: 6px; margin-right: 8px;">
                            <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none;">⌂ Beranda</a>
                            <span>/</span>
                            <span style="color: var(--primary); font-weight: 600;">Cara Pencegahan</span>
                        </nav>
                        <span class="home-tag">
                            <span>🛡️</span> MODUL 03
                        </span>
                    </div>

                    <h1 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(32px, 4.5vw, 48px); margin: 0 0 14px; line-height: 1.18; font-weight: 800; letter-spacing: -0.6px;">
                        Cara Pencegahan Keputihan <br><span style="font-family: 'Playfair Display', Georgia, serif; font-weight: 600; font-style: italic; color: var(--primary);">(Vulva Hygiene)</span>
                    </h1>

                    <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); max-width: 500px; margin: 0 0 26px;">
                        Panduan praktis, penuh empati, dan berbasis sains kedokteran untuk memelihara keseimbangan flora normal organ intim wanita serta mencegah timbulnya keputihan abnormal (<em>fluor albus patologis</em>).
                    </p>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 12px;">
                        <a href="#arah-basuh" class="button" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                            Mulai Panduan <span aria-hidden="true" style="margin-left: 6px;">↓</span>
                        </a>
                        <span class="home-badge-outline">
                            VULVA HYGIENE GUIDELINES
                        </span>
                    </div>
                </div>

                <!-- Right Hero Image Frame -->
                <div style="position: relative; text-align: center;">
                    <div style="position: relative; display: inline-block; max-width: 460px; width: 100%;">
                        <div style="border-radius: 28px; overflow: hidden; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.12); border: 1px solid var(--border); aspect-ratio: 4/3.2; background: var(--surface-2);">
                            <img src="{{ asset('assets/image 3.jpg') }}" alt="Edukasi Kebidanan & Kesehatan Flora-V Care" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Floating Card Overlay Sesuai Referensi -->
                        <div class="card" style="position: absolute; bottom: -20px; right: clamp(10px, 3vw, 24px); left: clamp(10px, 3vw, 24px); background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 16px 22px; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16); text-align: left;">
                            <span class="home-card-eyebrow">
                                <span>✔</span> ATURAN EMAS
                            </span>
                            <p style="font-size: 13.5px; line-height: 1.5; color: var(--text); margin: 0; font-weight: 500;">
                                Arah basuh selalu dari depan ke belakang menggunakan air bersih yang mengalir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Jump Bar -->
    <nav class="cp-jump-bar" aria-label="Lompat ke bagian">
        <div class="cp-wrap">
            <div class="cp-jump-inner">
                <span class="cp-jump-label">⇪ LOMPAT KE:</span>
                <a class="cp-jump-link" href="#arah-basuh">1. Arah Basuh</a>
                <a class="cp-jump-link" href="#hindari-kimiawi">2. Hindari Kimiawi</a>
                <a class="cp-jump-link" href="#celana-dalam">3. Celana Dalam</a>
                <a class="cp-jump-link" href="#pantyliner">4. Pantyliner</a>
                <a class="cp-jump-link" href="#cuci-tangan">5. Cuci Tangan</a>
                <a class="cp-jump-link" href="#handuk-pribadi">6. Handuk Pribadi</a>
            </div>
        </div>
    </nav>

    <div class="cp-main">
        <div class="cp-wrap">
            <!-- Section 1: Prinsip Arah & Kualitas Air -->
            <section id="arah-basuh" class="cp-section">
                <div class="cp-sec-head">
                    <div>
                        <div class="cp-sec-kicker">
                            <span class="cp-num-badge">1</span>
                            <span class="cp-sec-eyebrow">PRINSIP ARAH &amp; KUALITAS AIR</span>
                        </div>
                        <h2 class="cp-sec-title">Cara Membersihkan Organ Kewanitaan dengan Benar</h2>
                    </div>
                    <span class="cp-head-pill">Aturan Emas: Depan ke Belakang</span>
                </div>

                <div class="cp-grid-4">
                    <article class="cp-step-card">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">1</span>
                                <span class="cp-step-ico" aria-hidden="true">💧</span>
                            </div>
                            <!-- Ilustrasi Air Bersih Mengalir -->
                            <div class="cp-card-illus is-blue" title="Gunakan air bersih mengalir">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <defs>
                                        <linearGradient id="tapGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#94a3b8"/>
                                            <stop offset="100%" stop-color="#cbd5e1"/>
                                        </linearGradient>
                                        <linearGradient id="streamGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#38bdf8"/>
                                            <stop offset="100%" stop-color="#0284c7"/>
                                        </linearGradient>
                                    </defs>
                                    <!-- Keran air -->
                                    <path d="M 20 28 L 48 28 C 54 28 58 32 58 38 L 58 42 L 50 42 L 50 36 C 50 34 48 33 46 33 L 20 33 Z" fill="url(#tapGrad)"/>
                                    <rect x="36" y="22" width="10" height="6" rx="2" fill="#64748b"/>
                                    <path d="M 32 20 L 50 20" stroke="#64748b" stroke-width="2.5" stroke-linecap="round"/>
                                    <!-- Aliran air mengalir jernih -->
                                    <path d="M 52 42 Q 54 50 54 62" stroke="url(#streamGrad)" stroke-width="3" stroke-linecap="round" fill="none"/>
                                    <path d="M 56 43 Q 57 52 57 60" stroke="#7dd3fc" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                                    <!-- Tetesan dan cipratan segar -->
                                    <circle cx="53" cy="54" r="1.5" fill="#bae6fd"/>
                                    <circle cx="68" cy="46" r="3" fill="#38bdf8"/>
                                    <circle cx="78" cy="38" r="2" fill="#7dd3fc"/>
                                    <path d="M 72 26 C 74 30 76 33 76 35 C 76 37 74 39 72 39 C 70 39 68 37 68 35 C 68 33 70 30 72 26 Z" fill="#0284c7"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Gunakan Air Bersih</h3>
                            <p class="cp-step-desc">
                                Gunakan air bersih, air mengalir, atau pancuran bersih saat membasuh. Hindari air tergenang atau berbau.
                            </p>
                        </div>
                        <span class="cp-chip">✓ Air Mengalir</span>
                    </article>

                    <article class="cp-step-card">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">2</span>
                                <span class="cp-step-ico" aria-hidden="true">↓</span>
                            </div>
                            <!-- Ilustrasi Arah Depan ke Belakang -->
                            <div class="cp-card-illus is-green" title="Arah usap depan ke belakang">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <defs>
                                        <linearGradient id="arrowGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#10b981"/>
                                            <stop offset="100%" stop-color="#059669"/>
                                        </linearGradient>
                                    </defs>
                                    <!-- Titik Vulva (Depan) -->
                                    <circle cx="24" cy="32" r="12" fill="#dcfce7" stroke="#10b981" stroke-width="2"/>
                                    <text x="24" y="36" font-size="11" font-weight="700" fill="#047857" text-anchor="middle">V</text>
                                    <!-- Panah Mengarah ke Belakang -->
                                    <path d="M 40 32 L 62 32" stroke="url(#arrowGrad)" stroke-width="4" stroke-linecap="round"/>
                                    <path d="M 58 26 L 66 32 L 58 38" fill="none" stroke="url(#arrowGrad)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                    <!-- Titik Anus (Belakang) -->
                                    <circle cx="80" cy="32" r="10" fill="#f1f5f9" stroke="#94a3b8" stroke-width="1.8"/>
                                    <text x="80" y="36" font-size="10" font-weight="600" fill="#475569" text-anchor="middle">A</text>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Basuh Depan ke Belakang</h3>
                            <p class="cp-step-desc">
                                Basuh area genitalia dengan sapuan dari arah <strong>depan (vulva)</strong> menuju <strong>belakang (anus)</strong>, bukan sebaliknya.
                            </p>
                        </div>
                        <span class="cp-chip is-neutral">→ Depan &gt; Anus</span>
                    </article>

                    <article class="cp-step-card">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">3</span>
                                <span class="cp-step-ico" aria-hidden="true">✨</span>
                            </div>
                            <!-- Ilustrasi Tepuk Kering Lembut -->
                            <div class="cp-card-illus is-blue" title="Keringkan lembut dengan handuk halus">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Handuk lembut berlipat -->
                                    <path d="M 28 20 Q 55 14 74 22 L 68 48 Q 50 42 22 46 Z" fill="#e0f2fe" stroke="#38bdf8" stroke-width="1.8"/>
                                    <path d="M 22 46 Q 48 40 68 48 L 64 56 Q 44 48 18 52 Z" fill="#bae6fd" stroke="#0284c7" stroke-width="1.5"/>
                                    <!-- Kilau bersih kering -->
                                    <path d="M 76 16 L 78 20 L 82 22 L 78 24 L 76 28 L 74 24 L 70 22 L 74 20 Z" fill="#f59e0b"/>
                                    <circle cx="86" cy="32" r="2" fill="#38bdf8"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Bilas &amp; Keringkan</h3>
                            <p class="cp-step-desc">
                                Bilas tuntas hingga residu kotoran hilang, lalu tepuk-tepuk kering dengan handuk bersih khusus atau kain katun lembut.
                            </p>
                        </div>
                        <span class="cp-chip">✓ Jangan Digosok Keras</span>
                    </article>

                    <article class="cp-step-card is-danger">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">4</span>
                                <span class="cp-step-ico" aria-hidden="true">⊘</span>
                            </div>
                            <!-- Ilustrasi Bahaya Arah Terbalik -->
                            <div class="cp-card-illus is-danger" title="Dilarang membasuh dari belakang ke depan">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Tanda Larangan Merah -->
                                    <circle cx="50" cy="32" r="22" fill="#ffe4e6" stroke="#ef4444" stroke-width="2.5"/>
                                    <!-- Panah terbalik yang dicoret -->
                                    <path d="M 64 32 L 36 32" stroke="#ef4444" stroke-width="3" stroke-linecap="round"/>
                                    <path d="M 42 26 L 34 32 L 42 38" fill="none" stroke="#ef4444" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <!-- Garis Palang Merah Larangan -->
                                    <line x1="34" y1="16" x2="66" y2="48" stroke="#dc2626" stroke-width="3.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Hindari Arah Sebaliknya</h3>
                            <p class="cp-step-desc">
                                <strong>Dilarang</strong> membasuh dari anus ke depan vagina. Langkah ini memindahkan bakteri usus (<em>E. coli</em>) ke liang vagina.
                            </p>
                        </div>
                        <span class="cp-chip is-danger">⚠ Risiko Infeksi Tinggi</span>
                    </article>
                </div>

                <div class="cp-callout">
                    <span class="cp-callout-ico" aria-hidden="true">💡</span>
                    <div>
                        <div class="cp-callout-head">
                            <span class="cp-callout-title">CATATAN PENTING TIM KEBIDANAN</span>
                            <span class="cp-callout-badge">Esensial</span>
                        </div>
                        <p class="cp-callout-text">
                            Hanya gunakan air bersih alami. Hindari mencampur cairan kimia antiseptik atau sabun wangi yang dapat mengubah pH normal (3.8 – 4.5). Pastikan selalu kering sebelum memakai pakaian dalam.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Section 2: Perlindungan Keseimbangan pH -->
            <section id="hindari-kimiawi" class="cp-section">
                <div class="cp-sec-head">
                    <div>
                        <div class="cp-sec-kicker">
                            <span class="cp-num-badge">2</span>
                            <span class="cp-sec-eyebrow">PERLINDUNGAN KESEIMBANGAN PH</span>
                        </div>
                        <h2 class="cp-sec-title">Hindari Produk Beraroma &amp; Bahan Kimiawi</h2>
                        <p class="cp-sec-sub">
                            Vagina memiliki mekanisme pembersihan alami (<em>self-cleaning organ</em>). Menambahkan wewangian justru merusak ekosistem bakteri baik <em>Lactobacillus</em>.
                        </p>
                    </div>
                </div>

                <div class="cp-grid-2">
                    <div>
                        <div class="cp-avoid-box">
                            <div class="cp-avoid-head">
                                <span aria-hidden="true">⊗</span> JANGAN GUNAKAN
                            </div>
                            <div class="cp-avoid-item">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                        <!-- Botol Sabun Pembersih Wangi Berbahaya -->
                                        <rect x="13" y="14" width="14" height="20" rx="4" fill="#f43f5e"/>
                                        <rect x="17" y="9" width="6" height="5" rx="1" fill="#cbd5e1"/>
                                        <path d="M 17 9 L 10 9" stroke="#94a3b8" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="20" cy="24" r="3.5" fill="#ffffff" opacity="0.8"/>
                                        <line x1="8" y1="8" x2="32" y2="32" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="cp-avoid-name">Sabun Pembersih Kewanitaan Beraroma</p>
                                    <p class="cp-avoid-desc">Feminine wash dengan parfum/fragrance sintetis yang tajam.</p>
                                </div>
                            </div>
                            <div class="cp-avoid-item">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                        <!-- Tisu Wangi Bercoret -->
                                        <rect x="10" y="12" width="20" height="18" rx="2" fill="#fda4af" stroke="#f43f5e" stroke-width="1.2"/>
                                        <path d="M 15 12 Q 20 6 25 12" fill="#ffffff" stroke="#f43f5e" stroke-width="1"/>
                                        <path d="M 14 20 Q 20 18 26 20" stroke="#ffffff" stroke-width="1.5" fill="none"/>
                                        <line x1="8" y1="8" x2="32" y2="32" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="cp-avoid-name">Tisu Toilet Beraroma / Berparfum</p>
                                    <p class="cp-avoid-desc">Zat pewangi pada serat tisu dapat menyebabkan kontak alergi pada vulva.</p>
                                </div>
                            </div>
                            <div class="cp-avoid-item">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                        <!-- Bedak Tabur Talkum -->
                                        <path d="M 14 16 L 26 16 L 28 32 L 12 32 Z" fill="#fed7aa" stroke="#f97316" stroke-width="1.2"/>
                                        <rect x="16" y="11" width="8" height="5" rx="1" fill="#fdba74"/>
                                        <!-- Butiran partikel bedak beterbangan -->
                                        <circle cx="18" cy="8" r="1" fill="#f97316"/>
                                        <circle cx="21" cy="6" r="1.2" fill="#f97316"/>
                                        <circle cx="23" cy="8" r="1" fill="#f97316"/>
                                        <line x1="8" y1="8" x2="32" y2="32" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="cp-avoid-name">Bedak Tabur di Sekitar Kemaluan</p>
                                    <p class="cp-avoid-desc">Partikel talc dapat menyumbat pori, menimbulkan inflamasi, dan berisiko iritasi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="cp-instead-box">
                            <div class="cp-instead-head">
                                <span aria-hidden="true">✓</span> LAKUKAN INI SEBAGAI GANTINYA
                            </div>
                            <p class="cp-instead-text">
                                Cukup bersihkan menggunakan air bersih hangat atau bersuhu ruang, lalu tepuk halus menggunakan handuk katun kering.
                            </p>
                        </div>
                    </div>

                    <div class="cp-impact-stack">
                        <div class="cp-impact-card">
                            <div style="width: 42px; height: 42px; border-radius: 10px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg viewBox="0 0 40 40" width="28" height="28" aria-hidden="true">
                                    <!-- Iritasi & Kemerahan Panas -->
                                    <circle cx="20" cy="20" r="14" fill="#fee2e2" stroke="#ef4444" stroke-width="1.5"/>
                                    <path d="M 20 12 L 20 22" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="20" cy="27" r="1.5" fill="#dc2626"/>
                                    <path d="M 9 12 Q 13 9 16 12" stroke="#f87171" stroke-width="1.2" fill="none"/>
                                    <path d="M 24 12 Q 27 9 31 12" stroke="#f87171" stroke-width="1.2" fill="none"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="cp-impact-title">1. Menimbulkan Iritasi</h3>
                                <p class="cp-impact-desc">
                                    Menyebabkan reaksi alergi kontak, kulit genital kemerahan, sensasi terbakar, gatal hebat, dan rasa nyeri saat buang air.
                                </p>
                            </div>
                        </div>

                        <div class="cp-impact-card">
                            <div style="width: 42px; height: 42px; border-radius: 10px; background: #faf5ff; border: 1px solid #e9d5ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg viewBox="0 0 40 40" width="28" height="28" aria-hidden="true">
                                    <!-- Tabung Laboratorium Keseimbangan pH Rusak -->
                                    <path d="M 16 10 L 24 10 L 24 22 L 28 30 C 29 32 27 34 25 34 L 15 34 C 13 34 11 32 12 30 L 16 22 Z" fill="#f3e8ff" stroke="#a855f7" stroke-width="1.5"/>
                                    <path d="M 14 28 Q 20 26 26 28 L 25 33 L 15 33 Z" fill="#c084fc"/>
                                    <circle cx="18" cy="24" r="1.2" fill="#a855f7"/>
                                    <circle cx="22" cy="21" r="1.5" fill="#9333ea"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="cp-impact-title">2. Mengganggu Keseimbangan pH</h3>
                                <p class="cp-impact-desc">
                                    Mengubah kondisi lingkungan mikro asam alami (pH &lt; 4.5) menjadi basa, sehingga bakteri pelindung <em>Lactobacillus</em> mati.
                                </p>
                            </div>
                        </div>

                        <div class="cp-impact-card">
                            <div style="width: 42px; height: 42px; border-radius: 10px; background: #ecfdf5; border: 1px solid #a7f3d0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg viewBox="0 0 40 40" width="28" height="28" aria-hidden="true">
                                    <!-- Bakteri Patogen & Kuman Jahat -->
                                    <ellipse cx="20" cy="20" rx="9" ry="6" fill="#6ee7b7" stroke="#059669" stroke-width="1.5"/>
                                    <!-- Silia / rambut kuman -->
                                    <line x1="20" y1="12" x2="20" y2="9" stroke="#059669" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="20" y1="28" x2="20" y2="31" stroke="#059669" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="10" y1="20" x2="7" y2="20" stroke="#059669" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="30" y1="20" x2="33" y2="20" stroke="#059669" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="13" y1="15" x2="11" y2="12" stroke="#059669" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="27" y1="25" x2="29" y2="28" stroke="#059669" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="cp-impact-title">3. Memicu Bakteri Patogen</h3>
                                <p class="cp-impact-desc">
                                    Kuman jahat seperti <em>Gardnerella vaginalis</em> dan jamur <em>Candida albicans</em> berkembang biak tanpa hambatan alami.
                                </p>
                            </div>
                        </div>

                        <div class="cp-impact-card">
                            <div style="width: 42px; height: 42px; border-radius: 10px; background: #fff7ed; border: 1px solid #fed7aa; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg viewBox="0 0 40 40" width="28" height="28" aria-hidden="true">
                                    <!-- Stetoskop / Konsultasi Medis -->
                                    <path d="M 13 10 L 13 18 C 13 23 17 26 21 26 C 25 26 29 23 29 18 L 29 10" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M 21 26 L 21 31 C 21 33 23 34 25 34 L 27 34" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="28" cy="34" r="3" fill="#fb923c" stroke="#ea580c" stroke-width="1.2"/>
                                    <circle cx="13" cy="10" r="2" fill="#c2410c"/>
                                    <circle cx="29" cy="10" r="2" fill="#c2410c"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="cp-impact-title">4. Memicu Keputihan Abnormal</h3>
                                <p class="cp-impact-desc">
                                    Menghasilkan cairan keputihan berbau amis/asam menusuk, bergumpal seperti keju basi, berwarna kehijauan, dan butuh terapi medis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 3: Kenyamanan & Sirkulasi Udara -->
            <section id="celana-dalam" class="cp-section">
                <div class="cp-sec-head">
                    <div>
                        <div class="cp-sec-kicker">
                            <span class="cp-num-badge">3</span>
                            <span class="cp-sec-eyebrow">KENYAMANAN &amp; SIRKULASI UDARA</span>
                        </div>
                        <h2 class="cp-sec-title">Pilih &amp; Rawat Pakaian Dalam yang Tepat</h2>
                    </div>
                </div>

                <div class="cp-grid-3">
                    <article class="cp-card-3">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-circle-ico" aria-hidden="true">✓</span>
                                <span class="cp-head-pill">Katun 100%</span>
                            </div>
                            <!-- Ilustrasi Celana Dalam Katun Bersirkulasi -->
                            <div class="cp-card-illus is-green" title="Celana dalam katun breathable">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <defs>
                                        <linearGradient id="cottonPanty" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#bbf7d0"/>
                                            <stop offset="100%" stop-color="#86efac"/>
                                        </linearGradient>
                                    </defs>
                                    <!-- Celana Dalam Katun -->
                                    <path d="M 18 16 Q 50 22 82 16 C 78 32 70 52 58 58 Q 50 55 42 58 C 30 52 22 32 18 16 Z" fill="url(#cottonPanty)" stroke="#16a34a" stroke-width="1.8"/>
                                    <!-- Garis-garis semilir udara sejuk -->
                                    <path d="M 50 26 Q 52 35 50 44" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                    <path d="M 40 28 Q 42 36 39 42" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                                    <path d="M 60 28 Q 62 36 61 42" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                                    <!-- Badge Katun Sehat -->
                                    <circle cx="78" cy="46" r="10" fill="#ffffff" stroke="#16a34a" stroke-width="1.5"/>
                                    <text x="78" y="50" font-size="9" font-weight="bold" fill="#166534" text-anchor="middle">100%</text>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Bahan Katun Alami</h3>
                            <p class="cp-step-desc">
                                Gunakan celana dalam berbahan dasar <strong>100% serat katun</strong>. Katun mampu menyerap keringat berlebih dan memiliki sirkulasi udara optimal sehingga area intim tidak lembap.
                            </p>
                        </div>
                        <span class="cp-chip is-neutral">◎ Sangat Direkomendasikan</span>
                    </article>

                    <article class="cp-card-3 is-warn">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-circle-ico" aria-hidden="true">✕</span>
                                <span class="cp-head-pill" style="color: #ea580c; border-color: #fed7aa;">Hindari Ketat</span>
                            </div>
                            <!-- Ilustrasi Celana Ketat / Nilon Panas -->
                            <div class="cp-card-illus is-warn" title="Hindari bahan nilon dan celana ketat">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Celana Jeans Ketat Menekan -->
                                    <path d="M 28 12 L 72 12 L 68 56 L 53 56 L 50 30 L 47 56 L 32 56 Z" fill="#93c5fd" stroke="#2563eb" stroke-width="1.8"/>
                                    <!-- Garis tekanan / uap panas merah -->
                                    <path d="M 50 18 L 50 26" stroke="#f97316" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M 40 38 Q 50 42 60 38" stroke="#ef4444" stroke-width="2" fill="none" stroke-linecap="round"/>
                                    <path d="M 42 46 Q 50 50 58 46" stroke="#ef4444" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                                    <!-- Ikon silang waspada -->
                                    <circle cx="78" cy="24" r="9" fill="#fee2e2" stroke="#ef4444" stroke-width="1.5"/>
                                    <line x1="74" y1="20" x2="82" y2="28" stroke="#ef4444" stroke-width="2" stroke-linecap="round"/>
                                    <line x1="82" y1="20" x2="74" y2="28" stroke="#ef4444" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Hindari Nilon &amp; Ketat</h3>
                            <p class="cp-step-desc">
                                Hindari bahan sintetis seperti <strong>nilon, polyester</strong> kedap udara, atau jeans ketat. Bahan ini memerangkap uap keringat, menaikkan suhu vulva, dan memicu jamur.
                            </p>
                        </div>
                        <span class="cp-chip is-danger">⚠ Pemicu Kelembapan Tinggi</span>
                    </article>

                    <article class="cp-card-3">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-circle-ico">2×</span>
                                <span class="cp-head-pill">Rutin Harian</span>
                            </div>
                            <!-- Ilustrasi Ganti Celana Dalam Rutin -->
                            <div class="cp-card-illus is-blue" title="Ganti celana dalam minimal 2x sehari">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Dua lapis celana dalam bersih (pagi & malam) -->
                                    <g opacity="0.65" transform="translate(10, -4)">
                                        <path d="M 22 22 Q 45 27 68 22 C 65 34 59 48 50 52 C 41 48 35 34 32 22 Z" fill="#bae6fd" stroke="#0284c7" stroke-width="1.2"/>
                                    </g>
                                    <g transform="translate(-2, 4)">
                                        <path d="M 24 22 Q 50 28 76 22 C 72 36 64 52 54 56 C 44 52 36 36 32 22 Z" fill="#e0f2fe" stroke="#0284c7" stroke-width="1.6"/>
                                        <path d="M 38 27 Q 50 31 62 27" stroke="#ffffff" stroke-width="1.5" fill="none"/>
                                    </g>
                                    <!-- Indikator Jam / Rotasi -->
                                    <circle cx="78" cy="42" r="11" fill="#ffffff" stroke="#0284c7" stroke-width="1.5"/>
                                    <text x="78" y="46" font-size="10" font-weight="bold" fill="#0369a1" text-anchor="middle">2×</text>
                                    <path d="M 68 34 A 12 12 0 0 1 88 34" fill="none" stroke="#38bdf8" stroke-width="1.8" stroke-dasharray="2 2"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Ganti Teratur (Min. 2×)</h3>
                            <p class="cp-step-desc">
                                Ganti celana dalam minimal <strong>2 kali sehari</strong> (pagi hari dan malam menjelang tidur), atau segera ganti bila terasa basah setelah olahraga atau banyak beraktivitas.
                            </p>
                        </div>
                        <span class="cp-chip is-neutral">🕒 Pagi Setelah Mandi &amp; Malam Tidur</span>
                    </article>
                </div>
            </section>

            <!-- Section 4: Manajemen Pembalut Tipis -->
            <section id="pantyliner" class="cp-section">
                <div class="cp-sec-head">
                    <div>
                        <div class="cp-sec-kicker">
                            <span class="cp-num-badge">4</span>
                            <span class="cp-sec-eyebrow">MANAJEMEN PEMBALUT TIPIS</span>
                        </div>
                        <h2 class="cp-sec-title">Hindari Penggunaan Pantyliner Berlebihan</h2>
                    </div>
                </div>

                <div class="cp-grid-2">
                    <div class="cp-panty-stack">
                        <article class="cp-panty-card">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                    <!-- Pantyliner berpalang merah (dilarang tiap hari) -->
                                    <path d="M 12 20 C 12 14 16 12 20 12 C 24 12 28 14 28 20 C 28 26 24 28 20 28 C 16 28 12 26 12 20 Z" fill="#ffe4e6" stroke="#f43f5e" stroke-width="1.5"/>
                                    <path d="M 16 20 C 16 16 18 15 20 15 C 22 15 24 16 24 20 C 24 24 22 25 20 25 C 18 25 16 24 16 20 Z" fill="#ffffff"/>
                                    <line x1="8" y1="8" x2="32" y2="32" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="cp-impact-title">Penggunaan Terus-Menerus Tiap Hari</h3>
                                <p class="cp-impact-desc">
                                    Lapisan plastik bawah pantyliner menghambat pori udara, menciptakan efek ‘rumah kaca’ yang memerangkap panas dan kelembapan, memicu jamur <em>Candida</em>.
                                </p>
                            </div>
                        </article>

                        <article class="cp-panty-card">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: #ecfdf5; border: 1px solid #a7f3d0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                    <!-- Jam Waktu Ganti 3-4 Jam -->
                                    <circle cx="20" cy="20" r="12" fill="#dcfce7" stroke="#10b981" stroke-width="1.8"/>
                                    <polyline points="20 13 20 20 25 23" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="20" cy="20" r="1.5" fill="#047857"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="cp-impact-title">Gunakan Hanya Saat Diperlukan</h3>
                                <p class="cp-impact-desc">
                                    Gunakan saat masa akhir menstruasi (bercak flek) atau saat masa subur (ovulasi) ketika cairan vagina sedang tinggi. <strong>Wajib ganti tiap 3–4 jam.</strong>
                                </p>
                            </div>
                        </article>
                    </div>

                    <aside class="cp-fact-card">
                        <div>
                            <h3 class="cp-fact-title">
                                <span aria-hidden="true">ⓘ</span> Fakta Medis Pantyliner
                            </h3>
                            <p class="cp-fact-text">
                                Banyak remaja putri merasa lebih ‘bersih’ jika memakai pantyliner setiap hari. Namun riset ginekologi membuktikan sebaliknya: kebiasaan ini meningkatkan risiko vaginitis hingga 3 kali lipat karena kelembapan statis pada membran mukosa.
                            </p>
                        </div>
                        <div class="cp-fact-tip">
                            <strong>☀️ Solusi Lebih Sehat:</strong> Bawa 1 celana dalam ganti di tas jika beraktivitas seharian!
                        </div>
                    </aside>
                </div>
            </section>

            <!-- Section 5: Higienitas Tangan & Sentuhan -->
            <section id="cuci-tangan" class="cp-section">
                <div class="cp-sec-head">
                    <div>
                        <div class="cp-sec-kicker">
                            <span class="cp-num-badge">5</span>
                            <span class="cp-sec-eyebrow">HIGIENITAS TANGAN &amp; SENTUHAN</span>
                        </div>
                        <h2 class="cp-sec-title">Cuci Tangan Sebelum &amp; Sesudah Menyentuh Area Genital</h2>
                        <p class="cp-sec-sub">
                            Mencegah kontaminasi silang kuman berbahaya dari gagang pintu, smartphone, atau uang masuk ke mukosa vagina yang sensitif.
                        </p>
                    </div>
                </div>

                <div class="cp-grid-3">
                    <article class="cp-card-3">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">1</span>
                                <span class="cp-head-pill" style="color: #ea580c; border-color: #fed7aa;">Peringatan</span>
                            </div>
                            <!-- Ilustrasi Stop / Kuman di Ponsel & Uang -->
                            <div class="cp-card-illus is-warn" title="Jangan langsung sentuh area intim setelah memegang benda kotor">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Layar Ponsel & Bakteri -->
                                    <rect x="22" y="14" width="22" height="38" rx="3" fill="#cbd5e1" stroke="#475569" stroke-width="1.5"/>
                                    <rect x="25" y="18" width="16" height="26" fill="#f8fafc"/>
                                    <circle cx="33" cy="48" r="1.5" fill="#475569"/>
                                    <!-- Tangan Stop / Larangan -->
                                    <circle cx="68" cy="33" r="18" fill="#fee2e2" stroke="#ef4444" stroke-width="1.8"/>
                                    <!-- Ikon telapak tangan stop -->
                                    <path d="M 64 24 L 64 34 M 67 22 L 67 34 M 70 23 L 70 34 M 61 27 L 61 35 C 61 40 73 40 73 35 L 73 31" fill="#fca5a5" stroke="#dc2626" stroke-width="1.2"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Jangan Sentuh Dulu!</h3>
                            <p class="cp-step-desc">
                                Jangan langsung menyentuh organ kewanitaan setelah memegang ponsel, uang, atau fasilitas umum sebelum tangan disucikan.
                            </p>
                        </div>
                    </article>

                    <article class="cp-card-3">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">2</span>
                                <span class="cp-head-pill">20 Detik</span>
                            </div>
                            <!-- Ilustrasi Cuci Tangan dengan Sabun -->
                            <div class="cp-card-illus is-blue" title="Cuci tangan dengan sabun dan air mengalir">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Busa sabun & telapak tangan -->
                                    <circle cx="45" cy="30" r="12" fill="#e0f2fe" stroke="#38bdf8" stroke-width="1.5"/>
                                    <circle cx="58" cy="34" r="10" fill="#bae6fd" stroke="#0284c7" stroke-width="1.5"/>
                                    <circle cx="48" cy="44" r="8" fill="#f0f9ff" stroke="#38bdf8" stroke-width="1.2"/>
                                    <!-- Gelembung busa berterbangan -->
                                    <circle cx="34" cy="20" r="3.5" fill="#bae6fd"/>
                                    <circle cx="64" cy="18" r="4.5" fill="#e0f2fe" stroke="#38bdf8" stroke-width="1"/>
                                    <circle cx="74" cy="26" r="3" fill="#bae6fd"/>
                                    <circle cx="30" cy="36" r="2.5" fill="#e0f2fe"/>
                                    <!-- Sparkle bersih -->
                                    <path d="M 24 16 L 26 19 L 29 20 L 26 21 L 24 24 L 22 21 L 19 20 L 22 19 Z" fill="#0284c7"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Cuci dengan Sabun</h3>
                            <p class="cp-step-desc">
                                Cuci kedua telapak, punggung tangan, dan sela-sela jari menggunakan sabun di bawah air mengalir minimal selama 20 detik.
                            </p>
                        </div>
                    </article>

                    <article class="cp-card-3">
                        <div>
                            <div class="cp-step-top">
                                <span class="cp-step-num">3</span>
                                <span class="cp-head-pill" style="color: #166534; border-color: #bbf7d0;">Aman Higienis</span>
                            </div>
                            <!-- Ilustrasi Tangan Higienis Aman -->
                            <div class="cp-card-illus is-green" title="Tangan higienis siap membersihkan organ intim">
                                <svg viewBox="0 0 100 65" width="90" height="55" aria-hidden="true">
                                    <!-- Perisai Perlindungan Higienis -->
                                    <path d="M 50 14 C 50 14 68 18 68 32 C 68 46 50 54 50 54 C 50 54 32 46 32 32 C 32 18 50 14 50 14 Z" fill="#dcfce7" stroke="#16a34a" stroke-width="2"/>
                                    <!-- Centang Hijau Bersih -->
                                    <path d="M 42 33 L 48 39 L 60 27" fill="none" stroke="#15803d" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <!-- Sparkles kebersihan -->
                                    <circle cx="76" cy="22" r="2.5" fill="#22c55e"/>
                                    <circle cx="24" cy="26" r="2" fill="#22c55e"/>
                                </svg>
                            </div>
                            <h3 class="cp-step-title">Aman Bersihkan Genital</h3>
                            <p class="cp-step-desc">
                                Tangan yang higienis aman untuk membasuh area genital. Setelah selesai, cuci tangan kembali untuk proteksi menyeluruh.
                            </p>
                        </div>
                    </article>
                </div>
            </section>

            <!-- Section 6: Sanitasi Perlengkapan Mandi -->
            <section id="handuk-pribadi" class="cp-section">
                <div class="cp-sec-head">
                    <div>
                        <div class="cp-sec-kicker">
                            <span class="cp-num-badge">6</span>
                            <span class="cp-sec-eyebrow">SANITASI PERLENGKAPAN MANDI</span>
                        </div>
                        <h2 class="cp-sec-title">Hindari Berbagi Handuk Pribadi</h2>
                    </div>
                </div>

                <div class="cp-grid-2">
                    <article class="cp-towel-card is-risk">
                        <div>
                            <div class="cp-towel-head">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                        <!-- Handuk Berbagi yang Lembap & Kuman -->
                                        <rect x="10" y="10" width="14" height="24" rx="2" fill="#fed7aa" stroke="#f97316" stroke-width="1.2"/>
                                        <rect x="18" y="14" width="14" height="22" rx="2" fill="#fecdd3" stroke="#f43f5e" stroke-width="1.2"/>
                                        <line x1="8" y1="8" x2="32" y2="32" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="cp-towel-kicker" style="color: #9e1c47;">KEBIASAAN BERISIKO</span>
                                    <h3 class="cp-step-title" style="margin: 0;">Berbagi Handuk Bersama</h3>
                                </div>
                            </div>
                            <p class="cp-step-desc">
                                Handuk yang lembap merupakan habitat ideal bagi perkembangbiakan mikroorganisme seperti <em>Trichomonas vaginalis</em>, jamur kurap, dan bakteri stafilokokus. Memakai handuk teman atau keluarga memperbesar transmisi spora jamur.
                            </p>
                        </div>
                        <span class="cp-chip is-danger">◎ Media Penularan Patogen</span>
                    </article>

                    <article class="cp-towel-card is-safe">
                        <div>
                            <div class="cp-towel-head">
                                <div style="width: 44px; height: 44px; border-radius: 10px; background: #ecfdf5; border: 1px solid #a7f3d0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true">
                                        <!-- Handuk Pribadi Kering Bersinar -->
                                        <rect x="12" y="12" width="18" height="22" rx="3" fill="#bbf7d0" stroke="#16a34a" stroke-width="1.5"/>
                                        <line x1="12" y1="28" x2="30" y2="28" stroke="#15803d" stroke-width="1"/>
                                        <!-- Matahari Jemur Kering -->
                                        <circle cx="30" cy="10" r="4.5" fill="#fbbf24"/>
                                        <path d="M 30 3 L 30 5 M 30 15 L 30 17 M 23 10 L 25 10 M 35 10 L 37 10" stroke="#f59e0b" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="cp-towel-kicker" style="color: #166534;">PRAKTIK SEHAT</span>
                                    <h3 class="cp-step-title" style="margin: 0;">Gunakan Handuk Pribadi</h3>
                                </div>
                            </div>
                            <p class="cp-step-desc">
                                Selalu gunakan handuk khusus milik sendiri. Jemur handuk di bawah terik sinar matahari setelah dipakai hingga benar-benar kering, dan cuci teratur minimal 1 minggu sekali dengan detergen bersih.
                            </p>
                        </div>
                        <span class="cp-chip">🛡️ Perlindungan Mandiri Terjaga</span>
                    </article>
                </div>
            </section>

            <!-- Interactive Checklist -->
            <section class="cp-checklist-box" aria-label="Evaluasi Harian Mandiri">
                <div class="cp-check-head">
                    <div>
                        <span class="cp-sec-eyebrow">EVALUASI HARIAN MANDIRI</span>
                        <h2 class="cp-sec-title" style="margin-top: 4px;">Cek Kebiasaan Hygiene Kamu</h2>
                        <p class="cp-sec-sub" style="margin-top: 4px;">
                            Centang kebiasaan yang sudah kamu terapkan secara konsisten hari ini:
                        </p>
                    </div>
                    <div class="cp-score-pill">
                        <span class="cp-score-num" id="cpScoreNum">0/6</span>
                        <div>
                            <div id="cpScoreTitle" style="font-size: 12px; font-weight: 700; color: #2b121b;">Mulai Evaluasi</div>
                            <div style="font-size: 11px; color: #7c5c67;">Skor Kebiasaan Bersih</div>
                        </div>
                    </div>
                </div>

                <div class="cp-check-grid" id="cpChecklist">
                    <label class="cp-check-item">
                        <input type="checkbox" class="cp-check-input">
                        <span>Membasuh dari depan ke belakang dengan air bersih</span>
                    </label>
                    <label class="cp-check-item">
                        <input type="checkbox" class="cp-check-input">
                        <span>Tidak memakai sabun berparfum / pembersih kimia</span>
                    </label>
                    <label class="cp-check-item">
                        <input type="checkbox" class="cp-check-input">
                        <span>Memakai celana dalam katun yang tidak ketat</span>
                    </label>
                    <label class="cp-check-item">
                        <input type="checkbox" class="cp-check-input">
                        <span>Mengganti celana dalam minimal 2 kali sehari</span>
                    </label>
                    <label class="cp-check-item">
                        <input type="checkbox" class="cp-check-input">
                        <span>Cuci tangan sebelum &amp; sesudah membasuh vagina</span>
                    </label>
                    <label class="cp-check-item">
                        <input type="checkbox" class="cp-check-input">
                        <span>Hanya menggunakan handuk pribadi yang kering</span>
                    </label>
                </div>
            </section>

            <!-- Bottom Banner -->
            <section class="cp-banner">
                <div>
                    <span class="cp-banner-pill">🛡️ THE CAMPUS OF BERLIAN</span>
                    <h2 class="cp-banner-title">VULVA HYGIENE</h2>
                    <p class="cp-banner-text">
                        Cara Menjaga Kebersihan Area Genital dengan Benar untuk Masa Depan Remaja Putri yang Lebih Percaya Diri &amp; Bebas Masalah Keputihan.
                    </p>
                    <p class="cp-banner-quote">
                        Halo Teman-teman! Tetap Sehat, Bersih &amp; Percaya Diri!
                    </p>
                </div>
                <div class="cp-banner-card">
                    <div style="font-size: 26px; margin-bottom: 8px;" aria-hidden="true">🛡️</div>
                    <div style="font-size: 14px; font-weight: 700; margin-bottom: 6px;">Pendidikan Kebidanan</div>
                    <div style="font-size: 12px; line-height: 1.55; color: rgba(255, 255, 255, 0.85);">
                        Disusun dengan penuh kasih oleh Nur Elis Safi'Una<br>
                        • STIKES Karya Husada Kediri
                    </div>
                </div>
            </section>

            <!-- Bottom Navigation -->
            <div class="cp-bottom-nav">
                <a class="button button-outline" href="{{ route('public.tanda-gejala') }}">
                    <span aria-hidden="true">←</span> Modul 02: Tanda &amp; Gejala
                </a>
                <span class="cp-progress-label">3 DARI 5 MODUL SELESAI</span>
                <a class="button" href="{{ route('public.video') }}">
                    Modul 04: Video Edukasi <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.cp-check-input');
            const scoreNum = document.getElementById('cpScoreNum');
            const scoreTitle = document.getElementById('cpScoreTitle');

            function updateScore() {
                const checked = document.querySelectorAll('.cp-check-input:checked').length;
                scoreNum.textContent = checked + '/6';

                inputs.forEach(function (input) {
                    input.closest('.cp-check-item').classList.toggle('is-checked', input.checked);
                });

                if (checked === 0) {
                    scoreTitle.textContent = 'Mulai Evaluasi';
                } else if (checked < 4) {
                    scoreTitle.textContent = 'Terus Tingkatkan!';
                } else if (checked < 6) {
                    scoreTitle.textContent = 'Sudah Baik!';
                } else {
                    scoreTitle.textContent = 'Sangat Baik! 🎉';
                }
            }

            inputs.forEach(function (input) {
                input.addEventListener('change', updateScore);
            });
        });
    </script>
</x-public-layout>
