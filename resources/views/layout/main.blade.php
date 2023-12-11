<div class="container-fluid">
    <div class="row">
        @include('osfrportal::layout.leftmenu')
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            {{-- <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4"> --}}
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                @yield('title2', '')
                @if (isset($title2))
                    {{ $title2 }}
                @endif
                @yield('breadcrumb', Breadcrumbs::render())
            </div>

            @yield('content', '')
            @guest
                {{-- @include('web.ozidb.sections.auth.loginformmodal') --}}
            @endguest
        </main>
    </div>
</div>
