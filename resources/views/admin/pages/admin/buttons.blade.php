
{{-- @can('admins.edit') --}}
  @if (auth()->guard('admin')->user()->can('admins.edit', 'admin'))

<a href="{{route('admin.admin.edit',['admin'=>$admin->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
{{-- @endcan --}}
@endif
  @if (auth()->guard('admin')->user()->can('admins.delete', 'admin'))
{{-- @can('admins.delete') --}}
<button type="button" data-url="{{route('admin.admin.destroy',['admin'=>$admin->id])}}"
   data-item-id="{{ $admin->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{-- @endcan --}}
@endif
<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
