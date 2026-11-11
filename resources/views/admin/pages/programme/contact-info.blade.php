<div id="contact-info" class="tab-pane fade">
    <h2>{{ \App\Helpers\TranslationHelper::translate('Contact Info') }}</h2>
    <div class="row">

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Email') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="email"
                    value="{{ old('email', @($programme != null) ? $programme->email : '') }}"
                    name="email" autocomplete="email" placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Email') }} "
                    class="form-control inp_"  />
            </div>
        </div>


        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Phone') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text"
                    value="{{ old('phone', @($programme != null) ? $programme->phone : '') }}"
                    name="phone" autocomplete="phone" placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Phone') }}"
                    class="form-control inp_"  />
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Facebook Page') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text"
                    value="{{ old('facebook', @($programme != null) ? $programme->facebook : '') }}"
                    name="facebook" autocomplete="facebook" placeholder="{{ \App\Helpers\TranslationHelper::translate('Facebook Page Url') }}"
                    class="form-control inp_"  />
            </div>
        </div>
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Instagram Page') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text"
                    value="{{ old('instagram', @($programme != null) ? $programme->instagram : '') }}"
                    name="instagram" autocomplete="instagram" placeholder="{{ \App\Helpers\TranslationHelper::translate('Instagram Page Url') }}"
                    class="form-control inp_"  />
            </div>
        </div>
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Twitter Page') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text"
                    value="{{ old('twitter', @($programme != null) ? $programme->twitter : '') }}"
                    name="twitter" autocomplete="twitter" placeholder="{{ \App\Helpers\TranslationHelper::translate('Twitter Page Url') }}"
                    class="form-control inp_"  />
            </div>
        </div>
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Gmail') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="text"
                    value="{{ old('gmail', @($programme != null) ? $programme->gmail : '') }}"
                    name="gmail" autocomplete="gmail" placeholder="{{ \App\Helpers\TranslationHelper::translate('Gmail') }}"
                    class="form-control inp_"  />
            </div>
        </div>

    </div>
</div>
