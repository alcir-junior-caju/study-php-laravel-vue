@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->all())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erro ao Cadastrar!</strong> Verifique o formulário de envio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <panel title="Lista de Usuários" color="text-white bg-dark">
                    <breadcrumbs :list="{{ $content['breadcrumbs'] }}"></breadcrumbs>
                    <list
                        :titles="['#', 'Nome', 'E-mail', 'Autor', 'Data']"
                        :itens="{{ json_encode($content['users']) }}"
                        order="asc"
                        column="0"
                        create="#create"
                        show="/admin/users/"
                        edit="/admin/users/"
                        remove="/admin/users/"
                        token="{{ csrf_token() }}"
                        modal="yes"
                    >
                    </list>

                    <div class="mt-3">
                        {{ $content['users']->links() }}
                    </div>
                </panel>
            </div>
        </div>
    </div>
    <modal id="createData" title="Inserir Usuário">
        <formdata id="createForm" action="{{ route('admin.users.store') }}" method="post" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" class="form-control" name="name" v-model="$store.state.item.name" placeholder="Nome" value="{{ old('name') }}" />
                <div class="invalid-feedback" @if ($errors->has('name')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" name="email" v-model="$store.state.item.email" placeholder="E-mail" value="{{ old('email') }}" />
                <div class="invalid-feedback" @if ($errors->has('email')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" class="form-control" name="password" v-model="$store.state.item.password" placeholder="Senha" value="{{ old('password') }}" />
                <div class="invalid-feedback" @if ($errors->has('password')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="author">Autor</label>
                <select name="author" id="author" class="form-control">
                    <option {{ (old('author')) && old('author') == '0' ? 'selected' : '' }} value="0">Não</option>
                    <option {{ (old('author')) && old('author') == '1' ? 'selected' : '' }} value="1">Sim</option>
                </select>
                <div class="invalid-feedback" @if ($errors->has('author')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('author'))
                            {{ $errors->first('author') }}
                        @endif
                    </strong>
                </div>
            </div>
        </formdata>
        <span slot="buttons">
            <button form="createForm" class="btn btn-success">Inserir</button>
        </span>
    </modal>
    <modal id="editData" title="Editar Usuário">
        <formdata id="editForm" :action="'/admin/users/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" class="form-control" name="name" v-model="$store.state.item.name" placeholder="Nome" />
                <div class="invalid-feedback" @if ($errors->has('name')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" name="email" v-model="$store.state.item.email" placeholder="E-mail" />
                <div class="invalid-feedback" @if ($errors->has('email')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" class="form-control" name="password" v-model="$store.state.item.password" placeholder="Senha" />
                <div class="invalid-feedback" @if ($errors->has('password')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="author">Autor</label>
                <select name="author" id="author" class="form-control" v-model="$store.state.item.author">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
                <div class="invalid-feedback" @if ($errors->has('author')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('author'))
                            {{ $errors->first('author') }}
                        @endif
                    </strong>
                </div>
            </div>
        </formdata>
        <span slot="buttons">
            <button form="editForm" class="btn btn-success">Editar</button>
        </span>
    </modal>
    <modal id="showData" :title="$store.state.item.name">
        <h5>@{{ $store.state.item.email }} (@{{ $store.state.item.author }})</h5>
        <small>@{{ $store.state.item.created_at }}</small>
    </modal>
@endsection
