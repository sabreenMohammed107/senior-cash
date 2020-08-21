@extends('layout.main')

@section('crumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=""><i class="material-icons"></i> {{ __(' Home') }} </a></li>
    </ol>
</nav>

@endsection

@section('content')
<div class="row">

    <div class="col-md-12">



        <div class="ms-panel">
            <div class="ms-panel-header d-flex justify-content-between">
                <h6>Cash box</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="{{route('cash-box.update',$row->id)}}" method="POST">

                            {{ csrf_field() }}

                            @method('PUT')
                            <div class="ms-auth-container row">

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Name</label>
                                        <input type="text"  value="{{$row->name}}" name="name" class="form-control" placeholder="Name">
                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Balance Start Date</label>
                                        <?php $date = date_create($row->balance_start_date) ?>
                                        <input type="date" readonly value="{{date_format($date,'Y-m-d')}}" class="form-control" placeholder="Balance Start Date">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Open Balance</label>
                                        <input name="open_balance" readonly value="{{$row->open_balance}}" type="text" class="form-control" placeholder="open balance">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Current Balance</label>
                                        <?php

                                                $currentBalance = App\Models\Financial_entry::where('cash_box_id', $row->id)->sum('debit') - App\Models\Financial_entry::where('cash_box_id', $row->id)->sum('credit');

                                        ?>
                                        <input name="current_balance" readonly value="{{$currentBalance}}" type="text" class="form-control" placeholder="open balance">
                                    </div>
                                </div>
                               
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
										<textarea name="note" id="newClint"  class="form-control" placeholder="Notes" rows="3">{{$row->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group d-flex justify-content-end text-center">
                            <a href="{{ route('cash-box.index') }}" class="btn btn-dark mx-2"> Cancel</a>
                                <input  type="submit" value="Add" class="btn btn-success ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection