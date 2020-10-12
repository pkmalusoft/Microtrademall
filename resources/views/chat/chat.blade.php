@extends('layouts.user')

@section('content')
<div class="authRightBlock">
	 <chat-component :user="{{ auth()->user() }}"></chat-component>
</div>
@endsection 