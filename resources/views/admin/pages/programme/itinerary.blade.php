@if(isset($programme) && $programme->programmeItinerary->count() > 0)
    <div id="itinerary" class="tab-pane fade">
        <h2 class="mb-3"> {{ \App\Helpers\TranslationHelper::translate('Programme Itinerary') }} </h2>
        <div class="row px-3 mt-4" id="days_container">
            @foreach($programme->programmeItinerary as $k => $programmeItinerary)
                <div class="col-md-12 mb-3 card day_item py-3">
                    <div class="day" id="day_{{$k}}" onclick="toggleIncludes(this)">
                        <h3>{{ \App\Helpers\TranslationHelper::translate('Day') }} {{$k + 1}}</h3>
                        <div class="toggle_icon">
                            <i class="fa fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="day_includes mt-3" id="day_includes_{{$k + 1}}" style="display: none">

                        @foreach($programmeItinerary->programmeItineraryItems as $key => $programmeItineraryItem)
                            @if($key == 0)
                                <div class="row day_includes_item ">
                                    <div class="col-lg-5">
                                        <input type="text" name="itinerary[{{$k + 1}}][1][en]" class="form-control inp_"
                                               value="{{$programmeItineraryItem->getTranslation('details', 'en')}}"
                                               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details in English') }}">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" name="itinerary[{{$k + 1}}][1][ar]" class="form-control inp_"
                                               value="{{$programmeItineraryItem->getTranslation('details', 'ar')}}"

                                               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details in Arabic') }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-sm btn-warning w-100 bold"
                                                data-id='{{$k + 1}}'
                                                onclick="plusIncludeItem(this)">
                                             +{{ \App\Helpers\TranslationHelper::translate('Add') }}
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="row day_includes_item ">
                                    <div class="col-lg-5">
                                        <input type="text" name="itinerary[{{$k + 1}}][{{$key + 2}}][en]"
                                               class="form-control inp_"
                                               value="{{$programmeItineraryItem->getTranslation('details', 'en')}}"

                                               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details in English') }}">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" name="itinerary[{{$k + 1}}][{{$key + 2}}][ar]"
                                               class="form-control inp_"
                                               value="{{$programmeItineraryItem->getTranslation('details', 'ar')}}"

                                               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Include Details in Arabic') }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100 bold"
                                                onclick="deleteIncludeItem(this)">
                                            {{ \App\Helpers\TranslationHelper::translate('Delete') }}
                                            <i class='fa fa-trash-can'></i>
                                        </button>
                                    </div>
                                </div>
                            @endif

                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div id="itinerary" class="tab-pane fade">
        <h2 class="mb-3"> Programme Itinerary </h2>
        <div class="row px-3 mt-4" id="days_container">
            <h3 class="m-auto alert alert-warning" id="zero_duration">
                The Duration is 0 .. Please Add Some Days
            </h3>
        </div>
    </div>
@endif
