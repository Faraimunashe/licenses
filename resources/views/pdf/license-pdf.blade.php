<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company-License</title>
    <style>
        .center {
            display: block;
            margin-left: 35%;
            margin-right: auto;
        }
        .top-header{
            width: 100%;
            color: rgb(3, 43, 2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        .sub-top-header{
            width: 100%;
            color: black;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        ol {
            background: #ff9999;
            padding: 20px;
        }

        ul {
            background: #3399ff;
            padding: 20px;
        }

        ol li {
            background: #ffe5e5;
            color: darkred;
            padding: 5px;
            margin-left: 35px;
        }

        ul li {
            background: #cce5ff;
            color: darkblue;
            margin: 5px;
        }
        .footer {
            position:absolute;
            bottom:0;
            width:100%;
            height:60px;
        }
        .bar-code {
            font-family: 'Libre Barcode 39';
            font-size: 10px;
        }
    </style>
</head>
<body>
    <img class="center" src="{{ storage_path('app/public/logi-removebg-preview.png') }}" style="width: 200px; height: 200px">
    <h1 class="top-header">MUNICIPALITY OF GWANDA</h1>
    <h4 class="sub-top-header">This is to certify the license status of company below </h4>
    <br/>
    <ul>
        <li><strong>Company: </strong>{{ $company->name }}</li>
        <li><strong>Address: </strong> {{ $company->address }}</li>
        <li><strong>Registration: </strong>{{ $company->created_at }}</li>
        <li><strong>Status: </strong> {{ reg_status($registration->status) }}</li>
        <li><strong>Licensed Until: </strong>{{ $license->expiry }}</li>
        <li><strong>Licensed Status: </strong>{{ license_status($license->status) }}</li>
    </ul>

    <div class="footer">
        <h1 class="bar-code">Generated On: {{ now() }}</h1>
    </div>

</body>
</html>
