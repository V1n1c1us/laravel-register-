@extends('layouts.dashboard.template')

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-users"></i> Usuários</h6>
        </div>
        <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="table-responsive-sm">
          <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th><i class="fa fa-cog"></i></th>
                <th><i class="fa fa-cog"></i></th>
            </thead>
            <tbody>
                @foreach ($user as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <a href="{{ url('user/edit', $u->id)}}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td></td>
                </tr>    
                @endforeach
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection