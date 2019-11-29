@extends('layout')
@section('header')
<style>
    .fill {
    overflow: hidden;
    background-size: cover;
    background-position: center;
    background-image: url('images/butterfly_trail.jpg');
}
</style>
@endsection
<div class="fill">
@section('content')
@section('h1', 'Contact Us')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact</div>
                <div class="card-body">
                    250-398-8532
                </div>
                <div class="card-body">
                    scoutisland@shaw.ca
                </div>
                <div class="card-body">
                    1305 A Borland Road,
                    Williams Lake, BC;
                    V2G 5K5
                </div>

                <div class="card-header">About Us</div>
                <div class="card-body">
                    Scout Island Nature Centre is a registered charitable organization run by the Williams Lake Field Naturalists in cooperation with the Nature Trust of British Columbia and the City of Williams Lake. It is a community centre for people and wildlife and offers walking trails and nature programs to the public and school groups.
                </div>
                 <div class="card-header">How We are Funded</div>
                <div class="card-body">
                    Funds come from public fund-raising appeals, annual Nature Centre banquets, fee-for-service from the City of Williams Lake, grants from provincial and federal agencies, grants from foundations, donations from local businesses and public donations accepted at the Nature House. A complete list of supporters is found <a href="https://scoutisland.ca/support-us/" target="_blank">Here</a>
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
