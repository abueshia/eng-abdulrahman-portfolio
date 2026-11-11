{{--@can('place_paintscategorys.view_details')--}}
   @if (auth()->guard('admin')->user()->can('paintscategory.view_details', 'admin'))
<a href="{{route('admin.paintscategory.show',['paintscategory'=>$paintscategory->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_paintscategorys.edit')--}}
   @if (auth()->guard('admin')->user()->can('paintscategory.edit', 'admin'))
<a href="{{route('admin.paintscategory.edit',['paintscategory'=>$paintscategory->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}

{{--@can('place_paintscategorys.delete')--}}
   @if (auth()->guard('admin')->user()->can('paintscategory.delete', 'admin'))
<button type="button" data-url="{{route('admin.paintscategory.destroy',['paintscategory'=>$paintscategory->id])}}"
   data-item-id="{{ $paintscategory->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
