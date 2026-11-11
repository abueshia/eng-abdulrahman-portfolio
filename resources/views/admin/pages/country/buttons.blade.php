{{--@can('countries.view_details')--}}
  @if (auth()->guard('admin')->user()->can('countries.read', 'admin'))
<a href="{{route('admin.country.show',['country'=>$country->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('countries.edit')--}}
  @if (auth()->guard('admin')->user()->can('countries.edit', 'admin'))
<a href="{{route('admin.country.edit',['country'=>$country->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('countries.delete')--}}
  @if (auth()->guard('admin')->user()->can('countries.delete', 'admin'))
<button type="button" data-url="{{route('admin.country.destroy',['country'=>$country->id])}}"
   data-item-id="{{ $country->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
