@extends('layout')
@section('title', 'Search Families')
@section('header')
<style>
        div.wrapper {
            padding-left: 300px;
            padding-right: 300px;
        }

        input {
             position: relative;
             display: block;
             margin : 0 auto;
        }

</style>
@endsection
@section('h1', 'Search for Families')
@section('content')


<div class="class="col-lg-8 col-md-10 col-sm-12"">
        <p>Search for Families in the System: </p>

        <input id="searchFamily" onkeyup="myFunction()" class="form-control" type="text" placeholder="Search" aria-label="Search"/>
        <ul id="families">
            @foreach ($families as $family)
            <li style="display:none;"><div><a href="#" id="{{ $family->id }}" value="{{ $family->id }}" onclick="showFamilies('{{$family->id}}');">{{ $family->first_name }} {{ $family->last_name }}</a></div></li>
            @endforeach
        </ul>

</div>


<script>
    function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("searchFamily");
  filter = input.value.toUpperCase();
  ul = document.getElementById("families");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("div")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
    } else {
        li[i].style.display = "none";
    }
  }
}

function showFamilies(id) {
    var index, families, family, info, children, familychildren;
    families = @json($families);
    children = @json($children);

    family = families.filter(f => f.id === parseInt(id))[0];
    familychildren = children.filter(c =>c.f_id === parseInt(id));

    info = "Name: " +family.first_name + " " + family.last_name;
    info += "\nPhone: " + family.phone;
    info += "\nEmail: " + family.email;

    familychildren.forEach(child =>
      info += "\nChild: " + child.child_name
    );

    window.alert(info);
}
</script>
@endsection
