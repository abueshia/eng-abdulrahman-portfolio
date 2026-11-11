<?php $__env->startPush('admin_css'); ?>
    <link href="<?php echo e(asset('dashboard/assets/css/tags-input.min.css')); ?>" rel="stylesheet">

<?php $__env->stopPush(); ?>

<?php if($method == 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Product')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Add Product')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Products'), 'link' => route('admin.product.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Product'), 'link' => route('admin.product.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bread-crumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BreadCrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2072a121b282e859e8bdea9c58b76d8)): ?>
<?php $attributes = $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8; ?>
<?php unset($__attributesOriginalc2072a121b282e859e8bdea9c58b76d8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2072a121b282e859e8bdea9c58b76d8)): ?>
<?php $component = $__componentOriginalc2072a121b282e859e8bdea9c58b76d8; ?>
<?php unset($__componentOriginalc2072a121b282e859e8bdea9c58b76d8); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <!--begin::Card body-->

                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php if($method == 'PUT'): ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">

                            <?php endif; ?>
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Name in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="<?php echo e(old('name.'.$key) ?? $product->getTranslation('name',$key)); ?>"
                                                       placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('Name in')); ?> <?php echo e(__('methods.' . $lang)); ?>"
                                                       name="name[<?php echo e($key); ?>]"/>
                                                <?php $__errorArgs = ['name.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




 


                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Description in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                                    :
                                                </label>
                                    
                                                <textarea class="form-control form-control-solid" rows="4"
                                                          placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('Description in')); ?> <?php echo e(__('methods.' . $lang)); ?>"
                                                          name="description[<?php echo e($key); ?>]"><?php echo e(old('description.'.$key) ?? $product->getTranslation('description',$key)); ?></textarea>
                                                <?php $__errorArgs = ['description.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          

                                         <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('Choose Category')); ?> :
        <span class="text-danger">*</span>
    </label>
    <select name="productcategory_id" id="productcategory_id" class="form-control form-control-solid">
        <option value=""><?php echo e(\App\Helpers\TranslationHelper::translate('Choose Category')); ?></option>
        <?php $__currentLoopData = $productcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
            <option value="<?php echo e($category->id); ?>" 
                    <?php echo e(old('productcategory_id', isset($product->productcategory_id) ? $product->productcategory_id : null) == $category->id ? 'selected' : ''); ?>>
                <?php echo e($category->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['productcategory_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger" role="alert">
        <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

                                        

                                        

   
 

<div class="col-6 mb-5">
    <!-- Label -->
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('Image')); ?>:
        <span class="text-danger">
            <?php echo e(\App\Helpers\TranslationHelper::translate('Size')); ?> <span dir="ltr">400 x 400</span>
        </span>
    </label>

    <!-- رفع صور جديدة -->
    <input type="file" class="form-control form-control-solid" name="images[]" multiple />
    <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<?php echo e(\App\Helpers\TranslationHelper::translate("Error")); ?>',
                text: '<?php echo e($message); ?>',
            });
        </script>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <!-- عرض الصور -->
    <div class="mt-3">
        <label class="fs-6 fw-bold">
            <?php echo e(\App\Helpers\TranslationHelper::translate('Uploaded Images')); ?>:
        </label>
        <div class="row mt-2">
            <?php $__currentLoopData = $product->getMedia('products'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 col-sm-4 col-6 mb-3 text-center">
                    <a href="<?php echo e($media->getUrl()); ?>" target="_blank">
                        <img src="<?php echo e($media->getUrl()); ?>" 
                             alt="product" 
                             class="img-fluid img-thumbnail" 
                             style="width: 150px; height: 150px; object-fit: contain;">
                    </a>
                    <!-- زر حذف الصورة -->
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-image-btn" data-url="<?php echo e(route('admin.product.media.delete', $media->id)); ?>">
                        <?php echo e(\App\Helpers\TranslationHelper::translate('Delete')); ?>

                    </button>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
                                    
                                                                            </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Save')); ?></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>


                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
    <!--end::Content-->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('admin_js'); ?>


<script src="<?php echo e(asset('dashboard/assets/js/tags-input.min.js')); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>
$(document).ready(function() {
    console.log("Document is ready");
    $('#productcategory_id').select2({
        placeholder: "<?php echo e(\App\Helpers\TranslationHelper::translate('Choose Category')); ?>",
        allowClear: true
    });
});

</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-image-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // منع إعادة تحميل الصفحة

                const url = this.dataset.url;

                // إظهار نافذة التأكيد
                Swal.fire({
                    title: '<?php echo e(\App\Helpers\TranslationHelper::translate("Are you sure?")); ?>',
                    text: '<?php echo e(\App\Helpers\TranslationHelper::translate("This action cannot be undone.")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<?php echo e(\App\Helpers\TranslationHelper::translate("Yes, delete it!")); ?>',
                    cancelButtonText: '<?php echo e(\App\Helpers\TranslationHelper::translate("Cancel")); ?>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // تنفيذ طلب الحذف باستخدام fetch API
                        fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                // إظهار رسالة نجاح
                                Swal.fire(
                                    '<?php echo e(\App\Helpers\TranslationHelper::translate("Deleted!")); ?>',
                                    '<?php echo e(\App\Helpers\TranslationHelper::translate("Your image has been deleted.")); ?>',
                                    'success'
                                ).then(() => {
                                    location.reload(); // تحديث الصفحة بعد الحذف
                                });
                            } else {
                                Swal.fire(
                                    '<?php echo e(\App\Helpers\TranslationHelper::translate("Error!")); ?>',
                                    '<?php echo e(\App\Helpers\TranslationHelper::translate("Unable to delete the image.")); ?>',
                                    'error'
                                );
                            }
                        }).catch(error => {
                            Swal.fire(
                                '<?php echo e(\App\Helpers\TranslationHelper::translate("Error!")); ?>',
                                '<?php echo e(\App\Helpers\TranslationHelper::translate("Something went wrong.")); ?>',
                                'error'
                            );
                        });
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/product/form.blade.php ENDPATH**/ ?>