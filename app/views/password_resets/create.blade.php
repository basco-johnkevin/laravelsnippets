@extends('layouts.master')

@section('content')

    <div class="row login-page-wrapper">

      <div class="col-sm-6 col-md-6 col-md-offset-3">
        <h1 class="text-center login-title">Fill in the email to reset your password</h1>
        <div class="account-wall">

          {{ Form::open(array('route' => 'password_resets.store', 'class'=>'form-signin')) }}

            {{ Form::text('email', $value = null, array('placeholder' => 'Email', 'class'=> 'form-control', 'required' => 'required', 'autofocus' => 'autofocus' )) }}

            {{ Form::submit('Reset password', array('class' => 'btn btn-lg btn-primary btn-block')) }}

            <span class="clearfix"></span>

          {{ Form::close() }}

        </div>
      </div>
    </div>
@stop