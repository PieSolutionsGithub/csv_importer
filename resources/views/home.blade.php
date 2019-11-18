@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Upload CSV File</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{ implode('', $errors->all('CSV File is Required')) }}
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="alert alert-dismissable alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>
                            {!! session()->get('message') !!}
                        </strong>
                    </div>
                @endif

                 <!-- Form -->
                 <form method='post' action='upload_csv' enctype='multipart/form-data' >
                   {{ csrf_field() }}
                   <input type='file' name='file' accept=".csv" required="required">
                   <input type='submit' name='submit' value='Import'>
                 </form>
                 <!-- Form Close Here -->

            </div>
        </div>
    </div>



    <div class="col-md-12 custom_datatable_class" style="margin-top: 50px; ">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Invoice ID</th>
            <th>Invoice Amount</th>
            <th>Due On</th>
            <th>Selling Amount</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($customers))
            @foreach($customers as $record)
            <tr>
                <td>{{ $logged_user_name }}</td>
                <td>{{ $record->invoice_number }}</td>
                <td>{{ $record->invoice_amount }}</td>
                <td>{{ \Carbon\Carbon::parse($record->due_on)->format('d-m-Y')}}</td>
                <td>{{ $record->invoice_sell_amount }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Customer Name</th>
            <th>Invoice ID</th>
            <th>Invoice Amount</th>
            <th>Due On</th>
            <th>Selling Amount</th>
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
