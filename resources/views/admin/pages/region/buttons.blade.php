{{--@can('regions.view_details')--}}
  @if (auth()->guard('admin')->user()->can('regions.read', 'admin'))
<a href="{{route('admin.region.show',['region'=>$region->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('regions.edit')--}}
  @if (auth()->guard('admin')->user()->can('regions.edit', 'admin'))
<a href="{{route('admin.region.edit',['region'=>$region->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('regions.delete')--}}
  @if (auth()->guard('admin')->user()->can('regions.delete', 'admin'))
<button type="button" data-url="{{route('admin.region.destroy',['region'=>$region->id])}}"
   data-item-id="{{ $region->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
