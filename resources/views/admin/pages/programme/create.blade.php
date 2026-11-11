@extends('admin.layouts.app')

{{-- @push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush --}}

@push('admin_css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <style>

        
        .tab {
            display: none;
        }

        .nav-tabs {
            border-bottom: 2px solid #95999d;
        }

        .nav-item {
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
        }

        .day {
            position: relative;
            cursor: pointer
        }

        .toggle_icon {
            position: absolute;
            top: 6px;
            right: 31px;
        }

        .toggle_icon i {
            color: #000;
            font-weight: bold;
            font-size: 16px;
        }
        
        
    </style>
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ @($programme != null) ? 'Edit' : 'Add' }} {{ \App\Helpers\TranslationHelper::translate('Programme') }}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.index')}}" class="text-muted text-hover-primary">{{ \App\Helpers\TranslationHelper::translate('Home') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                {{--                    <li class="breadcrumb-item">--}}
                {{--                        <span class="bullet bg-gray-400 w-5px h-2px"></span>--}}
                {{--                    </li>--}}
                <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{ \App\Helpers\TranslationHelper::translate('Programme') }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif



        <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
                        {{-- <button type="submit" style="float: right; width:10%" id="submit_btn" class="btn btn-primary">
                            {{ \App\Helpers\TranslationHelper::translate('Save') }}
                        </button> --}}
                        <button type="submit" 
        id="submit_btn" 
        class="btn btn-primary" 
        style="width: 10%; float: {{ app()->getLocale() == 'ar' ? 'left' : 'right' }};">
    {{ \App\Helpers\TranslationHelper::translate('Save') }}
