@include('employee.header')
@include('employee.sidebar')

<div class="page-content-wrapper">
    <div class="page-content">
        @yield('employee-content')
    </div>
</div>
@include('employee.footer')
