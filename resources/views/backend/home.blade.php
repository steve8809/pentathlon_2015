@extends('master')
@section('title', 'Admin Vezérlőpult')

@section('content')

    <div class="container">
        <div class="row banner">

            <div class="col-md-12">

                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Felhasználók adatai</h4>
                            <a href="/admin/users" class="btn btn-default btn-raised">Összes felhasználó</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Jogosultsági körök</h4>
                            <a href="/admin/roles" class="btn btn-default btn-raised">Összes jogosultság</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Országok listája</h4>
                            <a href="/admin/countries" class="btn btn-default btn-raised">Összes ország</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Szabályok</h4>
                            <a href="/admin/swimming_ce_rules" class="btn btn-default btn-raised">Úszás, kombinált szabályok</a>
                            <a href="/admin/fencing_rules" class="btn btn-default btn-raised">Vívás szabályok</a>

                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Lovak</h4>
                            <a href="/admin/horses" class="btn btn-default btn-raised">Összes ló</a>
                            <a href="/admin/horses/create" class="btn btn-primary btn-raised">Ló felvétele</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Klubok</h4>
                            <a href="/admin/clubs" class="btn btn-default btn-raised">Összes klub</a>
                            <a href="/admin/clubs/create" class="btn btn-primary btn-raised">Klub felvétele</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Versenyzők</h4>
                            <a href="/admin/competitors" class="btn btn-default btn-raised">Összes versenyző</a>
                            <a href="/admin/competitors/create" class="btn btn-primary btn-raised">Versenyző felvétele</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Versenyek</h4>
                            <a href="/admin/competitions" class="btn btn-default btn-raised">Összes verseny</a>
                            <a href="/admin/competitions/create" class="btn btn-primary btn-raised">Verseny felvétele</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Csoportok, eredmények</h4>
                            <a href="/admin/competitiongroups" class="btn btn-default btn-raised">Összes csoport</a>
                            <a href="/admin/competitiongroups/create" class="btn btn-primary btn-raised">Csoport felvétele</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>

                </div>
            </div>
        </div>
        <div class="placeholder"></div>
    </div>

@endsection