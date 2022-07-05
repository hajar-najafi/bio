@extends('nav.nav')
<link href="/css/styles.css" rel="stylesheet" />
@section('title')
    Token form
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Two Factor Auth</div>

                <div class="card-body">

                    <form method="POST" action="/profile/verifytoken">
                        @csrf

                        <div class="row mb-4">
                            <label for="token">Enter the token</label>
                            <input type="text" name="token" >
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    save
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
