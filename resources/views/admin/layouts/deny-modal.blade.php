<!--begin::Modal-->
<div class="modal fade" id="deny_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{\App\Helpers\TranslationHelper::translate('Deny Package Request')}}</h5>
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                </button>--}}
            </div>
            <div class="modal-body">
                <p style="font-size: 18px;font-weight: bold;">
                    {{ \App\Helpers\TranslationHelper::translate('Are Your Sure') }} ?
               </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('dashboard.close')}}</button>
                <button type="button" class="btn btn-danger" id="deny-button"
                        data-url=""
                        data-status="denied"
                >{{ \App\Helpers\TranslationHelper::translate('Deny') }}</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
