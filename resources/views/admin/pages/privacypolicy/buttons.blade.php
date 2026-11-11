 @if (auth()->guard('admin')->user()->can('privacypolicy.view_details', 'admin'))
<a href="{{route('admin.privacypolicy.show',['privacypolicy'=>$privacypolicy->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif

 @if (auth()->guard('admin')->user()->can('privacypolicy.edit', 'admin'))
<a href="{{route('admin.privacypolicy.edit',['privacypolicy'=>$privacypolicy->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif

{{--@can('place_privacypolicys.delete')--}}
 {{-- @if (auth()->guard('admin')->user()->can('privacypolicy.delete', 'admin'))
<button type="button" data-url="{{route('admin.privacypolicy.destroy',['privacypolicy'=>$privacypolicy->id])}}"
   data-item-id="{{ $privacypolicy->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button> --}}
{{-- @endif --}}
{{-- @endcan --}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
