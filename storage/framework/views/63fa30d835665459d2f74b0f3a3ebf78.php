<?php $__env->startSection('estilos'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/footable.core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/footable.metro.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/footable.js')); ?>"></script>
    <script src="<?php echo e(asset('js/footable.sort.js')); ?>"></script>
    <script src="<?php echo e(asset('js/footable.paginate.js')); ?>"></script>

    <script type="text/javascript">
        $(function () {
            $('.footable').footable();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContainer'); ?>
    <section class="container-fluid main-container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4><b><?php echo trans('applicationResource.admin.lastMol'); ?></b></h4>
                    </div>
                </div>
                <?php echo $__env->make('admin.adminMenuPartial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

        <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                    <hr>
                        <table class="footable table" data-sort="false" data-page-size="5">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th data-hide="phone"><?php echo trans('applicationResource.confirm.ref'); ?></th>
                                <th data-hide="phone"><?php echo trans('applicationResource.criteria.createdAt'); ?></th>
                                <th data-hide="phone"><?php echo trans('applicationResource.criteria.family'); ?></th>
                                <th data-hide="phone"><?php echo trans('applicationResource.criteria.subFamily'); ?></th>
                                <th data-hide="phone"><?php echo trans('applicationResource.criteria.subSubFamily'); ?></th>
                                <th data-hide="phone"></th>
                            </tr>

                            </thead>

                            <tbody>
                            <?php for($i = 0; $i < sizeof($molecules); $i++): ?>
                                <tr>
                                    <td><?php echo e($molecules[$i]->id); ?></td>
                                    <td><?php echo e($molecules[$i]->reference); ?></td>
                                    <td><?php echo e($molecules[$i]->created_at); ?></td>
                                    <td><?php echo e($molecules[$i]->family); ?></td>
                                    <td><?php echo e($molecules[$i]->subFamily); ?></td>
                                    <td><?php echo e($molecules[$i]->subSubFamily); ?></td>
                                    <td><a href="<?php echo url('admin/molEdit',$molecules[$i]->id); ?>"
                                           class="btn btn-danger"
                                           role="button"><?php echo trans('applicationResource.button.view'); ?></a></td>
                                </tr>
                            <?php endfor; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="pagination center-block"></div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/usuario/Downloads/C14-CORREGIDO/C14-main-2/resources/views/admin/adminLastMolecules.blade.php ENDPATH**/ ?>