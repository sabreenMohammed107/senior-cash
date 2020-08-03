@extends('layout.main')

@section('crumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=""><i class="material-icons"></i> {{ __(' Home') }} </a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit-Cash Loans</li>

    </ol>
</nav>

@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header d-flex justify-content-between">
                <h6>Cash Loans</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <form action="{{route('cash-finance.update',$editrow->id)}}" method="POST">

                    {{ csrf_field() }}

                    @method('PUT')
                    <div class="row">


                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Cash Name</label>
                                <input type="text" value="{{$Selectrow->name}}" class="form-control" placeholder="Cash Name" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Current Balance</label>
                                <input type="text" class="form-control" value="{{$currentBalance}}" placeholder="Current Balance" disabled>
                            </div>
                        </div>
                       
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Entry Date</label>
                                <?php
                                $date = date_create($editrow->entry_date);
                                ?>
                                <input name="entry_date" value="{{ date_format($date,'Y-m-d') }}" type="date" class="form-control" placeholder="date">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cash_box_id" value="{{$Selectrow->id}}">
                    <div style="margin-bottom:25px">
                        <div style="border-bottom:solid 2px #0094ff;width:160px">
                            @if($editrow->credit)
                            <style>
                                .hide {
                                    display: none;
                                }
                            </style>
                            <input type="radio" name="tab" value="igotnone" onclick="show1();" checked /> Out
                            <input type="radio" name="tab" value="igottwo" onclick="show2();" disabled /> In
                            @else
                            <style>
                                .hide2 {
                                    display: none;
                                }
                            </style>
                            <input type="radio" name="tab" value="igotnone" onclick="show1();" disabled /> Out
                            <input type="radio" name="tab" value="igottwo" onclick="show2();" checked /> In
                            @endif
                        </div>


                    </div>
                    <div class="ms-auth-container row no-gutters">
                        <div class="col-12 p-3">
                            <div id="div2" class="hide2">
                                <div class="ms-auth-container row">
                                  
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Amount
                                                Money</label>
                                            <input type="number" name="credit" value="{{$editrow->credit}}" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                            <textarea name="notes" id="newClint" class="form-control" placeholder="Notes" rows="3">{{$editrow->notes}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="div1" class="hide">
                                <div class="ms-auth-container row">
                                    
                               
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Amount
                                                Money</label>
                                            <input type="number" name="debit" value="{{$editrow->debit}}" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Currency</label>
                                        <input type="text" class="form-control" placeholder="LE">
                                    </div>
                                </div> -->
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                            <textarea name="notes" id="newClint" class="form-control" placeholder="Notes" rows="3">{{$editrow->notes}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="input-group d-flex justify-content-end text-center">
                                <a href="{{ route('cash-finance.show',$Selectrow->id) }}" class="btn btn-dark mx-2"> Cancel</a>
                                <!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
                                <input type="submit" value="Add" class="btn btn-success ">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
<!--radio button-->
<script>
    function show1() {
        document.getElementById('div1').style.display = 'none';
        document.getElementById('div2').style.display = 'block';
    }

    function show2() {
        document.getElementById('div2').style.display = 'none';
        document.getElementById('div1').style.display = 'block';
    }

</script>


@endsection