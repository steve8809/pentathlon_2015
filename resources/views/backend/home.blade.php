@extends('master')
@section('title', 'Admin Vezérlőpult')

@section('content')

    <div class="container">
        <div class="row banner">

            <div class="col-md-12">

                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-social-person"></i>
                        </div>
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Felhasználók adatai</h4>
                            <a href="/admin/users" class="btn btn-default btn-raised">Minden felhasználó</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>
                    <div class="list-group-item">
                        <div class="row-action-primary">
                            <i class="mdi-social-group"></i>
                        </div>
                        <div class="row-content">
                            <h4 class="list-group-item-heading">Jogosultsági körök</h4>
                            <a href="/admin/roles" class="btn btn-default btn-raised">Minden jogosultság</a>
                            <a href="/admin/roles/create" class="btn btn-primary btn-raised">Jogosultság készítése</a>
                        </div>
                    </div>
                    <div class="list-group-separator"></div>

                </div>

            </div>

        </div>
    </div>

@endsection