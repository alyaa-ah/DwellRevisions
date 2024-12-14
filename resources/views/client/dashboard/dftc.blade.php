@extends('client/layout')

@section('content')

<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-4">
                        <a href="{{ url('/client/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-dashboard') || Request::is('client/view-dashboard-staffhouse') || Request::is('client/view-dashboard-DFTC') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-prereservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-prereservations') || Request::is('client/view-staffhouse-prereservations') || Request::is('client/view-DFTC-prereservations') ? 'bg-dark-green text-dark-white' : '' }}">                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-history') || Request::is('client/view-staffhouse-history') || Request::is('client/view-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-canceled-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-canceled-preservations') || Request::is('client/view-staffhouse-canceled-preservations') || Request::is('client/view-DFTC-canceled-preservations') || Request::is('client/view-guesthouse-rejected-preservations') || Request::is('client/view-staffhouse-rejected-preservations') || Request::is('client/view-DFTC-rejected-preservations') ? 'bg-dark-green text-dark-white' : '' }}">                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS </span>
                        </a>
                    </li>
                    <li class="border-b border-gray-300 w-full">
                        <a href="{{ url('/client/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-account')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-1 d-none d-sm-inline">ACCOUNT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 3rem">DASHBOARD</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center mt-2">
                    <!-- Buttons for medium and larger screens -->
                    <div class="button-group d-none d-md-flex">
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-dashboard') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-dashboard') }}">Guest House</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-dashboard-staffhouse') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-dashboard-staffhouse') }}">Staff House</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-dashboard-DFTC') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-dashboard-DFTC') }}">DFTC</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mt-2">
                    <!-- Buttons for small screens -->
                    <div class="select-group d-md-none">
                        <select class="form-select h-9 Montserrat bg-light-green text-dark-white sm:my-2 sm:w-full md:w-auto" onchange="location = this.value;">
                            <option class="{{ Request::is('client/view-dashboard*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-dashboard') }}" {{ Request::is('client/view-guesthouse-preservations*') ? 'selected' : '' }}>Guest House</option>
                            <option class="{{ Request::is('client/view-dashboard-staffhouse*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-dashboard-staffhouse') }}" {{ Request::is('client/view-dashboard-staffhouse*') ? 'selected' : '' }}>Staff House</option>
                            <option class="{{ Request::is('client/view-dashboard-DFTC*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-dashboard-DFTC') }}" {{ Request::is('client/view-dashboard-DFTC*') ? 'selected' : '' }}>DFTC</option>
                        </select>
                    </div>
                </div>
            </div>
            <p class="Montserrat text-2xl md:text-5xl font-extrabold textGradient text-center mt-3">
                DUMLAO FARMER'S TRAINING CENTER
            </p>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-striped table-hover w-auto" id="dftcHistoryRatingClientTable">
                        <thead>
                            <tr>
                                <th width="30%">Room Name</th>
                                <th width="15%">Check In Date</th>
                                <th width="15%">Check Out Date</th>
                                <th width="5%">Amount</th>
                                <th width="20%" class="text-center">To Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dftcCurrentBookingsHistory as $booking)
                                <tr>
                                    <td>{{ $booking->room_number }}</td>
                                    <td>{{ $booking->check_in_date }}</td>
                                    <td>{{ $booking->check_out_date }}</td>
                                    <td>
                                        @if ($booking->total_amount == '0.00' && $booking->position == 'Student')
                                            FREE
                                        @else
                                            {{ $booking->total_amount }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($booking->ratings == "NULL" || $booking->ratings == "")
                                            <button type="button" onclick="makeRatingsDftc('{{ addslashes(json_encode($booking)) }}')" class="btn btn-warning"><i class="fa-solid fa-star" style="color: BLACK;"></i></button>
                                        @else
                                            <button type="button" onclick="viewRatingsDftc('{{ addslashes(json_encode($booking)) }}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rating-DFTC-booking-modal">
    <div class="modal-dialog modal-m">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Ratings and Feedbacks</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="rating-clientDftc">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="booking_id" id="client_rating_id_DFTC" hidden>
                                </div>
                                <div class="mb-3">
                                    <label for="rating" class="form-group Montserrat text-m font-semibold text-light-green">Rate your experience:</label>
                                    <div id="star-rating" class="d-flex">
                                        <span class="star" data-value="1">&#9733;</span>
                                        <span class="star" data-value="2">&#9733;</span>
                                        <span class="star" data-value="3">&#9733;</span>
                                        <span class="star" data-value="4">&#9733;</span>
                                        <span class="star" data-value="5">&#9733;</span>
                                    </div>
                                    <input type="hidden" name="rating" id="rating-value">
                                </div>
                                <div class="mb-3">
                                    <label for="feedback" class="form-group Montserrat text-m font-semibold text-light-green">Your feedback:</label>
                                    <textarea name="feedback" id="feedback" rows="4" class="form-control" placeholder="Leave any comments here..."></textarea>
                                </div>
                                <div class="row justify-end">
                                    <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green w-fit mr-2">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-rating-DFTC-booking-modal">
    <div class="modal-dialog modal-m">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">View Rating and Feedback</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 border-4 rounded-md border-green-600">
                            <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Rating and Feedback Information
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Rating</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="ratingDftcModal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Feedback</p>
                                </div>
                                <div class="col-md-10 ">
                                    <textarea class="form-control" id="feedbackDftcModal" readonly cols="45" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#star-rating .star');
        const ratingValue = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('mouseover', function () {
                const value = this.getAttribute('data-value');
                highlightStars(value);
            });

            star.addEventListener('mouseout', function () {
                highlightStars(ratingValue.value); // Reset to current rating
            });

            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingValue.value = value; // Set the hidden input value
            });
        });

        function highlightStars(value) {
            stars.forEach(star => {
                const starValue = star.getAttribute('data-value');
                if (starValue <= value) {
                    star.style.color = '#FFD700'; // Highlight color (gold)
                } else {
                    star.style.color = '#ccc'; // Default color (gray)
                }
            });
        }
    });
</script>

<style>
    #star-rating .star {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s ease-in-out;
    }
</style>
@endsection
