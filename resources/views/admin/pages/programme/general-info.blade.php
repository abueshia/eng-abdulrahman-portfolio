<div id="personal" class="tab-pane fade show active text-start"  >
    <h2 >{{ \App\Helpers\TranslationHelper::translate('General info') }}</h2>
    <div class="row">


        @foreach (Config('language') as $key => $lang)
            <div class="col-md-6">
                <div class="input__group mb-25">
                    <label for="name_{{$key}}">
                        {{ \App\Helpers\TranslationHelper::translate('Programme Name in') }} {{ $lang }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="name_{{$key}}"
                           value="{{ old('name_'.$key, isset($programme) ? $programme->getTranslation('name', $key) : '') }}"
                           name="name_{{ $key }}" autocomplete="name"
                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Name in') }} {{ $key }}" class="form-control inp_"/>
                </div>
            </div>
        @endforeach


                {{-- @foreach (Config('language') as $key => $lang)
            <div class="col-md-6">
                <div class="input__group mb-25">
                    <label for="meta_title_{{$key}}">
                        {{ \App\Helpers\TranslationHelper::translate('Programme Meta Title in') }} {{ $lang }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="meta_title_{{$key}}"
                           value="{{ old('meta_title_'.$key, isset($programme) ? $programme->getTranslation('meta_title', $key) : '') }}"
                           name="meta_title_{{ $key }}" autocomplete="meta_title"
                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Meta Title in') }} {{ $key }}" class="form-control inp_"/>
                </div>
            </div>
        @endforeach --}}


        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Number of Rates') }}</label>
                <input type="number"
                       value="{{ old('rate', @($programme != null) ? $programme->rate : '') }}"
                       name="rate" min="1" autocomplete="rate" placeholder="Programme rate"
                       class="form-control inp_" required/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Number of Stars') }}</label>
                <input type="number"
                       value="{{ old('star', @($programme != null) ? $programme->star : '') }}"
                       name="star" min="1" max="6" oninput="checkMaxValue(this)" autocomplete="star" placeholder="Programme star"
                       class="form-control inp_" required/>

            </div>
        </div>




        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Country') }}</label>
                <select name="country_id" id="country_id" class="form-select inp_">
                    <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Country') }}</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ old('', isset($programme) ? ($programme->country_id == $country->id ? 'selected' : '') : '') }}>
                            {{ $country->getTranslation('name', app()->getLocale()) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('City') }}</label>
                <select name="city_id" id="city_id" class="form-select inp_">
                    <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose City') }}</option>
                    @if(isset($programme))
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ old('', isset($programme) ? ($programme->city_id == $city->id ? 'selected' : '') : '') }}>
                                {{ $city->getTranslation('name', app()->getLocale()) }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Region') }}</label>
                <select name="region_id" id="region_id" class="form-select inp_">
                    <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Region') }}</option>
                    @if(isset($programme))
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"
                                {{ old('', isset($programme) ? ($programme->region_id == $region->id ? 'selected' : '') : '') }}>
                                {{ $region->getTranslation('name', app()->getLocale()) }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        @foreach (Config('language') as $key => $lang)
            <div class="col-md-6">
                <div class="input__group mb-25">
                    <label>
                        {{ \App\Helpers\TranslationHelper::translate('Location Name in') }} {{ $lang }}
                    </label>
                    <input type="text"
                           value="{{ old('location_name_'.$key, isset($programme) ? $programme->getTranslation('location_name', $key) : '') }}"
                           name="location_name_{{ $key }}" autocomplete="address"
                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Location Name in') }} {{ $key }}" class="form-control inp_"/>
                </div>
            </div>
        @endforeach
            <div class="col-md-6">
                <div class="input__group mb-25">
                    <label>{{ \App\Helpers\TranslationHelper::translate('Status') }}</label>
                    <select name="status" id="status" class="form-select inp_">
                        <option value="1"
                            {{ old('status', isset($programme) ? ($programme->status == 1 ? 'selected' : '') : '') }}>
                            {{ \App\Helpers\TranslationHelper::translate('Active') }}
                        </option>
                        <option value="0"
                            {{ old('status', isset($programme) ? ($programme->status == 0 ? 'selected' : '') : '') }}>
                           {{ \App\Helpers\TranslationHelper::translate('In Active') }}
                        </option>
                    </select>

                </div>
            </div>

            <div class=" col-lg-6 col-12 mb-5 mt-2 d-none">
                <label class="fs-5 fw-bold form-label mb-2" for="longitude">
                      :{{ \App\Helpers\TranslationHelper::translate('Longitude') }}
                    <span
                        class="text-danger">*</span>
                </label>
                <input type="text" class="form-control m-input" name="longitude"
                       id="longitude" min="0" value="31.295372104565704"
                       step="0.1" placeholder="{{ \App\Helpers\TranslationHelper::translate('Please enter longitude') }}"/>
            </div>
            <div class=" col-lg-6 col-12 mb-5 mt-2 d-none">
                <label class="fs-5 fw-bold form-label mb-2" for="latitude">
                      :{{ \App\Helpers\TranslationHelper::translate('latitude') }}
                    <span
                        class="text-danger">*</span>
                </label>

                <input type="text" class="form-control m-input" name="latitude"
                       id="latitude" min="0" value="29.969633980120133"
                       step="0.1" placeholder="{{ \App\Helpers\TranslationHelper::translate('Please enter latitude') }}"/>
            </div>
            <div class="col-lg-12 col-12">
                <label for="searchTextField">{{ \App\Helpers\TranslationHelper::translate('Map Location') }}</label>

                <input style="padding: 0 0 0 20px"
                       type="text"
                       id="searchTextField"
                       name="map" class="form-control inp_"
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Map Location') }}"
                       value="{{ old('map', @($programme != null) ? $programme->map : '') }}">
                <!--end::Label-->
                <!--begin::Input-->

            </div>
            <div class="col-12 mb-5 mt-2">
                <div id="map_canvas" style="height: 350px;width: 100%;margin: 0.6em;"></div>
            </div>


        <div class="col-md-12">
            <label>{{ \App\Helpers\TranslationHelper::translate('Description In ar') }}
                <span class="text-danger">*</span></label>
            <textarea id="programme_summernote_ar" class=" inp_"
                      name="description[ar]">{{ isset($programme) ? $programme->getTranslation('description', 'ar') : '' }}</textarea>
        </div>

        <div class="col-md-12">
            <label>{{ \App\Helpers\TranslationHelper::translate('Description in en') }}
                <span class="text-danger">*</span></label>
            <textarea id="programme_summernote_en" class=" inp_"
                      name="description[en]">{{ isset($programme) ? $programme->getTranslation('description', 'en') : '' }}</textarea>
        </div>



    </div>
</div>
