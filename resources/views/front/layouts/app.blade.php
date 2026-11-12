<!DOCTYPE html>
<html class="no-js" lang="{{app()->getLocale()}}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>

    <link
        href="https://fonts.googleapis.com/css2?family=Arial&family=Courier+New&family=Georgia&family=Times+New+Roman&family=Verdana&family=Tahoma&family=Trebuchet+MS&family=Comic+Sans+MS&family=Lucida+Console&family=Impact&display=swap"
        rel="stylesheet">
<link rel="canonical" href="{{ url()->current() }}" />
<meta name="google-site-verification" content="BAhvjPEWQ7NkzrV0xIbrRYL88Wv21hqVfOKuaYlDffQ" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'المهندس عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah — Full-Stack Software Engineer (PHP Laravel & React.js)')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('front/assets/img/favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('front/assets/img/favicon.png') }}" />
    <!-- SEO & Open Graph Meta Tags -->
    <meta name="description" content="الموقع الرسمي ومعرض أعمال المهندس عبدالرحمن أبو عيشة (Eng. Abdelrahman Abu Aishah) — مهندس برمجيات متكامل Full-Stack بخبرة +4 سنوات في تطوير الباك إند باستخدام PHP و Laravel وبناء واجهات المستخدم الحديثة باستخدام JavaScript و React.js." />
    <meta name="keywords" content="عبدالرحمن أبو عيشة, مهندس عبدالرحمن أبو عيشة, Eng Abdelrahman Abu Aishah, Software Engineer, Full Stack Developer, PHP Laravel Developer, React.js Developer, Backend Engineer, Frontend Developer, برمجة مواقع, تطوير أنظمة, لارافيل, ريأكت" />
    <meta name="author" content="المهندس عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah" />
    <meta name="robots" content="index, follow" />
    
    <!-- Open Graph (Facebook/WhatsApp) -->
    <meta property="og:title" content="المهندس عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah — Software Engineer" />
    <meta property="og:description" content="مهندس برمجيات متكامل (PHP Laravel & React.js) بخبرة أكثر من 4 سنوات في تصميم وتطوير الأنظمة والمواقع الاحترافية." />
    <meta property="og:image" itemprop="image" content="{{ asset('front/assets/img/logo/Silver-blue.png') }}?v=4" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="800" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:site_name" content="المهندس عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah" />
    <meta property="og:locale" content="ar_EG" />
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="المهندس عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah — Software Engineer" />
    <meta name="twitter:description" content="معرض أعمال المهندس عبدالرحمن أبو عيشة — تطوير باك إند PHP Laravel وفرونت إند React.js." />
    <meta name="twitter:image" content="{{ asset('front/assets/img/dr_og.jpg') }}?v=3" />

    <!-- Google Structured Data (JSON-LD) for Software Engineer Portfolio -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "المهندس عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah",
      "jobTitle": "Full-Stack Software Engineer (PHP Laravel & React.js)",
      "image": "{{ asset('front/assets/img/dr.jpg') }}",
      "@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "knowsAbout": ["PHP", "Laravel", "JavaScript", "React.js", "RESTful APIs", "MySQL", "HTML5", "CSS3", "Bootstrap", "Full-Stack Web Development"]
    }
    </script>

     @yield('meta')

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('front/assets/css/style_ar.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('front/assets/css/style_en.css') }}">
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@400;700&display=swap');
    </style>

    <meta http-equiv="x-ua-compatible" content="ie=edge"/>

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="{{ asset('front/assets/img/logo/Silver-blue.png') }}"
    />
<link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}"/>

   
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="icon" href="{{asset('front/assets/img/logo/Silver-blue.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.css"
        integrity="sha512-ryx4QW6sYyQthh6MIGW1cDEfNuIwTsvWtORXg5t3sqmh3TSNmqMr+VBN5N0T+z0GqqsiDJ5O8YhP4diuBGmcrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    @stack('color_css')
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}"/>
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('front/assets/css/style_ar.css')}}"/>
    @endif

    @stack('css')

    <style>
        /* Global Popup */
        .dt-popup-overlay { position: fixed; inset: 0; background: rgba(16, 36, 43, 0.6); backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.3s; }
        .dt-popup-overlay.show { opacity: 1; visibility: visible; }
        .dt-popup-box { background: #fff; width: 90%; max-width: 400px; border-radius: 24px; padding: 34px 24px 24px; text-align: center; position: relative; transform: translateY(20px) scale(0.95); transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 30px 60px -20px rgba(0,0,0,0.3); }
        .dt-popup-overlay.show .dt-popup-box { transform: translateY(0) scale(1); }
        .dt-popup-close { position: absolute; top: 12px; right: 16px; background: none; border: none; font-size: 28px; color: #7C9691; cursor: pointer; line-height: 1; transition: 0.2s; }
        .dt-popup-close:hover { color: #211D16; }
        .dt-popup-icon { width: 60px; height: 60px; background: #E9D9B0; color: #3F3323; font-size: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        .dt-popup-title { font-family: 'El Messiri', serif; font-size: 22px; color: #1E1810; margin: 0 0 10px; font-weight: 700; }
        .dt-popup-desc { font-family: 'Tajawal', sans-serif; font-size: 14.5px; color: #3E5A55; margin: 0 0 24px; line-height: 1.7; }
        .dt-popup-actions { display: flex; flex-direction: column; gap: 12px; }
        .dt-popup-btn { display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px; border-radius: 12px; text-decoration: none; font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 15px; transition: 0.2s; }
        .dt-popup-btn--wa { background: #C9A455; color: #fff; }
        .dt-popup-btn--wa:hover { background: #C9A455; color: #fff; }
        .dt-popup-btn--phone { background: #F4F1E9; color: #1E1810; }
        .dt-popup-btn--phone:hover { background: #E8DFC9; }
    </style>

</head>

<body class="grey-bg">

 

<!-- preloader -->
<div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div>


@include('front.includes.header')
{{--End Header--}}
<main>

    @yield('content')

</main>

@include('front.includes.footer')

   <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.js"
        integrity="sha512-QokzG/B/9i5X3BYbmuyNn2ah9EiApK5KY4saOYZRCQINuB+X52ED0L3RCc/1x7YUA85qaFZ9uoB4x5SmkLGCJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script> <!-- Local bootstrap JS file -->
    <script src="{{asset('front/assets/js/jquery-3.7.1.js')}}"></script> <!-- Local jQuery file -->
    <script src="{{asset('front/assets/js/main.js')}}"></script> <!-- User-defined JS file -->
    <script>
        AOS.init();
    </script>

<script>
    $(document).on("click", ".add-flight-btn", function () {
        console.log("Add Flight button clicked");

        // Allow a maximum of 3 flight fields
        if ($(".multi-flight-field").length < 3) {
            $(".multi-flight-field:last")
                .clone()
                .insertAfter(".multi-flight-field:last");
        }

        // Ensure delete button shows up for the last field
        $(this)
            .closest(".multi-flight-wrap")
            .find(".multi-flight-field:last")
            .children(".multi-flight-delete-wrap")
            .show();

   
        $(".date-multi-picker").each(function (index) {
            var $this = $(this);
            $this.attr("id", "date_" + index); // Assign unique ID

        });
       

    });

    $(document).on("click", ".multi-flight-remove", function () {
        $(".multi-flight-remove")
            .closest(".multi-flight-wrap")
            .find(".multi-flight-field")
            .not(":first")
            .last()
            .remove();
    });

   

   

   

    function removeRoom(room_btn) {
        let room_row = $(room_btn).closest('.room_item');
        room_row.remove();
    }

    function updateRoomPersons() {
        let room_adults = $('#room_adults');
        let adult_number = $("input[name='adult_number[]']");
        let adult_number_sum = 0;
        adult_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            adult_number_sum += value;
        });
        room_adults.text(adult_number_sum);
        // alert(adult_number_sum);

        let room_children = $('#room_children');
        let child_number = $("input[name='child_number[]']");
        let child_number_sum = 0;
        child_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            child_number_sum += value;
        });
        room_children.text(child_number_sum);
        // alert(child_number_sum);
    }

    function updateFlightPersons() {
        let room_adults = $('#room_adults');
        let adult_number = $("input[name='adult_number[]']");
        let adult_number_sum = 0;
        adult_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            adult_number_sum += value;
        });
        room_adults.text(adult_number_sum);
        // alert(adult_number_sum);

        let room_children = $('#room_children');
        let child_number = $("input[name='child_number[]']");
        let child_number_sum = 0;
        child_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            child_number_sum += value;
        });
        room_children.text(child_number_sum);
        // alert(child_number_sum);
    }

</script>

@stack('js')

@if(Session::has('error'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                text: "{{Session::get('error')}}",
                dangerMode: true,
                confirmButtonColor: '#e98f33',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'حسنا',
                showCloseButton: true,
            });
        });
    </script>
