<div id="commission" class="tab-pane fade">
    <h2>Commission</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="input__group mb-25">
                <label>
                    {{ \App\Helpers\TranslationHelper::translate('Commission') }}
                </label>
                <input type="number"
                    value="{{ old('commission', @($hotel != null) ? $hotel->commission : '') }}"
                    name="commission" autocomplete="number" min="1" placeholder=" % {{ \App\Helpers\TranslationHelper::translate('Commission In') }}"
                    class="form-control" />
            </div>
        </div>
    </div>
</div>
