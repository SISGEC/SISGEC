@php
    $item_class = "";
    $a_class = "sidebar-link";
    if(!empty($li_class)) {
        $item_class .= " ".$li_class;
    }
    $link = !empty($url) ? $url : "#";
    $has_child = !empty($children) && is_array($children) ? true : false;
    if($has_child) {
        $item_class .= " dropdown";
        $link = "javascript:void(0);";
        $a_class = "dropdown-toggle";
    }
@endphp
<li class="nav-item{{ $item_class }}">
    <a class="{{ $a_class }}" href="{{ $link }}">
        <span class="icon-holder">
            <i class="{{ $color ?? "c-blue-500" }} {{ $icon ?? "" }}"></i>
        </span>
        <span class="title">{{ $title ?? "" }}</span>
        @if ($has_child)
            <span class="arrow">
                <i class="ti-angle-right"></i>
            </span>
        @endif
    </a>
    @if ($has_child)
        <ul class="dropdown-menu">
            @foreach ($children as $child)
                <li>
                    <a class='sidebar-link' href="{{ array_get($child, "url", "#") }}">{{ array_get($child, "title", "") }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</li>