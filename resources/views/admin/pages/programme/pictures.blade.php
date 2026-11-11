<div id="pictures" class="tab-pane fade">
    <h2 style="text-align: left">Pictures</h2>

    <div class="row ">
        <div class="col-md-6" style="margin-bottom: 4%;">
            <label style="text-align:left !important">
                {{ \App\Helpers\TranslationHelper::translate('Main Image') }}
                <span class="text-danger">*</span>
            </label>

            <div class="upload-img-box {{isset($programme) && $programme->getMainImage() != null ? 'imgShow' : ''}}" id="fileInpContainer" style="background-color: #f0f0f0; height: 200px; width: 350px;">
                <img src="{{ old('main_image', @($programme != null) ? $programme->getMainImage() : '') }}" id="HotelMainIMGPreview" style="height: 200px; width: 350px;"/>
                <input type="file" class="{{!isset($programme) || $programme == null ? 'inp_' : ''}}" name="main_image" id="IMG_INP" {{ @($programme != null) ? '' : 'required' }}
                    accept="image/*" />
                <div class="upload-img-box-icon">
                    <i class="fa fa-camera"></i>
                    <p class="m-0">{{ \App\Helpers\TranslationHelper::translate('Image') }}</p>
                </div>
            </div>

        </div>
        <div class="col-md-6" style="margin-bottom: 4%;">
            <label style="text-align:left !important">
                {{ \App\Helpers\TranslationHelper::translate('Banner') }}
                <span class="text-danger">*</span>
            </label>

            <div class="upload-banner-box {{isset($programme) && $programme->getFirstMediaUrl('programmes_banners') != null ? 'imgShow' : ''}}" id="bannerContainer" style="background-color: #f0f0f0; height: 200px; width: 350px;">
                <img src="{{ old('banner', @($programme != null) ? $programme->getFirstMediaUrl('programmes_banners') : '') }}" id="HotelMainbannerPreview" style="height: 200px; width: 350px;" />
                <input type="file" name="banner" id="banner_INP" {{ @($programme != null) ? '' : 'required' }}
                    accept="image/*" class="{{!isset($programme) || $programme == null ? 'inp_' : ''}}"  />
                <div class="upload-img-box-icon">
                    <i class="fa fa-camera"></i>
                    <p class="m-0">{{ \App\Helpers\TranslationHelper::translate('Image') }}</p>
                </div>
            </div>

        </div>
        
        <div class="col-lg-12 mb-2"  style="text-align: left; margin-top: 40px;">

            <div class="input__group">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Other Images') }}
                </label>
                <input  type="file" name="images[]" class="{{!isset($programme) || $programme == null ? 'inp_' : ''}}"  multiple />
            </div>

        </div>

    </div>

    @if(isset($programme) && $programme->programmeImages->count() > 0)
    <div class="row" style="text-align: left">
        @foreach ($programme->programmeImages as $programmeImage )

            <div class="col-lg-2">
                <img width="100px" src="{{ asset($programmeImage->getFirstMediaUrl('programme_images')) }}" alt="" srcset="">
            </div>

        @endforeach

    </div>
    @endif










</div>


