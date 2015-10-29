<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_responsive">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Öttusa eredménykezelő</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar_responsive">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Felhasználó <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if (Auth::check())
                            @if(Auth::user()->hasRole('admin'))
                                <li><a href="/admin">Admin</a></li>
                            @endif
                            <li><a href="/users/logout"><span class="glyphicon glyphicon-off"></span> Kilépés</a></li>
                        @else
                            <li><a href="/users/register">Regisztráció</a></li>
                            <li><a href="/users/login">Belépés</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>