@endif


<script>
    function submitLogout() {
        // alert()
        let logout_form = $("#logout_form");
        logout_form.submit();
    }
</script>

<!-- Global Popup -->
<div id="dtGlobalPopup" class="dt-popup-overlay">
    <div class="dt-popup-box">
        <button class="dt-popup-close" id="dtPopupClose">&times;</button>
        <div class="dt-popup-icon">
            <i class="fa-solid fa-laptop-code"></i>
        </div>
        <h3 class="dt-popup-title">هل لديك فكرة مشروع برمجي؟</h3>
        <p class="dt-popup-desc">تواصل معي الآن لتحويل فكرتك إلى نظام أو موقع احترافي متكامل بأحدث تقنيات PHP Laravel و React.js.</p>
        <div class="dt-popup-actions">
            <a href="https://wa.me/201042917680" target="_blank" class="dt-popup-btn dt-popup-btn--wa">
                <i class="fa-brands fa-whatsapp"></i> تواصل عبر الواتساب
            </a>
            <a href="{{ route('message_contact') }}" class="dt-popup-btn dt-popup-btn--phone">
                <i class="fa-solid fa-paper-plane"></i> اطلب مشروعك الآن
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.getElementById('dtGlobalPopup');
        var closeBtn = document.getElementById('dtPopupClose');
        
        // Show popup if not closed in this session
        if (popup && !sessionStorage.getItem('dt_popup_closed')) {
            setTimeout(function() {
                popup.classList.add('show');
            }, 3000); // 3 seconds delay for better UX
        }
        
        // Close on button click
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                popup.classList.remove('show');
                sessionStorage.setItem('dt_popup_closed', 'true');
            });
        }

        // Close on overlay click
        if (popup) {
            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    popup.classList.remove('show');
                    sessionStorage.setItem('dt_popup_closed', 'true');
                }
            });
        }
    });
