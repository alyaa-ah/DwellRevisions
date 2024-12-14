@extends('adminDftc/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-5">
                        <a href="{{ url('/adminDFTC/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-rooms') || Request::is('adminDFTC/create-room') ? 'bg-dark-green text-dark-white' : '' }}">                            
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-ongoing-DFTC-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-ongoing-DFTC-pre-reservations') || Request::is('adminDFTC/view-pending-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span></a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-DFTC-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-guesthouse-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-rejected-pre-reservations') || Request::is('adminDFTC/view-canceled-pre-reservations')  ? 'bg-dark-green text-dark-white' : '' }}">
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
                                <a href="{{ url('/adminDFTC/view-my-ongoing-DFTC-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-my-ongoing-guesthouse-pre-reservations') || Request::is('adminDFTC/view-my-ongoing-staffhouse-pre-reservations') || Request::is('adminDFTC/view-my-ongoing-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="ms-1">PRE-BOOKINGS</span>
                                </a>
                            </li>
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminDFTC/view-my-DFTC-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-my-guesthouse-history') || Request::is('adminDFTC/view-my-staffhouse-history') || Request::is('adminDFTC/view-my-DFTC-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-history"></i>
                                    <span class="ms-1">HISTORY</span>
                                </a>
                            </li>
                            <li class="border-gray-300 w-full">
                                <a href="{{ url('/adminDFTC/view-my-DFTC-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-canceled-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-rejected-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminDFTC/view-my-guesthouse-rejected-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">VOIDS</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="border-b border-ray-300 w-full">
                        <a href="{{ url('/adminDFTC/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
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
                                <div class="card m-2 text-white bg-primary shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($dftcCurrentBookingsReviewed <= 9)
                                                    0{{$dftcCurrentBookingsReviewed}}
                                                @else
                                                    {{$dftcCurrentBookingsReviewed}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('/public/images/icons/ongoing.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
                                                <span style="font-size: 18px;">Ongoing</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" >
                                        <canvas class="chart text-white" id="dftcChartOngoing"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card m-2 text-white bg-info shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($dftcCurrentBookingsHistory <= 9)
                                                    0{{$dftcCurrentBookingsHistory}}
                                                @else
                                                    {{$dftcCurrentBookingsHistory}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('/public/images/icons/history.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
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
                                <div class="card m-2 text-white bg-warning shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($dftcCurrentBookingsNotReviewed <= 9)
                                                    0{{$dftcCurrentBookingsNotReviewed}}
                                                @else
                                                    {{$dftcCurrentBookingsNotReviewed}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('/public/images/icons/pending.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
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
                                <div class="card m-2 text-white bg-danger shadow-md rounded-md">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($dftcVoidedBookings <= 9)
                                                    0{{$dftcVoidedBookings}}
                                                @else
                                                    {{$dftcVoidedBookings}}
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('/public/images/icons/voids.svg') }}" alt="earnings" style="height: 20px; width: 30px; background: none;">
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
                    <div class="col-md-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                  <!-- Total Earnings -->
                                <div class="card mx-2 mb-2 bg-success shadow-md rounded-md text-white">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="Montserrat text-3xl">
                                                @if ($totalAmountSumFormatted >= 1000)
                                                    ₱ {{ $totalAmountSumFormatted }}
                                                @elseif ($totalAmountSumFormatted >= 100)
                                                    ₱ 0{{ $totalAmountSumFormatted }}
                                                @else
                                                    ₱ 0{{ $totalAmountSumFormatted }}
                                                @endif
                                            </div>
                                            <div class="ml-5 d-flex align-items-center">
                                                <img src="{{ asset('/public/images/icons/earnings.svg') }}" alt="earnings" style="height: 20px; width: 30px" class="mr-1">
                                                <span style="font-size: 18px; margin-top: 0.5rem">Earnings</span>
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
        const ctx = document.getElementById('dftcChartOngoing').getContext('2d');
        const labels = {!! json_encode($labels) !!};
        const dataSets = {!! json_encode($dataSets) !!};

        dataSets.forEach(dataset => {
            dataset.borderColor = 'rgba(192, 192, 192, 1)';
            dataset.backgroundColor = 'rgba(255, 255, 255, 1)';
        });

        const DFTCBookingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: dataSets
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('dftcChartHistory').getContext('2d');
        const labels = {!! json_encode($labelsHistory) !!};
        const dataSets = {!! json_encode($dataSetshistory) !!};

        dataSets.forEach(dataset => {
            dataset.borderColor = 'rgba(255, 165, 0, 1)';
            dataset.backgroundColor = 'rgba(255, 206, 86, 1)';
        });

        const DFTCBookingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: dataSets
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart for dftcChartPending
        const ctx1 = document.getElementById('dftcChartPending').getContext('2d');
        const labels1 = {!! json_encode($labelsPending) !!};
        const dataSets1 = {!! json_encode($dataSetsPending) !!};

        dataSets1.forEach(dataset => {
            dataset.borderColor = 'rgba(0, 0, 0, 1)';
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

        // Chart for dftcChartVoids
        const ctx2 = document.getElementById('dftcChartVoids').getContext('2d');
        const labels2 = {!! json_encode($voidsLabels) !!};
        const dataSets2 = {!! json_encode($voidsDataSets) !!};

        dataSets2.forEach(dataset => {
            dataset.borderColor = 'rgba(0, 255, 255, 1)';
            dataset.backgroundColor = 'rgba(255, 255, 240, 1)';
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

        // Chart for dftcChartTotalEarnings
        const ctx3 = document.getElementById('dftcChartTotalEarnings').getContext('2d');
        const labels3 = {!! json_encode($labelsTotal) !!};
        const dataSets3 = {!! json_encode($dataSetsTotal) !!};
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

        dataSets3.forEach(dataset => {
            dataset.borderColor = 'rgba(255, 255, 255, 1)';
            dataset.backgroundColor = backgroundColors;
        });

        const DFTCBookingChart3 = new Chart(ctx3, {
            type: 'bar',
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
    });
</script>

@endsection
