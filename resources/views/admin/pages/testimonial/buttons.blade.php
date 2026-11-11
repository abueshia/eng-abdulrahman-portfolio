{{--@can('place_testimonials.view_details')--}}
 {{-- @if (auth()->guard('admin')->user()->can('testimonial.view_details', 'admin'))
<a href="{{route('admin.testimonial.show',['testimonial'=>$testimonial->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif --}}
{{--@endcan--}}
{{--@can('place_testimonials.edit')--}}
 {{-- @if (auth()->guard('admin')->user()->can('testimonial.edit', 'admin'))
<a href="{{route('admin.testimonial.edit',['testimonial'=>$testimonial->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif --}}
{{--@can('place_testimonials.delete')--}}
 @if (auth()->guard('admin')->user()->can('testimonial.delete', 'admin'))
<button type="button" data-url="{{route('admin.testimonial.destroy',['testimonial'=>$testimonial->id])}}"
   data-item-id="{{ $testimonial->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
