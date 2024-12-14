@extends('main/layout')

@section('content')
<div class="outer-container">
    <div class="container flex-column d-flex justify-content-center align-items-center">
        <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 text-center">
                <br><br><br><br>
                <div class="button-group d-none d-md-flex">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('main/view-guesthouse-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-guesthouse-rooms') }}">Guest House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('main/view-staffhouse-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-staffhouse-rooms') }}">Staff House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('main/view-DFTC-rooms') || Request::is('main/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-DFTC-rooms') }}">DFTC</a>
                </div>       
            </div>
        </div>
        <div class="row justify-content-center" style="width:80%;">
            <div class="col-md-12 mt-2">
                <!-- Buttons for small screens -->
                <div class="select-group d-md-none">
                    <select class="form-select h-9 Montserrat bg-light-green text-dark-white w-100" style="width:100%;" onchange="location = this.value;">
                        <option class="{{ Request::is('main/view-guesthouse-rooms') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/main/view-guesthouse-rooms') }}" {{ Request::is('main/view-guesthouse-rooms') ? 'selected' : '' }}>Guest House</option>
                        <option class="{{ Request::is('main/view-staffhouse-rooms') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/main/view-staffhouse-rooms') }}" {{ Request::is('main/view-staffhouse-rooms') ? 'selected' : '' }}>Staff House</option>
                        <option class="{{ Request::is('main/view-DFTC-rooms') || Request::is('main/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/main/view-DFTC-rooms') }}" {{ Request::is('main/view-DFTC-rooms') || Request::is('main/view-DFTC-halls')  ? 'selected' : '' }}>DFTC</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 text-center">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <a class="btn btn-nav h-9 Montserrat {{ Request::is('main/view-DFTC-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-DFTC-rooms') }}">Rooms</a>
                        <a class="btn btn-nav h-9 Montserrat {{ Request::is('main/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-DFTC-halls') }}">Halls</a>
                    </div>
                </div>           
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12">
                <p class="Montserrat h-12 mt-2 sm:h-14 md:h-16 lg:h-20 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold textGradient">
                    <span class="hidden sm:inline">DUMLAO FARMER'S TRAINING CENTER</span>
                    <span class="sm:hidden">DFTC ROOMS</span>
                </p>
                <p class="Montserrat text-md font-bold textGradient text-center ">FACILITY </p>
            </div>
        </div>
    </div>
</div>    
@foreach($DFTC as $index => $room)
    @if ($room->room_type == "Hall")
        <div class="container z-1 mt-3 d-flex flex-column justify-content-center align-items-center">
            <div class="card lg:w-9/12 sm:width: 100%;">
                <div class="card-body">
                    <div class="container d-flex justify-content-center" style="padding: 0;">
                        <div class="row" style="width: 100%">
                            <div class="col-md-5 d-flex justify-content-center align-items-center" data-aos="fade-right" data-aos-duration="800" style="padding: 0;">
                                <div id="carouselExampleControls{{$index}}" class="carousel slide" data-bs-ride="carousel" style="max-height: 320px; overflow: hidden;">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('/public/photos/rooms/' . $room->room_photo1) }}" class="d-block" style="max-height: 100%; width: 100%;  object-fit: cover;" alt="Room Photo 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('/public/photos/rooms/' . $room->room_photo2) }}" class="d-block" style="max-height: 100%; width: 100%;  object-fit: cover;" alt="Room Photo 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('/public/photos/rooms/' . $room->room_photo3) }}" class="d-block" style="max-height: 100%; width: 100%;  object-fit: cover;" alt="Room Photo 3">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{$index}}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{$index}}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Room Description -->
                            <div class="col-md-7" data-aos="fade-up" data-aos-duration="800">
                                <div class="container" style="padding: 0;">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-12">
                                            <p class="Montserrat h-12 text-1xl sm:text-1xl md:text-1xl lg:text-4xl font-extrabold textGradient text-left">{{ $room->room_number }}</p>
                                        </div>
                                    </div>
                                </div>

                                <span class="Montserrat text-sm font-bold textGradient text-left">DFTC | </span>
                                <span class="Montserrat text-sm font-semibold text-light-green text-left">Status: {{ $room->room_status }}</span>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <p class="Montserrat text-light-green text-sm font-semibold  text-justify">{{ $room->room_description }}</p><br>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-list" style="color: #25ec06;"></i></td>
                                                <td class="Montserrat text-light-green text-sm font-semibold">Type: {{ $room->room_type }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-user-group" style="color: #25ec06;"></i></td>
                                                <td class="Montserrat text-light-green text-sm font-semibold">Capacity: {{ $room->room_capacity }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-money-bill" style="color: #25ec06;"></i></td>
                                                <td class="Montserrat text-light-green text-sm font-semibold">Base Rate: {{ $room->room_baserate }}  Pesos</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-bookmark" style="color: #25ec06;"></i></td>
                                                <td class="Montserrat text-light-green text-sm font-semibold text-justify">Inclusion: {{ $room->room_inclusion }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-ellipsis" style="color: #25ec06;"></i></td>
                                                <td class="Montserrat text-light-green text-sm font-semibold text-justify">Amenities: {{ $room->room_amenities }}</td>
                                            </tr>
                                            @php
                                                $bookingCount = $bookings->where('room_id', $room->id)->count();
                                            @endphp
                                        </table>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-end text-right">
                                    <div class="col-md-12">
                                        <p class="Montserrat text-light-green text-sm font-medium">Rate: {{ $room->room_rate }} Pesos</p>
                                        <div class="d-flex justify-content-end">
                                            <button onclick="viewDftcHallPreBookingsMain('{{ $room->id }}')" class="btn lg:rounded-full md:rounded mt-1 bg-light-green text-white Montserrat hover:bg-dark-green transition ease-in-out duration-500 mr-2 flex items-center space-x-1">
                                                <span class="hidden sm:inline">Pre-Booking(s) |</span>
                                                <span class="flex items-center">{{ $bookingCount }}<i class="fa-solid fa-user fa-sm text-gray-300 ml-1"></i></span>
                                            </button>
                                            <h1 class="text-lg mt-2 text-light-green Montserrat font-semibold"><a id="btnLogin" data-bs-toggle="modal" data-bs-target="#loginModal" class=" hover:text-green-600 hover:underline">Please login to book</a></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
</div>
<br><br>
<div class="modal fade" id="dftchall-prebookings-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">DFTC Pre-Booking Details</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scrollable" id="bookingDetailsContainerDftchall">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nonedftchall-prebookings-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">DFTC Pre-Booking Details</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="Montserrat text-xl font-semibold text-light-green text-center" >No pre-booking(s) to be fetched.</p>
            </div>
        </div>
    </div>
</div>
@endsection
