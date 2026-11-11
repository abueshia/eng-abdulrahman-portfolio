@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Branche'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Branche'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Branches'), 'link' => route('admin.branche.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Branche'), 'link' => route('admin.branche.index')]">
    </x-bread-crumb>
@endsection

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <!--begin::Card body-->

                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$branche->id}}">

                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $branche->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                              @endforeach

          

                                                      @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('address in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea class="form-control form-control-solid" rows="4"
                                                          placeholder="{{\App\Helpers\TranslationHelper::translate('address in')}} {{__('methods.' . $lang)}}"
                                                          name="address[{{ $key}}]">{{ old('address.'.$key) ?? $branche->getTranslation('address',$key)}}</textarea>
                                                @error('address.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                                                 <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Phone Number') }}
                    :
                </label>
                <input type="tel" class="form-control form-control-solid"
                       value="{{ old('phone') ?? $branche->phone }}" 
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Phone Number') }}"
                       name="phone"/>
                @error('phone')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            
                                             <div class="col-6  mb-5">
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Image')}} : <span
                                                        class="text-danger"> {{\App\Helpers\TranslationHelper::translate('Size')}} <span dir="ltr">400 x 400</span></span></label>
                                                <!--end::Label-->
                                                <input type="file" class="form-control form-control-solid" name="image"/>
                                                @error('image')
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                                @if($branche->getFirstMediaUrl('branches') != null)
                                                    <img src="{{ $branche->getFirstMediaUrl('branches') }}"
                                                         alt="offer" width="100px"
                                                         style="border-radius: 5px">
                                                @endif
                                            </div>



            {{-- <div class="col-12 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ __('Select City') }}:
    </label>
    <!-- Dropdown -->
    <select name="city_id" class="form-select form-control form-control-solid">
        <option value="" disabled selected>{{ __('Select a City') }}</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}" {{ old('city_id', $branche->city_id) == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>
    @error('city_id')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}



{{-- <div class="col-12 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ __('Select Location on Map') }}:
    </label>
    <div id="map" style="width: 100%; height: 400px; border: 1px solid #ccc;"></div>
    <input type="text" id="google_map" name="google_map" 
           class="form-control mt-3 form-control-solid" 
           placeholder="{{ __('Selected Location') }}" 
           value="{{ old('google_map', $branche->google_map) }}" />
    @error('google_map')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>  --}}

<div class="col-12 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Select Location on Map') }}:
    </label>

    <input type="text" id="google_map" name="google_map" 
           class="form-control mb-3 form-control-solid" 
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Selected Location') }} " 
           value="{{ old('google_map', $branche->google_map) }}" />
    
    @error('google_map')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <!-- الخريطة -->
    <div id="map" style="width: 100%; height: 400px; border: 1px solid #ccc;"></div>
</div>






                                    
                                                                            </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>

                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
    <!--end::Content-->

@endsection
@push('admin_js')

<script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>


{{-- 
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyB-uADMlF6PqwccIr3q6Vpyl0wJgJNsxOM&libraries=places&region=eg&language=en&sensor=true"></script>

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
                map = new google.maps.Map(document.getElementById('map'), mapOptions),
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: image
                });
            var input = document.getElementById('google_map');
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

                        $("#google_map").val(results[0].formatted_address);
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
</script> --}}

<script src="https://maps.google.com/maps/api/js?key=AIzaSyB-uADMlF6PqwccIr3q6Vpyl0wJgJNsxOM&libraries=places&region=eg&language=ar&sensor=true"></script>

<script>
    $(function () {
        var lat = "{{isset($programme->latitude) ? $programme->latitude : "30.043415482478093"}}",
            lng = "{{isset($programme->latitude) ? $programme->longitude : "31.229973393925782"}}",
            latlng = new google.maps.LatLng(lat, lng),
            image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';

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
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions),
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: image
            });

        var input = document.getElementById('google_map');
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"],
            componentRestrictions: { country: "EG" } // تحديد الدولة لتكون مصر فقط
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
            $('#latitude').val(event.latLng.lat());
            $('#longitude').val(event.latLng.lng());
            infowindow.close();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                "latLng": event.latLng
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var lat = results[0].geometry.location.lat(),
                        lng = results[0].geometry.location.lng(),
                        placeName = results[0].address_components[0].long_name,
                        latlng = new google.maps.LatLng(lat, lng);
                    moveMarker(placeName, latlng);
                    $("#google_map").val(results[0].formatted_address);
                }
            });
        });

        function moveMarker(placeName, latlng) {
            marker.setIcon(image);
            marker.setPosition(latlng);
            infowindow.setContent(placeName);
        }
    });
</script>



@endpush
