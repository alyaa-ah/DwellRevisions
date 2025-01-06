@extends('adminSH/layout')

@section('content')
<div class="outer-container">
    <div class="container flex-column d-flex justify-content-center align-items-center">
        <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 text-center">
                <br><br><br>
                <div class="button-group d-none d-md-flex">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminSH/view-guesthouse-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right: 5px;" href="{{ url('/adminSH/view-guesthouse-rooms') }}">Guest House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminSH/view-staffhouse-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right: 5px;" href="{{ url('/adminSH/view-staffhouse-rooms') }}">Staff House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminSH/view-DFTC-rooms') || Request::is('adminSH/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right: 5px;" href="{{ url('/adminSH/view-DFTC-rooms') }}">DFTC</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="width:80%;" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 mt-2">
                <!-- Buttons for small screens -->
                <div class="select-group d-md-none">
                    <select class="form-select h-9 Montserrat bg-light-green text-dark-white w-100" style="width:100%;" onchange="location = this.value;">
                        <option class="{{ Request::is('adminSH/view-guesthouse-rooms') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminSH/view-guesthouse-rooms') }}" {{ Request::is('adminSH/view-guesthouse-rooms') ? 'selected' : '' }}>Guest House</option>
                        <option class="{{ Request::is('adminSH/view-staffhouse-rooms') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminSH/view-staffhouse-rooms') }}" {{ Request::is('adminSH/view-staffhouse-rooms') ? 'selected' : '' }}>Staff House</option>
                        <option class="{{ Request::is('adminSH/view-DFTC-rooms') || Request::is('adminSH/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminSH/view-DFTC-rooms') }}" {{ Request::is('adminSH/view-DFTC-rooms') || Request::is('adminSH/view-DFTC-halls') ? 'selected' : '' }}>DFTC</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12">
                <p class="Montserrat font-extrabold textGradient text-left text-3xl sm:text-4xl md:text-5xl lg:text-6xl h-12 sm:h-14 md:h-16 lg:h-20">GUEST HOUSE</p>
                <p class="Montserrat text-md font-bold textGradient text-center ">FACILITY </p>
            </div>
        </div>
    </div>
