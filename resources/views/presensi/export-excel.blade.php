<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .table-export {
            border-collapse: collapse;
            width: 100%;
        }
        .table-export th, .table-export td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: center;
        }
        .header-bg {
            background-color: #f8cbad; /* Peach/Orange-ish color from image */
            font-weight: bold;
        }
        .nama-col {
            text-align: left !important;
            width: 200px;
        }
    </style>
</head>
<body>
    <table class="table-export">
        <thead>
            <!-- Row 1 -->
            <tr>
                <th colspan="2" class="header-bg">{{ $monthName }}</th>
                <th colspan="{{ count($dates) * 2 }}" class="header-bg">Tanggal</th>
                <th rowspan="4" class="header-bg">Jumlah Kehadiran</th>
            </tr>
            <!-- Row 2 -->
            <tr>
                <th rowspan="3" class="header-bg">No</th>
                <th rowspan="3" class="header-bg">Nama</th>
                @foreach($dates as $date)
                    <th colspan="2" class="header-bg" style="{{ $date['isWeekend'] ? 'background-color: #efefef;' : '' }}">
                        {{ $date['day'] }}
                    </th>
                @endforeach
            </tr>
            <!-- Row 3 -->
            <tr>
                @foreach($dates as $date)
                    <th colspan="2" class="header-bg" style="{{ $date['isWeekend'] ? 'background-color: #efefef;' : '' }}">
                        {{ $date['dayName'] }}
                    </th>
                @endforeach
            </tr>
            <!-- Row 4 -->
            <tr>
                @foreach($dates as $date)
                    <th class="header-bg" style="{{ $date['isWeekend'] ? 'background-color: #efefef;' : '' }}">M</th>
                    <th class="header-bg" style="{{ $date['isWeekend'] ? 'background-color: #efefef;' : '' }}">K</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($karyawans as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="nama-col">{{ $k->name }}</td>
                    @php $totalHadir = 0; @endphp
                    @foreach($dates as $date)
                        @php
                            $dayData = isset($presensiData[$k->id][$date['day']]) ? $presensiData[$k->id][$date['day']] : collect();
                            $datang = $dayData->where('type', 'Datang')->first();
                            $pulang = $dayData->where('type', 'Pulang')->first();
                            $izin = $dayData->where('type', 'izin')->first();
                            
                            if($datang) $totalHadir++;
                            
                            $bgCell = $date['isWeekend'] ? 'background-color: #f9f9f9;' : '';
                            
                            // Style for Clock-In (M)
                            $styleM = $bgCell;
                            $textM = '';
                            if ($izin) {
                                $styleM .= 'background-color: #ffeb9c;'; // Yellow
                                $textM = 'Izin';
                            } elseif ($datang) {
                                $textM = \Carbon\Carbon::parse($datang->clock_at)->format('H:i');
                                if ($datang->status == 'Terlambat') {
                                    $styleM .= 'background-color: #ffc7ce; color: #9c0006;'; // Red
                                } elseif ($datang->status == 'Tepat Waktu') {
                                    $styleM .= 'background-color: #c6efce; color: #006100;'; // Green
                                }
                            }

                            // Style for Clock-Out (K)
                            $styleK = $bgCell;
                            $textK = '';
                            if ($izin) {
                                $styleK .= 'background-color: #ffeb9c;'; // Yellow
                                $textK = 'Izin';
                            } elseif ($pulang) {
                                $textK = \Carbon\Carbon::parse($pulang->clock_at)->format('H:i');
                                if ($pulang->status == 'Pulang Cepat') {
                                    $styleK .= 'background-color: #ffc7ce; color: #9c0006;'; // Red
                                } elseif ($pulang->status == 'Pulang Normal') {
                                    $styleK .= 'background-color: #c6efce; color: #006100;'; // Green
                                }
                            }
                        @endphp
                        <td style="{{ $styleM }}">{{ $textM }}</td>
                        <td style="{{ $styleK }}">{{ $textK }}</td>
                    @endforeach
                    <td class="header-bg">{{ $totalHadir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
