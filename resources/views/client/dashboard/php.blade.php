{{-- @extends('client/layout')

@section('content')

<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-4">
                        <a href="{{ url('/client/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-ratings') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-ratings') || Request::is('client/view-staffhouse-ratings') || Request::is('client/view-DFTC-ratings') ? 'bg-dark-green text-dark-white' : '' }}"> <i class="fas fa-star"></i>
                            <span class="ms-1 d-none d-sm-inline">RATINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-prereservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-prereservations') || Request::is('client/view-staffhouse-prereservations') || Request::is('client/view-DFTC-prereservations') ? 'bg-dark-green text-dark-white' : '' }}"><i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-history') || Request::is('client/view-staffhouse-history') || Request::is('client/view-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}"><i class="fas fa-history"></i>
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
            <div class="container card w-100 bg-light-white mt-2">
                <p class="Montserrat text-2xl md:text-5xl font-extrabold textGradient text-center mt-3">
                    GUEST HOUSE
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="guestHouseDashboardTable">
                            <thead>
                                <tr>
                                    <th width="15%">Room Name</th>
                                    <th width="60%" style="text-align: left">Report</th>
                                    <th width="5%" class="text-center">Link</th>
                                    <th width="5%">GH number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guesthousebooking as $booking)
                                    <tr>
                                        <td>{{ $booking->room_number }}</td>
                                        <td>
                                            @if ($booking->status == 'Pending Review')
                                                Your request is now <span class="status-badge pending">pending for approval.</span>
                                            @elseif ($booking->status == 'Canceled')
                                                Your request has been <span class="status-badge canceled"> cancelled due to {{ $booking->reason }}</span>
                                            @elseif ($booking->status == 'Rejected')
                                                Your request has been <span class="status-badge rejected"> rejected due to {{ $booking->reason }}</span>
                                            @else
                                                Your request is now <span class="status-badge approved">approved by the admin.</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($booking->status == 'Pending Review')
                                                <a href="{{ url('/client/view-guesthouse-prereservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @elseif ($booking->status == 'Canceled')
                                                <a href="{{ url('/client/view-guesthouse-canceled-preservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @elseif ($booking->status == 'Rejected')
                                                <a href="{{ url('/client/view-guesthouse-rejected-preservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @else
                                                <a href="{{ url('/client/view-guesthouse-prereservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $booking->GH_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container card w-100 bg-light-white mt-5">
                <div class="row">
                    <p class="Montserrat text-2xl md:text-5xl font-extrabold textGradient text-center mt-3 mb-2">
                        STAFF HOUSE
                    </p>
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="staffHouseDashboardTable">
                            <thead>
                                <tr>
                                    <th width="15%">Room Name</th>
                                    <th width="60%" style="text-align: left">Report</th>
                                    <th width="5%" class="text-center">Link</th>
                                    <th width="5%">SH number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffhousebooking as $booking)
                                    <tr>
                                        <td>{{ $booking->room_number }}</td>
                                        <td>
                                            @if ($booking->status == 'Pending Review')
                                                Your request is now <span class="status-badge pending">pending for approval.</span>
                                            @elseif ($booking->status == 'Canceled')
                                                Your request has been <span class="status-badge canceled"> cancelled due to {{ $booking->reason }}</span>
                                            @elseif ($booking->status == 'Rejected')
                                                Your request has been <span class="status-badge rejected"> rejected due to {{ $booking->reason }}</span>
                                            @else
                                                Your request is now <span class="status-badge approved">approved by the admin.</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($booking->status == 'Pending Review')
                                                <a href="{{ url('/client/view-staffhouse-prereservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @elseif ($booking->status == 'Canceled')
                                                <a href="{{ url('/client/view-staffhouse-canceled-preservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @elseif ($booking->status == 'Rejected')
                                                <a href="{{ url('/client/view-staffhouse-rejected-preservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @else
                                                <a href="{{ url('/client/view-staffhouse-prereservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $booking->SH_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container card w-100 bg-light-white mt-5">
                <div class="row">
                    <p class="Montserrat text-2xl md:text-5xl font-extrabold textGradient text-center mt-3 mb-2">
                        DUMLAO FARMER'S TRAINING CENTER
                    </p>
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="dftcDashboardTable">
                            <thead>
                                <tr>
                                    <th width="20%">Room Name</th>
                                    <th width="70%" style="text-align: left">Report</th>
                                    <th width="5%" class="text-center">Link</th>
                                    <th width="5%">DFTC number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dftcbooking as $booking)
                                    <tr>
                                        <td>{{ $booking->room_number }}</td>
                                        <td>
                                            @if ($booking->status == 'Pending Review')
                                                Your request is now <span class="status-badge pending">pending for approval.</span>
                                            @elseif ($booking->status == 'Canceled')
                                                Your request has been <span class="status-badge canceled"> cancelled due to {{ $booking->reason }}</span>
                                            @elseif ($booking->status == 'Rejected')
                                                Your request has been <span class="status-badge rejected"> rejected due to {{ $booking->reason }}</span>
                                            @else
                                                Your request is now <span class="status-badge approved">approved by the admin.</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($booking->status == 'Pending Review')
                                                <a href="{{ url('/client/view-DFTC-prereservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @elseif ($booking->status == 'Canceled')
                                                <a href="{{ url('/client/view-DFTC-canceled-preservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @elseif ($booking->status == 'Rejected')
                                                <a href="{{ url('/client/view-DFTC-rejected-preservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @else
                                                <a href="{{ url('/client/view-DFTC-prereservations') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $booking->DFTC_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rating-guesthouse-booking-modal">
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
                            <form id="rating-clientGuestHouse">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="booking_id" id="client_rating_id" hidden>
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
<div class="modal fade" id="view-rating-guesthouse-booking-modal">
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
                                    <p id="ratingGuestHouseModal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Feedback</p>
                                </div>
                                <div class="col-md-10 ">
                                    <textarea class="form-control" id="feedbackGuestHouseModal" readonly cols="45" rows="5"></textarea>
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

@endsection --}}
