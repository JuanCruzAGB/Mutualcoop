<ul class="sidebar-menu-list tabs tab-menu-list lg:text-lg bg-white text-blue-900">
    <li class="tab"><a href="/dashboard" class="sidebar-link tab-link p-0">
            <span class="link-text">Dashboard</span>
        </a></li>
    @foreach($tabs as $tab)
    @if(isset($tab->tabs))
    <li id="dropdown-{{$tab->slug}}" class="tab dropdown closed">
        <a href="{{$tab->url}}" class="sidebar-link tab-link dropdown-header p-0">
            <span class="tab-text">
                <span class="link-text">{{$tab->name}}</span>
            </span>
            <button class="dropdown-button">
                <i class="dropdown-icon fas fa-sort-down"></i>
            </button>
        </a>
        <ul class="dropdown-menu-list">
            @foreach($tab->tabs as $subtab)
            @if(isset($subtab->tabs))
            <li id="dropdown-{{$subtab->slug}}" class="tab dropdown closed">
                <a href="{{$subtab->url}}" class="sidebar-link tab-link dropdown-header px-4">
                    <span class="tab-text">
                        <i class="link-icon left {{$subtab->icon}}"></i>
                        <span class="link-text">{{$subtab->name}}</span>
                    </span>
                    <button class="dropdown-button">
                        <i class="dropdown-icon fas fa-sort-down"></i>
                    </button>
                </a>
                <ul class="dropdown-menu-list">
                    @foreach($subtab->tabs as $subsubtab)
                    <li class="tab">
                        <a target="{{$subsubtab->target}}" href="{{$subsubtab->url}}"
                            class="sidebar-link sidebar-button dropdown-link tab-link px-12">
                            <i class="link-icon left {{$subsubtab->icon}}"></i>
                            <span class="link-text">{{$subsubtab->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @else
                <li class="tab"><a href="{{$subtab->url}}" target="{{$subtab->target}}" class="sidebar-link tab-link p-3">
                    <i class="link-icon left {{$subtab->icon}}"></i>
                    <span class="link-text">{{$subtab->name}}</span>
                </a></li>
            @endif
            @endforeach
        </ul>
    </li>
    @else
    <li class="tab"><a href="{{$tab->url}}" class="sidebar-link tab-link p-0">
            <i class="link-icon left {{$tab->icon}}"></i>
            <span class="link-text">{{$tab->name}}</span>
        </a></li>
    @endif
    @endforeach
</ul>