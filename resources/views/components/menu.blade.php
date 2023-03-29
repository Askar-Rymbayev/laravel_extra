<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($categories as $category)
                    @php
                        $subCategories = $category->subcategories;
                    @endphp
                    <li class="nav-item {{ !is_null($subCategories) ? 'dropdown' : '' }}">
                        <a class="nav-link {{ !is_null($subCategories) ? 'dropdown-toggle' : '' }}" aria-current="page" href="/category/{{ $category->id }}" {{ !is_null($subCategories) ? 'role=button data-bs-toggle=dropdown aria-expanded=false' : '' }}>{{ $category->title }}</a>
                        @if(!is_null($subCategories))
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/category/{{ $category->id }}">Все</a>
                                </li>
                                @foreach($subCategories as $subCategory)
                                    <li>
                                        <a class="dropdown-item" href="/category/{{ $subCategory->id }}">{{ $subCategory->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