</div>
@foreach($guestHouseRooms as $index => $room)
<div class="container z-1 mt-3 mb-4 d-flex flex-column justify-content-center align-items-center">
    <div class="card lg:w-9/12 md:w-fit">
        <div class="card-body">
            <div class="container d-flex justify-content-center" style="padding: 0;">
                <div class="row" style="width: 100%">
                    <div class="col-md-5 d-flex justify-content-center align-items-center" data-aos="fade-right" data-aos-duration="800" style="padding: 0;">
                        <div id="carouselExampleControls{{$index}}" class="carousel slide" data-bs-ride="carousel" style="max-height: 320px; overflow: hidden;">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('photos/rooms/' . $room->room_photo1) }}" class="d-block" style="max-height: 100%; width: 100%;  object-fit: cover;" alt="Room Photo 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('photos/rooms/' . $room->room_photo2) }}" class="d-block" style="max-height: 100%; width: 100%;  object-fit: cover;" alt="Room Photo 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('photos/rooms/' . $room->room_photo3) }}" class="d-block" style="max-height: 100%; width: 100%;  object-fit: cover;" alt="Room Photo 3">
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
                        <div class="container">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <p class="Montserrat h-12 text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-extrabold textGradient text-left">{{ $room->room_number }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                            $bookingCount = $bookings->where('room_id', $room->id)->count();
                            $bookingFeedbacks = $feedbacks->where('room_id', $room->id);
                        @endphp
                        <span class="Montserrat text-sm font-bold textGradient text-left">Guest House | </span>
                        <span class="Montserrat text-sm font-semibold text-light-green text-left">
                            Status:
                            @if($bookingCount > 0)
                                <span class="inline-flex items-center">
                                    <i class="fa fa-calendar-check-o" style="color: orange; margin-right: 5px;"></i>
                                    <span style="color: orange; font-weight: bold;">Pre-Booked</span>
                                </span>
                            @elseif($room->room_status === 'Available')
                                <span class="inline-flex items-center mt-3">
                                    <i class="fa fa-check-circle" style="color: green; margin-right: 5px;"></i>
                                    <span style="color: green; font-weight: bold;">Available</span>
                                </span>
                            @else
                                <span class="inline-flex items-center">
                                    <i class="fa fa-times-circle" style="color: red; margin-right: 5px;"></i>
                                    <span style="color: red; font-weight: bold;">Unavailable</span>
                                </span>
                            @endif

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="Montserrat text-light-green text-sm font-semibold" style="text-align: justify;">{{ $room->room_description }}</p><br>

                                <table class="table table-borderless">
                                    <tr>
                                        <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-star" style="color: #25ec06;"></i></td>
                                        <td class="Montserrat text-light-green text-sm font-semibold">Ratings:
                                            @if($room->averageRating > 0)
                                                    <span>
                                                        {{ number_format($room->averageRating, 2) }}
                                                    </span>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($room->averageRating >= $i)
                                                            <!-- Full star -->
                                                            <i class="fa fa-star" style="color: #FFD700;"></i>
                                                        @elseif ($room->averageRating > ($i - 1) && $room->averageRating < $i)
                                                            <!-- Half star -->
                                                            <i class="fa fa-star-half-o" style="color: #FFD700;"></i>
                                                        @else
                                                            <!-- Empty star -->
                                                            <i class="fa fa-star-o" style="color: #FFD700;"></i>
                                                        @endif
                                                    @endfor
                                            @else
                                                <span>No ratings yet</span>
                                            @endif
                                        </tr>
                                    <tr>
                                    <tr>
                                        <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-list" style="color: #25ec06;"></i></td>
                                        <td class="Montserrat text-light-green text-sm font-semibold">Type: {{ $room->room_type}}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-user-group" style="color: #25ec06;"></i></td>
                                        <td class="Montserrat text-light-green text-sm font-semibold">Capacity: {{ $room->room_capacity }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-bookmark" style="color: #25ec06;"></i></td>
                                        <td class="Montserrat text-light-green text-sm font-semibold text-justify">Inclusion: {{ $room->room_inclusion }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-ellipsis" style="color: #25ec06;"></i></td>
                                        <td class="Montserrat text-light-green text-sm font-semibold text-justify">Amenities: {{ $room->room_amenities }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 Montserrat text-light-green text-sm font-semibold text-center"><i class="fa-solid fa-comment" style="color: #25ec06;"></i></td>
                                        <td class="Montserrat text-light-green text-sm font-semibold text-justify">
                                            Comments:
                                            <div style="max-height: 150px; overflow-y: auto; padding: 5px;">
                                                @php
                                                    $filteredFeedbacks = $bookingFeedbacks->filter(function ($feedback) {
                                                        return !is_null($feedback->ratings) && !is_null($feedback->feedbacks);
                                                    });
                                                @endphp

                                                @foreach ($filteredFeedbacks as $feedback)
                                                    @php
                                                        $firstName = explode(' ', $feedback->fullname)[0];
                                                        $rating = (int)$feedback->ratings;
                                                    @endphp
                                                    <div class="feedback-item" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                                                        <div style="flex: 1;">
                                                            <div>
                                                                <strong class="Montserrat text-light-green text-sm font-semibold">{{ $firstName }}</strong><br>
                                                                <span style="font-weight: 500;">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $rating)
                                                                            <i class="fa fa-star" style="color: #FFD700;"></i> <!-- Filled star -->
                                                                        @else
                                                                            <i class="fa fa-star-o" style="color: #FFD700;"></i> <!-- Empty star -->
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                            <div style="font-weight: 380; margin-top: 5px;">
                                                                {{ $feedback->feedbacks }}
                                                            </div>
                                                        </div>
                                                        <div style="text-align: right; flex-shrink: 0;">
                                                            <span style="font-weight: 500;">{{ $feedback->comment_date }}</span>
                                                        </div>
                                                    </div>
                                                    <hr style="color: #1ABC02">
                                                @endforeach

                                                @if ($bookingFeedbacks->isEmpty())
                                                    <span style="font-weight: 500;">No comments yet</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row d-flex align-items-end text-right">
                            <div class="col-md-12">
                                <p class="Montserrat text-light-green text-sm font-medium">Rate: {{ $room->room_rate }} Head</p>
                                @if(session()->has('loggedInCustomer') || session()->has('loggedInSuperAdmin') || session()->has('loggedInAdminSH'))
                                    @if($room->room_status != 'Unavailable' && $room->room_status != 'On-Renovation')
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="guestHouse-booking"
                                                onclick="bookGuestHouse('{{ addslashes(json_encode($room)) }}', '{{ addslashes(json_encode(session('loggedInAdminSH'))) }}')"
                                                class="btn rounded-full mr-3 bg-light-green text-white Montserrat hover:bg-dark-green transition ease-in-out duration-500">
                                                Book Now
                                            </button>
                                        </div>
                                    @else
                                        <h1>Room is currently not available for booking</h1>
                                    @endif
                                @else
                                    <h1>Please login to book</h1>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
<br>
<!-- Pre-Bookings Modal -->
<div class="modal fade" id="preBookingsModal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">PRE-BOOKINGS</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" style="border-radius: 15px;  overflow: hidden;">
                    <thead class="table-active">
                        <td class="Montserrat  text-sm font-semibold text-center align-content-center" style="color:#1ABC02">Username</td>
                        <td class="Montserrat text-sm font-semibold text-center align-content-center" style="color:#1ABC02">Number of Lodgers</td>
                        <td class="Montserrat text-sm font-semibold text-center align-content-center" style="color:#1ABC02">Check-in Date</td>
                        <td class="Montserrat text-sm font-semibold text-center align-content-center"style="color:#1ABC02">Check-out Date</td>
                    </thead>
                    <tr>
                        <td class="Montserrat  text-sm font-semibold align-content-center" style="color:#1ABC02">#</td>
                        <td class="Montserrat text-sm font-semibold text-center align-content-center" style="color:#1ABC02">#</td>
                        <td class="Montserrat text-sm font-semibold text-center align-content-center" style="color:#1ABC02">#</td>
                        <td class="Montserrat text-sm font-semibold text-center align-content-center"style="color:#1ABC02">#</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="guesthouse-prebooking-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Guest House Pre-Booking Details</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scrollable" id="bookingDetailsContainerGuestHouse">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="noneguesthouse-prebooking-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Guest House Pre-Booking Details</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="Montserrat text-xl font-semibold text-light-green text-center" >No pre-booking(s) to be fetched.</p>
            </div>
        </div>
    </div>
</div>
@endsection
