@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <pre>
                    {{ json_encode($categories, JSON_PRETTY_PRINT); }}
                </pre>
                <div class="m-6" style="padding: 50px"></div>
            </div>
        </div>
    </div>
@endsection
