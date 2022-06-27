@extends('nav.nav')
<a href="/certificate/form" class="btn btn-light" style="margin-top: 150px;margin-left: 30px;background-color: #0b5ed7">Add Certificate</a>
<div style="margin-top: 80px;margin-left: 30px;margin-right: 30px">

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col">Course Name</th>
        <th scope="col">Teacher/Academy</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($certificates as $certificate)
        <tr>
            <th scope="row">{{$certificate->id}}</th>
            <td>{{$certificate->name}}</td>
            <td>{{$certificate->teacher}}</td>
            <td>{{$certificate->date}}</td>
            <td><form method="POST" action="/certificate/destroy/{{$certificate->id}}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>Delete</button>
                </form></td>
            <td> <form action="/edit/{{$certificate->id}}" method="get">@csrf<button class="btn btn-success">Edit</button></form></td>

        </tr>
    @endforeach
    </tbody>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>