@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">

    <div class="col-md-12 custom_datatable_class" style="margin-top: 50px; ">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Serial No.</th>
            <th>Customer Name</th>
            <th>Message</th>
            <th>Save Date</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($messages))
          
            @foreach($messages as $record)
            <tr>
                <td>{{ 1 }}</td>
                <td>{{ $logged_user_name }}</td>
                <td>{{ $record->message }}</td>
                <td>{{ \Carbon\Carbon::parse($record->due_on)->format('d-m-Y')}}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Serial No.</th>
            <th>Customer Name</th>
            <th>Message</th>
            <th>Save Date</th>
        </tr>
    </tfoot>
</table>

</div>

</div>

</div>


<script type="text/Javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/Javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/Javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        //alert('working');
        $('#example').DataTable();
    } );
</script>



@endsection
