@extends('adminSH/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-16">
                        <a href="{{ url('/adminSH/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-rooms') || Request::is('adminSH/create-room') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-ongoing-staffhouse-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-ongoing-staffhouse-pre-reservations') || Request::is('adminSH/view-pending-staffhouse-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span></a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-staffhouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-staffhouse-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-rejected-pre-reservations') || Request::is('adminSH/view-canceled-pre-reservations')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS </span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="#" class="dropdown-toggle nav-link text-white" id="myActivities" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tasks fa-fw me-sm-1 fa-md"></i>
                            <span class="d-none d-sm-inline me-sm-1">MY ACTIVITIES</span>
                        </a>
                        <ul class="dropdown-menu bg-dark-green text-dark-white"  aria-labelledby="myActivities">
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminSH/view-my-ongoing-staffhouse-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminSH/view-my-ongoing-guesthouse-pre-reservations') || Request::is('adminSH/view-my-ongoing-staffhouse-pre-reservations') || Request::is('/adminSH/view-my-ongoing-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="ms-1">PRE-BOOKINGS</span>
                                </a>
                            </li>
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminSH/view-my-staffhouse-history') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminSH/view-my-guesthouse-history') || Request::is('adminSH/view-my-staffhouse-history') || Request::is('adminSH/view-my-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-history"></i>
                                    <span class="ms-1">HISTORY</span>
                                </a>
                            </li>
                            <li class="border-gray-300 w-full">
                                <a href="{{ url('/adminSH/view-my-staffhouse-canceled-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('/adminSH/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminSH/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminSH/view-my-DFTC-canceled-pre-reservations') || Request::is('adminSH/view-my-DFTC-rejected-pre-reservations') || Request::is('adminSH/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminSH/view-my-guesthouse-rejected-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">VOIDS</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="border-b border-ray-300 w-full">
                        <a href="{{ url('/adminSH/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-1 d-none d-sm-inline">ACCOUNT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-9 col-md-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">DASHBOARD</p>
            <div class="card w-full bg-light-white mt-2 px-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3">
                                <!-- Current bookings reviewed -->
                                <div class="card m-2 text-white bg-primary shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($staffHouseCurrentBookingsReviewed <= 9)
                                                    0{{$staffHouseCurrentBookingsReviewed}}
                                                @else
                                                    {{$staffHouseCurrentBookingsReviewed}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/icons/ongoing.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
                                                <span style="font-size: 18px;">Ongoing</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3">
                                        <canvas class="chart text-white" id="dftcChartOngoing"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                 <!-- Booking History -->
                                <div class="card text-white bg-info m-2 shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($staffHouseCurrentBookingsHistory <= 9)
                                                    0{{$staffHouseCurrentBookingsHistory}}
                                                @else
                                                    {{$staffHouseCurrentBookingsHistory}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/icons/history.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
                                                <span style="font-size: 18px;">History</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" >
                                        <canvas class="chart text-white" id="dftcChartHistory"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!--not reviewed booking-->
                                <div class="card text-white bg-warning shadow-md rounded-md m-2">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($staffHouseCurrentBookingsNotReviewed <= 9)
                                                    0{{$staffHouseCurrentBookingsNotReviewed}}
                                                @else
                                                    {{$staffHouseCurrentBookingsNotReviewed}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/icons/pending.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
                                                <span style="font-size: 18px;">Pending</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" >
                                        <canvas class="chart text-white" id="dftcChartPending"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-danger m-2 shadow-md rounded-md ">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($staffHouseVoidedBookings <= 9)
                                                    0{{$staffHouseVoidedBookings}}
                                                @else
                                                    {{$staffHouseVoidedBookings}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/icons/voids.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
                                                <span style="font-size: 18px;">Voids</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" >
                                        <canvas class="chart text-white" id="dftcChartVoids"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 px-4 my-2">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <div class="card text-white bg-success mb-2 shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl ml-5">
                                                @if ($totalAmountSumFormatted >= 1000)
                                                    ₱ {{ $totalAmountSumFormatted }}
                                                @elseif ($totalAmountSumFormatted >= 100)
                                                    ₱ 0{{ $totalAmountSumFormatted }}
                                                @else
                                                    ₱ 0{{ $totalAmountSumFormatted }}
                                                @endif
                                            </div>
                                            <div class="ml-5 d-flex align-items-center">
                                                <img src="{{ asset('images/icons/earnings.svg') }}" alt="earnings" style="height: 20px; width: 30px" class="mr-1">
                                                <span style="font-size: 18px;">Earnings</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-auto" style="height: 100%; overflow-y: auto; width: 90%;">
                                        <canvas class="chart text-white" id="dftcChartTotalEarnings" style="height: 100%; width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx1 = document.getElementById('dftcChartOngoing').getContext('2d');
        const labels1 = {!! json_encode($labels) !!};
        const dataSets1 = {!! json_encode($dataSets) !!};

        dataSets1.forEach(dataset => {
            dataset.borderColor = 'rgba(192, 192, 192, 1)';
            dataset.backgroundColor = 'rgba(255, 255, 255, 1)';
        });

        const DFTCBookingChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: labels1,
                datasets: dataSets1
            },
            options: {
                color: 'white',
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            },
                            color: 'white'
                        }
                    }
                }
            }
        });

        const ctx2 = document.getElementById('dftcChartHistory').getContext('2d');
        const labels2 = {!! json_encode($labelsHistory) !!};
        const dataSets2 = {!! json_encode($dataSetshistory) !!};

        dataSets2.forEach(dataset => {
            dataset.borderColor = 'rgba(255, 165, 0, 1)';
            dataset.backgroundColor = 'rgba(255, 206, 86, 1)';
        });

        const DFTCBookingChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels2,
                datasets: dataSets2
            },
            options: {
                color: 'white',
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            },
                            color: 'white'
                        }
                    }
                }
            }
        });

        const ctx3 = document.getElementById('dftcChartPending').getContext('2d');
        const labels3 = {!! json_encode($labelsPending) !!};
        const dataSets3 = {!! json_encode($dataSetsPending) !!};

        dataSets3.forEach(dataset => {
            dataset.borderColor = 'rgba(0, 0, 0, 1)';
            dataset.backgroundColor = 'rgba(255, 255, 255, 1)';
        });

        const DFTCBookingChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: labels3,
                datasets: dataSets3
            },
            options: {
                color: 'white',
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            },
                            color: 'white'
                        }
                    }
                }
            }
        });

        const ctx4 = document.getElementById('dftcChartVoids').getContext('2d');
        const labels4 = {!! json_encode($voidsLabels) !!};
        const dataSets4 = {!! json_encode($voidsDataSets) !!};

        dataSets4.forEach(dataset => {
            dataset.borderColor = 'rgba(0, 255, 255, 1)';
            dataset.backgroundColor = 'rgba(255, 255, 240, 1)';
        });

        const DFTCBookingChart4 = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: labels4,
                datasets: dataSets4
            },
            options: {
                color: 'white',
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            },
                            color: 'white'
                        }
                    }
                }
            }
        });

        const ctx5 = document.getElementById('dftcChartTotalEarnings').getContext('2d');
        const labels5 = {!! json_encode($labelsTotal) !!};
        const dataSets5 = {!! json_encode($dataSetsTotal) !!};

        const backgroundColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(83, 102, 255, 1)',
            'rgba(50, 205, 50, 1)',
            'rgba(220, 20, 60, 1)',
            'rgba(30, 144, 255, 1)',
            'rgba(255, 165, 0, 1)'
        ];

        dataSets5.forEach(dataset => {
            dataset.borderColor = 'rgba(255, 255, 255, 1)';
            dataset.backgroundColor = backgroundColors;
        });

        const DFTCBookingChart5 = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: labels5,
                datasets: dataSets5
            },
            options: {
                color: 'white',
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            },
                            color: 'white'
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
