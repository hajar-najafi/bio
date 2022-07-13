@extends('nav.nav')
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
