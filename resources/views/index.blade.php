@extends('main/layout')

@section('content')
    <div class="container logo-container d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <img src="{{ asset('images/Logo.png') }}" class="h-48 logo-image" alt="Navbar Logo">
        <p class="Montserrat font-medium text-medium-green tracking-wide text-lg text-center">NUEVA VIZCAYA STATE UNIVERSITY'S PRE-RESERVATION PLATFORM</p>
        <strong style="cursor: pointer" class="Montserrat text-medium-green  text-lg text-center" data-bs-toggle="modal" data-bs-target="#updateModal">Dwell Version 2 Release Notes</strong>
    </div>
    <div class="modal fade" id="updateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light-green text-center">
                    <h1 class="modal-title Montserrat text-white font-semibold fs-5">Dwell V2 Update Announcements</h1>
                    <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body Montserrat text-sm font-semibold">
                    <div>
                        <p class="Montserrat text-md font-bold text-medium-green">What's New</p><br>
                        <p class="Montserrat text-sm font-semibold text-justify  text-medium-green">
                            1. Introduced new features, including Ratings and Feedback, Early Check-Out, and Extended Check-Out options.
                        </p><br>
                        <p class="Montserrat text-sm font-semibold text-medium-green text-justify">
                            2. Added Forgot Password functionality and reCAPTCHA for enhanced security.
                        </p><br>
                        <p class="Montserrat text-sm font-semibold text-medium-green text-justify">
                            3. Resolved several minor bugs for improved performance.
                        </p><br>
                        <p class="Montserrat text-sm font-semibold text-justify text-red-500">
                            4. Introduced additional bugs to be fixed in the future.
                        </p><br>
                        <p class="Montserrat text-sm font-semibold text-justify text-red-500">
                            5. Removed unnecessary bullshits.
                        </p><br>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
