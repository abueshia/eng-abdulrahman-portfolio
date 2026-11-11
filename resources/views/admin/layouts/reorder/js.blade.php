<script src="{{ asset('dashboard/assets/js/jquery-ui-dist/jquery-ui.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('dashboard/assets/js/nestedSortable/jquery.mjs.nestedSortable2.js') }}" type="text/javascript" ></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        // initialize the nested sortable plugin
        $('.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            maxLevels: "{{$max}}",
            isTree: true,
            expandOnHover: 700,
            startCollapsed: false
        });

        $('.disclose').on('click', function() {
            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
        });

        $('#toArray').click(function(e){
            // get the current tree order
            arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});

            // log it
            // console.log(arraied);
            // send it with POST
            $.ajax({
                url: "{{$route}}",
                type: 'POST',
                data: {
                    tree: arraied,
                    _token: "{{csrf_token()}}",

                },
            })
                .done(function() {
                    // alert('success');
                    Swal.fire({
                        title: '{{\App\Helpers\TranslationHelper::translate('Done')}}',
                        icon : 'success',
                        text : '{{\App\Helpers\TranslationHelper::translate('Done, Sorting Has Been Saved')}}',
                        confirmButtonColor : '#009EF7',
                    });
                    // new Noty({
                    //     type: "success",
                    //     text: "<strong>Done</strong><br>Sorting Has Been Saved"
                    // }).show();
                })
                .fail(function() {
                    Swal.fire({
                        title: 'Fail!',
                        icon : 'danger',
                        text : 'Fail, Some Error Happened .. Please Try Again Later',
                        confirmButtonColor : '#009EF7',
                    });
                    // alert('fail');
                    // new Noty({
                    //     type: "error",
                    //     text: "<strong>Error</strong><br>Sorting Has Not Been Saved"
                    // }).show();
                })
                .always(function() {
                    console.log("complete");
                });

        });

        $.ajaxPrefilter(function(options, originalOptions, xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
            }
        });

    });
</script>
