
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    Bonjour {{ Auth::user()->name }} !
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="ajaxcontent">
        
        </div>
    </div>
</div>  
    
@endsection
