@extends('layouts.common.main')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('title', 'Nova Oportunidade de Venda')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Nova Oportunidade de Venda</h1>
        <form action="{{ route('sale_opportunity.store') }}" method="POST">
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

            <div class="mb-3">
                <label for="client" class="form-label">Cliente</label>
                <input type="text" name="client" class="form-control" id="client" value=""
                    required>
                @if ($errors->get('client'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('client'),
                    ])
                @endif
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Produto</label>
                <input type="text" name="product" class="form-control" id="product" value=""
                    required>
                @if ($errors->get('product'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('product'),
                    ])
                @endif
            </div>

            <div class="mb-3">
                <label for="seller" class="form-label">Vendedor</label>
                <input type="text" name="seller" class="form-control" id="seller" value=""
                    required>
                @if ($errors->get('seller'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('seller'),
                    ])
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            const clientsAutocompleteData = JSON.parse("{!! $clientsAutocompleteData !!}");
            const productsAutocompleteData = JSON.parse("{!! $productsAutocompleteData !!}");
            const sellersAutocompleteData = JSON.parse("{!! $sellersAutocompleteData !!}");

            $("#client").autocomplete({
                source: clientsAutocompleteData
            });

            $("#product").autocomplete({
                source: productsAutocompleteData
            });

            $("#seller").autocomplete({
                source: sellersAutocompleteData
            });
        });
    </script>
@endsection
