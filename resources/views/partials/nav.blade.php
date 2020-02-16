<nav class="navbar navbar-expand-lg navbar-light navbar-default">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
        專案站台
        </a>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a href="{{ action('CustomerController@index') }}" class="nav-link">
            客戶列表
            </a>
        </li>
        </ul>
    </div>
</nav>