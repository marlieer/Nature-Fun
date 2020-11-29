@extends('layout')
@section('title', 'Search Children')
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
@section('h1', 'Search for Children')
@section('content')


<div class="col-lg-8 col-md-10 col-sm-12">
        <p>Search for Child in the System: </p>

        <input id="searchChild" onkeyup="myFunction()" class="form-control" type="text" placeholder="Search" aria-label="Search"/>
        <ul id="children">
            @foreach ($children as $child)
            <li style="display: none;"><div><a href="#" id="{{ $child->id }}" value="{{ $child->id }}" onclick="showChild('{{$child->id}}');">{{ $child->name }} {{ $child->last_name }}</a></div></li>
            @endforeach
        </ul>

</div>


<script>
    function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("searchChild");
  filter = input.value.toUpperCase();
  ul = document.getElementById("children");
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

function showChild(id) {
    var index, children, child, info;
    children = @json($children);
    child = children.filter(c => c.id === parseInt(id))[0];
    info = "Child: " +child.name + " " + child.last_name;
    info += "\nFamily: " +child.first_name + " " + child.last_name;
    info += "\nPhone: " + child.phone;
    info += "\nEmail: " + child.email;
    info += "\nAllergies: " + child.allergy_info;
    info += "\nNotes: " + child.notes;
    info += "\nCan take photos? " + child.can_take_photos;
    window.alert(info);
}
</script>
@endsection
