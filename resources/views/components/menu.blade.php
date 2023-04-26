<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">Суши Пицца</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($categories as $category)
                    @php
                        $subCategories = $category->subcategories;
                    @endphp
                    <li class="nav-item {{ !is_null($subCategories) ? 'dropdown' : '' }}">
                        <a class="nav-link {{ $id == $category->id ? 'active' : '' }} {{ !is_null($subCategories) ? 'dropdown-toggle' : '' }}" aria-current="page" href="/category/{{ $category->id }}" {{ !is_null($subCategories) ? 'role=button data-bs-toggle=dropdown aria-expanded=false' : '' }}>{{ $category->title }}</a>
                        @if(!is_null($subCategories))
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ $id == $category->id ? 'active' : '' }}" href="/category/{{ $category->id }}">Все</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @foreach($subCategories as $subCategory)
                                    <li>
                                        <a class="dropdown-item {{ $id == $subCategory->id ? 'active' : '' }}" href="/category/{{ $subCategory->id }}">{{ $subCategory->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Доставка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Контакты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('cart.show') }}">Корзина</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
