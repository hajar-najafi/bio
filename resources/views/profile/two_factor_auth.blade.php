@extends('nav.nav')
<link href="/css/styles.css" rel="stylesheet" />
@section('title')
    manage two factor Auth
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Two Factor Auth</div>

                <div class="card-body">

                    <form method="POST" action="/profile/twofactor">
                        @csrf

                        <div class="row mb-4">
                        <label for="type">choose the type</label>
                        <select name="type">
                        <option value="off">Off</option>
                        <option value="sms">sms</option>
                        </select>
                        </div>
                        <div class="row mb-4">
                            <label for="phone">Enter your phone number</label>
                            <input type="text" name="phone" >
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
