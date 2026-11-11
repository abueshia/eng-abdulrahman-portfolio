@if($user_package->is_active == 1)
    <span class="badge badge-success">
        {{\App\Helpers\TranslationHelper::translate('Active')}}
    </span>
@else
    <span class="badge badge-danger">
        {{\App\Helpers\TranslationHelper::translate('Not Active')}}
    </span>
@endif
