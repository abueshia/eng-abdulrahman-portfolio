@can('documents.view_details')
<a href="{{route('admin.document.show',['document'=>$document->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endcan
@can('documents.edit')
<a href="{{route('admin.document.edit',['document'=>$document->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endcan
@can('documents.delete')
<button type="button" data-url="{{route('admin.document.destroy',['document'=>$document->id])}}"
   data-item-id="{{ $document->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
