<style>
    body {
        direction: {{ (app()->getLocale() == 'ar') ? 'rtl' : 'ltr' }};
    }
</style>

<div id="important-info" class="tab-pane fade">
    <h2 style="text-align:left"> {{ \App\Helpers\TranslationHelper::translate('Programme Details') }}</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label> {{ \App\Helpers\TranslationHelper::translate('Check In') }}</label>
                <input type="time"
                    value="{{ old('check_in', @($programme != null) ? $programme->check_in : '') }}"
                    name="check_in" autocomplete="check_in"
                    placeholder=" {{ \App\Helpers\TranslationHelper::translate('Check In') }}" class="form-control inp_"  />

            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Check out') }}</label>
                <input type="time"
                    value="{{ old('check_out', @($programme != null) ? $programme->check_out : '') }}"
                    name="check_out" autocomplete="check_out"
                    placeholder="{{ \App\Helpers\TranslationHelper::translate('Check Out') }}" class="form-control inp_"  />

            </div>
        </div>



        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Group Size') }}</label>
                <input type="number"
                    value="{{ old('group_size', @($programme != null) ? $programme->group_size : '') }}"
                    name="group_size" min="1" autocomplete="group_size"
                    placeholder="{{ \App\Helpers\TranslationHelper::translate('Group Size') }}" class="form-control inp_"  />

            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Tour Type') }}</label>
                <select name="tour_type_id" id="tour_type_id" class="form-select">
                    @foreach ($tour_types as $tour_type)
                        <option value="{{ $tour_type->id }}"
                            {{ old('tour_type_id', isset($programme) ? ($programme->tour_type_id == $tour_type->id ? 'selected' : '') : '') }}>
                            {{ $tour_type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Duration (Days)') }}</label>
                <input type="number" onchange="refreshDays(this)"
                    value="{{ old('duration', @($programme != null) ? $programme->duration : '') }}"
                    name="duration" min="1" autocomplete="duration" id="duration"
                    placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Duration (Days)') }}" class="form-control inp_"  />

            </div>
        </div>


        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Is Featured') }}</label>
                <select name="is_featured" id="status" class="form-select">
                    <option value="1"
                        {{ old('is_featured', isset($programme) ? ($programme->is_featured == 1 ? 'selected' : '') : '') }}>
                        Active</option>
                    <option value="0"
                        {{ old('is_featured', isset($programme) ? ($programme->is_featured == 0 ? 'selected' : '') : '') }}>
                        {{ \App\Helpers\TranslationHelper::translate('In Active') }}</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label for="price">{{ \App\Helpers\TranslationHelper::translate('Price') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="number" id="price"
                       value="{{ old('price', @($programme != null) ? $programme->price : '') }}"
                       name="price" min="1" autocomplete="price"
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Price (per person)') }}" class="form-control inp_" >

            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('discount type') }}
                    <span class="text-danger">*</span>
                </label>
                <select name="discount_type" id="discount_type" class="form-select">
                    <option value="percent"
                        {{ old('discount_type', isset($programme) ? ($programme->discount_type == 'percent' ? 'selected' : '') : '') }}>
                        {{ \App\Helpers\TranslationHelper::translate('Percent') }}</option>
                    <option value="fixed"
                        {{ old('discount_type', isset($programme) ? ($programme->discount_type == 'fixed' ? 'selected' : '') : '') }}>
                        {{ \App\Helpers\TranslationHelper::translate('Fixed') }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('discount') }}
                    <span class="text-danger">*</span>
                </label>
                <input type="number"
                       value="{{ old('discount ', @($programme != null) ? $programme->discount : 0) }}"
                       name="discount" min="0" autocomplete="discount" placeholder=" discount"
                       id="discount" class="form-control inp_" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>{{ \App\Helpers\TranslationHelper::translate('Tax') }}</label>
                <input type="number"
                       value="{{ old('tax', @($programme != null) ? $programme->tax : 0) }}"
                       name="tax" min="0" autocomplete="tax"
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Tax') }}" class="form-control inp_"  />

            </div>
        </div>

        <div class="col-md-6">
            <div class="input__group mb-25">
                <label for="valid_from">{{ \App\Helpers\TranslationHelper::translate('Valid From') }}</label>
                <input type="date" id="valid_from"
                       value="{{ old('valid_from', @($programme != null) ? $programme->valid_from : '') }}"
                       name="valid_from" autocomplete="valid_from"
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Valide From') }}" class="form-control inp_" required/>

            </div>
        </div>


        <div class="col-md-6">
            <div class="input__group mb-25">
                <label for="valid_to">{{ \App\Helpers\TranslationHelper::translate('Valid To') }}</label>
                <input type="date" id="valid_to"
                       value="{{ old('valid_to', @($programme != null) ? $programme->valid_to : '') }}"
                       name="valid_to" autocomplete="valid_to" placeholder="{{ \App\Helpers\TranslationHelper::translate('Programme Valid To') }}"
                       class="form-control inp_" required/>

            </div>
        </div>

    </div>

</div>
