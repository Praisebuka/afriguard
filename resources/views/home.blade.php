@extends('layouts.main')

@section('content')
@include('sections.intro')

<main id="main">
  @include('sections.about')

  @include('sections.hotels')
  
  @include('sections.schedule')
  
  @include('sections.features')

  @include('sections.gallery')

  @include('sections.contact')

  @include('sections.faq')

</main>
@endsection