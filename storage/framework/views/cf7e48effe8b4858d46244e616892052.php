<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Card Details')); ?>
<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text'=>\App\Helpers\TranslationHelper::translate('card'),'link'=>route('admin.card.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
        ],'button' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

                        <div class="card-body py-4 px-0" dir="<?php echo e(Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'); ?>">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3"><?php echo e(\App\Helpers\TranslationHelper::translate('Card Details')); ?></h4>

                                </div>
<?php if(auth()->guard('admin')->user()->can('card.edit', 'admin')): ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="<?php echo e(route('admin.card.edit', $card->id)); ?>">
                                            <span><?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?></span> &nbsp;
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                               <?php endif; ?>
                            </div>


              <div class="row px-0 mt-3">
                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                <?php echo e(\App\Helpers\TranslationHelper::translate('title in')); ?>  <?php echo e(__('methods.' . $lang)); ?>:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                <?php echo e($card->getTranslation('title',$key)); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Category')); ?>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            <?php echo e($card->categories->name ?? '-'); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('category colid')); ?>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            <?php echo e($card->categorycolid->name ?? '-'); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            
                            <div class="row px-0 mt-3">
                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                <?php echo e(\App\Helpers\TranslationHelper::translate('card in')); ?>  <?php echo e(__('methods.' . $lang)); ?>:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                <?php echo $card->getTranslation('des',$key); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>


<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                <?php echo e(\App\Helpers\TranslationHelper::translate('Images')); ?> :
            </div>


            <div class="col-lg-9 col-md-9 col-sm-9 col-12 text-left details_item">
    <div class="row">
        <?php if($card->getFirstMediaUrl('cards')): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <a href="<?php echo e($card->getFirstMediaUrl('cards')); ?>" target="_blank">
                    <img src="<?php echo e($card->getFirstMediaUrl('cards')); ?>" 
                         alt="card image" 
                         style="width: 100%; height: 150px; object-fit: contain; border-radius: 5px;">
                </a>
            </div>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted"><?php echo e(\App\Helpers\TranslationHelper::translate('No Image Available')); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

        </div>
    </div>
</div> 

<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                <?php echo e(\App\Helpers\TranslationHelper::translate('card Video')); ?> :
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-12 text-left details_item">
    <div class="row">
       <?php if($card->getFirstMediaUrl('cardscard_video')): ?>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <video width="100%" height="150" controls>
            <source src="<?php echo e($card->getFirstMediaUrl('cardscard_video')); ?>" type="video/mp4">
            <?php echo e(\App\Helpers\TranslationHelper::translate('Your browser does not support the video tag.')); ?>

        </video>
    </div>
<?php else: ?>
    <div class="col-12">
        <p class="text-muted"><?php echo e(\App\Helpers\TranslationHelper::translate('No Video Available')); ?></p>
    </div>
<?php endif; ?>

    </div>
</div>

        </div>
    </div>
</div>






                            

        


                        </div>


                    </div>

                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/pages/card/show.blade.php ENDPATH**/ ?>