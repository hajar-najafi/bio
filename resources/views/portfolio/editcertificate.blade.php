@extends('nav.nav')


<form method="post" action="/certificate/edit/{{$certificate->id}}" >
    @csrf
    <label for="name">name</label>
    <input type="text" name="name" id="name">
    <label for="teacher">Academy/Teacher</label>
    <input type="text" name="teacher" id="teacher">
    <label for="date">Date</label>
    <input type="text" name="date" id="date">

    <button class="btn btn-danger">Submit</button>
</form>

