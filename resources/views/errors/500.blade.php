@extends('errors::minimal')

@section('title', __('messages.errors.server_error'))
@section('code', '500')
@section('message', __('messages.errors.server_error'))
