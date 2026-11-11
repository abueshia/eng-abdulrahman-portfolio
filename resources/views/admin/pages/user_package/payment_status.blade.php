@if($user_package->payment_status == 'paid')
    <span class="badge badge-success">
        {{\App\Helpers\TranslationHelper::translate('Paid')}}
    </span>
@else
    <span class="badge badge-danger">
        {{\App\Helpers\TranslationHelper::translate('Un Paid')}}
    </span>
@endif
