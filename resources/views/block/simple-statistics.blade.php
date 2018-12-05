<div class="layers bd bgc-white p-20">
    <div class="layer w-100 mB-10">
        <h6 class="lh-1">{{ $title ?? "" }}</h6>
    </div>
    <div class="layer w-100">
        <div class="peers ai-sb fxw-nw">
            <div class="peer peer-greed">
                <span id="{{ $sparklinedash ?? "sparklinedash" }}"></span>
            </div>
            <div class="peer">
                <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-{{ $color ?? "gray" }}-50 c-{{ $color ?? "gray" }}-500"><span class="{{ $sparklinedash ?? "sparklinedash"}}-percent"></span> {{ __("global.records") }}</span>
            </div>
        </div>
    </div>
</div>