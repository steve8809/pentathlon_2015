<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_responsive">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">Öttusa eredménykezelő</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar_responsive">

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/admin/competitiongroups">Csoportok, eredmények</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Adatbázis <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/horses">Lovak</a></li>
                        <li><a href="/admin/clubs">Klubok</a></li>
                        <li><a href="/admin/competitors">Versenyzők</a></li>
                        <li><a href="/admin/competitions">Versenyek</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Szabályok <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/swimming_ce_rules">Úszás, kombinált</a></li>
                        <li><a href="/admin/fencing_rules">Vívás</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Adatok <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/users">Felhasználók adatai</a></li>
                        <li><a href="/admin/roles">Jogosultsági körök</a></li>
                        <li><a href="/admin/countries">Országok listája</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><span class="glyphicon glyphicon-user"></span> @if(Auth::user()) {!! Auth::user()->name !!}
                        @else Felhasználó @endif <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if (Auth::check())
                            <li><a href="/home"><span class="glyphicon glyphicon-dashboard"></span> Vissza a főoldalra</a></li>
                            <li><a href="/users/logout"><span class="glyphicon glyphicon-off"></span> Kilépés</a></li>
                        @else
                            <li><a href="/users/register"><span class="glyphicon glyphicon-registration-mark"></span> Regisztráció</a></li>
                            <li><a href="/users/login"><span class="glyphicon glyphicon-log-in"></span> Belépés</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>