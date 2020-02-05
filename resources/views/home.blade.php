@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <panel title="Informações" color="text-white bg-dark">
                <breadcrumbs :list="{{ $content['breadcrumbs'] }}"></breadcrumbs>
                <div class="row">
                    <div class="col-4">
                        <panel title="Conteúdo 1" color="text-white bg-primary"  link="{{ route('admin.articles.index') }}" label="Veja os Artigos">
                            Artigos
                        </panel>
                    </div>
                    <div class="col-4">
                        <panel title="Conteúdo 2" color="text-white bg-success"  link="{{ route('admin.users.index') }}" label="Veja os Usuários">
                            Conteúdo 2
                        </panel>
                    </div>
                    <div class="col-4">
                        <panel title="Conteúdo 3" color="text-white bg-secondary" link="#" label="Veja os Autores">
                            Conteúdo 3
                        </panel>
                    </div>
                </div>
            </panel>
        </div>
    </div>
</div>
@endsection
