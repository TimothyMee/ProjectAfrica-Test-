<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Letters Africa Test
                </div>

                <div class="col-md-12">
                    <form action="/trip/start-trip" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label>User:</label>
                            <select name="user_id" class="col-md-6">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{$user["id"]}}"> {{$user["lastname"]}} {{$user["firstname"]}} {{$user["middlename"]}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6">Takeoff:</label>
                            <select name="takeoff" class="col-md-6">
                                <option value="">Select Takeoff Station</option>
                                @foreach($stations as $station)
                                    <option value="{{$station["id"]}}"> {{$station["name"]}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6">Destination:</label>
                            <select name="destination" class="col-md-6">
                                <option value="">Select Destination Station</option>
                                @foreach($stations as $station)
                                    <option value="{{$station["id"]}}"> {{$station["name"]}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6">Bus?</label>
                            <Select name="bus" class="col-md-6">
                                <option value="No" selected>No</option>
                                <option value="Yes">Yes</option>
                            </Select>
                        </div>


                        <input type="submit" value="submit">
                    </form>
                </div>

                <div class="col-md-12">
                    <hr>
                    <h3>End Trip</h3>
                    <form method="post" action="/trip/end-trip">
                        {{csrf_field()}}
                       <div class="form-group">
                           <label>Select Trip to Close: </label>
                           <select name="id" class="col-md-6">
                               <option value="">Select Trip</option>
                               @foreach($inactiveTrips as $trip)
                                    <option value="{{$trip["id"]}}">User: {{$trip["user"]['firstname']}}  {{$trip["user"]['lastname']}} || Des: {{$trip["destination"]}} || Takeoff: {{$trip["takeoff"]}} || Bus: {{$trip['bus']}}</option>
                               @endforeach
                           </select>
                       </div>

                        <input type="submit" value="End Trip">
                    </form>
                </div>

                <div>
                    <hr>
                    <h3>All Trips</h3>
                    <table border="1">
                        <tr>
                            <th>User</th>
                            <th>Takeoff</th>
                            <th>Destination</th>
                            <th>Bus</th>
                            <th>Active</th>
                        </tr>
                        @foreach($trips as $trip)
                            <tr>
                                <td>{{$trip["user"]['firstname']}}  {{$trip["user"]['lastname']}}</td>
                                <td>{{$trip["takeoff"]}}</td>
                                <td>{{$trip["destination"]}}</td>
                                <td>{{$trip["bus"]}}</td>
                                <td>{{$trip["active"]}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
