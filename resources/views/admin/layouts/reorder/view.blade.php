<div class="row mt-4">
    <div class="col-md-8 col-md-offset-2">
        <div class="card p-4" dir="ltr">
            <p>{{\App\Helpers\TranslationHelper::translate('Use Drag & Drop')}}</p>
            <ol class="sortable mt-0 ">
                @php(\App\Helpers\ReorderHelper::reorderComponent($data, $label))
            </ol>
        </div><!-- /.card -->
        <button id="toArray" class="btn btn-success" data-style="zoom-in"><i class="la la-save"></i> {{\App\Helpers\TranslationHelper::translate('Save')}}</button>
    </div>
</div>
