@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
    <div>
        <div class="page-header d-print-none">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">iHomis Menu</h2>
                </div>
            </div>
        </div>
        <div class="row row-cards">
            <div class="col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('auth.admin.users.list') }}" class="btn py-4 w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-settings-code">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M11.482 20.924a1.666 1.666 0 0 1 -1.157 -1.241a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.312 .318 1.644 1.794 .995 2.697" />
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M20 21l2 -2l-2 -2" />
                        <path d="M17 17l-2 2l2 2" />
                    </svg>
                    System Administration
                </a>
            </div>
        </div>
    </div>
@endsection
