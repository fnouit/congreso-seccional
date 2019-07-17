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
        <delegacion></delegacion>
    </template>
    <template v-if="menu==3">
        <nivel></nivel>
    </template>
    <template v-if="menu==4">
        <nomenclatura></nomenclatura>
    </template>  
    <template v-if="menu==5">
        <delegado></delegado>
    </template>       
    <template v-if="menu==6">
        <rol></rol>
    </template>       
@endsection