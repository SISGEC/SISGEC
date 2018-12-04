<div class="bd bgc-white">
    <div class="layers">
        <div class="layer w-100 pX-20 pT-20">
            <h6 class="lh-1">{{ $title ?? "" }}</h6>
        </div>
        <div class="layer w-100 p-20">
            <canvas id="{{ $chart_id ?? "line-chart" }}" height="220"></canvas>
        </div>
        <div class="layer bdT p-20 w-100">
            <div class="peers ai-c jc-c gapX-20">
                @php
                    $peers = isset($peers) && is_array($peers) ? $peers : [];
                @endphp
                {{--@foreach ($peers as $peer)
                    <div class="peer">
                        <span class="fsz-def fw-600 mR-10 c-{{ array_get($peer, "color", "gray") }}-800">{{ array_get($peer, "percent", "0%") }} <i class="fa {{ array_get($peer, "icon", "fa-minus") }} c-{{ array_get($peer, "color", "gray") }}-500"></i></span>
                        <small class="c-grey-500 fw-600">{{ array_get($peer, "title", "") }}</small>
                    </div>    
                @endforeach--}}
            </div>
        </div>
    </div>
</div>