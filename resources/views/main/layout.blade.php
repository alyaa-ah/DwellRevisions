<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

   {{-- <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.css" integrity="sha512-n1PBkhxQLVIma0hnm731gu/40gByOeBjlm5Z/PgwNxhJnyW1wYG8v7gPJDT6jpk0cMHfL8vUGUVjz3t4gXyZYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/public/images/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link href="{{ asset('public/build/assets/app-DNm3bkJO.css') }}" rel="stylesheet"> --}}
    <!-- External CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/styles1.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles/main/styles.css') }}">
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
        .styled-list {
            list-style-type: disc;
            padding-left: 20px;
        }

        .styled-list li {
            margin-bottom: 10px;
        }

        .styled-list li strong {
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="bg-gradient-to-r fixed-top from-dark-green via-light-green to-dark-green" style="height: 68px;"></div>
        </div>
            <nav class="fixed-top bg-body-tertiary bg-gradient-to-r from-light-white via-lightest-green to-lightest-green" style="height: 60px;">
                <div class="container-fluid  mx-auto px-2">
                    <div class="flex items-center justify-between py-2 relative">
                        <div class="flex items-center w-full lg:w-auto">
                            <a class="navbar-brand" href="{{url('/')}}">
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
                                    <a class="btn btn-nav Montserrat {{ Request::is('main/view-home') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-home') }}">HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-nav Montserrat {{ Request::is('main/view-guesthouse-rooms') || Request::is('main/view-staffhouse-rooms') || Request::is('main/view-DFTC-rooms') || Request::is('main/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-guesthouse-rooms') }}">ROOMS</a>
                                </li>
                                <li class="lg:hidden"><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <button id="btnLogin" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-nav Montserrat inactive">LOGIN</button>
                                </li>
                                <li class="nav-item">
                                    <button id="btnRegister" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-nav Montserrat inactive">REGISTER</button>
                                </li>
                            </ul>
                        </div>

                        <!-- User greetings on the right (outside toggle button)-->
                        <div class="hidden lg:flex lg:items-center text-end">
                            <a class="navbar-brand text-light-green Montserrat icon lg:text-lg font-medium hover:text-dark-green transition ease-in-out duration-500" href="{{url('/')}}">Welcome, Guest User! <i class="fas fa-user fa-xl icon" style="color: #1abc02;"></i></a>
                        </div>
                    </div>

                    <!-- Navbar links for smaller devices-->
                    <div class="lg:hidden fixed top-0 right-0 bg-gradient-to-r from-light-white via-lightest-green to-lightest-green p-4 shadow-lg drop-shadow-lg rounded-bl-lg" id="mobileMenu" style="display: none;">
                    <button class="text-white text-xl absolute top-2 right-2 focus:outline-none bg-light-green p-2 rounded" onclick="toggleMenu()">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="flex flex-col flex-wrap px-2 mt-10">
                        <a class="navbar-brand text-light-green Montserrat icon text-lg font-medium hover:text-dark-green transition ease-in-out duration-500 mb-4 inline-block max-w-xs break-normal align-middle" href="{{url('/')}}">
                            Welcome, Guest User!
                        </a>
                        <ul class="flex flex-col justify-center text-center space-y-2 list-none w-full">
                            <li class="nav-item">
                                <a class="btn btn-nav Montserrat block {{ Request::is('main/view-home') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/main/view-home') }}" style="width:100%">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-nav Montserrat block {{ Request::is('main/view-guesthouse-rooms') || Request::is('main/view-staffhouse-rooms') || Request::is('main/view-DFTC-rooms') || Request::is('main/view-DFTC-halls') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('main/view-guesthouse-rooms') }}" style="width:100%">ROOMS</a>
                            </li>
                            <li><hr class="dropdown-divider bg-dark-green" style="height: 1px;"></li>
                            <li class="nav-item">
                                <button id="btnLogin" data-bs-toggle="modal" data-bs-target="#loginModal"  class="btn btn-nav Montserrat block inactive" style="width:100%">LOGIN</button>
                            </li>
                            <li class="nav-item">
                                <button id="btnRegister" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-nav Montserrat block inactive" style="width:100%">REGISTER</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        </div>

             @yield('content')


        <footer class="footer">
            <div class="container-fluid" data-aos="fade-right" data-aos-duration="800">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.min.js" integrity="sha512-Ozu7Km+muKCuIaPcOyNyW8yOw+KvkwsQyehcEnE5nrr0V4IuUqGZUKJDavjSCAA/667Dt2z05WmHHoVVb7Bi+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/script.js') }}"></script>


</body>
</html>
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
<!-- Register Modal -->
<div class="modal fade" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green text-center">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">REGISTER</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body Montserrat text-sm font-semibold" style="max-height: 400px; overflow-y: auto;">
            <form id="registration-form" action="">
                @csrf
                    <div class="form-group text-light-green">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Please type here your username">
                    </div><br>
                    <div class="form-group text-light-green">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Please type here your fullname">
                    </div><br>

                    <div class="form-group text-light-green">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Please type here your google email">
                    </div><br>
                    <div class="form-group text-light-green">
                        <label class="text-sm">Position/Designation</label><br>
                        <select name="position" id="position" class="form-control">
                            <option value="">Select Position</option>
                            <option value="Guest">Guest</option>
                            <option value="Student">Student</option>
                            <option value="Employee">Employee</option>
                        </select>
                    </div><br>
                    <div class="form-group text-light-green">
                        <label for="agency">Department/Agency/College</label>
                        <input type="text" class="form-control" id="agency" name="agency" placeholder="Please type here your department/agency/college">
                    </div><br>
                    <div class="form-group text-light-green">
                        <label for="country_code">Contact Number</label>
                        <div class="input-group">
                            <!-- Custom Country Code Dropdown -->
                            <div class="custom-dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img id="selected-flag" src="{{ asset('icons/ph.png') }}" alt="Philippines" style="width: 18px;">PH (+63)
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-value="+63" data-flag="{{ asset('icons/ph.png') }}">
                                        <img src="{{ asset('icons/ph.png') }}" alt="Philippines" style="width: 18px;">PH (+63)</a></li>
                                </ul>
                            </div>

                            <!-- Hidden input to store the selected country code -->
                            <input type="hidden" id="country_code" name="country_code" value="+63">

                            <!-- Contact number input -->
                            <input type="number" class="form-control contact-input" id="contact" name="contact" placeholder="Please type your contact number" min="0">
                        </div>
                    </div>
                    <div class="form-group text-light-green">
                        <label for="address">Home Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Please type here your home address">
                    </div>
                    <div class="modal-footer">
                        <div class="container d-flex justify-content-center text-align-center">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <input type="checkbox" id="termsCheckbox" required class="me-2" >
                                    <label for="termsCheckbox" class="Montserrat text-blue-500 underline text-xs font-medium">
                                        <a href="#termsAndConditions" data-bs-toggle="modal">Terms and Conditions</a>
                                    </label>
                                </div>
                                <div class="col-12 d-flex justify-content-center align-items-center mt-2">
                                    <input type="checkbox" id="privacyCheckbox" required class="me-2">
                                    <label for="privacyCheckbox" class="Montserrat text-blue-500 underline text-xs font-medium">
                                        <a href="#privacypolicy" data-bs-toggle="modal">Privacy Policy Agreement</a>
                                    </label>
                                </div>
                                <div class="col-12 d-flex justify-content-center align-items-center mt-4 captcha-container">

                                    <div class="captcha-box">

                                        <span class="captcha-code" id="captchaCode">

                                        </span>
                                    </div>


                                    <span class="refresh-btn" id="refreshCaptcha">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </span>
                                </div>

                                <input type="text" id="captchaInput" class="form-control mt-3" placeholder="Enter here the CAPTCHA" required>

                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <button id="register-btn" type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Register</button>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <span class="Montserrat text-xs font-medium">Already have an account?</span>
                                <a  id="btnLogin" data-bs-toggle="modal" data-bs-target="#loginModal" class="Montserrat text-xs font-medium text-light-green hover:text-green-600 hover:underline" style="cursor: pointer;">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green text-center">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">LOGIN</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body Montserrat text-sm font-semibold">
                <form id="login-form">
                    <div class="form-group text-light-green">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Please type here your username">
                    </div><br>
                    <div class="form-group text-light-green">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Please type here your password">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Login</button>
                    </div>
                </form>
                <hr>
                <div class="modal-footer flex items-center space-x-2 Montserrat text-xs font-medium">
                    <div>
                        <span>Don't have an account?</span>
                        <a id="btnRegister" data-bs-toggle="modal" data-bs-target="#registerModal" class="Montserrat text-light-green hover:text-green-600 hover:underline" style="cursor: pointer;">
                            REGISTER
                        </a>
                    </div>
                    <div>
                        <span>Forgot your password?</span>
                        <a id="btnPassword" data-bs-toggle="modal" data-bs-target="#forgotPassword-modal" class="Montserrat text-light-green hover:text-green-600 hover:underline" style="cursor: pointer;">
                            REQUEST RESET
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="forgotPassword-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green text-center">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">Reset Password</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body Montserrat text-sm font-semibold">
                <form id="forgotPassword-form">
                    <div class="form-group text-light-green">
                        <label for="username">Email</label>
                        <input type="email" class="form-control" name="email" id="forgotEmailPassword" placeholder="Please type here your google email here.">
                    </div><br>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Submit</button>
                    </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="privacypolicy" tabindex="-1" aria-labelledby="privacypolicyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-green text-center">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5" id="privacypolicyLabel">Privacy Policy Agreement</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body Montserrat text-sm" style="text-align: justify; max-height: 80vh; overflow: scroll;">
                <strong>Effective Date: September 07, 2024</strong>
                <br>
                <strong>1. Introduction</strong>
                <p> Auxillary Program Services of Nueva Vizcaya State University is committed to protecting your privacy. This Privacy Policy outlines how we collect, use, disclose, and protect your personal information when you interact with our website, products, or services.</p>

                <strong>2. Information We Collect</strong>
                <p>We may collect the following types of personal information:</p>
                <ul class="styled-list">
                    <li><strong>Personal Identifiable Information (PII):</strong> This includes your name, email address, phone number, and other contact information.</li>
                    <li><strong>Usage Data:</strong> Information about how you use our services, such as your IP address, browser type, device information, and interaction with our website.</li>
                    <li><strong>Cookies and Tracking Technologies:</strong> We may use cookies and similar tracking technologies to collect information about your browsing activities.</li>
                </ul>

                <strong>3. How We Use Your Information</strong>
                <p>We may use your personal information for the following purposes:</p>
                <ul class="styled-list">
                    <li>To provide and improve our products and services.</li>
                    <li>To communicate with you about our products, services, and promotions.</li>
                    <li>To process your orders and payments.</li>
                    <li>To comply with legal requirements and protect our rights.</li>
                </ul>

                <strong>4. Disclosure of Your Information</strong>
                <p>We may disclose your personal information to:</p>
                <ul class="styled-list">
                    <li>Our affiliates and subsidiaries.</li>
                    <li>Third-party service providers who assist us in providing our services.</li>
                    <li>Law enforcement authorities or regulatory bodies as required by law.</li>
                </ul>

                <strong>5. Data Security</strong>
                <p>We implement reasonable security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. However, no method of transmission over the internet or electronic storage is completely secure.</p>

                <strong>6. Your Rights</strong>
                <p>You have the right to:</p>
                <ul class="styled-list">
                    <li>Access and rectify your personal information.</li>
                    <li>Object to the processing of your personal information.</li>
                    <li>Request the erasure of your personal information.</li>
                    <li>Restrict the processing of your personal information.</li>
                    <li>Data portability.</li>
                </ul>

                <strong>7. Children's Privacy</strong>
                <p>We do not knowingly collect personal information from children under the age of 17. If you are a parent or guardian and believe that your child has provided us with personal information, please contact us.</p>

                <strong>8. Changes to This Privacy Policy</strong>
                <p>We may update this Privacy Policy from time to time. We will notify you of any significant changes by posting the revised policy on our website.</p>

                <strong>9. Contact Us</strong>
                <p>If you have any questions about this Privacy Policy, please contact us at:</p>
                <ul class="styled-list">
                    <li><strong>Auxillary Program Services of Nueva Vizcaya State University</strong></li>
                    <li><strong>Bayombong, Nueva Vizcaya Philippines 3700</strong></li>
                    <li><strong>dwellasp@gmail.com</strong></li>
                </ul>
            </div>
            <div class="modal-footer flex items-center space-x-2 Montserrat text-xs font-medium">
                <span>Get back to register form?</span>
                <a id="btnRegister" data-bs-toggle="modal" data-bs-target="#registerModal" class="Montserrat text-light-green hover:text-green-600 hover:underline" style="cursor: pointer;">
                    REGISTER
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="termsAndConditions" tabindex="-1" aria-labelledby="termsAndConditionsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-green text-center">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5" id="termsAndConditionsLabel">Terms and Conditions</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body Montserrat text-sm" style="text-align: justify; max-height:80vh; overflow: scroll;">
                <strong style="font-size: 18px">Terms and Conditions</strong>
                <p><strong>Last updated:</strong> December 15, 2024</p>

                <p>Please read these Terms and Conditions carefully before using the dwell.sharvilclass.com website operated by Auxillary Program Services of Nueva Vizcaya State University.</p>

                <p>Your access to and use of the Service is conditioned upon your acceptance of and compliance with these Terms. These Terms apply to all visitors, users, and others who access or use the Service.</p>

                <p>By accessing or using the Service, you agree to be bound by these Terms. If you disagree with any part of the Terms, you may not access the Service.</p>

                <strong>1. Use of the Service</strong>
                <p>You are responsible for your use of the Service and for any content you post to the Service. You agree to use the Service in compliance with applicable laws, rules, and regulations.</p>

                <strong>2. User Accounts</strong>
                <p>When you create an account with us, you must provide accurate, complete, and current information. Failure to do so constitutes a breach of the Terms, which may result in the termination of your account.</p>

                <strong>3. Intellectual Property</strong>
                <p>The Service and its original content, features, and functionality are and will remain the exclusive property of Auxillary Program Services and its licensors.</p>

                <strong>4. Termination</strong>
                <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

                <strong>5. Limitation of Liability</strong>
                <p>In no event shall Auxillary Program Services, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of the Service.</p>

                <strong>6. Disclaimer</strong>
                <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.</p>

                <strong>7. Governing Law</strong>
                <p>These Terms shall be governed and construed in accordance with the laws of Republic of the Philippines, without regard to its conflict of law provisions.</p>

                <strong>8. Changes</strong>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

                <strong>9. Contact Us</strong>
                <p>If you have any questions about these Terms, please contact us at dwellasp@gmail.com</p>
            </div>
            <div class="modal-footer flex items-center space-x-2 Montserrat text-xs font-medium">
                <span>Get back to register form?</span>
                <a id="btnRegister" data-bs-toggle="modal" data-bs-target="#registerModal" class="Montserrat text-light-green hover:text-green-600 hover:underline" style="cursor: pointer;">
                    REGISTER
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ url('js/registration/register.js') }}"></script>
<script type="text/javascript" src="{{ url('js/login/login.js') }}"></script>
<script type="text/javascript" src="{{ url('js/login/forgotpassword.js') }}"></script>
<script type="text/javascript" src="{{ url('js/main/prebook/functions.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dropdownItems = document.querySelectorAll('.dropdown-item');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();


            const countryCode = item.getAttribute('data-value');
            const flagUrl = item.getAttribute('data-flag');
            const countryText = item.textContent.trim();


            const flagImage = document.getElementById('selected-flag');
            flagImage.src = flagUrl;
            flagImage.alt = countryText;


            const button = document.querySelector('.dropdown-toggle');
            button.innerHTML = `<img id="selected-flag" src="${flagUrl}" alt="${countryText}" style="width: 18px;"> ${countryText}`;


            const countryCodeInput = document.getElementById('country_code');
            countryCodeInput.value = countryCode;


            const selectedCountryCode = countryCodeInput.value;
            console.log(selectedCountryCode);
        });
    });
});
$(document).ready(function(){
    function generateCaptcha() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*?';
    var captcha = '';
    for (var i = 0; i < 6; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        captcha += characters[randomIndex];
    }
    $('#captchaCode').text(captcha);
    }
    $('#refreshCaptcha').click(function() {
        generateCaptcha();
    });
    generateCaptcha();
});
</script>

