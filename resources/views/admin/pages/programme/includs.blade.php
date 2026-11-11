<div id="includs" class="tab-pane fade">
    <h2 class="mb-3"> Programme Includes {{ \App\Helpers\TranslationHelper::translate('Map Location') }}</h2>
    <div class="row px-3 mt-4">
        <div class="includes">
            @if(isset($programme))
                @if($programme->programmeIncludes->count() > 0)
                    @foreach($programme->programmeIncludes as $k => $programmeInclude)
                        @if($k == 0)
                            <div class="row include_item">
                                <div class="col-lg-5">
                                    <input type="text" name="includes[1][en]" class="form-control inp_"
                                           value="{{$programmeInclude->getTranslation('details', 'en')}}"
                                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details (En)') }}">
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" name="includes[1][ar]" class="form-control inp_"
                                           value="{{$programmeInclude->getTranslation('details', 'ar')}}"
                                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details (Ar)') }}">
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-sm btn-warning w-100 bold"
                                            onclick="plusGeneralIncludeItem(this)">
                                        {{ \App\Helpers\TranslationHelper::translate('Add') }} +
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" name="includes[{{$k+1}}][en]" class="form-control inp_"
                                           value="{{$programmeInclude->getTranslation('details', 'en')}}"
                                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details in English') }}">
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" name="includes[{{$k+1}}][ar]" class="form-control inp_"
                                           value="{{$programmeInclude->getTranslation('details', 'ar')}}"
                                           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details in Arabic') }}">
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100 bold"
                                            onclick="deleteIncludeItem(this)">
                                        Delete{{ \App\Helpers\TranslationHelper::translate('Add') }}
                                        <i class='fa fa-trash-can'></i>

                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach

                @else
                    <div class="row include_item">
                        <div class="col-lg-5">
                            <input type="text" name="includes[1][en]" class="form-control inp_"
                                   placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details (En)') }}">
                        </div>
                        <div class="col-lg-5">
                            <input type="text" name="includes[1][ar]" class="form-control inp_"
                                   placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details (Ar)') }}">
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-sm btn-warning w-100 bold"
                                    onclick="plusGeneralIncludeItem(this)">
                                {{ \App\Helpers\TranslationHelper::translate('Add') }} +
                            </button>
                        </div>
                    </div>
                @endif
            @else
                <div class="row include_item">
                    <div class="col-lg-5">
                        <input type="text" name="includes[1][en]" class="form-control inp_"
                               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details (En)') }}">
                    </div>
                    <div class="col-lg-5">
                        <input type="text" name="includes[1][ar]" class="form-control inp_"
                               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details (Ar)') }}">
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-sm btn-warning w-100 bold"
                                onclick="plusGeneralIncludeItem(this)">
                            {{ \App\Helpers\TranslationHelper::translate('Add') }} +
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
