<?php $__env->startSection('headers'); ?>
    <?php
    header("Cache-Control: no-store, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/spin.js')); ?>"></script>
    <script src="<?php echo e(asset('js/loadingScreen.js')); ?>"></script>
    <script src="<?php echo e(asset('js/loadFamilies.js')); ?>"></script>

    <script type="text/javascript">
        var currentMolData  = '';
        var sketcherReady   = false;

        window.addEventListener('message', function(e) {
            if (!e.data || e.data.type !== 'chemlab_update') return;
            currentMolData = e.data.mol || '';
            sketcherReady  = true;
            var count = e.data.atomCount || 0;
            var badge = document.getElementById('atomBadge');
            if (badge) {
                badge.textContent = count + ' átomo' + (count !== 1 ? 's' : '');
                badge.style.display = count > 0 ? 'inline-block' : 'none';
            }
        });

        function submitForm() {
            var tieneDibujo = (currentMolData && currentMolData.trim() !== '');
            document.getElementById('smileCode').value = tieneDibujo ? currentMolData : '';
            document.getElementById('jmeCode').value   = tieneDibujo ? currentMolData : '';
            return true;
        }

        function clearSketcher() {
            var frame = document.getElementById('chemlabFrame');
            if (frame && frame.contentWindow) {
                frame.contentWindow.postMessage({ type: 'chemlab_clear' }, '*');
            }
            currentMolData = '';
        }
        
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>
    <style>
        .main-container {
            max-width: 90% !important;
            width: 100% !important;
            padding-top: 30px !important;
        }

        .chemlab-outer-wrapper {
            position: relative;
            width: 100%;
            background: #fff;
        }

        .chemlab-wrapper {
            width: 100%;
            height: calc(85vh - 160px);
            min-height: 500px;
            border: 1px solid #dde8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .chemlab-wrapper iframe {
            border: none;
            display: block;
            width: 100%;
            height: 100%;
        }

        .molab-patch {
            position: absolute;
            top: 0;
            left: 0;
            width: 190px; 
            height: 40px;
            background-color: #f8fbfe; 
            z-index: 999;
            display: flex;
            align-items: center;
            padding-left: 14px;
            pointer-events: none;
            border-right: 1px solid #e1e8ed; 
            border-bottom: 1px solid #e1e8ed;
        }

        .molab-patch .mol-text { color: #4A90E2; font-family: "Segoe UI", Arial, sans-serif; font-size: 17px; font-weight: bold; }
        .molab-patch .pro-text { color: #5cb85c; font-family: "Segoe UI", Arial, sans-serif; font-size: 17px; margin-left: 3px; }

        .form-col { padding-top: 10px; }
        .form-col label { font-size: 16px !important; font-weight: bold; display: block; }
        
        .family-container {
            margin-top: 25px !important; 
            margin-bottom: 20px;
        }

        .btn-danger { 
            font-size: 19px !important; 
            padding: 12px 35px !important; 
            font-weight: bold !important;
        }
    </style>

    <section class="container main-container">
        <div class="row">
            <div class="col-xs-12 text-center" style="margin-bottom: 10px;">
                <h4 style="margin:0;"><b><?php echo trans('applicationResource.form.busquedas.subestructura'); ?></b></h4>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-8">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:5px;">
                    <span id="atomBadge" style="display:none; background:#e8f4ff; color:#0070aa; border:1px solid #b0d4f0; border-radius:10px; font-size:12px; padding:2px 8px;"></span>
                </div>

                <div class="chemlab-outer-wrapper">
                    <div class="molab-patch">
                        <span class="mol-text">MoLab</span><span class="pro-text">Pro</span>
                    </div>
                    <div class="chemlab-wrapper">
                        <iframe id="chemlabFrame" src="<?php echo e(url('/chemlab-sketcher')); ?>?v=<?php echo e(filemtime(public_path('chemlab.html'))); ?>" title="MoLab Pro"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 text-center form-col">
                <form id="searchForm" role="form" method="POST" action="<?php echo e(url('search/bySubstructure')); ?>" onsubmit="return submitForm() && showLoading()">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="smileCode" id="smileCode" value="<?php echo e(old('smileCode')); ?>">
                    <input type="hidden" name="jmeCode"   id="jmeCode"   value="<?php echo e(old('jmeCode')); ?>">

                    <div class="form-group">
                        <label>Estereoquímica</label>
                        <p style="font-size:12px; color:#666;">Usa <strong>W↑</strong> y <strong>W↓</strong></p>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Seleccionar Familia</label>
                        <div class="family-container">
                            <?php echo $__env->make('search.familiesPartial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>

                    <button class="btn btn-md btn-danger" type="submit" name="submitBtn" value="submitBtn">
                        <i class="fa fa-search"></i> <?php echo trans('applicationResource.form.buscar'); ?>

                    </button>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/usuario/Downloads/C14-CORREGIDO/C14-main-2/resources/views/search/bySubstructure.blade.php ENDPATH**/ ?>