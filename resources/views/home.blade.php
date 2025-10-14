@extends('layouts.main')

@section('content')
@include('sections.intro')

<main id="main">
  @include('sections.about')

  @include('sections.who_are_we')
  
  @include('sections.schedule')
  
  @include('sections.features')

  @include('sections.gallery')

  @include('sections.contact')

  @include('sections.faq')


</main>
@endsection