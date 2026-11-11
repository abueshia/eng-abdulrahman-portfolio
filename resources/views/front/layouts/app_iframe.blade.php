<!DOCTYPE html>
<html class="no-js" lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>silverblue</title>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!-- Place favicon.ico in the root directory -->
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="{{asset('front/assets/img/logo/favicon.png')}}"
    />
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Tajawal&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">


    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/slick.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/daterangepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/nice-select.css')}}"/>
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="{{asset('front/assets/css/swiper-bundle.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/magnific-popup.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/spacing.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/toastr.css')}}"/>

    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/custom.css')}}"/>
    @stack('css')
</head>

<body class="grey-bg">
<!-- preloader -->
<div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div>
<!-- preloader end  -->

<!-- back-to-top-start  -->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="far fa-angle-double-up"></i>
</button>
<!-- back-to-top-end  -->

<!-- it-offcanvus-area-start -->
<div class="it-offcanvas-area">
    <div class="it-offcanvas">
        <div class="it-offcanvas__close-btn">
            <button class="close-btn"><i class="fal fa-times"></i></button>
        </div>
        <div class="it-offcanvas__logo">
            <a href="{{route('site.home')}}">
                <img src="{{asset('front/assets/img/logo/logo.png')}}" alt=""/>
            </a>
        </div>
        <div class="it-offcanvas__text">
            <p>
                Suspendisse interdum consectetur libero id. Fermentum leo vel orci
                porta non. Euismod viverra nibh cras pulvinar suspen.
            </p>
        </div>
        <div class="it-menu-mobile"></div>

        <div class="col-xxl-4 col-xl-3 col-6">
            <div
                class="tr-header-right-action d-flex align-items-center"
            >

            <div class="tr-header-right-lang lang-sellector d-none d-md-block me-3 custom-lang-select lang-class" style="width: 55px; display: flex; align-items: center; justify-content: center;">
                <select class="tr-select-lang" onchange="location.href=this.value" style="border: none; background-color: transparent; outline: none; color: #87CEEB;">
                    <option value="{{ LaravelLocalization::getLocalizedURL('ar') }}"
                            @if(app()->getLocale() == 'ar') selected @endif>
                        AR
                    </option>
                    <option value="{{ LaravelLocalization::getLocalizedURL('en') }}"
                            @if(app()->getLocale() == 'en') selected @endif>
                        EN
                    </option>
                </select>
            </div>

                @auth
                <div class="tr-header-right-btn d-none d-md-block">
                    <a class="tr-btn" href="{{ route('user.profile')}}">{{ \App\Helpers\TranslationHelper::translate('Profile') }}</a>
                </div>

                @else
                <div class="tr-header-right-btn d-none d-md-block">
                    <a class="tr-btn" href="{{ route('user.login.form')}}">{{ \App\Helpers\TranslationHelper::translate('Login') }}</a>
                </div>
                @endauth

                {{-- <div class="tr-header-bar d-xl-none ml-30">
                    <button class="tr-menu-bar">
                        <i class="fa-sharp fa-light fa-bars-staggered"></i>
                    </button>
                </div> --}}


            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
<!-- it-offcanvus-area-end -->

{{--Start Header--}}
@include('front.includes.header')
{{--End Header--}}
<main>
    @yield('content')
</main>

{{--@include('front.includes.footer')--}}

<!-- JS here -->
<script src="{{asset('front/assets/js/jquery.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('front/assets/js/slick.min.js')}}"></script>
<script src="{{asset('front/assets/js/magnific-popup.js')}}"></script>
<script src="{{asset('front/assets/js/purecounter.js')}}"></script>
<script src="{{asset('front/assets/js/wow.js')}}"></script>
<script src="{{asset('front/assets/js/moment.min.js')}}"></script>
<script src="{{asset('front/assets/js/daterangepicker.min.js')}}"></script>
<script src="{{asset('front/assets/js/nice-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('front/assets/js/swiper-bundle.js')}}"></script>
<script src="{{asset('front/assets/js/isotope-pkgd.js')}}"></script>
<script src="{{asset('front/assets/js/imagesloaded-pkgd.js')}}"></script>

<script src={{asset("front/assets/js/sweet_alert.js")}}></script>
{{--Toastr--}}
<script src={{asset("front/assets/js/toastr.js")}}></script>

<script src="{{asset('front/assets/js/search.js')}}"></script>
<script src="{{asset('front/assets/js/main.js')}}"></script>
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

        // Destroy all previous date range pickers
        $(".date-multi-picker").daterangepicker("destroy");

        // Re-initialize date pickers with unique IDs
        $(".date-multi-picker").each(function (index) {
            var $this = $(this);
            $this.attr("id", "date" + index); // Assign unique ID

            // Initialize daterangepicker
            $this.daterangepicker({
                singleDatePicker: true,
                opens: "right",
                locale: {
                    format: "DD/MM/YYYY",
                },
            });
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


    function validateInfantsNumber(infants_number) {
        let infants_number_input = $(infants_number);
        let infants_number_val = infants_number_input.val();
        let dropdown_menu = infants_number_input.closest('.dropdown-menu');
        let adult_number_input = dropdown_menu.find('input[name="adult_number"]');
        let adult_number_val = adult_number_input.val();

        if (infants_number_val > adult_number_val) {
            toastr.error('{{\App\Helpers\TranslationHelper::translate('Infants Must Have Adults to Hold .. Please Add Adults First')}}', {
                CloseButton: true,
                ProgressBar: true
            });
            let new_val = infants_number_input.val() - 1;
            infants_number_input.val(new_val);
        }
    }

    function validateTotalPassengers(passenger_inp) {
        let passenger_input = $(passenger_inp);
        let dropdown_menu = passenger_input.closest('.dropdown-menu');
        let all_passenger_inputs = dropdown_menu.find('.passenger_input');

        // Initialize sum variable
        let total = 0;

        // Iterate over each input and sum the values
        all_passenger_inputs.each(function() {
            // Convert input value to a number and add to the total
            total += parseInt($(this).val()) || 0; // Defaults to 0 if value is NaN or empty
        });

        if(total > 9) {
            let new_val = passenger_input.val() - 1;
            passenger_input.val(new_val);

            toastr.error('{{\App\Helpers\TranslationHelper::translate('Max Passengers Count is')}}' + ' : 9 ' + '{{\App\Helpers\TranslationHelper::translate('Passengers')}}', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    }

</script>
@stack('js')
</body>
</html>
