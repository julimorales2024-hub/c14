<?php $__env->startSection('estilos'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fileinput.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/fileinput.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>

    <section class="container-fluid main-container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">


                <div class="row text-center">
                    <div class="col-xs-12">
                        <h4><b><?php echo trans('applicationResource.admin.excel'); ?></b></h4>
                    </div>
                </div>

                <?php echo $__env->make('admin.adminMenuPartial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <br>

                <form class="form-horizontal" action="<?php echo url('/admin/upload'); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-sm-offset-3 text-center">
                            <label class="control-label"><?php echo trans('applicationResource.admin.selectFile'); ?></label>
                            <input id="input-1" type="file" name="file" class="file">
                            <?php if($errors->has('file')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('file')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr class="invisible">
                    <!--<div class="row">
                        <div class="col-xs-12 text-center">
                            <button class="btn btn-danger" type="submit"><?php echo trans('applicationResource.button.upload'); ?></button>
                        </div>
                    </div>-->

                </form>

                <?php if(isset($logResults)): ?>
                    <div class="row previousResult">
                        <p>Carga de datos realizada con exito</p>
                        <p>Resultados:</p>
                        <div class="col-xs-offset-2 col-xs-8 logResult" style="overflow-y: scroll ">
                            <p><?php echo nl2br($logResults); ?></p>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/usuario/Downloads/C14-CORREGIDO/C14-main-2/resources/views/admin/upload.blade.php ENDPATH**/ ?>