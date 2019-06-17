@extends('layouts.admin')
@section('title', 'Sistema Delegados 2020')
@section('content')
    <template v-if="menu==0">
        <h1>Principal</h1>
    </template>
    <template v-if="menu==1">
        <region></region>
    </template>
    <template v-if="menu==2">
        <h1>Delegaciones</h1>
    </template>
@endsection