<?php $__env->startSection('estilos'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/footable.core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/footable.metro.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/footable.js')); ?>"></script>
    <script src="<?php echo e(asset('js/footable.sort.js')); ?>"></script>
    <script type="text/javascript">
        $(function () {
            $('.footable').footable();
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#checkAll').click(function(){
                $('.checkConfirm').prop('checked',this.checked);
            })
        })


    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>
    <section class="container-fluid main-container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4><b><?php echo trans('applicationResource.admin.confirm'); ?></b></h4>
                    </div>
                </div>

                <?php echo $__env->make('admin.adminMenuPartial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="footable table" data-sort="false">
                                        <thead>
                                        <tr>
                                            <th><?php echo trans('applicationResource.confirm.id'); ?></th>
                                            <th><?php echo trans('applicationResource.confirm.ref'); ?></th>
                                            <th data-hide="phone"><?php echo trans('applicationResource.confirm.created'); ?></th>
                                            <th data-hide="phone"><?php echo trans('applicationResource.confirm.mod'); ?></th>
                                            <th data-hide="phone"><?php echo trans('applicationResource.confirm.edit'); ?></th>
                                            <th data-hide="phone"><input type="checkbox" id="checkAll"></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $__currentLoopData = $molecules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $molecule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo $molecule->id; ?></td>
                                                <td><?php echo $molecule->reference; ?></td>
                                                <td><?php echo $molecule->created_at; ?></td>
                                                <td><?php echo $molecule->updated_at; ?></td>
                                                <td><a class="btn btn-danger btn-md"
                                                       href="<?php echo url('admin/molEdit/'.$molecule->id); ?>"><?php echo trans('applicationResource.confirm.edit'); ?></a>
                                                </td>
                                                <td><input class="checkConfirm" type="checkbox"
                                                           name="check[<?php echo $molecule->id; ?>]"
                                                           value="<?php echo $molecule->id; ?>"></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <?php echo $molecules->render(); ?>

                        </div>
                    </div>

                    <div id="alert" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo trans('applicationResource.dialog.sure'); ?></h4>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo trans('applicationResource.dialog.confirm'); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger"><?php echo trans('applicationResource.confirm.confirm'); ?></button>
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal"><?php echo trans('applicationResource.button.cancel'); ?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <button class="btn btn-danger btn-md confirm-btn" data-toggle="modal"
                        data-target="#alert"><?php echo trans('applicationResource.button.confirm'); ?> </button>
            </div>
        </div>


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/usuario/Downloads/C14-CORREGIDO/C14-main-2/resources/views/admin/adminConfirmMolecule.blade.php ENDPATH**/ ?>