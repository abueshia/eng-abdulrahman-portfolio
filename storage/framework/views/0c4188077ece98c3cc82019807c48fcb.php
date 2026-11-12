<?php $__env->startSection('content'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@500;600;700&family=Tajawal:wght@400;500;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --dt-porcelain: #FBFAF7;
            --dt-porcelain-2: #F4F1E9;
            --dt-ink: #211D16;
            --dt-teal: #3F3323;
            --dt-teal-deep: #1E1810;
            --dt-mint: #E9D9B0;
            --dt-mint-soft: #F6EFDC;
            --dt-coral: #B8863A;
            --dt-coral-deep: #8F6526;
            --dt-gold: #C9A455;
            --dt-line: #E8DFC9;
            --dt-font-head: 'El Messiri', serif;
            --dt-font-body: 'Tajawal', sans-serif;
        }

        .dt-home {
            font-family: var(--dt-font-body);
            color: var(--dt-ink);
            background: var(--dt-porcelain);
            overflow-x: hidden;
        }

        .dt-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 28px;
        }

        .dt-h2 {
            font-family: var(--dt-font-head);
            font-size: clamp(28px, 3.4vw, 42px);
            line-height: 1.25;
            margin: 10px 0 18px;
            font-weight: 700;
        }

        .dt-p {
            font-size: 15.5px;
            line-height: 1.9;
            color: #3E5A55;
            max-width: 520px;
        }

        .dt-eyebrow-free {
            display: inline-block;
            color: var(--dt-coral);
            font-weight: 700;
            font-size: 14px;
            position: relative;
            padding-right: 22px;
        }

        .dt-eyebrow-free::before {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 2px;
            background: var(--dt-coral);
        }

        .dt-cta {
            background: linear-gradient(120deg, var(--dt-coral) 0%, var(--dt-coral-deep) 100%);
            color: #fff;
            text-decoration: none;
            padding: 13px 26px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 14.5px;
            display: inline-block;
            border: 0;
            cursor: pointer;
            box-shadow: 0 12px 24px -12px rgba(15, 94, 76, .5);
            transition: .25s;
        }

        .dt-cta:hover {
            filter: brightness(1.06);
            transform: translateY(-2px);
        }

        .dt-cta--lg {
            padding: 16px 34px;
            font-size: 15.5px;
        }

        .dt-cta--block {
            width: 100%;
            text-align: center;
        }

        .dt-btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--dt-teal-deep);
            text-decoration: none;
            font-weight: 700;
            font-size: 14.5px;
            border-bottom: 2px solid var(--dt-teal-deep);
            padding-bottom: 3px;
        }

        .dt-btn-ghost--light {
            color: #fff;
            border-color: #fff;
        }

        .dt-check-list {
            list-style: none;
            margin: 18px 0 26px;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .dt-check-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14.5px;
            color: #33504A;
        }

        .dt-check-list i {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--dt-mint-soft);
            color: var(--dt-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            flex-shrink: 0;
        }

        .dt-check-list--dark li {
            color: #DDEBE6;
        }

        .dt-check-list--dark i {
            background: rgba(255, 255, 255, .12);
            color: var(--dt-mint);
        }

        /* ---------- HERO ---------- */
        .dt-hero {
            position: relative;
            padding: 26px 0 0;
            overflow: hidden;
        }

        .dt-hero__blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(10px);
            opacity: .5;
            z-index: 0;
        }

        .dt-hero__blob--1 {
            width: 420px;
            height: 420px;
            background: var(--dt-mint-soft);
            top: -140px;
            left: -120px;
        }

        .dt-hero__blob--2 {
            width: 260px;
            height: 260px;
            background: #F6EFDC;
            bottom: -60px;
            right: -60px;
        }

        .dt-hero__inner {
            position: relative;
            z-index: 1;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 28px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            align-items: center;
        }

        .dt-hero__title {
            font-family: var(--dt-font-head);
            font-size: clamp(30px, 4.4vw, 52px);
            line-height: 1.16;
            font-weight: 700;
            margin: 12px 0 14px;
        }

        .dt-hero__title-accent {
            color: var(--dt-coral);
        }

        .dt-hero__desc {
            font-size: 15.5px;
            line-height: 1.8;
            color: #3E5A55;
            max-width: 460px;
            margin-bottom: 20px;
        }

        .dt-hero__actions {
            display: flex;
            align-items: center;
            gap: 22px;
            flex-wrap: wrap;
            margin-bottom: 26px;
        }

        .dt-hero__stats {
            display: flex;
            gap: 30px;
        }

        .dt-stat b {
            display: block;
            font-family: var(--dt-font-head);
            font-size: 26px;
            color: var(--dt-teal-deep);
        }

        .dt-stat span {
            font-size: 12.5px;
            color: #5E7B74;
        }

        .dt-hero__visual {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
        }

        .dt-portrait {
            position: relative;
            width: 100%;
            max-width: 480px;
            aspect-ratio: 1/1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dt-portrait__ring {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            animation: dtRingSpin 50s linear infinite;
            transform-origin: center;
        }

        @keyframes dtRingSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes dtFadeIn {
            to {
                opacity: 1;
            }
        }

        .dt-portrait__frame {
            position: relative;
            width: 76%;
            height: 76%;
            border-radius: 50%;
            overflow: hidden;
            border: 7px solid #fff;
            box-shadow: 0 30px 60px -25px rgba(16, 36, 43, .4), 0 0 0 2px var(--dt-mint);
            background: linear-gradient(150deg, var(--dt-mint) 0%, var(--dt-teal) 100%);
            opacity: 0;
            animation: dtFadeIn .9s ease forwards .2s;
        }

        .dt-portrait__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        .dt-portrait__orbit-icon {
            position: absolute;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dt-teal-deep);
            font-size: 16px;
            box-shadow: 0 14px 26px -14px rgba(16, 36, 43, .35);
            animation: dtFloat 4s ease-in-out infinite;
        }

        .dt-portrait__orbit-icon--1 {
            top: 1%;
            right: 16%;
            animation-delay: .2s;
        }

        .dt-portrait__orbit-icon--2 {
            top: 34%;
            right: -3%;
            animation-delay: 1.1s;
            color: var(--dt-gold);
        }

        .dt-portrait__orbit-icon--3 {
            bottom: 16%;
            left: -3%;
            animation-delay: 2s;
        }

        .dt-portrait__badge {
            position: absolute;
            bottom: 1%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border-radius: 100px;
            padding: 7px 20px 7px 8px;
            box-shadow: 0 18px 34px -18px rgba(16, 36, 43, .4);
            white-space: nowrap;
        }

        .dt-portrait__badge-mark {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(155deg, var(--dt-mint) 0%, var(--dt-teal) 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dt-portrait__badge-mark svg {
            width: 18px;
            height: 18px;
        }

        .dt-portrait__badge b {
            display: block;
            font-size: 13px;
            font-family: var(--dt-font-head);
            color: var(--dt-ink);
        }

        .dt-portrait__badge span {
            font-size: 10.5px;
            color: #7C9691;
        }

        @media (max-width: 560px) {
            .dt-portrait {
                max-width: 340px;
            }

            .dt-portrait__orbit-icon {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .dt-portrait__badge b {
                font-size: 12px;
            }
        }

        .dt-sparkle {
            position: absolute;
            color: var(--dt-gold);
            font-size: 18px;
            animation: dtFloat 3.4s ease-in-out infinite;
        }

        .dt-sparkle--1 {
            top: 12%;
            left: 8%;
            animation-delay: .2s;
        }

        .dt-sparkle--2 {
            bottom: 22%;
            right: 6%;
            animation-delay: 1s;
            font-size: 14px;
        }

        .dt-sparkle--3 {
            top: 52%;
            left: 2%;
            animation-delay: 1.8s;
            font-size: 12px;
        }

        @keyframes dtFloat {

            0%,
            100% {
                transform: translateY(0) scale(1);
                opacity: .9;
            }

            50% {
                transform: translateY(-14px) scale(1.15);
                opacity: 1;
            }
        }

        .dt-float-card {
            position: absolute;
            background: #fff;
            border-radius: 16px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 18px 40px -20px rgba(16, 36, 43, .35);
            animation: dtBob 5s ease-in-out infinite;
        }

        .dt-float-card i {
            color: var(--dt-teal);
            font-size: 18px;
        }

        .dt-float-card b {
            display: block;
            font-size: 12.5px;
        }

        .dt-float-card span {
            font-size: 11px;
            color: #7C9691;
        }

        .dt-float-card--1 {
            top: 6%;
            right: -4%;
            animation-delay: .3s;
        }

        .dt-float-card--2 {
            bottom: 8%;
            left: -6%;
            animation-delay: 1.6s;
        }

        @keyframes dtBob {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .dt-hero__marquee {
            margin-top: 30px;
            background: var(--dt-teal-deep);
            overflow: hidden;
            padding: 14px 0;
        }

        .dt-hero__marquee-track {
            display: flex;
            gap: 40px;
            width: max-content;
            animation: dtMarquee 22s linear infinite;
        }

        .dt-hero__marquee-track span {
            color: #fff;
            font-family: var(--dt-font-head);
            font-size: 15px;
            opacity: .85;
            white-space: nowrap;
        }

        @keyframes dtMarquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 900px) {
            .dt-hero__inner {
                grid-template-columns: 1fr;
            }

            .dt-float-card {
                display: none;
            }
        }

        @media (max-width: 560px) {
            .dt-hero {
                padding-top: 16px;
            }

            .dt-hero__visual {
                min-height: 300px;
                margin-top: 6px;
            }

            .dt-hero__marquee {
                margin-top: 18px;
            }

            .dt-hero__stats {
                gap: 20px;
            }
        }

        /* ---------- PREMIUM HOME ABOUT ---------- */
        .dt-home-about-premium {
            position: relative;
            padding: 60px 0;
            background: linear-gradient(135deg, var(--dt-porcelain) 0%, var(--dt-porcelain-2) 100%);
            color: var(--dt-ink);
            overflow: hidden;
            border-radius: 40px;
            margin: 0 20px 40px;
            box-shadow: 0 40px 80px -20px rgba(16, 36, 43, 0.1);
        }

        .dt-home-about-premium::before {
            content: 'ENG. ABDELRAHMAN';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 11vw;
            font-weight: 900;
            color: rgba(16, 36, 43, 0.02);
            white-space: nowrap;
            font-family: Arial, sans-serif;
            pointer-events: none;
            z-index: 1;
        }

        .dt-home-about-premium__grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 2;
            padding: 0 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dt-home-about-premium__visual {
            position: relative;
            z-index: 2;
        }

        .dt-home-about-premium__frame {
            position: relative;
            width: 100%;
            aspect-ratio: 16/11;
            border-radius: 40px 120px 40px 120px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            border: 2px solid #fff;
        }

        .dt-home-about-premium__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .dt-home-about-premium__frame:hover .dt-home-about-premium__img {
            transform: scale(1.08);
        }

        .dt-home-about-premium__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(16, 36, 43, 0.3), transparent 70%);
            z-index: 1;
        }

        .dt-home-about-premium__play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90px;
            height: 90px;
            background: var(--dt-coral);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 0 0 0 rgba(184, 134, 58, 0.6);
            animation: pulse-coral 2s infinite;
            z-index: 3;
            transition: 0.3s ease;
            text-decoration: none;
        }

        .dt-home-about-premium__play:hover {
            background: var(--dt-teal-deep);
            color: #fff;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .dt-home-about-premium__copy {
            position: relative;
            z-index: 2;
        }

        .dt-home-about-premium__subtitle {
            color: var(--dt-coral-deep);
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 16px;
            display: inline-block;
            background: rgba(184, 134, 58, 0.1);
            padding: 6px 16px;
            border-radius: 100px;
        }

        .dt-home-about-premium__title {
            font-family: var(--dt-font-head);
            font-size: clamp(34px, 4vw, 46px);
            line-height: 1.25;
            margin-bottom: 26px;
            color: var(--dt-teal-deep);
            font-weight: 700;
        }

        .dt-home-about-premium__text {
            font-size: 16px;
            line-height: 2.1;
            color: #5E7B74;
            margin-bottom: 30px;
        }

        .dt-home-about-premium__actions {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
        }

        .dt-home-about-premium__btn {
            background: var(--dt-teal-deep);
            color: #fff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--dt-teal-deep);
            transition: .25s;
        }

        .dt-home-about-premium__btn:hover {
            background: transparent;
            color: var(--dt-teal-deep);
            transform: translateY(-2px);
        }

        @media (max-width: 900px) {
            .dt-home-about-premium {
                margin: 40px 15px;
                padding: 60px 0;
                border-radius: 30px;
            }

            .dt-home-about-premium__grid {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 0 20px;
            }
        }

        /* ---------- INTENSIVE PROGRAM ---------- */
        .dt-program {
            padding: 80px 0 20px;
        }

        .dt-program__steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            flex-wrap: wrap;
            max-width: 820px;
            margin: 0 auto;
        }

        .dt-program__step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 14px;
            width: 180px;
        }

        .dt-program__icon {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: var(--dt-mint-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: var(--dt-teal-deep);
            border: 1px solid var(--dt-line);
        }

        .dt-program__step p {
            font-size: 14px;
            color: #5E7B74;
            margin: 0;
            line-height: 1.7;
        }

        .dt-program__step b {
            color: var(--dt-ink);
            font-weight: 800;
        }

        .dt-program__dash {
            width: 70px;
            height: 1px;
            background: var(--dt-line);
            margin: 0 -6px;
            margin-top: -52px;
            flex-shrink: 0;
        }

        @media (max-width: 760px) {
            .dt-program__dash {
                display: none;
            }
        }

        /* ---------- ABOUT DOCTOR ---------- */
        .dt-about-dr {
            padding: 80px 0;
            background: var(--dt-porcelain-2);
        }

        .dt-about-dr__grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: center;
        }

        .dt-about-dr__visual {
            position: relative;
        }

        .dt-video-card {
            display: block;
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 4/5;
            box-shadow: 0 30px 60px -20px rgba(16, 36, 43, .4);
            text-decoration: none;
            transition: transform .4s ease, box-shadow .4s ease;
        }

        .dt-video-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 40px 70px -15px rgba(16, 36, 43, .5);
        }

        .dt-video-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s ease;
        }

        .dt-video-card:hover .dt-video-card__img {
            transform: scale(1.05);
        }

        .dt-video-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30, 24, 16, 0.8), transparent 50%);
            z-index: 1;
        }

        .dt-video-card__play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--dt-coral);
            z-index: 2;
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            animation: pulse-white 2s infinite;
        }

        @keyframes pulse-white {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        @media (max-width: 900px) {
            .dt-about-dr__grid {
                grid-template-columns: 1fr;
            }

            .dt-video-card {
                aspect-ratio: 16/9;
            }
        }

        /* ---------- WHY US ---------- */
        .dt-why {
            padding: 100px 0;
        }

        .dt-why__grid {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            gap: 56px;
            align-items: center;
        }

        .dt-why__visual {
            position: relative;
            height: 420px;
        }

        .dt-why__img {
            position: absolute;
            border-radius: 24px;
            background: linear-gradient(150deg, var(--dt-mint) 0%, var(--dt-teal) 100%);
        }

        .dt-why__img--main {
            inset: 0 10% 0 0;
        }

        .dt-why__img--small {
            width: 46%;
            height: 46%;
            right: auto;
            left: 0;
            bottom: 0;
            border: 6px solid var(--dt-porcelain);
            background: linear-gradient(150deg, #F6EFDC, var(--dt-coral));
        }

        .dt-why__badge {
            position: absolute;
            top: -6%;
            left: -4%;
            background: #fff;
            border-radius: 16px;
            padding: 2px 18px;
            box-shadow: 0 18px 40px -20px rgba(16, 36, 43, .35);
            text-align: center;
        }

        .dt-why__badge b {
            font-family: var(--dt-font-head);
            font-size: 22px;
        }

        .dt-stars {
            color: var(--dt-gold);
            font-size: 12px;
            margin: 2px 0;
        }

        .dt-why__badge span {
            font-size: 10.5px;
            color: #7C9691;
        }

        @media (max-width: 900px) {
            .dt-why__grid {
                grid-template-columns: 1fr;
            }

            .dt-why__visual {
                height: 450px;
                margin-bottom: 20px;
            }

            .dt-why__badge {
                top: auto;
                bottom: -15px;
                left: 0;
            }
        }

        /* ---------- SPECIALTIES ---------- */
        .dt-specialties {
            padding: 30px 0 40px;
        }

        .dt-section-head {
            text-align: center;
            max-width: 640px;
            margin: 0 auto 50px;
        }

        .dt-section-head--light .dt-h2,
        .dt-section-head--light .dt-p {
            color: #fff;
        }

        .dt-section-head--light .dt-p {
            margin: 0 auto;
        }

        .dt-specialties__grid {
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            gap: 56px;
            align-items: center;
        }

        .dt-specialties__visual {
            position: relative;
            width: 100%;
        }

        .dt-specialties__tooth {
            position: absolute;
            top: 0;
            right: 6%;
            left: auto;
            width: 140px;
            opacity: .9;
            filter: drop-shadow(0 20px 30px rgba(14, 79, 79, .15));
            z-index: 1;
        }

        .dt-specialties__person {
            position: relative;
            width: 90%;
            aspect-ratio: 2/3;
            max-width: 420px;
            margin-top: 15%;
            margin-right: auto;
            margin-left: 0;
            border-radius: 24px;
            z-index: 2;
        }

        .dt-specialties__chips {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 26px 0 30px;
        }

        .dt-chip {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            border: 1px solid var(--dt-line);
            border-radius: 14px;
            padding: 12px 14px;
            text-decoration: none;
            color: var(--dt-ink);
            transition: .25s;
        }

        .dt-chip:hover {
            border-color: var(--dt-coral);
            transform: translateY(-2px);
            box-shadow: 0 14px 26px -18px rgba(16, 36, 43, .25);
        }

        .dt-chip__icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--dt-mint-soft);
            color: var(--dt-teal-deep);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .dt-chip b {
            display: block;
            font-size: 13.5px;
        }

        .dt-chip em {
            font-style: normal;
            font-size: 11px;
            color: var(--dt-coral);
        }

        @media (max-width: 900px) {
            .dt-specialties__grid {
                grid-template-columns: 1fr;
            }

            .dt-specialties__visual {
                margin-bottom: 16px;
            }
        }

        @media (max-width: 560px) {
            .dt-specialties__chips {
                grid-template-columns: 1fr;
            }
        }

        /* ---------- BEFORE / AFTER ---------- */
        .dt-ba {
            background: var(--dt-teal-deep);
            padding: 50px 0;
        }

        .dt-ba__slider {
            position: relative;
            max-width: 760px;
            margin: 0 auto;
            height: 400px;
            border-radius: 24px;
            overflow: hidden;
            background: linear-gradient(150deg, #dfe9e6, #b9cec8);
            cursor: ew-resize;
            user-select: none;
        }

        .dt-ba__img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .dt-ba__img--after {
            background: linear-gradient(150deg, #f3efe6, #c9e3d4);
            z-index: 1;
        }

        .dt-ba__img--before {
            background: linear-gradient(150deg, #cbb79a, #9c8264);
            z-index: 2;
            clip-path: inset(0 0 0 50%);
        }

        .dt-ba__tag {
            position: absolute;
            top: 16px;
            background: rgba(16, 36, 43, .6);
            color: #fff;
            font-size: 12px;
            padding: 5px 12px;
            border-radius: 20px;
            z-index: 10;
        }

        .dt-ba__tag--start {
            inset-inline-start: 16px;
        }

        .dt-ba__tag--end {
            inset-inline-end: 16px;
        }

        .dt-ba__handle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 44px;
            height: 44px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dt-teal-deep);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .25);
            pointer-events: none;
            z-index: 15;
        }

        .dt-ba__handle::before {
            content: "";
            position: absolute;
            top: -400px;
            bottom: -400px;
            left: 50%;
            width: 3px;
            background: #fff;
            transform: translateX(-50%);
            z-index: -1;
        }

        .dt-center-btn {
            text-align: center;
            margin-top: 0px;
        }

        /* ---------- REVIEWS (orbit) ---------- */
        .dt-reviews {
            padding: 100px 0 90px;
        }

        .dt-orbit {
            position: relative;
            max-width: 760px;
            margin: 0 auto;
            height: 300px;
        }

        .dt-orbit__arc {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .dt-orbit__head {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            margin: 0;
        }

        .dt-orbit__bubble {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            animation: dtBob 6s ease-in-out infinite;
        }

        .dt-orbit__avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid var(--dt-mint);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dt-teal-deep);
            font-size: 18px;
            box-shadow: 0 14px 26px -14px rgba(16, 36, 43, .3);
        }

        .dt-orbit__tag {
            background: var(--dt-mint-soft);
            color: var(--dt-teal-deep);
            font-size: 10.5px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .dt-orbit__bubble--1 {
            top: 52%;
            right: 0;
            animation-delay: .1s;
        }

        .dt-orbit__bubble--2 {
            top: 8%;
            right: 20%;
            animation-delay: .8s;
        }

        .dt-orbit__bubble--3 {
            top: 0;
            right: 48%;
            animation-delay: 1.5s;
        }

        .dt-orbit__bubble--4 {
            top: 10%;
            left: 16%;
            animation-delay: 2.2s;
        }

        .dt-orbit__bubble--5 {
            top: 50%;
            left: 0;
            animation-delay: 2.9s;
        }

        @media (max-width: 760px) {
            .dt-orbit {
                position: relative;
                height: auto;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: flex-start;
                gap: 10px 8px;
                padding-bottom: 4px;
            }

            .dt-orbit__arc {
                display: none;
            }

            .dt-orbit__head {
                position: static;
                transform: none;
                order: -1;
                flex: 0 0 100%;
                width: 100%;
                margin: 0 0 8px;
            }

            .dt-orbit__bubble {
                position: static;
                animation: none;
            }

            .dt-orbit__avatar {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }

            .dt-orbit__tag {
                font-size: 10px;
                padding: 3px 9px;
            }
        }

        .dt-rating-badges {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin: 30px 0 40px;
            flex-wrap: wrap;
        }

        .dt-rating-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            border: 1px solid var(--dt-line);
            border-radius: 14px;
            padding: 12px 20px;
        }

        .dt-rating-badge i {
            font-size: 22px;
            color: var(--dt-teal);
        }

        .dt-rating-badge b {
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dt-rating-badge span {
            display: block;
            font-size: 11.5px;
            color: #7C9691;
        }

        .dt-rating-badge .dt-stars {
            color: var(--dt-gold);
            font-size: 11px;
        }

        .dt-featured-review {
            max-width: 640px;
            margin: 0 auto;
            background: var(--dt-mint-soft);
            border-radius: 20px;
            padding: 30px;
        }

        .dt-featured-review__head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .dt-featured-review__head b {
            display: block;
            font-size: 14.5px;
        }

        .dt-featured-review p {
            font-size: 14.5px;
            line-height: 1.9;
            color: #294843;
            margin: 0;
        }

        .dt-review-card__stars {
            color: var(--dt-gold);
            font-size: 12px;
            margin-top: 2px;
        }

        .dt-review-card__avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--dt-teal);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .dt-add-review {
            max-width: 580px;
            margin: 56px auto 0;
            background: #fff;
            border: 1px solid var(--dt-line);
            border-radius: 24px;
            padding: 38px;
            box-shadow: 0 30px 60px -40px rgba(16, 36, 43, .25);
        }

        .dt-add-review__head {
            text-align: center;
            margin-bottom: 24px;
        }

        .dt-add-review__head h3 {
            font-family: var(--dt-font-head);
            font-size: 22px;
            margin: 8px 0 6px;
            color: var(--dt-ink);
        }

        .dt-add-review__head p {
            font-size: 13.5px;
            color: #7C9691;
            margin: 0;
        }

        .dt-add-review__form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .dt-add-review__rate {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 8px;
            font-size: 26px;
            margin-bottom: 6px;
        }

        .dt-add-review__rate input {
            display: none;
        }

        .dt-add-review__rate label {
            color: #E1E6DF;
            cursor: pointer;
            transition: .15s;
        }

        .dt-add-review__rate input:checked~label,
        .dt-add-review__rate label:hover,
        .dt-add-review__rate label:hover~label {
            color: var(--dt-gold);
        }

        .dt-add-review__form input[type="text"],
        .dt-add-review__form textarea {
            width: 100%;
            border: 1px solid var(--dt-line);
            border-radius: 12px;
            padding: 13px 16px;
            font-family: var(--dt-font-body);
            font-size: 14.5px;
            color: var(--dt-ink);
            background: var(--dt-porcelain);
            outline: none;
            transition: border-color .2s;
        }

        .dt-add-review__form input[type="text"]:focus,
        .dt-add-review__form textarea:focus {
            border-color: var(--dt-teal);
        }

        .dt-add-review__form textarea {
            min-height: 100px;
            resize: vertical;
        }

        .dt-add-review__form .dt-cta {
            margin-top: 4px;
        }

        @media (max-width: 560px) {
            .dt-add-review {
                padding: 24px 20px;
                margin-top: 36px;
            }
        }

        /* ---------- GALLERY ---------- */
        .dt-gallery {
            padding: 0 0 100px;
        }

        .dt-gallery__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 140px;
            gap: 14px;
        }

        .dt-gallery__item {
            border-radius: 18px;
            background: linear-gradient(150deg, var(--dt-mint) 0%, var(--dt-teal) 100%);
            grid-row: span 2;
        }

        .dt-gallery__item--tall {
            grid-row: span 3;
        }

        .dt-gallery__item:nth-child(2n) {
            background: linear-gradient(150deg, #F6EFDC, var(--dt-coral));
        }

        @media (max-width: 900px) {
            .dt-gallery__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ---------- BOOKING ---------- */
        .dt-booking {
            background: var(--dt-teal-deep);
            padding: 100px 0;
            color: #fff;
        }

        .dt-booking__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
            align-items: center;
        }

        .dt-booking .dt-p {
            color: #C7DCD4;
        }

        .dt-booking__form {
            background: #fff;
            border-radius: 22px;
            padding: 34px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .dt-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .dt-booking__form input,
        .dt-booking__form select,
        .dt-booking__form textarea {
            box-sizing: border-box;
            width: 100%;
            border: 1px solid var(--dt-line);
            border-radius: 12px;
            padding: 13px 16px;
            font-family: var(--dt-font-body);
            font-size: 14.5px;
            color: var(--dt-ink);
            background: var(--dt-porcelain);
            outline: none;
            transition: border-color .2s;
        }

        .dt-booking__form input:focus,
        .dt-booking__form select:focus,
        .dt-booking__form textarea:focus {
            border-color: var(--dt-teal);
        }

        .dt-booking__form textarea {
            min-height: 90px;
            resize: vertical;
        }

        @media (max-width: 900px) {
            .dt-booking__grid {
                grid-template-columns: 1fr;
            }

            .dt-form-row {
                grid-template-columns: 1fr;
            }
        }

        /* ---------- STICKY QUICK BAR ---------- */
        .dt-quickbar {
            position: sticky;
            bottom: 22px;
            z-index: 200;
            margin: 40px auto 0;
            max-width: 520px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 4px;
            background: linear-gradient(120deg, var(--dt-teal) 0%, var(--dt-teal-deep) 100%);
            border-radius: 100px;
            padding: 8px;
            box-shadow: 0 20px 40px -18px rgba(10, 56, 56, .5);
        }

        .dt-quickbar__item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #DDEBE6;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            padding: 8px 4px;
            border-radius: 100px;
            text-align: center;
        }

        .dt-quickbar__icon {
            font-size: 15px;
        }

        .dt-quickbar__item--main {
            background: rgba(255, 255, 255, .14);
            color: #fff;
        }

        @media (max-width: 560px) {
            .dt-quickbar {
                bottom: 14px;
                margin-left: 16px;
                margin-right: 16px;
            }
        }

        /* ---------- MOBILE SPACING TIGHTENING (page-wide) ---------- */
        @media (max-width: 640px) {
            .dt-h2 {
                margin: 6px 0 12px;
            }

            .dt-section-head {
                margin: 0 auto 28px;
            }

            .dt-p {
                font-size: 14px;
            }

            .dt-program {
                padding: 36px 0 6px;
            }

            .dt-program__steps {
                gap: 18px;
            }

            .dt-why {
                padding: 46px 0;
            }

            .dt-why__visual {
                height: 240px;
                margin-bottom: 16px;
            }

            .dt-why__grid {
                gap: 0;
            }

            .dt-specialties {
                padding: 10px 0 46px;
            }

            .dt-specialties__visual {
                margin-bottom: 16px;
            }

            .dt-ba {
                padding: 46px 0;
            }

            .dt-ba__slider {
                height: 280px;
            }

            .dt-reviews {
                padding: 46px 0 36px;
            }

            .dt-gallery {
                padding: 0 0 46px;
            }

            .dt-gallery__grid {
                grid-auto-rows: 110px;
                gap: 10px;
            }

            .dt-booking {
                padding: 46px 0;
            }

            .dt-booking__form {
                padding: 24px;
            }

            .dt-container {
                padding: 0 18px;
            }
        }

        /* Swiper Customizations */
        .ba-swiper {
            padding-bottom: 40px;
        }

        .ba-swiper .swiper-button-next,
        .ba-swiper .swiper-button-prev {
            color: var(--dt-mint);
            top: 50%;
            transform: translateY(-50%);
            margin-top: -20px;
        }

        .ba-swiper .swiper-button-next::after,
        .ba-swiper .swiper-button-prev::after {
            font-size: 24px;
            font-weight: bold;
        }

        .gallery-swiper {
            padding: 40px 0;
        }

        .gallery-swiper .swiper-slide {
            width: 300px;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            background: var(--dt-mint-soft);
        }

        .gallery-swiper .swiper-slide-active {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(16, 36, 43, 0.2);
            border: 2px solid var(--dt-mint);
        }

        .gallery-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-swiper-pagination {
            text-align: center;
            margin-top: 20px;
        }

        .gallery-swiper-pagination .swiper-pagination-bullet-active {
            background: var(--dt-teal);
        }

        /* ---------- FAQ ---------- */
        .dt-faq {
            padding: 80px 0;
            background: var(--dt-porcelain-2);
        }

        .dt-faq__grid {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .dt-faq__item {
            background: #fff;
            border: 1px solid var(--dt-line);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .dt-faq__toggle {
            display: none;
        }

        .dt-faq__title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 26px;
            font-weight: 700;
            font-size: 16px;
            color: var(--dt-ink);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .dt-faq__title i {
            color: var(--dt-coral);
            transition: transform 0.3s ease;
        }

        .dt-faq__content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
            background: #fff;
        }

        .dt-faq__content p {
            margin: 0;
            padding: 0 26px;
            font-size: 15px;
            color: #5E7B74;
            line-height: 1.8;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .dt-faq__toggle:checked+.dt-faq__title {
            color: var(--dt-teal);
        }

        .dt-faq__toggle:checked+.dt-faq__title i {
            transform: rotate(180deg);
        }

        .dt-faq__toggle:checked~.dt-faq__content {
            max-height: 200px;
            padding-bottom: 22px;
        }

        .dt-faq__toggle:checked~.dt-faq__content p {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <main class="dt-home">

        
        <section class="dt-hero">
            <div class="dt-hero__blob dt-hero__blob--1"></div>
            <div class="dt-hero__blob dt-hero__blob--2"></div>

            <div class="dt-hero__inner">
                <div class="dt-hero__copy">
                    <span class="dt-eyebrow-free">Full-Stack Software Engineer (Laravel & React.js)</span>
                    <h1 class="dt-hero__title">
                        نحوّل أفكارك إلى<br>
                        أنظمة ومواقع برمجية<br>
                        <span class="dt-hero__title-accent">بأعلى معايير الجودة</span>
                    </h1>
                    <p class="dt-hero__desc">
                        مهندس عبدالرحمن أبو عيشة — خبرة أكثر من 4 سنوات في هندسة وتطوير الباك إند باستخدام PHP & Laravel، وبناء واجهات المستخدم التفاعلية الحديثة باستخدام JavaScript و React.js.
                    </p>
                    <div class="dt-hero__actions">
                        <a href="#booking" class="dt-cta dt-cta--lg">اطلب مشروعك الآن</a>
                        <a href="#services" class="dt-btn-ghost">استكشف خدماتي التقنية</a>
                    </div>

                    <div class="dt-hero__stats">
                        <div class="dt-stat"><b data-count="4">0</b><span>+ سنوات خبرة</span></div>
                        <div class="dt-stat"><b data-count="45">0</b><span>+ مشروع برمجي ناجح</span></div>
                        <div class="dt-stat"><b data-count="100">0</b><span>% التزام بالجودة</span></div>
                    </div>
                </div>

                <div class="dt-hero__visual">
                    <div class="dt-portrait">
                        <svg class="dt-portrait__ring" viewBox="0 0 440 440" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="220" cy="220" r="206" fill="none" stroke="url(#dtRingGrad)"
                                stroke-width="2.5" stroke-dasharray="3 11" stroke-linecap="round" />
                            <defs>
                                <linearGradient id="dtRingGrad" x1="0" y1="0" x2="440" y2="440"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#E9D9B0" />
                                    <stop offset="1" stop-color="#3F3323" />
                                </linearGradient>
                            </defs>
                        </svg>

                        <div class="dt-portrait__frame">
                            <img src="<?php echo e(asset('front/assets/img/drrr.jpg')); ?>" alt="المهندس عبدالرحمن أبو عيشة"
                                class="dt-portrait__img">
                        </div>

                        <span class="dt-portrait__orbit-icon dt-portrait__orbit-icon--1"><i
                                class="fa-brands fa-laravel"></i></span>
                        <span class="dt-portrait__orbit-icon dt-portrait__orbit-icon--2"><i
                                class="fa-brands fa-react"></i></span>
                        <span class="dt-portrait__orbit-icon dt-portrait__orbit-icon--3"><i
                                class="fa-solid fa-code"></i></span>

                        <div class="dt-portrait__badge">
                            <span class="dt-portrait__badge-mark">
                                <i class="fa-solid fa-terminal"></i>
                            </span>
                            <div>
                                <b>م. عبدالرحمن أبو عيشة</b>
                                <span>Full-Stack Software Engineer</span>
                            </div>
                        </div>
                    </div>

                    <span class="dt-sparkle dt-sparkle--1">✦</span>
                    <span class="dt-sparkle dt-sparkle--2">✦</span>
                    <span class="dt-sparkle dt-sparkle--3">✦</span>

                    <div class="dt-float-card dt-float-card--1">
                        <i class="fa-brands fa-php"></i>
                        <div><b>PHP & Laravel</b><span>Backend Architecture</span></div>
                    </div>
                    <div class="dt-float-card dt-float-card--2">
                        <i class="fa-brands fa-react"></i>
                        <div><b>React.js & JS</b><span>Modern Frontend UI</span></div>
                    </div>
                </div>
            </div>

            <div class="dt-hero__marquee">
                <div class="dt-hero__marquee-track">
                    <span>PHP 8.3 & Laravel</span><span>React.js & JavaScript</span><span>RESTful APIs</span>
                    <span>لوحات تحكم متكاملة</span><span>MySQL & Database Design</span><span>Performance & SEO</span>
                    <span>PHP 8.3 & Laravel</span><span>React.js & JavaScript</span><span>RESTful APIs</span>
                    <span>لوحات تحكم متكاملة</span><span>MySQL & Database Design</span><span>Performance & SEO</span>
                </div>
            </div>
        </section>

        
        <section class="dt-program">
            <div class="dt-container">
                <div class="dt-section-head">
                    <span class="dt-eyebrow-free">منهجية العمل</span>
                    <h2 class="dt-h2">دورة حياة تطوير<br>مشاريعك البرمجية</h2>
                </div>

                <div class="dt-program__steps">
                    <?php
                        $dtSteps = [
                            ['icon' => 'fa-diagram-project', 'title' => 'تحليل وتصميم', 'sub' => 'هيكلة قاعدة البيانات والـ Architecture'],
                            ['icon' => 'fa-laptop-code', 'title' => 'تطوير متكامل', 'sub' => 'باك إند Laravel وفرونت إند React.js'],
                            ['icon' => 'fa-rocket', 'title' => 'إطلاق ودعم', 'sub' => 'اختبار الأداء، الحماية، والـ SEO'],
                        ];
                    ?>
                    <?php $__currentLoopData = $dtSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="dt-program__step">
                            <div class="dt-program__icon"><i class="fa-solid <?php echo e($step['icon']); ?>"></i></div>
                            <p><b><?php echo e($step['title']); ?></b> <?php echo e($step['sub']); ?></p>
                        </div>
                        <?php if(!$loop->last): ?>
                            <span class="dt-program__dash"></span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        
        <section class="dt-why">
            <div class="dt-container dt-why__grid">
                <div class="dt-why__visual">
                    <div class="dt-why__img dt-why__img--main"
                        style="background-image: url('<?php echo e(asset('front/assets/img/rrrrr.jpeg')); ?>'); background-size: cover; background-position: center;">
                    </div>
                    <div class="dt-why__badge">
                        <b>+4</b>
                        <div class="dt-stars">★★★★★</div>
                        <span>سنوات خبرة برمجية</span>
                    </div>
                </div>
                <div class="dt-why__copy">
                    <span class="dt-eyebrow-free">لماذا تعمل معي؟</span>
                    <h2 class="dt-h2">كود نظيف، أداء فائق<br>وقابلية للتوسع</h2>
                    <p class="dt-p">لا أكتفي بكتابة كود يعمل فقط، بل أصمم أنظمة برمجية تتبع أفضل الممارسات المعمارية (Clean Code & SOLID Principles) لضمان سهولة التطوير المستقبلي واستقرار النظام.</p>

                    <ul class="dt-check-list">
                        <li><i class="fa-solid fa-check"></i> خبرة +4 سنوات في تطوير تطبيقات الويب باستخدام PHP & Laravel</li>
                        <li><i class="fa-solid fa-check"></i> بناء واجهات تفاعلية سريعة ومتجاوبة بـ React.js و JavaScript</li>
                        <li><i class="fa-solid fa-check"></i> تصميم وبناء RESTful APIs مؤمنة لتطبيقات الموبايل والويب</li>
                        <li><i class="fa-solid fa-check"></i> التزام تام بالمواعيد والدعم الفني المستمر بعد التسليم</li>
                    </ul>

                    <a href="#booking" class="dt-btn-ghost">ابدأ مشروعك معي</a>
                </div>
            </div>
        </section>

        
        <section class="dt-specialties" id="services">
            <div class="dt-container dt-specialties__grid">
                <div class="dt-specialties__visual">
                    <div class="dt-specialties__tooth">
                        <svg viewBox="0 0 200 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="100" cy="110" r="85" fill="#fff" stroke="var(--dt-teal)" stroke-width="6" />
                        </svg>
                    </div>
                    <div class="dt-specialties__person"
                        style="background-image: url('<?php echo e(asset('front/assets/img/ggggg.jpg')); ?>'); background-size: cover; background-position: center top;">
                    </div>
                </div>

                <div class="dt-specialties__copy">
                    <span class="dt-eyebrow-free">خدماتي التقنية</span>
                    <h2 class="dt-h2">حلول برمجية متكاملة<br>من الباك إند للفرونت إند</h2>
                    <p class="dt-p">أقدم خدمات تطوير الويب الشاملة بدءاً من تخطيط قواعد البيانات وبناء الـ Backend والـ APIs وحتى تصميم وتطوير واجهات المستخدم التفاعلية.
                    </p>

                    <div class="dt-specialties__chips">
                        <?php
                            $dtSpecialties = [
                                ['icon' => 'fa-server', 'title' => 'تطوير باك إند PHP Laravel'],
                                ['icon' => 'fa-atom', 'title' => 'واجهات تفاعلية React.js'],
                                ['icon' => 'fa-network-wired', 'title' => 'بناء وربط RESTful APIs'],
                                ['icon' => 'fa-gauge-high', 'title' => 'لوحات تحكم إدارية وأنظمة ERP'],
                                ['icon' => 'fa-cart-shopping', 'title' => 'متاجر إلكترونية وبوابات دفع'],
                                ['icon' => 'fa-magnifying-glass-chart', 'title' => 'تحسين الأداء والـ SEO والأمان'],
                            ];
                        ?>
                        <?php $__currentLoopData = $dtSpecialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="#booking" class="dt-chip">
                                <span class="dt-chip__icon"><i class="fa-solid <?php echo e($s['icon']); ?>"></i></span>
                                <span>
                                    <b><?php echo e($s['title']); ?></b>
                                    <em>اطلب الخدمة الآن</em>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <a href="<?php echo e(route('services')); ?>" class="dt-cta">استعراض كافة الخدمات</a>
                </div>
            </div>
        </section>

        
        <section class="dt-home-about-premium">
            <div class="dt-home-about-premium__grid">

                <div class="dt-home-about-premium__visual">
                    <div class="dt-home-about-premium__frame">
                        <img src="<?php echo e(asset('front/assets/img/blog4.jpg')); ?>" alt="Eng. Abdelrahman Abu Aishah"
                            class="dt-home-about-premium__img"
                            onerror="this.src='<?php echo e(asset('front/assets/img/dr.jpg')); ?>'">
                        <div class="dt-home-about-premium__overlay"></div>
                        <a href="<?php echo e(asset('front/assets/img/vvid.mp4')); ?>" data-fancybox data-type="html5video"
                            class="dt-home-about-premium__play">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>

                <div class="dt-home-about-premium__copy">
                    <span class="dt-home-about-premium__subtitle">تعرف عليّ عن قرب</span>
                    <h2 class="dt-home-about-premium__title">م. عبدالرحمن أبو عيشة<br>Full-Stack Software Engineer</h2>
                    <p class="dt-home-about-premium__text">
                        مهندس برمجيات متخصص في بناء تطبيقات الويب المتكاملة بخبرة تزيد عن 4 سنوات. أجمع بين القوة المعمارية في الباك إند باستخدام PHP و Laravel، والمرونة والتفاعلية العالية في الفرونت إند باستخدام JavaScript و React.js، لتقديم منتجات رقمية متكاملة، سريعة، وآمنة تلبي طموحات العملاء والشركات.
                    </p>

                    <div class="dt-home-about-premium__actions">
                        <a href="<?php echo e(route('about')); ?>" class="dt-home-about-premium__btn">
                            اقرأ المزيد عن خبراتي <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="dt-ba" id="before-after">
            <div class="dt-container">
                <div class="dt-section-head dt-section-head--light" style="margin-bottom: 30px;">
                    <span class="dt-eyebrow-free">معرض الأعمال</span>
                    <h2 class="dt-h2" style="margin-bottom: 10px;">أحدث المشاريع والأنظمة</h2>
                </div>

                <div class="swiper ba-swiper">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="dt-ba__item" style="text-align: center;">
                                    <div class="dt-ba__slider swiper-no-swiping">
                                        <?php
                                            $afterImage =
                                                $banner->getFirstMediaUrl('after_image') ?:
                                                asset('front/assets/img/after1.jpg');
                                            $beforeImage =
                                                $banner->getFirstMediaUrl('before_image') ?:
                                                asset('front/assets/img/before1.jpg');
                                        ?>
                                        <div class="dt-ba__img dt-ba__img--after"
                                            style="background-image: url('<?php echo e($afterImage); ?>'); background-size: cover; background-position: center;">
                                        </div>
                                        <div class="dt-ba__img dt-ba__img--before"
                                            style="background-image: url('<?php echo e($beforeImage); ?>'); background-size: cover; background-position: center;">
                                        </div>

                                        <span
                                            class="dt-ba__tag dt-ba__tag--start"><?php echo e(app()->getLocale() == 'ar' ? 'قبل' : 'Before'); ?></span>
                                        <span
                                            class="dt-ba__tag dt-ba__tag--end"><?php echo e(app()->getLocale() == 'ar' ? 'بعد' : 'After'); ?></span>

                                        <div class="dt-ba__handle">
                                            <i class="fa-solid fa-arrows-left-right"></i>
                                        </div>
                                    </div>
                                    <div class="dt-ba__content" style="margin-top: 15px;">
                                        <h3 class="dt-h3"
                                            style="color: var(--dt-gold); font-size: 1.5rem; margin-bottom: 0;">
                                            <?php echo e($banner->title ?? 'مشروع مميز'); ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-button-next ba-next"></div>
                    <div class="swiper-button-prev ba-prev"></div>
                </div>

                <div class="dt-center-btn">
                    <a href="<?php echo e(route('cases.index')); ?>" class="dt-btn-ghost dt-btn-ghost--light">شاهد كل المشاريع</a>
                </div>
            </div>
        </section>

        
        <section class="dt-reviews" id="reviews">
            <div class="dt-container">

                <div class="dt-orbit">
                    <svg class="dt-orbit__arc" viewBox="0 0 760 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40 260 C 120 40, 640 40, 720 260" stroke="var(--dt-line)" stroke-width="1.5"
                            fill="none" />
                    </svg>

                    <?php
                        $dtOrbit = [
                            ['tag' => 'مواعيد محددة', 'pos' => 1],
                            ['tag' => 'معاملة ممتازة', 'pos' => 2],
                            ['tag' => 'نتائج مذهلة', 'pos' => 3],
                            ['tag' => 'عيادة منظمة', 'pos' => 4],
                            ['tag' => 'يستاهلوا', 'pos' => 5],
                        ];
                    ?>
                    <?php $__currentLoopData = $dtOrbit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="dt-orbit__bubble dt-orbit__bubble--<?php echo e($o['pos']); ?>">
                            <span class="dt-orbit__avatar"><i class="fa-solid fa-user"></i></span>
                            <span class="dt-orbit__tag"><?php echo e($o['tag']); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="dt-section-head dt-orbit__head">
                        <span class="dt-eyebrow-free">آراء عملائنا</span>
                        <h2 class="dt-h2">شوف تقييم وآراء<br>عملائنا بالتفصيل</h2>
                        <p class="dt-p">كل الآراء موثقة من صفحاتنا على جوجل وفيسبوك</p>
                    </div>
                </div>

                <div class="dt-rating-badges">
                    <div class="dt-rating-badge">
                        <i class="fa-brands fa-google"></i>
                        <div>
                            <b>4.9 <span class="dt-stars">★★★★★</span></b>
                            <span>بناءً على 805 تقييم</span>
                        </div>
                    </div>
                    <div class="dt-rating-badge">
                        <i class="fa-brands fa-facebook"></i>
                        <div>
                            <b>4.7 <span class="dt-stars">★★★★★</span></b>
                            <span>بناءً على 28 تقييم</span>
                        </div>
                    </div>
                </div>

                <div class="swiper reviews-swiper" style="max-width: 640px; margin: 0 auto;">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="dt-featured-review" style="margin: 0; width: 100%;">
                                    <div class="dt-featured-review__head">
                                        <span class="dt-review-card__avatar"><?php echo e(mb_substr($test->name, 0, 1)); ?></span>
                                        <div>
                                            <b><?php echo e($test->name); ?></b>
                                            <div class="dt-review-card__stars">
                                                <?php for($i = 0; $i < $test->rating; $i++): ?>
                                                    ★
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo e($test->description); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-pagination reviews-swiper-pagination" style="margin-top: 15px; position: static;">
                    </div>
                </div>

                
                <div class="dt-add-review">
                    <div class="dt-add-review__head">
                        <span class="dt-eyebrow-free">هل لديك مشروع برمجي؟</span>
                        <h3>تواصل معي الآن لبدء مشروعك</h3>
                        <p>أساعد الشركات ورواد الأعمال على بناء أنظمة وتطبيقات ويب متكاملة وعالية الأداء</p>
                    </div>
                    <div class="text-center">
                        <a href="#booking" class="dt-cta">اطلب مشروعك الآن</a>
                    </div>
                </div>
            </div>
        </section>





        <?php
            $galleryImages = [
                'gallery2.jpeg',
                'gallery3.jpeg',
                'gallery4.jpeg',
                'gallery5.jpeg',
                'gallery6.jpeg',
                'gallery7.jpeg',
                'gallery8.jpeg',
                'gallery9.jpeg',
                'gallery10.jpeg',
            ];
        ?>

        <section class="dt-gallery" id="gallery">
            <div class="dt-container">
                <div class="dt-section-head">
                    <span class="dt-eyebrow-free">لقطات من المشاريع</span>
                    <h2 class="dt-h2">واجهات ولوحات تحكم احترافية</h2>
                </div>

                <div class="swiper gallery-swiper">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <a href="<?php echo e(asset('front/assets/img/' . $img)); ?>" data-fancybox="gallery"
                                    data-caption="معرض أعمال م. عبدالرحمن أبو عيشة">
                                    <img src="<?php echo e(asset('front/assets/img/' . $img)); ?>" alt="معرض أعمال م. عبدالرحمن أبو عيشة"
                                        loading="lazy">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-pagination gallery-swiper-pagination"></div>
                </div>
            </div>
        </section>

        
        <section class="dt-faq" id="faq">
            <div class="dt-container">
                <div class="dt-section-head">
                    <span class="dt-eyebrow-free">الأسئلة الشائعة</span>
                    <h2 class="dt-h2">إجابات لكل استفساراتك التقنية</h2>
                </div>
                <div class="dt-faq__grid">
                    <div class="dt-faq__item">
                        <input type="checkbox" id="faq1" class="dt-faq__toggle">
                        <label for="faq1" class="dt-faq__title">ما هي التقنيات التي تعتمد عليها في تطوير المشاريع؟ <i
                                class="fa-solid fa-chevron-down"></i></label>
                        <div class="dt-faq__content">
                            <p>أعتمد على PHP 8.3 وإطار العمل Laravel لبناء الباك إند والـ APIs، وJavaScript وReact.js وBootstrap لبناء واجهات المستخدم التفاعلية والمتجاوبة.</p>
                        </div>
                    </div>
                    <div class="dt-faq__item">
                        <input type="checkbox" id="faq2" class="dt-faq__toggle">
                        <label for="faq2" class="dt-faq__title">هل تقدم خدمة تطوير الـ APIs لتطبيقات الموبايل؟ <i
                                class="fa-solid fa-chevron-down"></i></label>
                        <div class="dt-faq__content">
                            <p>نعم، أقوم بتصميم وتطوير RESTful APIs سريعة ومؤمنة بالكامل باستخدام Laravel Passport / Sanctum مع دعم إشعارات Firebase والربط مع بوابات الدفع.</p>
                        </div>
                    </div>
                    <div class="dt-faq__item">
                        <input type="checkbox" id="faq3" class="dt-faq__toggle">
                        <label for="faq3" class="dt-faq__title">هل تشمل الخدمة رفع المشروع على السيرفر وتهيئة الـ SEO؟<i
                                class="fa-solid fa-chevron-down"></i></label>
                        <div class="dt-faq__content">
                            <p>بالتأكيد، أقوم بإعداد السيرفر أو الاستضافة (cPanel / VPS)، وضبط إعدادات الحماية، وشهادات SSL، وتهيئة الموقع لمحركات البحث (Technical SEO).</p>
                        </div>
                    </div>
                    <div class="dt-faq__item">
                        <input type="checkbox" id="faq4" class="dt-faq__toggle">
                        <label for="faq4" class="dt-faq__title">هل يوجد دعم فني بعد تسليم المشروع؟ <i
                                class="fa-solid fa-chevron-down"></i></label>
                        <div class="dt-faq__content">
                            <p>نعم، أوفر فترة دعم فني مجاني بعد التسليم لضمان استقرار النظام، بالإضافة إلى إمكانية التعاقد على خطط صيانة وتطوير دورية.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        

        <section class="dt-booking" id="booking">
            <div class="dt-container dt-booking__grid">
                <div class="dt-booking__copy">
                    <span class="dt-eyebrow-free">اطلب مشروعك الآن</span>
                    <h2 class="dt-h2">خطوة واحدة تفصلك<br>عن إطلاق مشروعك البرمجي</h2>
                    <p class="dt-p">املأ البيانات بتفاصيل فكرتك وسأتواصل معك في أقرب وقت لمناقشة الخطة التنفيذية والتكلفة.</p>
                    <ul class="dt-check-list dt-check-list--dark">
                        <li><i class="fa-solid fa-check"></i> استشارة تقنية وتقييم مبدئي مجاني</li>
                        <li><i class="fa-solid fa-check"></i> رد سريع وتواصل مباشر</li>
                        <li><i class="fa-solid fa-check"></i> كود نظيف قابل للتوسع والتطوير</li>
                    </ul>
                </div>
                <form action="<?php echo e(route('create_message')); ?>" method="POST" class="dt-booking__form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="type" value="booking">

                    <div class="dt-form-row">
                        <input type="text" name="name" placeholder="الاسم بالكامل" required>
                        <input type="tel" name="phone" placeholder="رقم الهاتف / واتساب" required>
                    </div>
                    <select name="service" required>
                        <option value="" disabled selected>اختر نوع المشروع أو الخدمة المطلوبة</option>
                        <option value="تطوير موقع أو نظام متكامل (Full-Stack Laravel & React)">تطوير موقع أو نظام متكامل (Full-Stack Laravel & React)</option>
                        <option value="تطوير باك إند ولوحة تحكم (PHP Laravel)">تطوير باك إند ولوحة تحكم (PHP Laravel)</option>
                        <option value="تطوير واجهات مستخدم تفاعلية (React.js / Frontend)">تطوير واجهات مستخدم تفاعلية (React.js / Frontend)</option>
                        <option value="بناء وربط RESTful APIs لتطبيقات الموبايل">بناء وربط RESTful APIs لتطبيقات الموبايل</option>
                        <option value="متجر إلكتروني وربط بوابات الدفع">متجر إلكتروني وربط بوابات الدفع</option>
                        <option value="تطوير وتحديث مشروع قائم / إصلاح أخطاء">تطوير وتحديث مشروع قائم / إصلاح أخطاء</option>
                        <option value="استشارة تقنية خاصة">استشارة تقنية خاصة</option>
                    </select>
                    <textarea name="message" placeholder="اكتب نبذة مختصرة عن فكرة مشروعك أو متطلباتك (اختياري)"></textarea>
                    <button type="submit" class="dt-cta dt-cta--lg dt-cta--block">إرسال طلب المشروع</button>
                </form>
            </div>
        </section>




        
        <div class="dt-quickbar">
            <a href="<?php echo e(route('message_contact')); ?>" class="dt-quickbar__item">
                <span class="dt-quickbar__icon"><i class="fa-solid fa-envelope"></i></span>
                <span>تواصل معي</span>
            </a>
            <a href="#booking" class="dt-quickbar__item dt-quickbar__item--main">
                <span class="dt-quickbar__icon"><i class="fa-solid fa-laptop-code"></i></span>
                <span>اطلب مشروعك</span>
            </a>
            <a href="#reviews" class="dt-quickbar__item">
                <span class="dt-quickbar__icon"><i class="fa-solid fa-comment-dots"></i></span>
                <span>آراء العملاء</span>
            </a>
        </div>

    </main>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        (function() {
            // Animated counters
            var counters = document.querySelectorAll('[data-count]');
            var counted = false;

            function runCounters() {
                if (counted) return;
                counted = true;
                counters.forEach(function(el) {
                    var target = parseInt(el.getAttribute('data-count'), 10);
                    var current = 0;
                    var step = Math.max(1, Math.ceil(target / 60));
                    var timer = setInterval(function() {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        el.textContent = current.toLocaleString('en-US');
                    }, 20);
                });
            }
            var heroStats = document.querySelector('.dt-hero__stats');
            if (heroStats) {
                var io = new IntersectionObserver(function(entries) {
                    entries.forEach(function(e) {
                        if (e.isIntersecting) runCounters();
                    });
                }, {
                    threshold: .4
                });
                io.observe(heroStats);
            }

            // Before/After Multi-Slider Logic
            var baSliders = document.querySelectorAll('.dt-ba__slider');
            baSliders.forEach(function(slider) {
                var before = slider.querySelector('.dt-ba__img--before');
                var handle = slider.querySelector('.dt-ba__handle');
                var dragging = false;

                function setPos(clientX) {
                    var rect = slider.getBoundingClientRect();
                    var x = Math.min(Math.max(clientX - rect.left, 0), rect.width);
                    var pct = (x / rect.width) * 100;
                    var isRTL = getComputedStyle(slider).direction === 'rtl';

                    if (isRTL) {
                        before.style.clipPath = 'polygon(' + pct + '% 0, 100% 0, 100% 100%, ' + pct + '% 100%)';
                    } else {
                        before.style.clipPath = 'polygon(0 0, ' + pct + '% 0, ' + pct + '% 100%, 0 100%)';
                    }

                    handle.style.left = pct + '%';
                    handle.style.right = 'auto';
                }

                // Initialize positions
                var isRTL = getComputedStyle(slider).direction === 'rtl';
                before.style.clipPath = isRTL ? 'polygon(50% 0, 100% 0, 100% 100%, 50% 100%)' :
                    'polygon(0 0, 50% 0, 50% 100%, 0 100%)';
                handle.style.left = '50%';

                slider.addEventListener('mousedown', function(e) {
                    dragging = true;
                    setPos(e.clientX);
                });
                window.addEventListener('mouseup', function() {
                    dragging = false;
                });
                window.addEventListener('mousemove', function(e) {
                    if (dragging) setPos(e.clientX);
                });

                slider.addEventListener('touchstart', function(e) {
                    dragging = true;
                    setPos(e.touches[0].clientX);
                }, {
                    passive: true
                });
                window.addEventListener('touchend', function() {
                    dragging = false;
                });
                slider.addEventListener('touchmove', function(e) {
                    if (dragging) setPos(e.touches[0].clientX);
                }, {
                    passive: true
                });
            });

            // Initialize Before/After Swiper
            new Swiper('.ba-swiper', {
                loop: true,
                navigation: {
                    nextEl: '.ba-next',
                    prevEl: '.ba-prev',
                },
                noSwipingClass: 'swiper-no-swiping',
            });

            // Initialize Gallery Swiper
            new Swiper('.gallery-swiper', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                loop: true,
                coverflowEffect: {
                    rotate: 15,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                pagination: {
                    el: '.gallery-swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                }
            });
            // Initialize Reviews Swiper
            new Swiper('.reviews-swiper', {
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.reviews-swiper-pagination',
                    clickable: true,
                },
            });
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/front/index.blade.php ENDPATH**/ ?>