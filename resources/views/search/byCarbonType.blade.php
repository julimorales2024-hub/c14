@extends('layouts.master')

@section('headers')
<?php
header("Cache-Control: no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
@endsection

@section('estilos')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">
<style>
/* ── tabs ───────────────────────────────── */
.c-tabs {
    display: flex;
    flex-wrap: wrap;
    border-bottom: 2px solid #ddd;
    margin-bottom: 24px;
}
.c-tab {
    background: #fff;
    border: 1px solid #ccc;
    border-bottom: none;
    padding: 8px 18px;
    font-size: 13px;
    font-weight: 600;
    color: #555;
    cursor: pointer;
    margin-bottom: -2px;
    border-radius: 4px 4px 0 0;
    margin-right: 3px;
}
.c-tab.active {
    color: #fff;
    background: #c0392b;
    border-color: #c0392b;
    border-bottom-color: #c0392b;
    z-index: 1;
}
.c-tab:hover:not(.active) { color: #c0392b; }
.c-panel { display: none; }
.c-panel.active { display: block; }

/* ── checkbox grid (top section) ─────── */
.s-cbgrid {
    display: flex;
    flex-wrap: wrap;
    gap: 4px 32px;
    margin-bottom: 24px;
    padding: 0 4px;
}
.s-cbitem {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #333;
    cursor: pointer;
    min-width: 90px;
}
.s-cbitem input[type=checkbox] {
    width: 14px; height: 14px;
    cursor: pointer;
    accent-color: #c0392b;
}

/* ── slider grid ─────────────────────── */
.s-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0 28px;
    padding: 8px 4px 24px;
    align-items: flex-end;
}

/* ── one slider unit ─────────────────── */
.s-unit {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 38px;
    margin-bottom: 4px;
}

/* noUiSlider overrides — match original */
.noUi-vertical {
    height: 200px !important;
    width: 16px !important;
}
/* Rounded track, gray background */
.noUi-base,
.noUi-connects {
    border-radius: 10px !important;
    background: #d0cece !important;
}
.noUi-connect {
    background: #c0392b !important;
    border-radius: 10px !important;
}

/* Handle: white, wider than track, subtle shadow */
.noUi-vertical .noUi-handle {
    width: 34px !important;
    height: 16px !important;
    right: -9px !important;
    top: -8px !important;
    border-radius: 4px !important;
    background: #f8f8f8 !important;
    border: 1px solid #c8c8c8 !important;
    box-shadow: 0 2px 5px rgba(0,0,0,.22) !important;
    cursor: grab !important;
}
.noUi-vertical .noUi-handle:before,
.noUi-vertical .noUi-handle:after { display: none !important; }

/* Tooltip (shows value to the LEFT of handle) */
.noUi-vertical .noUi-tooltip {
    display: block !important;
    right: calc(100% + 6px) !important;
    left: auto !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    padding: 2px 5px !important;
    background: #fff !important;
    border: 1px solid #ccc !important;
    border-radius: 3px !important;
    color: #222 !important;
    white-space: nowrap !important;
    min-width: 20px;
    text-align: center;
}

/* Fixed "0" label at the bottom */
.s-zero {
    font-size: 11px;
    font-weight: 700;
    color: #222;
    margin-top: 3px;
    align-self: flex-end;
    padding-right: 2px;
}

/* Slider label (chemical name) */
.s-label {
    margin-top: 6px;
    font-size: 11px;
    font-weight: 700;
    color: #222;
    text-align: center;
    line-height: 1.3;
    white-space: nowrap;
}
.s-label sub { font-size: 7.5px; }
.s-label sup { font-size: 7.5px; }

/* X reset button */
.s-reset {
    margin-top: 5px;
    width: 22px; height: 22px;
    background: #c0392b;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 900;
    cursor: pointer;
    padding: 0;
    line-height: 1;
}
.s-reset:hover { background: #962d22; }

/* Search button */
.c-search {
    background: #c0392b;
    color: #fff;
    border: none;
    padding: 10px 40px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}
.c-search:hover { background: #962d22; }
</style>
@endsection

@section('scripts')
<script src="{{ asset('js/spin.js') }}"></script>
<script src="{{ asset('js/loadingScreen.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* Init every slider */
    document.querySelectorAll('.s-unit').forEach(function (unit) {
        var el = unit.querySelector('.s-slider');

        noUiSlider.create(el, {
            start:       [10],
            orientation: 'vertical',
            direction:   'rtl',      // 0 at bottom, 50 at top
            range:       { min: 0, max: 50 },
            step:        1,
            connect:     'lower',    // fill from bottom to handle
            tooltips:    [{ to: function(v){ return Math.round(v); } }],
        });

        unit._v = function () { return Math.round(el.noUiSlider.get()); };

        unit.querySelector('.s-reset').addEventListener('click', function () {
            el.noUiSlider.set(10);
        });
    });

    /* Tabs */
    document.querySelectorAll('.c-tab').forEach(function (b) {
        b.addEventListener('click', function () {
            document.querySelectorAll('.c-tab').forEach(x => x.classList.remove('active'));
            document.querySelectorAll('.c-panel').forEach(x => x.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('cp-' + this.dataset.tab).classList.add('active');
        });
    });

    /* Submit */
    document.getElementById('btnSearch').addEventListener('click', function () {
        var form = document.getElementById('cForm');
        form.querySelectorAll('.d').forEach(e => e.remove());
        var i = 0;
        document.querySelectorAll('.s-unit').forEach(function (u) {
            var mx = u._v();
            if (mx !== 10) {
                add(form, 'range[' + i + '][label]', u.dataset.key);
                add(form, 'range[' + i + '][max]',   mx);
                add(form, 'range[' + i + '][min]',   0);
                i++;
            }
        });
        if (i === 0) {
            document.querySelectorAll('.s-unit').forEach(function (u, idx) {
                add(form, 'range[' + idx + '][label]', u.dataset.key);
                add(form, 'range[' + idx + '][max]',   u._v());
                add(form, 'range[' + idx + '][min]',   0);
            });
        }
        showLoading();
        form.submit();
    });

    function add(f, n, v) {
        var h = document.createElement('input');
        h.type = 'hidden'; h.name = n; h.value = v; h.className = 'd';
        f.appendChild(h);
    }
});
</script>
@endsection

@section('mainContainer')
<?php
$groups = [
    'esqueleto'    => ['Cs'=>'C*','CHs'=>'CH*','CH2s'=>'CH<sub>2</sub>*','CH3s'=>'CH<sub>3</sub>*','COs'=>'C-O*','CHOs'=>'CH-O*','CH2Os'=>'CH<sub>2</sub>-O*','CH3Os'=>'CH<sub>3</sub>-O*','CNs'=>'C-N*','CHNs'=>'CH-N*','CH2Ns'=>'CH<sub>2</sub>-N*','CH3Ns'=>'CH<sub>3</sub>-N*'],
    'carbono'      => ['C'=>'C','CH'=>'CH','CH2'=>'CH<sub>2</sub>','CH3'=>'CH<sub>3</sub>','CO'=>'C-O','CHO'=>'CH-O','CH2O'=>'CH<sub>2</sub>-O','CH3O'=>'CH<sub>3</sub>-O','CN'=>'C-N','CHN'=>'CH-N','CH2N'=>'CH<sub>2</sub>-N','CH3N'=>'CH<sub>3</sub>-N'],
    'heteroatomos' => ['O'=>'O','N'=>'N','H'=>'H','F'=>'F','Cl'=>'Cl','Br'=>'Br','I'=>'I','P'=>'P','S'=>'S'],
    'tipos'        => ['CTali'=>'CT ali','CTaro'=>'CT aro','CTole'=>'CT ole','Csp2'=>'Csp<sup>2</sup>'],
    'alifaticos'   => ['Cali'=>'C ali','CHali'=>'CH ali','CH2ali'=>'CH<sub>2</sub> ali','COali'=>'C-O ali','CHOali'=>'CH-O ali','CNali'=>'C-N ali','CHNali'=>'CH-N ali'],
    'aromaticos'   => ['Caro'=>'C aro','CHaro'=>'CH aro','COaro'=>'C-O aro','CHOaro'=>'CH-O aro','CNaro'=>'C-N aro','CHNaro'=>'CH-N aro'],
    'olefinicos'   => ['Cole'=>'C ole','CHole'=>'CH ole','CH2ole'=>'CH<sub>2</sub> ole'],
    'otros'        => ['CCarbonil'=>'C=O'],
];
?>
<section class="container-fluid" style="background:#fff; padding:28px 20px 60px;">
<div class="row">
<div class="col-xs-12 col-md-10 col-md-offset-1">

    <div class="text-center" style="margin-bottom:24px;">
        <h4 style="font-weight:700;">{!! trans('applicationResource.form.busquedas.tiposCarbono') !!}</h4>
    </div>

    @if($errors->has('range'))
    <div class="text-center" style="margin-bottom:12px;">
        <strong style="color:#c0392b;">{!! trans('applicationResource.errors.requeridos') !!}</strong>
    </div>
    @endif

    {{-- Tabs --}}
    <div class="c-tabs">
        @php $first = true; @endphp
        @foreach(array_keys($groups) as $k)
            <button class="c-tab {{ $first ? 'active' : '' }}" data-tab="{{ $k }}">
                {!! trans('applicationResource.type.'.$k) !!}
            </button>
            @php $first = false; @endphp
        @endforeach
    </div>

    @php $first = true; @endphp
    @foreach($groups as $k => $items)
    <div id="cp-{{ $k }}" class="c-panel {{ $first ? 'active' : '' }}">

        {{-- Checkbox grid --}}
        <div class="s-cbgrid">
            @foreach($items as $key => $label)
            <label class="s-cbitem">
                <input type="checkbox" class="s-cb" data-key="{{ $key }}">
                <span>{!! $label !!}</span>
            </label>
            @endforeach
        </div>

        {{-- Sliders --}}
        <div class="s-grid">
            @foreach($items as $key => $label)
            <div class="s-unit" data-key="{{ $key }}">
                <div class="s-slider"></div>
                <div class="s-zero">0</div>
                <div class="s-label">{!! $label !!}</div>
                <button type="button" class="s-reset">X</button>
            </div>
            @endforeach
        </div>
    </div>
    @php $first = false; @endphp
    @endforeach

    <form id="cForm" method="POST" action="{!! url('search/byCarbonType') !!}">@csrf</form>

    <div class="text-center">
        <button id="btnSearch" class="c-search">
            {!! strtoupper(trans('applicationResource.form.buscar')) !!}
        </button>
    </div>

</div>
</div>
</section>
@endsection