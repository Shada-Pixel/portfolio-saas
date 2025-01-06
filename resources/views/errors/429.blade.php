@extends('errors::minimal')

@section('title', __('messages.errors.too_many_request'))
@section('code', '429')
@section('message', __('messages.errors.too_many_request'))
