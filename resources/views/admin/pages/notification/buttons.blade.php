   {{-- @if (auth()->guard('admin')->user()->can('notification.view_details', 'admin'))
<a href="{{route('admin.notification.show',['notification'=>$notification->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
   @if (auth()->guard('admin')->user()->can('notification.edit', 'admin'))
<a href="{{route('admin.notification.edit',['notification'=>$notification->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif

   @if (auth()->guard('admin')->user()->can('notification.delete', 'admin'))
<button type="button" data-url="{{route('admin.notification.destroy',['notification'=>$notification->id])}}"
   data-item-id="{{ $notification->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif --}}
 
<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