</script>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/201042917680" target="_blank" class="dt-floating-wa" aria-label="تواصل معنا عبر واتساب">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<style>
    .dt-floating-wa {
        position: fixed;
        bottom: 30px;
        left: 30px; /* Positioned on the left for RTL */
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #E9D9B0 0%, #C9A455 100%);
        color: #1E1810;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        box-shadow: 0 10px 20px rgba(201, 164, 85, 0.4);
        z-index: 999;
        text-decoration: none;
        transition: all 0.3s ease;
        animation: wa-pulse 2s infinite;
    }

    .dt-floating-wa:hover {
        transform: translateY(-5px) scale(1.05);
        color: #fff;
        background: linear-gradient(135deg, #C9A455 0%, #8F6526 100%);
        box-shadow: 0 15px 25px rgba(201, 164, 85, 0.6);
    }

    @keyframes wa-pulse {
        0% { box-shadow: 0 0 0 0 rgba(201, 164, 85, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(201, 164, 85, 0); }
        100% { box-shadow: 0 0 0 0 rgba(201, 164, 85, 0); }
    }
    
    @media (max-width: 768px) {
        .dt-floating-wa {
            bottom: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            font-size: 28px;
        }
    }
</style>

    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '{{ app()->getLocale() == "ar" ? "تم بنجاح!" : "Success!" }}',
                text: '{{ session("success") }}',
                confirmButtonText: '{{ app()->getLocale() == "ar" ? "حسناً" : "OK" }}',
                confirmButtonColor: '#C9A455',
                background: '#FBFAF7',
                color: '#1E1810',
                iconColor: '#C9A455',
                customClass: {
                    popup: 'dt-swal-popup',
                    title: 'dt-swal-title',
                    htmlContainer: 'dt-swal-text'
                }
            });
        });
    </script>
    <style>
        .dt-swal-popup {
            font-family: 'Tajawal', sans-serif !important;
            border-radius: 20px !important;
            border: 1px solid #E8DFC9 !important;
        }
        .dt-swal-title {
            font-family: 'El Messiri', serif !important;
            font-size: 24px !important;
            color: #1E1810 !important;
        }
        .dt-swal-text {
            font-size: 16px !important;
            color: #3E5A55 !important;
        }
        .swal2-html-container {
            font-family: 'Tajawal', sans-serif !important;
            color: #3E5A55 !important;
        }
        /* Override SweetAlert Success Icon Color */
        .dt-swal-popup .swal2-success {
            border-color: #C9A455 !important;
        }
        .dt-swal-popup .swal2-success [class^="swal2-success-line"] {
            background-color: #C9A455 !important;
        }
        .dt-swal-popup .swal2-success .swal2-success-ring {
            border-color: rgba(201, 164, 85, 0.3) !important;
        }
    </style>
    @endif

</body>
</html>
