<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Cash Out</title>
    <link rel="stylesheet" href="{{public_path().'/admin/css/sb-admin-2-school.min.css'}}">
    <link rel="stylesheet" href="{{'/admin/css/sb-admin-2-school.min.css'}}">
    <style>
        .icon {
            width: 20px;
        }
        .text-footer {
            font-size: 12px;
            margin-top: -5px;
        }
        body, .table {
            color: black;
        }
        .school-name {
            font-size: 22px;
            font-weight: 600;
        }
        .sidigs-powered {
            height: 30px;
        }
        .inline {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <table class="table">
                <tr>
                    <td>
                        <img height="120px" src="{{imagenABase64(Auth::user()->School->photo)}}" alt="Logo Sekolah">
                    </td>
                    <td>
                        <p class="mb-2 school-name">{{ strtoupper(Auth::user()->School->name)}}</p>
                        <p class="mb-0">{{ Auth::user()->School->address}}</p>
                        <p style="font-size: 12px;">{{ Auth::user()->School->phone ? 'Telp. '.Auth::user()->School->phone : '' }}{{ Auth::user()->School->website ? ' | Web : '.Auth::user()->School->website : '' }}{{ Auth::user()->School->email ? ' | Email : '.Auth::user()->School->email : '' }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <table class="table mb-0">
                <tr>
                    <td style="width: 80%">
                        <h3>
                            <span class="" style="font-size: 18px;">e-Kwitansi - #{{$topup->id}}  </span>
                           
                        </h3>
                    </td>
                    <td class="text-right">
                        <h3>
                            <span class="badge badge-success">BERHASIL</span>
                        </h3>
                    </td>
                </tr>
            </table> 
        </div>        
        <div class="row">
            <table class="table">
                <tr>
                    <th>
                        <p class="mb-0">NIS:</p>
                        <p class="ml-0 mb-0 font-weight-bold">{{$topup->Student->nis}}</p>
                    </th>
                    <th>
                        <p class="mb-0">Nama Murid:</p>
                        <p class="ml-0 mb-0 font-weight-bold" style="text-transform: capitalize">{{$topup->Student->name}}</p>
                    </th>
                    <th>
                        <p class="mb-0">Kelas:</p>
                        <p class="ml-0 mb-0 font-weight-bold">
                            @if($topup->Student->Classes)
                                {{strtoupper($topup->Student->Classes->name)}}
                            @else 
                                -
                            @endif
                        </p>
                    </th>
                </tr>
            </table>
        </div>
        <div class="row">
            <table class="table" border="2">
                <tr>
                    <th>
                        <p class="font-weight-bold inline">No.</p>
                    </th>
                    <th>
                        <p class="font-weight-bold inline">Tipe Transaksi</p>
                    </th>
                    <th>
                        <p class="font-weight-bold inline">Tanggal Pembayaran</p>
                    </th>
                    <th>
                        <p class="font-weight-bold inline">Penerima</p>
                    </th>
                    <th>
                        <p class="font-weight-bold inline">Jumlah</p>
                    </th>
                </tr>
                <tr>
                    <td>
                        1.
                    </td>
                    <td>
                        Cash Out
                    </td>
                    <td>
                        {{ucfirst($topup->created_at->format('d-m-Y'))}}
                    </td>
                    <td style="text-transform: capitalize">
                        {{$topup->Student->name}}
                    </td>
                    <td>
                        Rp. {{number_format($topup->amount)}}
                    </td>  
                </tr>
            </table>
        </div>
        <div class="row">
            <table class="table">
                <tr>
                    <td class="text-right">
                    <p class="text-primary mb-0">Sisa Saldo</p>
                    <h3>Rp. {{number_format($student->balance)}}</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <table class="table">
                <tr>
                    <td class="text-right">
                        <p class="font-weight-bold text-footer">Powered by &nbsp;<img class="sidigs-powered" src="{{asset('/images/logo-sidigs.png')}}" alt="Sidigs logo" ></p>
                        <!-- <p class="font-weight-bold text-footer">Powered by <b>SIDIGS</b></p> -->
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>