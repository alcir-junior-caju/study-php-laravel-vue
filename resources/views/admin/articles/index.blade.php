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
                <panel title="Lista de Artigos" color="text-white bg-dark">
                    <breadcrumbs :list="{{ $content['breadcrumbs'] }}"></breadcrumbs>
                    <list
                        :titles="['#', 'Título', 'Descrição', 'Data']"
                        :itens="{{ json_encode($content['articles']) }}"
                        order="asc"
                        column="0"
                        create="#create"
                        show="/admin/articles/"
                        edit="/admin/articles/"
                        remove="/admin/articles/"
                        token="{{ csrf_token() }}"
                        modal="yes"
                    >
                    </list>

                    <div class="mt-3">
                        {{ $content['articles']->links() }}
                    </div>
                </panel>
            </div>
        </div>
    </div>
    <modal id="createData" title="Inserir Artigo">
        <formdata id="createForm" action="{{ route('admin.articles.store') }}" method="post" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" class="form-control" name="title" v-model="$store.state.item.title" placeholder="Título" value="{{ old('title') }}" />
                <div class="invalid-feedback" @if ($errors->has('title')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('title'))
                            {{ $errors->first('title') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" id="description" class="form-control" name="description" v-model="$store.state.item.description" placeholder="Descrição" value="{{ old('description') }}" />
                <div class="invalid-feedback" @if ($errors->has('description')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('description'))
                            {{ $errors->first('description') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="body">Conteúdo</label>
                <textarea id="body" class="form-control" name="body">{{ old('body') }}</textarea>
                <div class="invalid-feedback" @if ($errors->has('body')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('body'))
                            {{ $errors->first('body') }}
                        @endif
                    </strong>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input type="datetime-local" id="date" class="form-control" name="date" value="{{ old('date') }}" />
                <div class="invalid-feedback" @if ($errors->has('date')) style="display:initial;" @endif>
                    <strong>
                        @if ($errors->has('date'))
                            {{ $errors->first('date') }}
                        @endif
                    </strong>
                </div>
            </div>
        </formdata>
        <span slot="buttons">
            <button form="createForm" class="btn btn-success">Inserir</button>
        </span>
    </modal>
    <modal id="editData" title="Editar Artigo">
        <formdata id="editForm" :action="'/admin/articles/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" class="form-control" name="title" v-model="$store.state.item.title" placeholder="Título" />
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" id="description" class="form-control" name="description" v-model="$store.state.item.description" placeholder="Descrição" />
            </div>
            <div class="form-group">
                <label for="body">Conteúdo</label>
                <textarea id="body" class="form-control" name="body" v-model="$store.state.item.body"></textarea>
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input type="text" id="date" class="form-control" name="date" v-model="$store.state.item.date" data-date-format="mm/dd/YYYY, h" />
            </div>
        </formdata>
        <span slot="buttons">
            <button form="editForm" class="btn btn-success">Editar</button>
        </span>
    </modal>
    <modal id="showData" :title="$store.state.item.title">
        <h5>@{{ $store.state.item.description }}</h5>
        <p>@{{ $store.state.item.body }}</p>
        <small>@{{ $store.state.item.date }}</small>
    </modal>
@endsection
