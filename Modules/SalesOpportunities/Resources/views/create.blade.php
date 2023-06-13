@extends('layouts.common.main')

@section('title', 'Nova Oportunidade de Venda')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Nova Oportunidade de Venda</h1>
        <form action="{{route('sale_opportunity.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" class="form-control" id="title" value="" required>
                @if ($errors->get('title'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('title'),
                    ])
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection
