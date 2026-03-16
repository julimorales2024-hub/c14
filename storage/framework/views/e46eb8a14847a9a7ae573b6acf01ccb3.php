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
    <script type="text/javascript">
        function selectAll() {
            var checkboxs=document.getElementsByClassName('checkEliminar');
            if (document.getElementById('checkAll').checked==true) {
                for (var i = 0; i < checkboxs.length; i++) {
                    checkboxs[i].checked=true;
                }
            }
            else{
                for (var i = 0; i < checkboxs.length; i++) {
                    checkboxs[i].checked=false;
                }
            }
            
            
        }

        function areCheckAll() {
            var comprobar=true;
            var checkboxs=document.getElementsByClassName('checkEliminar');
            for (var i = 0; i < checkboxs.length; i++) {
                if(checkboxs[i].checked==false){
                    comprobar=false;
                }
            }
            if(comprobar){ 
                document.getElementById('checkAll').checked=true;
            }else{
                document.getElementById('checkAll').checked=false;
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>
    <section class="container-fluid main-container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">


                <div class="row ">
                    <div class="col-xs-12 text-center">
                        <h4><b><?php echo trans('applicationResource.admin.edit'); ?></b></h4>
                    </div>
                </div>

                

                <?php echo $__env->make('admin.adminMenuPartial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <br>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('admin/search')); ?>"
                      onsubmit="showLoading()">
                    <?php echo csrf_field(); ?>
                    <hr class="col-xs-12 invisible">

                    <div class="form-group row">
                        <label class="col-xs-offset-4 col-xs-1 col-sm-offset-3 col-sm-2 control-label ">Id</label>
                        <div class="col-xs-4 col-sm-2">
                            <input type="text" class="form-control  input-sm" id="id" name="id">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xs-offset-4 col-xs-1 col-sm-offset-3 col-sm-2 control-label">Ref</label>
                        <div class="col-xs-4 col-sm-2">
                            <input type="text" class="form-control input-sm" id="reference" name="reference">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 text-center">
                            <button type="submit" name="submitBtn" value="submitBtn" class="btn btn-danger">
                                <?php echo trans('applicationResource.form.buscar'); ?>

                            </button>
                        </div>
                    </div>
                </form>
                
                <?php if(session('message')): ?>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4 class="help-block">
                                <strong style="color: red;"><?php echo trans('applicationResource.errors.busquedaNull'); ?></strong>
                            </h4>
                        </div>
                    </div>
                <?php endif; ?>
                



                <?php if(isset($molecules)): ?>

                    <?php if(count($molecules)>0): ?>
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <?php echo e(Form::open(array('method' => 'DELETE', 'action' => 'AdminSearchController@destroy'))); ?>

                                <table class="footable table tablet footable-loaded" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th class="footable-visible footable-first-column">ID</th>
                                            <th class="footable-visible">Reference</th>
                                            <th class="footable-visible">Edit</th>
                                            <th class="footable-visible footable-last-column">
                                                <input type="checkbox" id="checkAll" onclick="selectAll()">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $molecules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo $reference->id; ?></td>
                                            <td><?php echo $reference->reference; ?></td>
                                            <td><a href="<?php echo url('admin/molEdit/'.$reference->id); ?>"
                                                   class="btn btn-danger "
                                                   role="button"><?php echo trans('applicationResource.button.view'); ?></a>
                                            </td>
                                            <td><input type="checkbox" name="check[]" property="check" class="checkEliminar" value="<?php echo $reference->id; ?>" onclick="areCheckAll()"></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <input type="text" hidden="true" name="reference" value="<?php echo $reference->reference; ?>">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <div class="pagination pagination-centered"></div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <hr class="invisible">
                                <div class="row text-center">
                                    <div class="col-xs-12">
                                        <button type="submit" name="" value="removeBtn" class="btn btn-md btn-danger">
                                            <?php echo trans('applicationResource.button.delete'); ?>

                                        </button>
                                    </div>
                                </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h4 class="help-block">
                                    <strong style="color: red;"><?php echo trans('applicationResource.errors.deleteOk'); ?></strong>
                                </h4>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                <?php endif; ?>


                <?php if(isset($references)): ?>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4 class="help-block">
                                <strong style="color: red;"><?php echo trans('applicationResource.errors.reference'); ?></strong>
                            </h4>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($errors->has('emptyError')): ?>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4 class="help-block">
                                <strong style="color: red;"><?php echo trans('applicationResource.errors.requeridos'); ?></strong>
                            </h4>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/usuario/Downloads/C14-CORREGIDO/C14-main-2/resources/views/admin/adminSearch.blade.php ENDPATH**/ ?>