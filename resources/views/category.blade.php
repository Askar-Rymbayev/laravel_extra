@extends('layouts.app')

@section('categories')
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @foreach($categories as $category)
            @php
                $subCategories = $category->subcategories;
            @endphp
            <li class="nav-item {{ !is_null($subCategories) ? 'dropdown' : '' }}">
                <a class="nav-link {{ !is_null($subCategories) ? 'dropdown-toggle' : '' }}" aria-current="page" href="/category/{{ $category->id }}">{{ $category->title }}</a>
                @if(!is_null($subCategories))
                    <ul class="dropdown-menu">
                        @foreach($subCategories as $subCategory)
                            <li>
                                <a class="dropdown-item" href="/category/{{ $category->id }}">{{ $subCategory->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endsection

@section('content')
    <ul>
        @foreach($products as $product)
            <li>
                {{ $product->id }} {{ $product->title }} {{ $product->price }} {{ $product->ingredients }}
            </li>
        @endforeach
    </ul>
@endsection


