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

  <script>
@if (session('success'))
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
@endif

@if (session('error'))
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Try Again'
    });
@endif

@if ($errors->any())
    Swal.fire({
        title: 'Validation Error!',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        icon: 'warning',
        confirmButtonText: 'Fix it'
    });
@endif
</script>

</main>
@endsection