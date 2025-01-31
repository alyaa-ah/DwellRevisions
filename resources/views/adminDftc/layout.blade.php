<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.css" integrity="sha512-n1PBkhxQLVIma0hnm731gu/40gByOeBjlm5Z/PgwNxhJnyW1wYG8v7gPJDT6jpk0cMHfL8vUGUVjz3t4gXyZYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/public/images/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- External CSS -->
    {{-- <link href="{{ asset('public/build/assets/app-DNm3bkJO.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/styles1.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles/adminDFTC/styles.css') }}">
    <title>Dwell</title>
    <style>
        body {
                background-image: url('{{ asset("images/BackgroundPicture.png") }}');
                font-family: 'Geologica', sans-serif;
            }
        @media (max-width: 768px) {
            body {
                font-family: 'Montserrat', sans-serif;
            }
        }
        @keyframes fb-hover {
            0% {
                content: url('{{ asset("images/fb.svg") }}');
            }
            100% {
                content: url('{{ asset("images/fb-hover.svg") }}');
            }
        }

        @keyframes gmail-hover {
            0% {
                content: url('{{ asset("images/gmail.svg") }}');
            }
            100% {
                content: url('{{ asset("images/gmail-hover.svg") }}');
            }
        }

        @keyframes ig-hover {
            0% {
                content: url('{{ asset("images/ig.svg") }}');
            }
            100% {
                content: url('{{ asset("images/ig-hover.svg") }}');
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="bg-gradient-to-r fixed-top from-dark-green via-light-green to-dark-green" style="height: 68px;"></div>
    </div>
    <nav class="fixed-top bg-body-tertiary bg-gradient-to-r from-light-white via-lightest-green to-lightest-green" style="height: 60px;">
        <div class="container-fluid mx-auto px-2">
            <div class="flex items-center justify-between py-2 relative">
                <div class="flex items-center w-full lg:w-auto">
                    <a class="navbar-brand" href="{{url('adminDftc/')}}">
                        <img src="{{ asset('images/Logo.png') }}" class="h-10 max-w-full" alt="Navbar Logo">
                    </a>
                    <!-- Toggle Button for smaller devices -->
                    <button class="lg:hidden bg-light-green text-gray-600 text-end focus:outline-none relative ml-auto p-2 rounded" id="toggleButton" aria-controls="top-navbar" aria-expanded="false" onclick="toggleMenu()">
                        <i id="menuIcon" class="fas fa-bars text-white"></i>
                    </button>
                    </div>

                <!-- Navbar links for larger devices-->
                <div class="hidden lg:flex lg:items-center lg:w-auto lg:space-x-6" id="top-navbar">
                    <ul class="flex flex-col lg:flex-row space-x-0 lg:space-x-2 list-none lg:ml-auto" id="navLinks">
                        <li class="nav-item">
                            <a class="btn btn-nav Montserrat {{ Request::is('adminDFTC/view-home') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-home') }}">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-nav Montserrat {{ Request::is('adminDFTC/view-guesthouse-rooms') || Request::is('adminDFTC/view-staffhouse-rooms') || Request::is('adminDFTC/view-DFTC-rooms') || Request::is('adminDFTC/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-DFTC-rooms') }}">ROOMS</a>
                        </li>
                        <li class="lg:hidden"><hr class="dropdown-divider"></li>
                        <li class="nav-item">
                            <a class="btn btn-nav Montserrat {{ Request::is('adminDFTC/view-guesthouse-pre-reservation-form') || Request::is('adminDFTC/view-staffhouse-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-room-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-DFTC-room-pre-reservation-form') }}">PRE-BOOK NOW</a>
                        </li>
                        <li class="nav-item">
                            <a id="signOutButton" class="btn btn-nav Montserrat inactive" style="width:100%;">LOGOUT</a>
                        </li>
                    </ul>
                </div>
                <!-- User greetings on the right (outside toggle button)-->
                <div class="hidden lg:flex lg:items-center text-end">
                    <a class="navbar-brand text-light-green Montserrat icon lg:text-lg font-medium hover:text-dark-green transition ease-in-out duration-500" href="{{ url('/adminDFTC/view-dashboard') }}">Hi, {{ session('loggedInAdminDftc')['fullname'] }}!<i class="fas fa-user fa-xl icon" style="color: #1abc02;"></i></a>
                </div>
            </div>

            <!-- Navbar links for smaller devices-->
            <div class="lg:hidden fixed top-0 right-0 bg-gradient-to-r from-light-white via-lightest-green to-lightest-green p-4 shadow-lg drop-shadow-lg rounded-bl-lg" id="mobileMenu" style="display: none;">
                <button class="text-white text-xl absolute top-2 right-2 focus:outline-none bg-light-green p-2 rounded" onclick="toggleMenu()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="flex flex-col flex-wrap px-2 mt-10">
                    <a class="navbar-brand text-light-green Montserrat icon text-lg font-medium hover:text-dark-green transition ease-in-out duration-500 mb-4 inline-block max-w-xs break-normal align-middle" href="{{ url('/adminDFTC/view-dashboard') }}">
                        Hi, {{ session('loggedInAdminDftc')['fullname'] }}! </a>
                    <ul class="flex flex-col justify-center text-center space-y-2 list-none w-full">
                        <li class="nav-item">
                            <a class="btn btn-nav Montserrat {{ Request::is('adminDFTC/view-home') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-home') }}" style="width:100%;" >HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-nav Montserrat {{ Request::is('adminDFTC/view-guesthouse-rooms') || Request::is('adminDFTC/view-staffhouse-rooms') || Request::is('adminDFTC/view-DFTC-rooms') || Request::is('adminDFTC/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-DFTC-rooms') }}" style="width:100%;">ROOMS</a>
                        </li>
                        <li><hr class="dropdown-divider bg-dark-green" style="height: 1px;"></li>
                        <li class="nav-item">
                            <a class="btn btn-nav Montserrat {{ Request::is('adminDFTC/view-guesthouse-pre-reservation-form') || Request::is('adminDFTC/view-staffhouse-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-room-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-DFTC-room-pre-reservation-form') }}" style="width:100%;">PRE-BOOK NOW</a>
                        </li>
                        <li class="nav-item">
                            <button id="signOutButtonSmallerDevice" class="btn btn-nav Montserrat inactive" style="width:100%;">LOGOUT</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

    @yield('content')

    <footer class="footer">
            <div class="container" data-aos="fade-right" data-aos-duration="800">
                <div class="row text-dark-white text-left">
                    <div class="col-md-4 mb-6 md:mb-0">
                        <img src="{{ asset('images/FooterLogo.png') }}" class="h-16" alt="Navbar Logo">
                        <p class="text-xs Montserrat footerText h-3">&copy; {{ date('Y') }} Dwell v2</p>
                        <p class="text-xs Montserrat footerText h-3">All Rights Reserved.</p>
                    </div>
                    <div class="col-md-4 mb-6 md:mb-0">
                        <p class="text-lg font-medium Montserrat footerText h-6">Get in Touch</p>
                        <p class="text-sm Montserrat footerText">Auxiliary Services Program Office, Nueva Vizcaya State University</p>
                        <a class="navbar-brand icon Montserrat text-sm footerText hover:text-light-white transition ease-in-out duration-500 block text-left" href="https://www.facebook.com/profile.php?id=100054605057754" target="_blank">
                            <i class="fa-brands fa-facebook fa-xl" style="color: #EAEAEA;"></i> Facebook Page
                        </a>
                    </div>
                    <div class="col-md-4 mb-6 md:mb-0">
                        <p class="text-lg font-medium Montserrat footerText h-6">Reach Out to Us</p>
                        <a class="navbar-brand icon Montserrat text-sm footerText hover:text-light-white transition ease-in-out duration-500 block text-left" href="https://mail.google.com/mail/?view=cm&fs=1&to=dwellasp@gmail.com" target="_blank">DwellNVSU@gmail.com</a>
                        <p class="text-lg font-medium Montserrat footerText h-6 mt-1">Learn More</p>
                        <a class="navbar-brand icon Montserrat text-sm footerText hover:text-light-white transition ease-in-out duration-500 block text-left" href="https://nvsu.edu.ph" target="_blank">Nueva Vizcaya State University</a>
                    </div>
                </div>
            </div>
            <div class="container rounded mt-3">
                <div class="row text-dark-white">
                    <div class="col-md-12"> <!-- Full-width column on small screens -->
                        <p class="text-sm Montserrat footerText h-4 text-center">Developed by:</p>
                        <p data-bs-toggle="modal" data-bs-target="#developers" class="text-sm Montserrat footerText mt-1 streamline text-center">
                            <i class="fa-solid fa-laptop-code" style="color: #ffffff;"></i> Streamline
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    <script src="{{ asset('public/build/assets/app-C1-XIpUa.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.min.js" integrity="sha512-Ozu7Km+muKCuIaPcOyNyW8yOw+KvkwsQyehcEnE5nrr0V4IuUqGZUKJDavjSCAA/667Dt2z05WmHHoVVb7Bi+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>

</body>
</html>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green text-center">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">LOGOUT</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <p class="Montserrat text-lg font-extrabold textGradient">DO YOU WANT TO LOGOUT?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="developers">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">DEVELOPMENT TEAM</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body developers">
                <div id="developersCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="background-color: #f5f5f5">
                            <div class="text-center">
                                <img class="rounded-circle shadow-1-strong mb-4 mx-auto" src="{{ asset('images/developers/kristine.png') }}" width="120px" height="120px" alt="kristinephoto">
                                <p class="Montserrat text-sm font-semibold text-light-green">Kristine Joy A. Briones</p>
                                <p class="Montserrat text-sm font-semibold text-light-green">Responsive Web Developer <br> Front-End Developer</p><br>
                                <p class="Montserrat text-sm font-semibold text-light-green">Contact me:</p>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="https://www.facebook.com/kj.briones20" target="_blank" class="mx-2">
                                        <img src="{{ asset('images/fb.svg') }}" class="social-icon fb-icon" alt="Facebook">
                                    </a>
                                    <a href="mailto:kristinejoy.briones20@gmail.com" class="mx-2">
                                        <img src="{{ asset('images/gmail.svg') }}" class="social-icon gmail-icon" alt="Gmail">
                                    </a>
                                    <a href="https://www.instagram.com/riexiel.b/" class="mx-2">
                                        <img src="{{ asset('images/ig.svg') }}" class="social-icon ig-icon" alt="Instagram">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="background-color: #f5f5f5">
                            <div class="text-center">
                                <img class="rounded-circle shadow-1-strong mb-4 mx-auto" src="{{ asset('images/developers/justin.png') }}" width="120px" height="120px" alt="justinphoto">
                                <p class="Montserrat text-sm font-semibold text-light-green">Marc Justin S. Manzano</p>
                                <p class="Montserrat text-sm font-semibold text-light-green"> Graphics & UI/UX Designer <br> Front-End Developer</p><br>
                                <p class="Montserrat text-sm font-semibold text-light-green">Contact me:</p>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="https://www.facebook.com/juunnnnnnnn?mibextid=ZbWKwL" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/fb.svg') }}" class="social-icon fb-icon" alt="Facebook">
                                    </a>
                                    <a href="mailto:mrcjstnmanzano@gmail.com" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/gmail.svg') }}" class="social-icon gmail-icon" alt="Gmail">
                                    </a>
                                    <a href="https://www.instagram.com/_justjstn?igsh=NnN5aHcybDhtazUw" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/ig.svg') }}" class="social-icon ig-icon" alt="Instagram">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="background-color: #f5f5f5">
                            <div class="text-center">
                                <img class="rounded-circle shadow-1-strong mb-4 mx-auto" src="{{ asset('images/developers/arjay.png') }}" width="120px" height="120px" alt="arjayphoto">
                                <p class="Montserrat text-sm font-semibold text-light-green">Arjay B. Ordinario</p>
                                <p class="Montserrat text-sm font-semibold text-light-green">Project Manager <br> Full-Stack Developer</p><br>
                                <p class="Montserrat text-sm font-semibold text-light-green">Contact me:</p>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="https://www.facebook.com/ArjayOrdinario29?mibextid=kFxxJD" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/fb.svg') }}" class="social-icon fb-icon" alt="Facebook">
                                    </a>
                                    <a href="mailto:arjay.ordinario026@gmail.com" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/gmail.svg') }}" class="social-icon gmail-icon" alt="Gmail">
                                    </a>
                                    <a href="https://www.instagram.com/arrrrrrj_?igsh=Y3NlbjJseTVvZHRh" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/ig.svg') }}" class="social-icon ig-icon" alt="Instagram">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="background-color: #f5f5f5">
                            <div class="text-center">
                                <img class="rounded-circle shadow-1-strong mb-4 mx-auto" src="{{ asset('images/developers/shammah.png') }}" width="120px" height="120px" alt="shammahphoto">
                                <p class="Montserrat text-sm font-semibold text-light-green">Shammah Bless B. Ortaliza</p>
                                <p class="Montserrat text-sm font-semibold text-light-green">UX Researcher & Technical Writer <br>Quality Assurance (QA) Tester </p><br>
                                <p class="Montserrat text-sm font-semibold text-light-green">Contact me:</p>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="https://www.facebook.com/shammah.ortaliza?mibextid=ZbWKwL" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/fb.svg') }}" class="social-icon fb-icon" alt="Facebook">
                                    </a>
                                    <a href="mailto:shammahblessbortaliza@gmail.com" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/gmail.svg') }}" class="social-icon gmail-icon" alt="Gmail">
                                    </a>
                                    <a href="https://www.instagram.com/shammahortaliza" target="_blank"  class="mx-2">
                                        <img src="{{ asset('images/ig.svg') }}" class="social-icon ig-icon" alt="Instagram">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="background-color: #f5f5f5">
                            <div class="text-center">
                                <img class="rounded-circle shadow-1-strong mb-4 mx-auto" src="{{ asset('images/developers/sirallen.png') }}" width="120px" height="120px" alt="shammahphoto">
                                <p class="Montserrat text-sm font-semibold text-light-green">Dr. Allen Mark A. Razalan</p>
                                <p class="Montserrat text-sm font-semibold text-light-green">Product Manager</p>
                                <p class="Montserrat text-sm font-semibold text-light-green">NVSU ASP Director</p><br>
                                <p class="Montserrat text-sm font-semibold text-light-green">Contact me:</p>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="https://www.facebook.com/allenmark.razalan" target="_blank"  class="mx-2" >
                                        <img src="{{ asset('images/fb.svg') }}" class="social-icon fb-icon" alt="Facebook">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#developersCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#developersCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js/adminDFTC/logout.js') }}"></script>
<script src="{{ url('js/adminDFTC/pre-booking/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/booking-guesthouse/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/booking-staffhouse/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/booking-dftc-room/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/booking-dftc-hall/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/room/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/DFTC/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/my-guesthouse/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/my-staffhouse/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/my-dftc-room/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/my-dftc-hall/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/pdf-form/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/account/functions.js') }}"></script>
<script src="{{ url('js/adminDFTC/data-tables/functions.js') }}"></script>
