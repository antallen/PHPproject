<nav class="navbar navbar-expand-lg navbar-light navbar-default">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
        專案站台
        </a>
        
            <a href="{{ action('CustomerController@new') }}" class="nav-link">
            新增客戶
            </a>
            <a href="{{ action('CustomerController@index') }}" class="nav-link">
            客戶列表
            </a>
       
    </div>
</nav>