@extends('superAdmin/layout')

@section('content')

<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-5">
                        <a href="{{ url('superAdminDashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdminDashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-rooms') || Request::is('superAdmin/view-create-room') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-guesthouse-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-preservations') || Request::is('superAdmin/view-staffhouse-preservations') || Request::is('superAdmin/view-DFTC-preservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-guesthouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-history') || Request::is('superAdmin/view-staffhouse-history') || Request::is('superAdmin/view-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-guesthouse-canceled-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-canceled-preservations') || Request::is('superAdmin/view-staffhouse-canceled-preservations') || Request::is('superAdmin/view-DFTC-canceled-preservations') || Request::is('superAdmin/view-guesthouse-rejected-preservations') || Request::is('superAdmin/view-staffhouse-rejected-preservations') || Request::is('superAdmin/view-DFTC-rejected-preservations') ?  'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS </span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-clients') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-clients') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-users"></i>
                            <span class="ms-1 d-none d-sm-inline"> CLIENTS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-activity-logs') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-activity-logs') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="ms-1 d-none d-sm-inline">ACTIVITY LOGS</span>
                        </a>
                    </li>
                    <li class="border-b border-gray-300 w-full">
                        <a href="{{ url('/superAdmin/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
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
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-auto xl:w-full bg-light-white mt-2 px-2">
                    <div class="row">
                        <div class="col-md-12 m-1">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <!-- Guest house -->
                                    <div class="card my-1 mx-1 bg-warning shadow-md rounded-md text-white">
                                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="Montserrat text-3xl">
                                                    @if ($totalAmountSumFormattedGuestHouse >= 1000)
                                                        ₱ {{ $totalAmountSumFormattedGuestHouse }}
                                                    @elseif ($totalAmountSumFormattedGuestHouse >= 100)
                                                        ₱ 0{{ $totalAmountSumFormattedGuestHouse }}
                                                    @else
                                                        ₱ 0{{ $totalAmountSumFormattedGuestHouse }}
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/public/images/icons/earnings.svg') }}" alt="earnings" style="height: 20px; width: 30px" class="mr-1">
                                                    <span class="d-sm-inline" style="font-size: 18px;">Earnings</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-chart-wrapper m-3">
                                            <canvas class="chart text-white w-100" id="guestHouseChartTotalEarnings"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Staff house -->
                                    <div class="card my-1 mx-2 bg-info shadow-md rounded-md text-white">
                                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="Montserrat text-3xl">
                                                    @if ($totalAmountSumFormattedStaffHouse >= 1000)
                                                        ₱ {{ $totalAmountSumFormattedStaffHouse }}
                                                    @elseif ($totalAmountSumFormattedStaffHouse >= 100)
                                                        ₱ 0{{ $totalAmountSumFormattedStaffHouse }}
                                                    @else
                                                        ₱ 0{{ $totalAmountSumFormattedStaffHouse }}
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/public/images/icons/earnings.svg') }}" alt="earnings" style="height: 20px; width: 30px" class="mr-1">
                                                    <span class="d-sm-inline" style="font-size: 18px;">Earnings</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-chart-wrapper m-3">
                                            <canvas class="chart text-white w-100" id="staffHouseChartTotalEarnings"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- DFTC -->
                                    <div class="card my-1 mx-2 text-white shadow-md rounded-md bg-primary">
                                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="Montserrat text-3xl">
                                                    @if ($totalAmountSumFormattedDftc >= 1000)
                                                        ₱ {{ $totalAmountSumFormattedDftc }}
                                                    @elseif ($totalAmountSumFormattedDftc >= 100)
                                                        ₱ 0{{ $totalAmountSumFormattedDftc }}
                                                    @else
                                                        ₱ 0{{ $totalAmountSumFormattedDftc }}
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/public/images/icons/earnings.svg') }}" alt="earnings" style="height: 20px; width: 30px;" class="mr-1">
                                                    <span class="d-sm-inline" style="font-size: 18px;">Earnings</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-chart-wrapper m-3">
                                            <canvas class="chart text-white w-100" id="dftcChartTotalEarnings"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-1">
                            <div class="row  d-flex justify-content-center">
                                <div class="col-md-12 ">
                                    <!-- Total Earnings -->
                                    <div class="card m-2 bg-success shadow-md rounded-md text-white">
                                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="Montserrat text-3xl">
                                                    @if ($totalAmountSumTotal >= 1000)
                                                        ₱ {{ $totalAmountSumTotal }}
                                                    @elseif ($totalAmountSumTotal >= 100)
                                                        ₱ 0{{ $totalAmountSumTotal }}
                                                    @else
                                                        ₱ 0{{ $totalAmountSumTotal }}
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/public/images/icons/earnings.svg') }}" alt="earnings" style="height: 20px; width: 30px" class="mr-1">
                                                    <span style="font-size: 18px; margin-top: 0.5rem">Total Earnings</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-chart-wrapper m-3">
                                            <canvas class="chart text-white" id="totalEarnings"></canvas>
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
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ctxDftc = document.getElementById('dftcChartTotalEarnings').getContext('2d');
    const labelsDftc = {!! json_encode($labelsTotalDftc) !!};
    const dataSetsDftc = {!! json_encode($dataSetsTotalDftc) !!};

    dataSetsDftc.forEach(dataset => {
        dataset.borderColor = 'rgba(192, 192, 192, 1)';
        dataset.backgroundColor = 'rgba(255, 255, 255, 1)';
    });

    const DFTCBookingChart = new Chart(ctxDftc, {
        type: 'line',
        data: {
            labels: labelsDftc,
            datasets: dataSetsDftc
        },
        options: {
            maintainAspectRatio: false,
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

    // Staff House Chart Total Earnings
    const ctxStaffHouse = document.getElementById('staffHouseChartTotalEarnings').getContext('2d');
    const labelsStaffHouse = {!! json_encode($labelsTotalStaffHouse) !!};
    const dataSetsStaffHouse = {!! json_encode($dataSetsTotalStaffHouse) !!};

    dataSetsStaffHouse.forEach(dataset => {
        dataset.borderColor = 'rgba(192, 192, 192, 1)';
        dataset.backgroundColor = 'rgba(255, 255, 255, 1)';
    });

    const StaffHouseChart = new Chart(ctxStaffHouse, {
        type: 'line',
        data: {
            labels: labelsStaffHouse,
            datasets: dataSetsStaffHouse
        },
        options: {
            maintainAspectRatio: false,
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

    // Guest House Chart Total Earnings
    const ctxGuestHouse = document.getElementById('guestHouseChartTotalEarnings').getContext('2d');
    const labelsGuestHouse = {!! json_encode($labelsTotalGuestHouse) !!};
    const dataSetsGuestHouse = {!! json_encode($dataSetsTotalGuestHouse) !!};

    dataSetsGuestHouse.forEach(dataset => {
        dataset.borderColor = 'rgba(192, 192, 192, 1)';
        dataset.backgroundColor = 'rgba(255, 255, 255, 1)';
    });

    const GuestHouseChart = new Chart(ctxGuestHouse, {
        type: 'line',
        data: {
            labels: labelsGuestHouse,
            datasets: dataSetsGuestHouse
        },
        options: {
            color: 'white',
            maintainAspectRatio: false,
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
    // Total Earnings Chart
    const labelsTotal = @json($labelsTotal);
    const dataTotal = @json($dataTotal);
    const totalAmountSumTotal = @json($totalAmountSumTotal);

    const ctxTotal = document.getElementById('totalEarnings').getContext('2d');

    const myChart = new Chart(ctxTotal, {
        type: 'bar',
        data: {
            labels: labelsTotal,
            datasets: [{
                label: 'Total Amount',
                data: dataTotal,
                backgroundColor: [
                    'rgba(255, 152, 0, 1)',
                    'rgba(23, 162, 184, 1)',
                    'rgba(0, 123, 255, 1)',
                ],
                borderColor: [
                    'rgba(40, 53, 147, 1)',
                    'rgba(33, 150, 243, 1)',
                    'rgba(255, 152, 0, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    ticks: {
                        color: 'white',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: 'white',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
            }
        }
    });
});

</script>
@endsection
