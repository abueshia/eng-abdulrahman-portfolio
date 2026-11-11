<!DOCTYPE html>
<html class="no-js" lang="<?php echo e(app()->getLocale()); ?>">
<head>


    <link
        href="https://fonts.googleapis.com/css2?family=Arial&family=Courier+New&family=Georgia&family=Times+New+Roman&family=Verdana&family=Tahoma&family=Trebuchet+MS&family=Comic+Sans+MS&family=Lucida+Console&family=Impact&display=swap"
        rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>

     <?php echo $__env->yieldContent('meta'); ?>

    <?php if(LaravelLocalization::getCurrentLocale() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('front/assets/css/style_ar.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('front/assets/css/style_en.css')); ?>">
    <?php endif; ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@400;700&display=swap');
    </style>
    

    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>silverblue</title>
    
       <meta name="description" content="<?php echo e($title ?? ''); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!-- Place favicon.ico in the root directory -->
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="<?php echo e(asset('front/assets/img/logo/Silver-blue.png')); ?>"
    />
<link rel="stylesheet" href="<?php echo e(asset('front/assets/css/bootstrap.min.css')); ?>"/>

    
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="icon" href="<?php echo e(asset('front/assets/img/logo/Silver-blue.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.css"
        integrity="sha512-ryx4QW6sYyQthh6MIGW1cDEfNuIwTsvWtORXg5t3sqmh3TSNmqMr+VBN5N0T+z0GqqsiDJ5O8YhP4diuBGmcrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <?php echo $__env->yieldPushContent('color_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('front/assets/css/style.css')); ?>"/>
    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('front/assets/css/style_ar.css')); ?>"/>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('css'); ?>

   

</head>

<body class="grey-bg">

 

<!-- preloader -->
<div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div>

<!-- preloader end  -->

<!-- back-to-top-start  -->

<!-- back-to-top-end  -->

<!-- it-offcanvus-area-start -->




<?php echo $__env->make('front.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main>

    <?php echo $__env->yieldContent('content'); ?>

</main>

<?php echo $__env->make('front.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- JS here -->


   <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.js"
        integrity="sha512-QokzG/B/9i5X3BYbmuyNn2ah9EiApK5KY4saOYZRCQINuB+X52ED0L3RCc/1x7YUA85qaFZ9uoB4x5SmkLGCJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo e(asset('front/assets/js/bootstrap.bundle.min.js')); ?>"></script> <!-- Local bootstrap JS file -->
    <script src="<?php echo e(asset('front/assets/js/jquery-3.7.1.js')); ?>"></script> <!-- Local jQuery file -->
    <script src="<?php echo e(asset('front/assets/js/main.js')); ?>"></script> <!-- User-defined JS file -->
    <script>
        AOS.init();
    </script>

<script>
    $(document).on("click", ".add-flight-btn", function () {
        console.log("Add Flight button clicked");

        // Allow a maximum of 3 flight fields
        if ($(".multi-flight-field").length < 3) {
            $(".multi-flight-field:last")
                .clone()
                .insertAfter(".multi-flight-field:last");
        }

        // Ensure delete button shows up for the last field
        $(this)
            .closest(".multi-flight-wrap")
            .find(".multi-flight-field:last")
            .children(".multi-flight-delete-wrap")
            .show();

   
        $(".date-multi-picker").each(function (index) {
            var $this = $(this);
            $this.attr("id", "date_" + index); // Assign unique ID

        });
        $('input[name="daterange_single[]"]').daterangepicker(
            {
                singleDatePicker: true,
                opens: "center",
            },
            function (start, end, label) {
                console.log(
                    "A new date selection was made: " + start.format("YYYY-MM-DD")
                );
            }
        );

    });

    $(document).on("click", ".multi-flight-remove", function () {
        $(".multi-flight-remove")
            .closest(".multi-flight-wrap")
            .find(".multi-flight-field")
            .not(":first")
            .last()
            .remove();
    });

    $('#hotel_check_in').daterangepicker(
        {
            singleDatePicker: true,
            opens: "center",
        },
        function (start, end, label) {
            console.log(
                "A new date selection was made: " + start.format("YYYY-MM-DD")
            );
        }
    );

    $('#hotel_check_out').daterangepicker(
        {
            singleDatePicker: true,
            opens: "center",
        },
        function (start, end, label) {
            console.log(
                "A new date selection was made: " + start.format("YYYY-MM-DD")
            );
        }
    );


    function addHotelRoom() {

        let parent_div = $("#parent_item");
        let rooms_count = parent_div.find('.room_item').length;
        let new_count = rooms_count + 1;
        if (new_count < 7) {
            parent_div.append("<div class=\"row room_item\">\n" +
                "                                                                <div class=\"col-lg-2 col-3 p-2 black_color fw-bold\">\n" +
                "                                                                    <img src=\"<?php echo e(asset('front/assets/img/bedroom.png')); ?>\" alt=\"bedroom\" style=\"width: 30px;\">\n" +
                "                                                                    <span>Room</span>&nbsp;\n" +
                "                                                                    <span class=\"room_number\">" + new_count +
                "</span>\n" +
                "                                                                </div>\n" +
                "                                                                <div class=\"col-lg-2 col-3 p-2 text-center\">\n" +
                "                                                                    <div class=\"qtyBtn align-items-center\">\n" +
                "                                                                        <div class=\"qtyDec\">\n" +
                "                                                                            <i class=\"fas fa-minus\"></i>\n" +
                "                                                                        </div>\n" +
                "                                                                        <input\n" +
                "                                                                            type=\"text\"\n" +
                "                                                                            name=\"adult_number[]\"\n" +
                "                                                                            value=\"0\"\n" +
                "                                                                            class=\"qty-input\"" +
                " onchange='updateRoomPersons()' >\n" +
                "                                                                        <div class=\"qtyInc\">\n" +
                "                                                                            <i class=\"fas fa-plus\"></i>\n" +
                "                                                                        </div>\n" +
                "                                                                    </div>\n" +
                "                                                                </div>\n" +
                "                                                                <div class=\"col-lg-2 col-3 p-2 text-center\">\n" +
                "                                                                    <div\n" +
                "                                                                        class=\"qtyBtn align-items-center\"\n" +
                "                                                                    >\n" +
                "                                                                        <div class=\"qtyDec\">\n" +
                "                                                                            <i class=\"fas fa-minus\"></i>\n" +
                "                                                                        </div>\n" +
                "                                                                        <input\n" +
                "                                                                            type=\"text\"\n" +
                "                                                                            name=\"child_number[]\"\n" +
                "                                                                            value=\"0\"\n" +
                "                                                                            class=\"qty-input\"\n" +
                "                                                                        onchange='updateRoomPersons()' />\n" +
                "                                                                        <div class=\"qtyInc\">\n" +
                "                                                                            <i class=\"fas fa-plus\"></i>\n" +
                "                                                                        </div>\n" +
                "                                                                    </div>\n" +
                "                                                                </div>\n" +
                "                                                                <div class=\"col-lg-6 col-3 p-2 text-end\">" +
                "<button type=\"button\" class=\"remove_btn\" onclick=\"removeRoom(this)\">\n" +
                "                                                                        <i class=\"fas fa-remove\"></i>\n" +
                "                                                                    </button>" +
                "</div>\n" +
                "                                                            </div>");
        }
    }


    function removeRoom(room_btn) {
        let room_row = $(room_btn).closest('.room_item');
        room_row.remove();
    }

    function updateRoomPersons() {
        let room_adults = $('#room_adults');
        let adult_number = $("input[name='adult_number[]']");
        let adult_number_sum = 0;
        adult_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            adult_number_sum += value;
        });
        room_adults.text(adult_number_sum);
        // alert(adult_number_sum);

        let room_children = $('#room_children');
        let child_number = $("input[name='child_number[]']");
        let child_number_sum = 0;
        child_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            child_number_sum += value;
        });
        room_children.text(child_number_sum);
        // alert(child_number_sum);
    }

    function updateFlightPersons() {
        let room_adults = $('#room_adults');
        let adult_number = $("input[name='adult_number[]']");
        let adult_number_sum = 0;
        adult_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            adult_number_sum += value;
        });
        room_adults.text(adult_number_sum);
        // alert(adult_number_sum);

        let room_children = $('#room_children');
        let child_number = $("input[name='child_number[]']");
        let child_number_sum = 0;
        child_number.each(function () {
            let value = parseFloat($(this).val()) || 0; // Get the value or default to 0 if invalid
            child_number_sum += value;
        });
        room_children.text(child_number_sum);
        // alert(child_number_sum);
    }

</script>

<?php echo $__env->yieldPushContent('js'); ?>

<?php if(Session::has('error')): ?>
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                text: "<?php echo e(Session::get('error')); ?>",
                dangerMode: true,
                confirmButtonColor: '#e98f33',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'حسنا',
                showCloseButton: true,
            });
        });
    </script>
<?php endif; ?>
<?php if(session('success')): ?>
    <script>
        // console.log('Done')
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                text: "<?php echo e(Session::get('success')); ?>",
                dangerMode: true,
                confirmButtonColor: '#e98f33',
                confirmButtonText: 'Thanks!!',
                showCloseButton: true,
            });
        });
    </script>
<?php endif; ?>

<script>
    function submitLogout() {
        // alert()
        let logout_form = $("#logout_form");
        logout_form.submit();
    }
</script>

</body>
</html>
<?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/layouts/app.blade.php ENDPATH**/ ?>