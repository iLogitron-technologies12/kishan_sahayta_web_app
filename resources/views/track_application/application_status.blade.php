<style>
        .mybox {
            background: linear-gradient(to bottom, #ffffcc 0%, #ccffff 100%);
            margin: 15px 35px 15px 35px;
            text-align: center;
            border-radius: 12px;
            border: 2px;
            color: #00175f;
            border-style: solid;
            border-color: #00175f;
        }

        .editbutton {
            border: none;
            margin: 5px;
            padding: 2px 30px 2px 30px;
            background: #ffeaea;
            border-radius: 10px;
            border-style: solid;
            border-color: #00175f;
        }
    </style>

    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="white">Track Your Applications</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="{{ url('index.php') }}">Home</a><i class="fa fa-angle-double-right"></i><span>My Dashboard</span>
                        <a href="{{ url('mydashboard.php?logout=logout') }}" style="float:right;text-align:right;">Logout<i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('msg'))
        <div class="msg" style="margin: 10px 45px 5px 45px; color: #004a2f; background-color: C9FFEB; border: 2px solid #0D583D; border-radius: 5px; font-weight: bold;">
            <span style="width: 40%"><center>{{ session('msg') }}</center></span>
        </div>
    @endif

    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @php
                            $phone = session('phone');
                            $sql_phone = "SELECT * FROM users WHERE phone='{$phone}'";
                            $result = mysqli_query($con, $sql_phone) or die("Query failed");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    @endphp
                                    <div class='col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12 mybox'>
                                        <h4><u>{{ $row['industry_name'] }}</u></h4>
                                        <p>{{ $row['user_district'] }} - {{ $row['subdivision'] }} - {{ $row['user_block'] }} - {{ $row['user_ward'] }}</p>
                                        <h6>Applicant Name  :   {{ $row['user_name'] }}</h6>
                                        <h6>Application Id  :   {{ $row['registration_id'] }}</h6>
                                        <h6>Application Date  : {{ $row['date_of_registration'] }}</h6>
                                        <h6> Application Status   :
                                            @if ($row['status'] == '0')
                                                <a style='color:#FF8700;'>Not Submitted</a>
                                            @elseif ($row['status'] == 1)
                                                <a style='color:blue;'>Submitted</a>
                                            @elseif ($row['status'] == 2)
                                                <a style='color:#0F9D0D;'>Forwarded by District Assistant</a>
                                            @elseif ($row['status'] == 3)
                                                <a style='color:#9B351F;'>Application Sent Back by DA</a>
                                            @elseif ($row['status'] == 4)
                                                <a style='color:#10B50D;'>Approved by GM</a>
                                            @elseif ($row['status'] == 5)
                                                <a style='color:#FF1B00;'>Rejected by GM</a>
                                            @elseif ($row['status'] == 6)
                                                <a style='color:#9B351F;'>Application Sent Back by GM</a>
                                            @elseif ($row['status'] == 7)
                                                <a style='color:#10B50D;'>Scrutinised by Bank & DIC</a>
                                            @elseif ($row['status'] == 8)
                                                <a style='color:#10B50D;'>Approved by Bank Manager</a>
                                            @elseif ($row['status'] == 9)
                                                <a style='color:#FF00E4;'>Applicant Undergoing EDB Training</a>
                                            @elseif ($row['status'] == '10')
                                                <a style='color:#04D2BF;'>Completed EDB Training</a>
                                            @elseif ($row['status'] == '11')
                                                <a style='color:#79F703;'>Loan Disbursing</a>
                                            @elseif ($row['status'] == '12')
                                                <a style='color:#A71E0D;'>Loan Disbursed</a>
                                            @endif
                                        </h6>
                                        @if($row['status']=='0')
                                            <button class="editbutton">
                                                <a href='{{ url("edit.php?edit={$row['registration_id']}") }}'>Edit & Submit <i class='fa fa-edit'></i></a>
                                            </button>
                                        @endif
                                        @if($row['status']==3 || $row['status']==6)
                                            <button class="editbutton">
                                                <a href='{{ url("edit.php?edit={$row['registration_id']}") }}'>Edit Application & Re-Submit <i class='fa fa-edit'></i></a>
                                            </button>
                                        @endif
                                    </div>
                                    @php
                                }
                            } else {
                                $failed .= "Seems you are new to this portal! Apply for a new application now.";
                                echo "<p style='color: #004400; background-color: #a2ffa2; border-radius: 8px;'>$failed </p>";
                            }
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
