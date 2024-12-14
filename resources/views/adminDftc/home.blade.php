@extends('adminDftc/layout')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <!-- About -->
            <div class="row m-10 mt-20 w-100">
                <div class="col-md-7" data-aos="fade-up" data-aos-duration="800">
                    <p class="Montserrat font-extrabold textGradient text-3xl sm:text-4xl md:text-5xl lg:text-6xl h-12 sm:h-14 md:h-16 lg:h-20">ABOUT US</p>
                    <p class="Montserrat text-xl font-normal text-justify">Dwell is a pre-booking system for Nueva Vizcaya State University's lodgings, simplifying reservations for clients. Although bookings aren't confirmed until payment, the system allows online pre-booking from anywhere with internet access. It offers a user-friendly interface for checking room availability, accessing terms and conditions, and initiating pre-bookings, reducing the need for in-person inquiries.</p>
                </div>
                <div class="col-md-5" data-aos="fade-left" data-aos-duration="800">
                    <table class="h-48 bg-lime-50 image-home" style="background-color: transparent;">
                        <tr>
                            <td colspan="2" class="p-1" style="width:1000px; height:200px;">
                                <img src="{{ asset('/public/images/Home/1.JPG') }}" style="width:1000px; height:200px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:60%; height:200px;">
                                <img src="{{ asset('/public/images/Home/2.JPG') }}" style="width:1000px; height:200px;">
                            </td>
                            <td class="p-1" style="width:40%; height:200px;">
                                <img src="{{ asset('/public/images/Home/3.JPG') }}" style="width:1000px; height:200px;">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <!-- Pre-Booking -->
            <div class="row d-flex flex-wrap-reverse w-100">
                <div class="col-md-5 mb-5" data-aos="fade-right" data-aos-duration="800">
                    <table class="h-48 bg-lime-50 image-home" style="background-color: transparent;">
                        <tr>
                            <td colspan="2" class="p-1" style="width:1000px; height:200px;">
                                <img src="{{ asset('/public/images/Home/4.JPG') }}" style="width:1000px; height:200px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:60%; height:200px;">
                                <img src="{{ asset('/public/images/Home/5.JPG') }}" style="width:1000px; height:200px;">
                            </td>
                            <td class="p-1" style="width:40%; height:200px;">
                                <img src="{{ asset('/public/images/Home/6.JPG') }}" style="width:1000px; height:200px;">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-7" data-aos="fade-up" data-aos-duration="800">
                    <p class="Montserrat font-extrabold textGradient text-3xl sm:text-4xl md:text-5xl lg:text-6xl h-12 sm:h-14 md:h-16 lg:h-20">PRE-BOOKING</p>
                    <p class="Montserrat text-xl font-normal text-justify">Please note that while pre-booking doesn't ensure a spot, it does reserve a place in line or indicate an intention to book in the future. It is similar to holding a spot in a queue or expressing interest before the actual booking process occurs. Once the pre-booking is completed, it typically precedes the final booking, where the client is required to finalize their reservation at the university campus.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