</button>


                        <!--begin::Col-->
                        <div class="container mt-0 ">
                            <ul class="nav nav-tabs mb-10" style="width: fit-content;">
                                <li class="nav-item">
                                    <a class="nav-link active personal_nav" data-tab="personal">{{ \App\Helpers\TranslationHelper::translate('Programme') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link important-info_nav" data-tab="important-info">{{ \App\Helpers\TranslationHelper::translate('Details') }}
                                        </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link itinerary_nav" data-tab="itinerary">{{ \App\Helpers\TranslationHelper::translate('Itinerary') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link includs_nav" data-tab="includs">{{ \App\Helpers\TranslationHelper::translate('Includs') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link contact-info_nav" data-tab="contact-info">{{ \App\Helpers\TranslationHelper::translate('Contact Info') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pictures_nav" data-tab="pictures">{{ \App\Helpers\TranslationHelper::translate('Pictures') }}</a>
                                </li>

                            </ul>
                            @if (@($programme != null))
                                <form id="myForm" action="{{ route('admin.programme.update', $programme->id) }}"
                                      method="POST"
                                      class="form-horizontal addStudentFRM tab-content mt-3" id="form"
                                      enctype="multipart/form-data">

                                    @method('PUT')
                                    @else
                                        <form id="myForm" action="{{ route('admin.programme.store') }}"
                                              method="POST"
                                              class="form-horizontal addStudentFRM tab-content mt-3" id="form"
                                              enctype="multipart/form-data">
                                            @endif

                                            @csrf

                                            @include('admin.pages.programme.general-info')

                                            @include('admin.pages.programme.details')

                                            @include('admin.pages.programme.itinerary')

                                            @include('admin.pages.programme.includs')

                                            @include('admin.pages.programme.contact-info')

                                            @include('admin.pages.programme.pictures')

                                        </form>
                        </div>

                        <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection



@push('admin_js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>

        $(document).ready(function () {
            $('#country_id').change(function () {
                var country = $(this).val();
                if (country) {
                    $.ajax({
                        url: '{{url('admin/city/getCityByCountry/')}}' + '/' + country,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#city_id').empty();
                            $('#city_id').append('<option selected disabled>Select City</option>');
                            $.each(data, function (id, name) {
                                $('#city_id').append('<option value="' + id + '">' + name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Select City</option>');
                }
            });


            $('#city_id').change(function () {
                var city = $(this).val();
                if (city) {
                    $.ajax({
                        url: '{{url('admin/city/getRegionsByCity/')}}' + '/' + city,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#region_id').empty();
                            $('#region_id').append('<option selected disabled>Select Region</option>');
                            $.each(data, function (id, name) {
                                $('#region_id').append('<option value="' + id + '">' + name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#region_id').empty();
                    $('#region_id').append('<option value="">Select Region</option>');
                }
            });

            let programme_form = $("#myForm");
            let submit_btn = $("#submit_btn");
            let all_inputs = programme_form.find('input.inp_');

            submit_btn.on('click', function (e) {
                e.preventDefault();


                var emptyInputs = $('.inp_').filter(function () {
                    if ($(this).is('input') || $(this).is('textarea')) {
                        return $(this).val().trim() === '';
                    } else if ($(this).is('select')) {
                        return $(this).val() === '' || $(this).val() === '0' || $(this).val() === '-1';
                    } else if ($(this).is('input[type="file"]')) {
                        return !$(this).val(); // Check if no file is selected
                    }
                });

                if (emptyInputs.length > 0) {
                    emptyInputs.each(function () {

                        if ($(this).is('input[type="file"]')) {
                            if ($(this).parent().parent().find('.error-message').length < 1) {
                                $(this).parent().after('<span class="error-message text-danger">This field is required.</span>');
                            }
                        } else {
                            if ($(this).parent().find('.error-message').length < 1) {
                                $(this).after('<span class="error-message text-danger">This field is required.</span>');
                            }
                        }
                        let parent_div = $('.' + $(this).closest('.tab-pane').attr('id') + '_nav');
                        if (!parent_div.hasClass('text-danger')) {
                            parent_div.addClass('text-danger');
                        }
                        if ($(this).parent().parent().hasClass('day_includes_item')) {
                            $(this).parent().parent().parent().show();
                        }


                    });
                }
                if (emptyInputs.length < 1) {
                    programme_form.submit();
                }
            });
        });

        $(document).ready(function () {
            $('#summernote_condition_ar').summernote();
        });

        $(document).ready(function () {
            $('#summernote_condition_en').summernote();
        });

        $(document).ready(function () {
            $('#summernote_policy_en').summernote();
        });


        $(document).ready(function () {
            $('#summernote_policy_ar').summernote();
        });


        $(document).ready(function () {
            $('#summernote_children_age_en').summernote();
        });

        $(document).ready(function () {
            $('#summernote_children_age_ar').summernote();
        });


        $(document).ready(function () {
            $('#programme_summernote_en').summernote();
        });

        $(document).ready(function () {
            $('#programme_summernote_ar').summernote();
        });


        $(document).ready(function () {
            $('.nav-link').click(function () {

                $('.nav-link').removeClass('active');
                var tab = $(this).data('tab');
                $(this).addClass('active')
                $('.tab-pane').removeClass('show active');
                $('#' + tab).addClass('show active');
            });
        });

        function submitForm() {
            // Here you can add your form submission logic
            var formData = new FormData(document.getElementById("form"));
            // Example: Send form data via AJAX
            // Replace this with your actual form submission code
            fetch('submit.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    // Handle response if needed
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        $(function () {
            $('#IMG_INP').change(function () {
                if (this.files.length) {
                    let FR = new FileReader(this.files[0]);
                    FR.onload = function (e) {
                        $("#fileInpContainer").addClass("imgShow");
                        $("#HotelMainIMGPreview").prop("src", e.target.result);
                    };
                    FR.readAsDataURL(this.files[0]);
                } else {
                    $("#fileInpContainer").removeClass("imgShow");
                }
            })

        });
        $(function () {
            $('#banner_INP').change(function () {
                if (this.files.length) {
                    let FR = new FileReader(this.files[0]);
                    FR.onload = function (e) {
                        $("#bannerContainer").addClass("imgShow");
                        $("#HotelMainbannerPreview").prop("src", e.target.result);
                    };
                    FR.readAsDataURL(this.files[0]);
                } else {
                    $("#bannerContainer").removeClass("imgShow");
                }
            })

        });


        //ajax




        //save form

        // document.addEventListener('DOMContentLoaded', function () {
        //     var saveButton = document.getElementById('saveForm');
        //     var form = document.getElementById('myForm');
        //
        //     saveButton.addEventListener('click', function (event) {
        //         event.preventDefault(); // Prevent button default behavior
        //
        //         // Your custom logic before form submission, if any
        //
        //
        //
        //         // form.submit(); // Submit the form
        //     });
        // });

    </script>


    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyB-uADMlF6PqwccIr3q6Vpyl0wJgJNsxOM&libraries=places&region=eg&language=en&sensor=true"></script>

    <script>
        $(function () {
            var lat = "{{isset($programme->latitude) ? $programme->latitude : "24.7136"}}",
                lng = "{{isset($programme->latitude) ? $programme->longitude : "46.6753"}}",
                latlng = new google.maps.LatLng(lat, lng),
                image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
            //zoomControl: true,
            //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
            var mapOptions = {
                    center: new google.maps.LatLng(lat, lng),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    panControl: true,
                    panControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    },
                    zoomControl: true,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.LARGE,
                        position: google.maps.ControlPosition.TOP_left
                    }
                },
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: image
                });
            var input = document.getElementById('searchTextField');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ["geocode"]
            });
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
                infowindow.close();
                var place = autocomplete.getPlace();
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                moveMarker(place.name, place.geometry.location);
                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());
            });
            google.maps.event.addListener(map, 'click', function (event) {
                // alert(event.latLng.lat())
                $('#latitude').val(event.latLng.lat());
                $('#longitude').val(event.latLng.lng());
                infowindow.close();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "latLng": event.latLng
                }, function (results, status) {
                    // console.log(results, status);
                    if (status == google.maps.GeocoderStatus.OK) {
                        // console.log(results);
                        var lat = results[0].geometry.location.lat(),
                            lng = results[0].geometry.location.lng(),
                            placeName = results[0].address_components[0].long_name,
                            latlng = new google.maps.LatLng(lat, lng);
                        moveMarker(placeName, latlng);

                        $("#searchTextField").val(results[0].formatted_address);
                    }
                });
            });

            function moveMarker(placeName, latlng) {
                marker.setIcon(image);
                marker.setPosition(latlng);
                infowindow.setContent(placeName);
                //infowindow.open(map, marker);
            }
        });

        function refreshDays(duration) {
            let current_duration = $(duration).val();
            let days_container = $("#days_container");
            let currentDivs = days_container.children('div.day_item').length;
            let zero_duration = $("#zero_duration");

            if (current_duration > 0) {
                zero_duration.hide();
                if (current_duration > currentDivs) {
                    // Append new divs if the input value is greater than the current number of divs
                    for (var i = currentDivs; i < current_duration; i++) {
                        let newCurrentDivs = days_container.children('div.day_item').length;

                        days_container.append(
                            "<div class=\"col-md-12 mb-3 card day_item py-3\">\n" +
                            "            <div class=\"day\" id=\"day_" + i + "\" onclick=\"toggleIncludes(this)\">\n" +
                            "                <h3>Day " + (i + 1) + "</h3>\n" +
                            "                <div class=\"toggle_icon\">\n" +
                            "                    <i class=\"fa fa-chevron-down\"></i>\n" +
                            "                </div>\n" +
                            "            </div>\n" +
                            "            <div class=\"day_includes mt-3\" id=\"day_includes_" + (newCurrentDivs + 1) + "\" style=\"display: none\">\n" +
                            "                <div class=\"row day_includes_item \">\n" +
                            "                    <div class=\"col-lg-5\">\n" +
                            "                        <input type=\"text\" name=\"itinerary[" + (newCurrentDivs + 1) + "][1][en]\"  class=\"form-control inp_\"\n" +
                            "                               placeholder=\"Enter Include Details in English\">\n" +
                            "                    </div>\n" +
                            "                    <div class=\"col-lg-5\">\n" +
                            "                        <input type=\"text\" name=\"itinerary[" + (newCurrentDivs + 1) + "][1][ar]\"  class=\"form-control inp_\"\n" +
                            "                               placeholder=\"Enter Include Details in Arabic\">\n" +
                            "                    </div>\n" +
                            "                    <div class=\"col-lg-2\">\n" +
                            "                        <button type=\"button\" class=\"btn btn-sm btn-warning w-100 bold\" data-id='" + (newCurrentDivs + 1) + "' onclick=\"plusIncludeItem(this)\">\n" +
                            "                            Add +\n" +
                            "                        </button>\n" +
                            "                    </div>\n" +
                            "                </div>\n" +
                            "            </div>\n" +
                            "        </div>"
                        );
                    }
                } else if (current_duration < currentDivs) {
                    // Remove excess divs if the input value is less than the current number of divs
                    days_container.children('div').slice(current_duration).remove();
                }
            } else {
                zero_duration.show();
            }

        }

        function toggleIncludes(day) {
            let day_div = $(day);
            let includes = $(day).parent().find('.day_includes');
            includes.slideToggle('fast')
        }

        function plusIncludeItem(btn) {
            let day_includes = $(btn).parent().parent().parent();
            let current_length = day_includes.children('div.day_includes_item').length;
            let day_id = $(btn).attr('data-id');
            day_includes.append(
                "<div class=\"row day_includes_item \">\n" +
                "                    <div class=\"col-lg-5\">\n" +
                "                        <input type=\"text\" name=\"itinerary[" + day_id + "][" + (current_length + 1) + "][en]\" class=\"form-control inp_\"\n" +
                "                               placeholder=\"Enter Include Details in English\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-lg-5\">\n" +
                "                        <input type=\"text\" name=\"itinerary[" + day_id + "][" + (current_length + 1) + "][ar]\" class=\"form-control inp_\"\n" +
                "                               placeholder=\"Enter Include Details in Arabic\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-lg-2\">\n" +
                "                        <button type=\"button\" class=\"btn btn-sm btn-danger w-100 bold\" onclick=\"deleteIncludeItem(this)\">\n" +
                "                            Delete " +
                "<i class='fa fa-trash-can'></i>" +
                "\n" +
                "                        </button>\n" +
                "                    </div>\n" +
                "                </div>"
            );
        }

        function plusGeneralIncludeItem(btn) {
            let includes = $(btn).parent().parent().parent();
            let current_length = $('.include_item').length;
            includes.append(
                "<div class=\"row include_item\">\n" +
                "                <div class=\"col-lg-5\">\n" +
                "                    <input type=\"text\" name=\"includes[" + (current_length + 1) + "][en]\" class=\"form-control inp_\"\n" +
                "                           placeholder=\"Enter Include Details in English\">\n" +
                "                </div>\n" +
                "                <div class=\"col-lg-5\">\n" +
                "                    <input type=\"text\" name=\"includes[" + (current_length + 1) + "][ar]\" class=\"form-control inp_\"\n" +
                "                           placeholder=\"Enter Include Details in Arabic\">\n" +
                "                </div>\n" +
                "<div class=\"col-lg-2\">\n" +
                "                    <button type=\"button\" class=\"btn btn-sm btn-danger w-100 bold\" onclick=\"deleteIncludeItem(this)\">\n" +
                "                            Delete " +
                "<i class='fa fa-trash-can'></i>" +
                "\n" +
                "                    </button>\n" +
                "                </div>" +
                "            </div>"
            );
        }

        function deleteIncludeItem(btn) {
            let current_row = $(btn).parent().parent();
            current_row.remove();
        }

        function checkMaxValue(input) {
            if (input.value > 6) {
                input.value = 6;
            }
        }
    </script>

@endpush
