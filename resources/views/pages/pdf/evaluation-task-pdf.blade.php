<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai {{ $task->name }} - {{ $intern->full_name }}</title>
    <style>
        *,
        ::before,
        ::after {
            box-sizing: border-box;
            /* 1 */
            border-width: 0;
            /* 2 */
            border-style: solid;
            /* 2 */
            border-color: #e5e7eb;
            /* 2 */
        }

        ::before,
        ::after {
            --tw-content: '';
        }

        html {
            line-height: 1.5;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
            -moz-tab-size: 4;
            /* 3 */
            tab-size: 4;
            /* 3 */
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            /* 4 */
            font-feature-settings: normal;
            /* 5 */
            font-variation-settings: normal;
            /* 6 */
        }

        body {
            margin: 0;
            /* 1 */
            line-height: inherit;
            /* 2 */
        }

        hr {
            height: 0;
            /* 1 */
            color: inherit;
            /* 2 */
            border-top-width: 1px;
            /* 3 */
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit;
        }

        a {
            color: inherit;
            text-decoration: inherit;
        }

        b,
        strong {
            font-weight: bolder;
        }

        code,
        kbd,
        samp,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em;
        }

        small {
            font-size: 80%;
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        table {
            text-indent: 0;
            /* 1 */
            border-color: inherit;
            /* 2 */
            border-collapse: collapse;
            /* 3 */
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            /* 1 */
            font-feature-settings: inherit;
            /* 1 */
            font-variation-settings: inherit;
            /* 1 */
            font-size: 100%;
            /* 1 */
            font-weight: inherit;
            /* 1 */
            line-height: inherit;
            /* 1 */
            color: inherit;
            /* 1 */
            margin: 0;
            /* 2 */
            padding: 0;
            /* 3 */
        }

        button,
        select {
            text-transform: none;
        }

        button,
        [type='button'],
        [type='reset'],
        [type='submit'] {
            -webkit-appearance: button;
            /* 1 */
            background-color: transparent;
            /* 2 */
            background-image: none;
            /* 2 */
        }

        :-moz-focusring {
            outline: auto;
        }


        :-moz-ui-invalid {
            box-shadow: none;
        }

        progress {
            vertical-align: baseline;
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto;
        }

        [type='search'] {
            -webkit-appearance: textfield;
            /* 1 */
            outline-offset: -2px;
            /* 2 */
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            /* 1 */
            font: inherit;
            /* 2 */
        }

        summary {
            display: list-item;
        }

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0;
        }

        fieldset {
            margin: 0;
            padding: 0;
        }

        legend {
            padding: 0;
        }

        ol,
        ul,
        menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        dialog {
            padding: 0;
        }

        textarea {
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            /* 1 */
            color: #9ca3af;
            /* 2 */
        }

        button,
        [role="button"] {
            cursor: pointer;
        }

        :disabled {
            cursor: default;
        }

        img,
        svg,
        video,
        canvas,
        audio,
        iframe,
        embed,
        object {
            display: block;
            /* 1 */
            vertical-align: middle;
            /* 2 */
        }

        img,
        video {
            max-width: 100%;
            height: auto;
        }

        [hidden] {
            display: none;
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        .fixed {
            position: fixed;
        }

        .bottom-0 {
            bottom: 0px;
        }

        .left-0 {
            left: 0px;
        }

        .table {
            display: table;
        }

        .h-12 {
            height: 3rem;
        }

        .w-1\/2 {
            width: 50%;
        }

        .w-full {
            width: 100%;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        .border-spacing-0 {
            --tw-border-spacing-x: 0px;
            --tw-border-spacing-y: 0px;
            border-spacing: var(--tw-border-spacing-x) var(--tw-border-spacing-y);
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .border-b-2 {
            border-bottom-width: 2px;
        }

        .border-r {
            border-right-width: 1px;
        }

        .border-main {
            border-color: #2273CE;
        }

        .bg-main {
            background-color: #2273CE;
        }

        .bg-slate-100 {
            background-color: #f1f5f9;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .px-14 {
            padding-left: 3.5rem;
            padding-right: 3.5rem;
        }

        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .pb-3 {
            padding-bottom: 0.75rem;
        }

        .pl-2 {
            padding-left: 0.5rem;
        }

        .pl-3 {
            padding-left: 0.75rem;
        }

        .pl-4 {
            padding-left: 1rem;
        }

        .pr-3 {
            padding-right: 0.75rem;
        }

        .pr-4 {
            padding-right: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .align-top {
            vertical-align: top;
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .italic {
            font-style: italic;
        }

        .text-main {
            color: #2273CE;
        }

        .text-neutral-600 {
            color: #525252;
        }

        .text-neutral-700 {
            color: #404040;
        }

        .text-slate-300 {
            color: #cbd5e1;
        }

        .text-slate-400 {
            color: #8aa9cb;
        }

        .text-white {
            color: #fff;
        }

        /* Custom */

        .label {
            display: inline-block;
            width: 130px;
        }

        .separator {
            display: inline-block;
            width: 10px;
            text-align: center;
            margin-right: 10px;
        }

        .value {
            flex: 1;
        }

        @page {
            margin: 0;
            margin-top: 40px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div>
        <div class="py-4">
            <div class="px-14 py-6">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-full align-top">
                                <div>
                                    <img src="https://i.imgur.com/dx3Vldi.png" class="h-12" />
                                </div>
                            </td>

                            <td class="align-top">
                                <div class="text-sm">
                                    <table class="border-collapse border-spacing-0">
                                        <tbody>
                                            <tr>
                                                <td class="pl-4">
                                                    <div>
                                                        <p class="whitespace-nowrap text-slate-400 text-right">
                                                            Maganger
                                                        </p>
                                                        <p class="whitespace-nowrap font-bold text-main text-right">
                                                            {{ $intern->full_name }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-14 text-sm text-neutral-700">
                <p class="text-main font-bold" style="margin-bottom: 10px;">Informasi</p>
                <p><span class="label">Posisi Magang</span> <span class="separator">:</span> <span
                        class="value">{{ $intern->position->name }}</span></p>
                <p><span class="label">Nama Lengkap</span> <span class="separator">:</span> <span
                        class="value">{{ $intern->full_name }}</span></p>
                <p><span class="label">Tugas</span> <span class="separator">:</span> <span
                        class="value">{{ $task->name }}</span></p>
                <p><span class="label">Bobot Tugas</span> <span class="separator">:</span> <span
                        class="value">{{ number_format($task->weight, 0) }} %</span></p>
            </div>

            <div class="px-14 py-10 text-sm text-neutral-700">
                <table class="w-full border-collapse border-spacing-0">
                    <thead>
                        <tr>
                            <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">Kriteria</td>
                            @foreach ($evaluators as $evaluator)
                                <td class="border-b-2 border-main pb-3 pl-3 text-center font-bold text-main">
                                    {{ $evaluator->name }}</td>
                            @endforeach
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Jumlah</td>
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Rata-Rata</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td class="border-b py-3 pl-23">{{ $evaluation->aspect->name }}</td>
                                @foreach ($evaluators as $evaluator)
                                    @php
                                        $score =
                                            $evaluation->evaluationDetails
                                                ->where('evaluator_id', $evaluator->id)
                                                ->first()->score ?? '';
                                    @endphp
                                    <td class="border-b py-3 pl-2 text-center">
                                        {{ is_numeric($score) ? number_format($score, $score == floor($score) ? 0 : 2) : '' }}
                                    </td>
                                @endforeach
                                <td class="border-b py-3 pl-2 text-center">
                                    {{ is_numeric($evaluation->total_score) ? number_format($evaluation->total_score, $evaluation->total_score == floor($evaluation->total_score) ? 0 : 2) : '' }}
                                </td>
                                <td class="border-b py-3 pl-2 text-center">
                                    {{ $evaluation->average_score }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>
