@extends('layouts.dashboard.template')

@section('content')
<div class="container-fluid">
        <div class="col-md-6">

                <div class="card shadow mb-4 border-left-success">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-users"></i> Editar Usuários</h6>
                    </div>
                    <div class="card-body">
                        <form class="user" action="{{ url('user/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password">
                            </div>
                            <div class="form-group">
                                    <input type="file" class="" id="imgprofile" name="imgprofile">
                                </div>
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Salvar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
</div>

@endsection
