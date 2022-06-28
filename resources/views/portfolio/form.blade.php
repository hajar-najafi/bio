@extends('nav.nav')
<link href="/css/styles.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
@section('content')
    <a href="/certificate" class="btn btn-success" style="margin-left: 30px;margin-top: 50px">All Certificates</a>
    <div style="margin-left: 350px"> <h2 > Here you can add new certificate </h2></div>

    <div style="margin-top: 100px;margin-left: 500px;position: center">

        <form method="post" action="/certificate/create" class="form-group">
            @csrf
            <label for="name">name</label>
            <input type="text" name="name" id="name" style="display:block;width: 300px;height: 50px;margin-bottom: 20px" >
            <label for="teacher">Academy/Teacher</label>
            <input type="text" name="teacher" id="teacher" style="display:block;width: 300px;height: 50px;margin-bottom: 20px">
            <label for="date">Date</label>
            <input type="text" name="date" id="date" style="display:block;width: 300px;height: 50px;margin-bottom: 20px">

            <button class="btn btn-danger" style="margin-top: 20px">Submit</button>
        </form>
    </div>
@endsection



