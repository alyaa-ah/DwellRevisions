<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-top: -50px;
            margin-bottom: -50px;
            font-size: 14px;
        }
        .container-flex {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        td span {
            text-align: right;
        }
        span {
            text-decoration: underline;
        }
        .footer {
            width: 100%;
            font-size: 12px;
        }
        .page-break {
            page-break-after: always;
        }
        .ordinal {
            font-size: 0.8em;
            vertical-align: super;
        }
        #dormitory-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        #dormitory-table th, #dormitory-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        #dormitory-table .text-center {
            text-align: center;
        }
        #dormitory-table .ordinal {
            text-decoration: none;
            font-size: 0.8em;
            vertical-align: super;
        }
        .spantitle{
            text-decoration: none;
            font-weight: bold;
        }
        .footer {
            width: 100%;
            font-size: 12px;
            bottom:0px;
            position: fixed;
        }
    </style>
</head>
<body>
    <div class="container-flex">
        {!! $headerHtml !!}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-row" style="margin-top: -1rem;">
                            <p style="text-align: right;"><span class="spantitle">RDFTC_No:</span> <span>{{ $DFTC_number}}</span>
                            <br><span>{{ $DFTC_date }}</span><br>
                            <span class="spantitle" style="text-align: right; margin-right: 4rem; margin-top: -1rem;">Date</span></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <span class="spantitle">Name of Requestor: </span> <span>{{ $fullname }}</span> <span class="spantitle" style="margin-left: 8rem;">Position/Designation: </span><span>{{ $position }}</span>
                            <br><span class="spantitle">Activity: </span><span>{{ $activity }}</span>
                            <br><span class="spantitle">Department/Agency/College: </span><span>{{ $agency }}</span>
                            <br><span class="spantitle">Contact Number: </span><span style="margin-right: 2rem;">{{ $contact }}</span>
                            <br><span class="spantitle">Address: </span><span>{{ $address }}</span>
                            <br><span class="spantitle">LODGING:</span>
                            <br>Dormitory Room 1<span class="ordinal" style="text-decoration: none">st</span> floor (64 capacity) <span style="text-decoration: none; margin-left: 7rem;"> = 100 pesos/head</span><br>
                            <span style="text-decoration: none; margin-left: 6.7rem;">2<span class="ordinal" style="text-decoration: none">nd</span> floor (30 capacity)</span> <span style="text-decoration: none; margin-left: 6.70rem;"> = 100 pesos/head </span> <br>
                            Air-conditioned Room: 1<span class="ordinal" style="text-decoration: none">st</span> floor 2 capacity <span style="text-decoration: none; margin-left: 5.8rem;"> = 500 pesos/head </span> <br>
                            <span style="text-decoration: none; margin-left: 11.7rem;">12 capacity w/out CR </span> <span style="text-decoration: none; margin-left: 1.9rem">= 200 pesos/head</span> <br>
                            <span style="text-decoration: none; margin-left: 12.2rem;">4 capacity w/out CR </span><span  style="text-decoration: none; margin-left: 2.1rem">= 200 pesos/head</span> <br>
                            <span style="text-decoration: none; margin-left: 9rem;">2<span class="ordinal" style="text-decoration: none">nd</span> floor 3 capacity </span><span style="text-decoration: none; margin-left: 5.70rem;">= 500 pesos/head</span> <br>
                        </p>
                    </div>

                    <div class="col-md-12">
                        <p>
                            <span class="spantitle">DURATION OF STAY:</span>
                            <br><span class="spantitle">Specific Dates: </span><span>{{ $check_in_date }} - {{ $check_out_date }}</span>
                            <span style="text-decoration: none; margin-left: 0.7rem;">
                                <span>{{ $number_of_days }}</span> <span class="spantitle">day(s)</span>
                                <span style="text-decoration: none; margin-left: 1rem;">
                                    <span>{{ $number_of_nights }}</span> <span class="spantitle">nigth(s) only</span>
                                </span>
                            </span>
                            <br>
                            <span class="spantitle">Date/Time of Arrival: </span> <span style="margin-right: 0.5rem;">{{ $check_in_date }} {{ $arrival }}</span>
                            <br><span style="text-decoration: none;">
                                <span class="spantitle">Date/Time of Departure: </span><span>{{ $check_out_date }} {{ $departure }}</span>
                            </span>
                            <br>
                            <span class="spantitle">Total Number of lodgers: Male: </span> <span>{{ $num_of_male}}</span>
                            <span class="spantitle">Female: </span><span>{{ $num_of_female}}</span>
                            = <span>{{ $total_lodgers }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" >
                    @if (in_array($room_number, ["ROOM 101", "ROOM 102", "ROOM 103", "ROOM 104", "ROOM 105", "ROOM 106", "ROOM 107", "ROOM 108"]))
                        <table id="dormitory-table" style="font-size: 12px;">
                            <tr>
                                <th colspan="11" class="text-center">
                                    Dormitory Room: 1<span class="ordinal" style="text-decoration: none;">st</span> Floor (8 capacity room: double deck bed)
                                </th>
                            </tr>
                            <tr>
                                <td></td>
                                @for ($i = 101; $i <= 108; $i++)
                                    <td>R{{ $i }}</td>
                                @endfor
                                <td>Total No</td>
                                <td>Total Amount</td>
                            </tr>
                            <tr>
                                <td>M</td>
                                @for ($i = 101; $i <= 108; $i++)
                                    <td>@if ($room_number == "ROOM $i") {{ $num_of_male }} @endif</td>
                                @endfor
                                <td>{{ $num_of_male }}</td>
                                <td rowspan="2" style="font-style: bold;">
                                    @if ($position == 'Student' && $total_amount == 0.00)
                                        FREE
                                    @else
                                        {{ $total_amount }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>F</td>
                                @for ($i = 101; $i <= 108; $i++)
                                    <td>@if ($room_number == "ROOM $i") {{ $num_of_female }} @endif</td>
                                @endfor
                                <td>{{ $num_of_female }}</td>
                            </tr>
                        </table>
                    @endif

                    @if (in_array($room_number, ["ROOM 201", "ROOM 202", "ROOM 203", "ROOM 204", "ROOM 205"]))
                        <table id="dormitory-table" style="font-size: 12px;">
                            <tr>
                                <th colspan="8" class="text-center">Dormitory Room: 2<span class="ordinal" style="text-decoration: none;">nd</span> Floor (6 capacity room: double deck bed)</th>
                            </tr>
                            <tr>
                                <td></td>
                                @for ($i = 201; $i <= 205; $i++)
                                    <td>R{{ $i }}</td>
                                @endfor
                                <td>Total No</td>
                                <td>Total Amount</td>
                            </tr>
                            <tr>
                                <td>M</td>
                                @for ($i = 201; $i <= 205; $i++)
                                    <td>@if ($room_number == "ROOM $i") {{ $num_of_male }} @endif</td>
                                @endfor
                                <td>{{ $num_of_male }}</td>
                                <td rowspan="2" style="font-style: bold;">
                                    @if ($position == 'Student' && $total_amount == 0.00)
                                        FREE
                                    @else
                                        {{ $total_amount }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>F</td>
                                @for ($i = 201; $i <= 205; $i++)
                                    <td>@if ($room_number == "ROOM $i") {{ $num_of_female }} @endif</td>
                                @endfor
                                <td>{{ $num_of_female }}</td>
                            </tr>
                        </table>
                    @endif
                    @if (in_array($room_number, ["AC ROOM 101", "AC ROOM 102", "AC ROOM 103", "AC ROOM 104", "AC ROOM 105", "AC ROOM 201", "AC ROOM 202"]))
                        <table id="dormitory-table" style="font-size: 12px;">
                            <tr>
                                <th colspan="10" class="text-center">Air-conditioned Room</th>
                            </tr>
                            <tr>
                                <td></td>
                                @for ($i = 101; $i <= 105; $i++)
                                    <td>AC R{{ $i }}</td>
                                @endfor
                                @for ($i = 201; $i <= 202; $i++)
                                    <td>AC R{{ $i }}</td>
                                @endfor
                                <td>Total No</td>
                                <td>Total Amount</td>
                            </tr>
                            <tr>
                                <td>M</td>
                                @for ($i = 101; $i <= 105; $i++)
                                    <td>@if ($room_number == "AC ROOM $i") {{ $num_of_male }} @endif</td>
                                @endfor
                                @for ($i = 201; $i <= 202; $i++)
                                    <td>@if ($room_number == "AC ROOM $i") {{ $num_of_male }} @endif</td>
                                @endfor
                                <td>
                                    @if (in_array($room_number, ["AC ROOM 101", "AC ROOM 102", "AC ROOM 103", "AC ROOM 104", "AC ROOM 105", "AC ROOM 201", "AC ROOM 202"]))
                                        {{ $num_of_male }}
                                    @endif
                                </td>
                                <td rowspan="2" style="font-style: bold;">
                                    @if (in_array($room_number, ["AC ROOM 101", "AC ROOM 102", "AC ROOM 103", "AC ROOM 104", "AC ROOM 105", "AC ROOM 201", "AC ROOM 202"]))
                                        @if ($position == 'Student' && $total_amount == 0.00)
                                            FREE
                                        @else
                                            {{ $total_amount }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>F</td>
                                @for ($i = 101; $i <= 105; $i++)
                                    <td>@if ($room_number == "AC ROOM $i") {{ $num_of_female }} @endif</td>
                                @endfor
                                @for ($i = 201; $i <= 202; $i++)
                                    <td>@if ($room_number == "AC ROOM $i") {{ $num_of_female }} @endif</td>
                                @endfor
                                <td>
                                    @if (in_array($room_number, ["AC ROOM 101", "AC ROOM 102", "AC ROOM 103", "AC ROOM 104", "AC ROOM 105", "AC ROOM 201", "AC ROOM 202"]))
                                        {{ $num_of_female }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif
                    @php
                        $rooms = [
                            "MAIN CONFERENCE HALL" => ['5000.00', '6000.00'],
                            "MINI CONFERENCE HALL" => ['3000.00', '4000.00'],
                            "MESS HALL" => ['2000.00', '2500.00']
                        ];
                    @endphp
                    @if (array_key_exists($room_number, $rooms))
                    <h6 style="font-size: 14px; mt-5">HALLS RENTAL RATES REGARDLESS OF THE HOURS CONSUMED</h6>
                        <table class="text-center mt-3 mb-3">
                            <tr>
                                <td rowspan="2">Facility Name</td>
                                <td colspan="2">Rate</td>
                                <td rowspan="2">Remarks</td>
                                <td rowspan="2">Amount</td>
                            </tr>
                            <tr>
                                <td>Day Time 7am - 5pm</td>
                                <td>Night Time 5pm - 12am</td>
                            </tr>

                            @foreach ($rooms as $roomName => $rates)
                                <tr>
                                    <th>{{ $roomName }}</th>
                                    <td>{{ $rates[0] }}</td>
                                    <td>{{ $rates[1] }}</td>
                                    <td>Beyond 8 hours additional 500/hour</td>
                                    <td style="font-style: bold;">
                                        @if ($room_number == $roomName)
                                            @if ($position == 'Student' && $total_amount == 0.00)
                                                FREE
                                            @else
                                                {{ $formattedMinusTotalAmount }}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <span class="spantitle mt-2">Additional Chargers: </span><i>To be given directly to the person(s) concerned just after the activity</i>
                        <table class="mt-3">
                            <tr>
                                <th>Janitorial Services</th>
                                <td>100 php per hour (after 5pm - weekdays)</td>
                                <td>700 php / day  = 8 hours (Weekends and Holidays)</td>
                                <td>Minimum of 4 hours (Weekends and Holidays)</td>
                                @if ($janitor_services != null || $janitor_services != '' || $janitor_services != 0)
                                    <td class="text-center" style="font-style: bold;">{{ $janitor_services }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>AV Tech services</th>
                                <td>100 php per hour (after 5pm - weekdays)</td>
                                <td>700 php / day  = 8 hours (Weekends and Holidays)</td>
                                <td>Minimum of 4 hours (Weekends and Holidays)</td>
                                @if ($av_services != null || $av_services != '' || $av_services != 0)
                                <td class="text-center" style="font-style: bold;">{{ $av_services }}</td>
                                @endif

                            </tr>
                        </table>
                    @endif
                    <br>
                </div>
            </div>
        </div>
        <div class="container-fluid footer" style="height:auto;">
            <div class="row">
                <div class="col-md-12">
                    <h6>Terms and Conditions</h6><br>
                    <p>PAYABLES SHOULD BE SETTLED ON BEFORE AND AFTER DEPARTURE DATE AND DIRECTLY TO THE CASHIERS OFFICE
                        (WITH ORDER OF PAYMENT TO BE SECURED AT AUXILIARY SERVICES OFFICE)
                    </p>
                    <p style="font-size: 8px;">NVSU-FR-ASP 12:00(061121)</p>
                </div>
            </div>
        </div>
    </div>
<div class="page-break mt-5"></div>
        {!! $headerHtml !!} <br>
        <p style="text-align: justify; font-weight: bold;">CONTRACT AND GUIDELINES FOR THE USAGE OF FACILITIES OF THE DUMLAO FARMERS' TRAINING CENTER</p>
        <p style="text-align: justify">1. Request for use of any of the facilities of the Training Center shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p>
        <p style="text-align: justify">2. For outside sponsored activity, the requesting party should pay at least 50% of the total amount of the requested hall as down payment and the remaining 50% shall be paid on or before the activity date at the Cashier's Office before the approval of the ASP Director. For lodging purposes, payment can be made before or after the accommodation. Payment shall be billed by the Project-in-Charge and paid at the Cashiers Office.</p>
        <p style="text-align: justify">3. For maximum use of the services, a request for the cancellation of postponement of any sponsored activity shall be allowed without fine; provided that such request for cancellation shall be filed 3 days before the said activity. Violation of this clause shall result to forfeiture.</p><br>
        <p style="text-align: justify">4. The cleanliness and orderliness of the facilities before and after use shall be observed by the contracting party/group concerned.</p>
        <p style="text-align: justify">5. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE CENTER. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p>
        <p style="text-align: justify">6. Any DFTC property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party. The University shall not be liable for loss of personal properties.</p>
        <p style="text-align: justify">7. The presence of the University Food Services is a pre-requisite in any instances to cater the food requirements of the contracting party. Outside caterers shall not be allowed to provide meals for any occasion participants unless prior arrangements were made with the Office of the Auxiliary Services Program and shall pay CORKAGE FEE of P500.00 for less than 50 participants, P750.00 for less than 100 participants, and P1,000.00 for more than 100 participants per day.</p>
        <p style="text-align: justify">8. This <b>CONTRACT APPLIES</b> for the use of the <b>DUMLAO FARMERS' TRAINING CENTER ONLY. </b><br>
            Upon affixing my signature I/WE hereby agree to conform to and abide by the terms and condition, rules and regulations stipulate in this contract
            governing the use of the facilities of the Dumlao Farmer's Training Center
        </p>
        <div class="col-md-3">
            <div class="row">
                <table class="table border-0 w-100">
                    <tr>
                        <td class="w-50 border-0">
                        </td>
                        <td class="w-50 border-0 text-center">
                            <p class="m-0" ><u>{{ $fullname }}</u></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border-0">
                        </td>
                        <td class="w-50 border-0 text-center">
                            <p class="m-0" style="text-decoration: none">Requestor</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border-0"><i>Recommending Approval:</i></td>
                        <td class="w-50 border-0">
                            <div class="text-right mr-5 mb-5">
                                <i>Approved:</i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center w-50 border-0">
                            <br><br>
                            <p class="m-0" >
                                @if ($admin != null)
                                <u>
                                    {{ $admin }}
                                </u>
                                @else
                                    _______________
                                @endif
                            </p>
                        </td>
                        <td class="text-center w-50 border-0">
                            <br><br>
                            <p class="m-0" >
                                @if ($director != null)
                                <u>
                                    {{ $director }}
                                </u>
                                @else
                                    _______________
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center w-50 border-0">
                            <p>Project In-Charge</p>
                        </td>
                        <td class="text-center w-50 border-0">
                            <p class="m-0">Director</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
</div>
<div class="container-fluid mt-5">
    <div class="col-md-3">
        <h6>PAYMENTS</h6>
        OR NO.:______________ <br>
        Amount:______________ <br>
        Date:________________ <br>
        <p style="font-size: 8px;">NVSU-FR-ASP 12:00(061121)</p>
    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
