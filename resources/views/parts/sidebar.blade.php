<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{ url("/") }}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    <img src="{{ config("app.office_brand") }}" alt="">
                                </div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">{{ __("global.system.name") }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="sidebar-menu scrollable pos-r">
            @component('atom/sidebar-menu-item', [
                'title' => __("sidebar.dashboard"),
                'url' => route("dashboard"),
                'icon' => 'ti-home',
                'color' => 'c-brown-500',
                'li_class' => 'mT-30'
            ])
            @endcomponent
            @component('atom/sidebar-menu-item', [
                'title' => __("sidebar.patients"),
                'icon' => 'ti-id-badge',
                'color' => 'c-brown-500',
                'children' => [
                    ['title' => __("sidebar.all"), 'url' => route("patients")],
                    ['title' => __("sidebar.new"), 'url' => route("patients.new")]
                ]
            ])
            @endcomponent
            @component('atom/sidebar-menu-item', [
                'title' => __("sidebar.medical-appointments"),
                'icon' => 'ti-calendar',
                'color' => 'c-brown-500',
                'url' => route("medical_appointments")
            ])
            @endcomponent
            @if (auth()->user()->is_doctor())
                @component('atom/sidebar-menu-item', [
                    'title' => __("sidebar.assistants"),
                    'icon' => 'ti-user',
                    'color' => 'c-brown-500',
                    'url' => route("assistants")
                ])
                @endcomponent
            @endif
        </ul>
    </div>
</div>