@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">{{ $storage->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                    <table class="table table-sm mb-0">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('SKU') }}</th>
                            <th scope="col">{{ __('Cost')  }}</th>
                            <th scope="col">{{ __('Receipts') }}</th>
                            <th scope="col">{{ __('Issues') }}</th>
                            <th scope="col">{{ __('Stocks') }}</th>
                            <th scope="col">{{ __('Stock Value') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($storage->products as $product)
                            <tr>
                                <th scope="row">{{ $product['sku'] }}</th>
                                <td>&yen;{{ number_format($product['cost']) }}</td>
                                <td>{{ number_format($product['receipts']) }}</td>
                                <td>{{ number_format($product['issues']) }}</td>
                                <td>{{ number_format($product['stocks']) }}</td>
                                <td>&yen;{{ number_format($product['stock_value']) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
