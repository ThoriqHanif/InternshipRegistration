<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {{ $intern->full_name }}</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Zilla+Slab:wght@400;700&display=swap"
    rel="stylesheet" /> --}}
    <style>
        :root {
            --blue: #1d6dcc;
            --black: #292929;
            --grey: #333333;
            --grey-soft: #a8a8a8;
            --soft-white: #f0f7ff;
            --white: #ffffff;
        }

        @font-face {
            font-family: 'Nunito';
            src: url('../storage/fonts/Nunito-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }


        @font-face {
            font-family: 'Nunito';
            src: url('../storage/fonts/Nunito-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'Zilla Slab';
            src: url('../storage/fonts/ZillaSlab-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
        }


        .container-all {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
            /* background-color: #a8a8a8; */
        }

        .certificate-container {
            width: auto;
            height: 100%;
            /* padding: 26px; */
            text-align: center;
            position: relative;
            background-color: var(--white);
            overflow: hidden;
            /* padding-bottom: 100px; */
        }

        .certificate-container .svg {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .container-content {
            padding-top: 161px;
            display: flex;
            flex-direction: column;
            justify-content: end;
            align-items: center;
            height: 80%;
            position: relative;
            z-index: 0;
        }

        .logo {}

        .logo img {
            margin-bottom: 3px;
            width: 100px;
        }

        .company-name {
            font-family: 'Zilla Slab';
            font-weight: 600;
            font-size: 25px;
            color: #1d6dcc;
            margin-bottom: 42px;

        }

        .title {
            font-family: 'Zilla Slab';
            font-size: 46px;
            letter-spacing: 2px;
            color: #333333;
            font-weight: 600;
        }

        .subtitle {
            font-family: 'Nunito';
            font-size: 18px;
            font-weight: normal;
            letter-spacing: 1.4px;
            color: #333333;
            margin-top: -12px;
            margin-bottom: 58px;
        }

        .description {
            font-family: 'Nunito';
            font-size: 17px;
            font-weight: normal;
            letter-spacing: 0.72px;
            line-height: 90%;
            color: #1d6dcc;
        }

        .recipient {
            font-family: 'Zilla Slab';
            font-weight: 600;
            font-size: 26px;
            line-height: 90%;
            text-align: center;
            justify-content: center;
            width: 346px;
            padding-left: 60px;
            padding-right: 60px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 7px;
            margin-top: 12px !important;
            margin-bottom: 20px !important;
            margin: auto;
            color: #ffffff;
            background-color: #1d6dcc;
        }

        .info-intern {
            font-family: 'Nunito';
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 0.72px !important;
            line-height: 90%;
            color: #1d6dcc;
            margin-bottom: 76px;
            margin-top: 5px;
        }

        .signature {
            font-family: 'Nunito';
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .signature-img {
            width: 300px;
            height: 75px;
        }

        hr {
            width: 34%;
            margin-top: 3px !important;
            margin: auto;
            color: #b0b0b0;
        }

        .name {
            font-family: 'Nunito';
            font-size: 18px;
            font-weight: normal;
            letter-spacing: 1px;
            line-height: 90%;
            margin-top: 10px;
        }


        .position {
            font-family: 'Nunito';
            font-size: 16px;
            color: #a8a8a8;
            line-height: 90%;
        }

        .page-break {
            page-break-after: always;
        }

        .evaluation-container {
            padding-top: 50px;
            display: flex;
            flex-direction: column;
            justify-content: end;
            align-items: center;
            height: 80%;
            position: relative;
            z-index: 0;
        }

        .table-evaluation {
            flex-grow: 1;
        }

        table {
            font-family: 'Nunito';
            font-weight: normal;
            font-size: 14px;
            width: 85%;
            margin: auto;
            border: 1px solid #333333;
            border-collapse: collapse;
            margin-bottom: 30px !important;
        }

        th {
            font-weight: 600 !important;
        }

        th,
        td {
            font-family: 'Nunito';
            font-weight: normal;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #333333;
        }

        tr {
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }

        .table-fit {
            width: 1%;
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .row {
            margin: auto;
            margin-top: 50px !important;
            /* position: fixed;
            bottom: 50;
            left: 0;
            right: 0; */
            width: 85%;
            z-index: 2;
        }

        .column {
            float: left;
        }

        .column-3 {
            width: 33.33%;
        }

        .column-2 {
            width: 50%;
        }

        .column-4 {
            width: 25%;
        }

        .note {
            text-align: left !important;
            font-weight: normal;
        }

        .title-note {
            font-family: 'Nunito';
            font-weight: normal;
            margin-bottom: 10px;
            font-size: 14px;
            letter-spacing: 1px;

        }

        .desc-note {
            font-family: 'Nunito';
            font-weight: normal;
            font-size: 14px;
            letter-spacing: 0.72px;
        }

        .grade-entry {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
        }

        .letter-grade {
            flex: 1;
            text-align: left;
        }

        .colon {
            width: 20px;
            margin: 0px 30px;
            text-align: center;
        }

        .predicate {
            flex: 2;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container-all">
        <div class="certificate-container">
            <img src="https://i.imgur.com/C48vAWV.png" alt="" class="svg" width="528" height="782">
            {{-- <svg width="528" height="782" viewBox="0 0 528 782" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M525.388 778.783H310.922V781.833H525.388V778.783Z" fill="#1D6DCC"></path>
                <path d="M525.386 781.828V456.739H522.336V781.828H525.386Z" fill="#1D6DCC"></path>
                <path d="M525.386 212.474V2.27075H522.336V212.474H525.386Z" fill="#1D6DCC"></path>
                <path d="M525.386 345.219V250.128H522.336V345.219H525.386Z" fill="#1D6DCC"></path>
                <path d="M527.523 453.074V450.327H520.079V453.074H527.523Z" fill="#1D6DCC"></path>
                <path d="M527.523 458.123V455.376H520.079V458.123H527.523Z" fill="#1D6DCC"></path>
                <path d="M220.639 778.783H2.20862V781.833H220.639V778.783Z" fill="#1D6DCC"></path>
                <path d="M5.30743 781.845L5.30743 714.534H2.25686L2.25686 781.845H5.30743Z" fill="#1D6DCC"></path>
                <path d="M5.30743 705.557L5.30743 570.142H2.25686L2.25686 705.557H5.30743Z" fill="#1D6DCC"></path>
                <path d="M5.30743 459.734L5.30743 158.738H2.25686L2.25686 459.734H5.30743Z" fill="#1D6DCC"></path>
                <path d="M362.919 2.19055H2.20862V5.24113H362.919V2.19055Z" fill="#1D6DCC"></path>
                <path d="M525.412 2.19055H420.772V5.24113H525.412V2.19055Z" fill="#1D6DCC"></path>
                <path d="M365.709 0H362.962V7.44463H365.709V0Z" fill="#1D6DCC"></path>
                <path d="M370.731 0H367.984V7.44463H370.731V0Z" fill="#1D6DCC"></path>
                <path d="M5.30743 113.67L5.30743 2.19055H2.25686L2.25686 113.67H5.30743Z" fill="#1D6DCC"></path>
                <path d="M7.44464 153.684V150.937H4.29153e-06V153.684H7.44464Z" fill="#1D6DCC"></path>
                <path d="M7.44464 158.733V155.986H4.29153e-06V158.733H7.44464Z" fill="#1D6DCC"></path>
            </svg> --}}
            <div class="container-content">
                <div class="logo">
                    <img src="https://i.imgur.com/yYArDIb.png" alt="Company Logo" />
                    <div class="company-name">kadangkoding</div>
                </div>
                <div class="title">CERTIFICATE</div>
                <div class="subtitle">OF INTERNSHIP PROGRAM</div>
                <div class="description">This certificate is granted to</div>
                <div class="recipient">

                    {{ $intern->full_name }}

                </div>
                <div class="description">
                    in recognition of internship program and<br />
                    contribution to the company from<br />
                </div>
                <div class="info-intern">
                    {{ \Carbon\Carbon::parse($intern->start_date)->format('F jS') }} to
                    {{ \Carbon\Carbon::parse($intern->end_date)->format('F jS') }} as
                    <br>
                    {{ $intern->position->name }}
                </div>
                <div class="signature">
                    <img src="https://i.imgur.com/0p46RpL.png" alt="Signature" class="signature-img" />
                    <hr>
                    <div class="name">
                        Dinar Budi Saputro
                    </div>
                    <div class="position">
                        Director
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-break"></div>
    <div class="container-all">
        <div class="certificate-container">
            {{-- <img src="https://i.imgur.com/C48vAWV.png" alt="" class="svg" width="528" height="782"> --}}
            <div class="evaluation-container">
                <div class="title">DAFTAR NILAI</div>
                <div class="subtitle">PRAKTIK KERJA LAPANGAN</div>
                <div class="table-evaluation">
                    <table id="technical-aspects">
                        <thead>
                            <tr>
                                <th rowspan="2" class="table-fit">No</th>
                                <th rowspan="2">Aspek Teknis</th>
                                <th colspan="3" class="text-center">Nilai Akhir</th>
                            </tr>
                            <tr>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Huruf</th>
                                <th class="text-center">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($technicalScores as $index => $score)
                                <tr>
                                    <td class="table-fit text-center">{{ $index + 1 }}</td>
                                    <td>{{ $score->aspect->name ?? 'Aspek Tidak Ditemukan' }}</td>
                                    <td class="text-center">{{ number_format($score->final_score, 2) }}</td>
                                    <td class="text-center">{{ $score->letter_grade }}</td>
                                    <td class="text-center">{{ $score->predicate }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Proses pengolahan nilai masih berlangsung.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <table id="non-technical-aspects">
                        <thead>
                            <tr>
                                <th rowspan="2" class="table-fit">No</th>
                                <th rowspan="2">Aspek Non Teknis</th>
                                <th colspan="3" class="text-center">Nilai Akhir</th>
                            </tr>
                            <tr>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Huruf</th>
                                <th class="text-center">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $nonTechnicalIndex = 1; @endphp

                            @forelse ($nonTechnicalScores as $score)
                                <tr>
                                    <td class="table-fit text-center">{{ $nonTechnicalIndex++ }}</td>
                                    <td>{{ $score->aspect->name ?? 'Aspek Tidak Ditemukan' }}</td>
                                    <td class="text-center">{{ number_format($score->final_score, 2) }}</td>
                                    <td class="text-center">{{ $score->letter_grade }}</td>
                                    <td class="text-center">{{ $score->predicate }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Proses pengolahan nilai masih berlangsung.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="column column-2">
                        <div class="note">
                            <div class="title-note">
                                KETERANGAN :
                            </div>
                            <div class="desc-note">
                                @foreach ($gradeRanges as $grade)
                                    <div class="grade-entry">
                                        <span class="letter-grade">{{ $grade->letter_grade }}</span>
                                        <span class="colon">:</span>
                                        <span class="predicate">{{ $grade->predicate }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- <div class="column column-2">
                        <div class="handsign">
                            <img src="https://i.imgur.com/0p46RpL.png" alt="Signature" class="signature-img" />
                            <hr>
                            <div class="name">
                                Dinar Budi Saputro
                            </div>
                            <div class="position">
                                Director
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</body>

</html>
