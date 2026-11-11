{{--@can('place_clients.view_details')--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    

{{-- @if (auth()->guard('admin')->user()->can('client.create', 'admin'))
<a href="{{ route('admin.client.create.points', ['client' => $client->id]) }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ \App\Helpers\TranslationHelper::translate('Add Points') }}">
    <i class="bi bi-plus-circle"></i> <!-- أيقونة دائرة تحتوي على + -->
</a>
@endif --}}

@if (auth()->guard('admin')->user()->can('client.create', 'admin'))
<a href="{{ route('admin.client.create.points', ['client' => $client->id]) }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" 
   title="{{ \App\Helpers\TranslationHelper::translate('Add Points') }}">
<i class="bi bi-plus-circle fs-1"></i></a>
@endif

@if (auth()->guard('admin')->user()->can('client.view_details', 'admin'))
<a href="{{route('admin.client.show',['client'=>$client->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_clients.edit')--}}
@if (auth()->guard('admin')->user()->can('client.edit', 'admin'))
<a href="{{route('admin.client.edit',['client'=>$client->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@can('place_clients.delete')--}}
@if (auth()->guard('admin')->user()->can('client.delete', 'admin'))
<button type="button" data-url="{{route('admin.client.destroy',['client'=>$client->id])}}"
   data-item-id="{{ $client->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}


<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
