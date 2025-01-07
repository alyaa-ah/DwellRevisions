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
            bottom:0px;
            position: fixed;
        }
        .page-break {
            page-break-after: always;
        }
        .spantitle{
            text-decoration: none;
            font-weight: bold;
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
                            <p style="text-align: right;"><span class="spantitle">RSH_No:</span> <span>{{ $SH_number}}</span>
                            <br><span>{{ $SH_date }}</span><br>
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
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <h6>DURATION OF STAY:</h6>
                            <br><span class="spantitle">Specific Dates: </span><span>{{ $check_in_date }} - {{ $check_out_date }}</span>
                            <span style="text-decoration: none; margin-left: 0.7rem;">
                                <span>{{ $number_of_days }}</span> <span class="spantitle">day(s)</span>
                                <span style="text-decoration: none; margin-left: 1rem;">
                                    <span>{{ $number_of_nights }}</span> <span class="spantitle">nigth(s) only</span>
                                </span>
                            </span>
                            <br>
                            <span class="spantitle">Date/Time of Arrival: </span> <span style="margin-right: 0.5rem;">{{ $check_in_date }} {{ $arrival }}</span><br>
                            <span style="text-decoration: none;">
                                <span class="spantitle">Date/Time of Departure: </span><span>{{ $check_out_date }} {{ $departure }}</span>
                            </span>
                            <br>
                            <span class="spantitle">Total Number of lodgers: Male: </span> <span>{{ $num_of_male}}</span>
                            <span class="spantitle">Female: </span><span>{{ $num_of_female}}</span>
                            = <span>{{ $total_lodgers }}</span>
                        </p>
                    </div>
                    <div class="col-md-12 mb-2 mt-3">
                        <h6>RATES AND COMPUTATION</h6>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th width="20%">Facility</th>
                                    <th width="20%">Description</th>
                                    <th width="10%">Rate</th>
                                    <th width="20%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($room_number === "ROOM 1")
                                    <tr>
                                        <td>Room 1 (2nd floor) (Ladies' Room)</td>
                                        <td>Air-conditioned room, good for 7 person with provition of extra bed</td>
                                        <td>500.00/head</td>
                                        <td>
                                            @if ($room_number == "ROOM 1")
                                                @if ($position == 'Student' && $total_amount == 0.00)
                                                    FREE
                                                @else
                                                    {{ $formattedMinusTotalAmount }}
                                                @endif
                                            @else

                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if ($room_number === "ROOM 2")
                                    <tr>
                                        <td>Room 2 (3rd floor) (Men's Room)</td>
                                        <td>Air-conditioned room, good for 7 person with provision for extra bed</td>
                                        <td>500.00/head</td>
                                        <td>
                                            @if ($room_number == "ROOM 2")
                                                @if ($position == 'Student' && $total_amount == 0.00)
                                                    FREE
                                                @else
                                                    {{ $formattedMinusTotalAmount }}
                                                @endif
                                            @else

                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if ($additional_bedding == "" || $additional_bedding == 0 || $additional_bedding == null)
                                @else
                                    <tr>
                                        <td>Additional Bed</td>
                                        <td></td>
                                        <td>200.00/head</td>
                                        <td>
                                            @if ($additional_bedding == 0.00)

                                            @else
                                                @if ($position == 'Student' && $total_amount == 0.00)
                                                    FREE
                                                @else
                                                    {{ $additional_bedding }}
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4" style="text-align: left;">
                                        <span style="display: inline-block; text-decoration: none;">TOTAL AMOUNT:</span>
                                        <span style="text-decoration: none; float: right; font-style: bold;">
                                            @if ($position == 'Student' && $total_amount == 0.00)
                                                FREE
                                            @else
                                                {{ $total_amount }}
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <table style="border-collapse: collapse; width: 100%; text-align: left;">
                            <tr>
                                @if ($male_guest != null || $female_guest != null)
                                <td style="border: none; text-align: left;">
                                    <h6>Name Of Guest(s)</h6>
                                </td>
                            @endif
                            </tr>
                            <tr>
                                <td style="border: none; vertical-align: top;">
                                    <!-- Render Male Guests -->
                                    @if ($male_guest != null)
                                        {!! implode('<br>', array_map(function($name) {
                                            return '<span style="text-decoration: underline;">' . trim($name) . ' (M)</span>';
                                        }, explode(',', $male_guest))) !!}
                                    @endif
                                </td>
                                <td style="border: none; vertical-align: top;">
                                    <!-- Render Female Guests -->
                                    @if ($female_guest != null)
                                        {!! implode('<br>', array_map(function($name) {
                                            return '<span style="text-decoration: underline;">' . trim($name) . ' (F)</span>';
                                        }, explode(',', $female_guest))) !!}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid footer">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <h6>Mode of Payment:</h6>
                    Please Check <br>
                    <div style="margin-left: 7rem;">
                        @if ($payment == "Cash")
                            <input type="checkbox" checked style="transform: scale(1.5);"> Cash
                        @else
                            <input type="checkbox" style="transform: scale(1.5);"> Cash
                        @endif
                        <span style="text-decoration: none; margin-left: 4rem;">
                            @if ($payment == "Salary Deduction")
                                <input type="checkbox" checked style="transform: scale(1.5);"> Salary Deduction
                            @else
                                <input type="checkbox" style="transform: scale(1.5);"> Salary Deduction
                            @endif
                        </span>
                    </div>
                </div>
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
    <div>
        {!! $headerHtml !!} <br>
            <p style="text-align: justify">CONTRACT AND GUIDELINES FOR LODGING AT THE STAFF HOUSE</p>
            <p style="text-align: justify">1. Request for accommodation at the Staff House shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p><br>
            <p style="text-align: justify">2. The cleanliness and orderliness of the room/s before and after use shall be observed by the contracting party/group concerned.</p><br>
            <p style="text-align: justify">3. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE STAFF HOUSE. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p><br>
            <p style="text-align: justify">4. Any Staff House property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party.</p><br>
            <p style="text-align: justify">5. The guest/s is/are requested to observe hte house rules especially the <b>curfew hour of 10:00 in the evening.</b></p><br>
            <p style="text-align: justify">6. Only registered guest/s is/are allowed to use the facilities including telephone, comfort rooms, and other fixtures of the Staff House. Visitor/s of guest/s is/are not allowed to enter the room of said guest/s.</p><br>
            <p style="text-align: justify">7. The use of cooking equipment and materials shall be requested before use. The charge is P150.00 per day per room</p><br>
            <p style="text-align: justify">8. Loss of personal belongings shall not be the responsibility of the University <br>
                Upon affixing my signature I/WE hereby agree to conform to and abide by the terms and condition, rules and regulations stipulate in this contract
                governing the use of the facilities of the Staff House.
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
            <p>OR NO.:______________</p>
            <p>Amount:______________</p>
            <p>Date:________________</p>
            <p style="font-size: 8px;">NVSU-FR-ASP 12:00(061121)</p>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
