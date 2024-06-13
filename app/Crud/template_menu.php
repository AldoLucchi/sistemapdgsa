<!--begin:Menu item-->
<div class="menu-item">
    <!--begin:Menu link-->
    <a class="menu-link {{ request()->routeIs('crud.%OBJETO_VIEW%.*') ? 'active' : '' }}" href="{{ route('crud.%OBJETO_VIEW%.index') }}">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title">%OBJETO%</span>
    </a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->