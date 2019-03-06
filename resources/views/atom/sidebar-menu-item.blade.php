@php
    $item_class = "";
    $dropdown_id = uniqid("dropdown-");
    $a_class = "sidebar-link";
    $a_attr = "";
    if(!empty($li_class)) {
        $item_class .= " ".$li_class;
    }
    $link = !empty($url) ? $url : "#";
    $has_child = !empty($children) && is_array($children) ? true : false;
    if($has_child) {
        $item_class .= " dropdown";
        $link = "javascript:void(0);";
        $a_class = "dropdown-toggle";
        $a_attr = 'role="button" id="'.$dropdown_id.'-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
    }
@endphp
<li class="nav-item{{ $item_class }}">
    <a id="{{$dropdown_id}}" class="{{ $a_class }}" href="{{ $link }}" {!!$a_attr!!}>
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
        <ul id="{{$dropdown_id}}-menu" class="dropdown-menu" aria-labelledby="{{$dropdown_id}}">
            @foreach ($children as $child)
                <li>
                    <a class='sidebar-link' href="{{ array_get($child, "url", "#") }}">{{ array_get($child, "title", "") }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</li>