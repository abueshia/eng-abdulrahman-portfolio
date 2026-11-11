{{--@can('message_messages.view_details')--}}
@if (auth()->guard('admin')->user()->can('messages.view_details', 'admin'))
<a href="{{route('admin.message.show',['message'=>$message->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('message_messages.edit')--}}
{{-- <a href="{{route('admin.message.edit',['message'=>$message->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a> --}}
{{--@endcan--}}

{{--@can('message_messages.delete')--}}
@if (auth()->guard('admin')->user()->can('messages.delete', 'admin'))
<button type="button" data-url="{{route('admin.message.destroy',['message'=>$message->id])}}"
   data-item-id="{{ $message->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
