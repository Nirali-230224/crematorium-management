<!doctype html>
<html lang="gu">

<head>
    <meta charset="UTF-8">

    <!-- Gujarati Font -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Gujarati&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Noto Sans Gujarati', sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .receipt-box {
            width: 650px;
            /* A4 width */
            height: 870px;
            /* A4 height */
            margin: auto;
            border: 3px solid #2c5aa0;
            position: relative;
            box-sizing: border-box;
            padding: 15px;
            overflow: hidden;
            /* 🔥 prevents overflow */
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #2c5aa0;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 22px;
            font-weight: bold;
            margin-top: 16px;
        }

        .small {
            font-size: 12px;
        }

        .row {
            margin-top: 10px;
            line-height: 1.4;
        }

        .line {
            display: inline-block;
            border-bottom: 1px solid #000;
            height: 18px;
            vertical-align: bottom;
            padding: 0 5px;
            overflow: hidden;
        }

        .w-100 {
            width: 100px;
        }

        .w-150 {
            width: 150px;
        }

        .w-200 {
            width: 200px;
        }

        .w-250 {
            width: 250px;
        }

        .w-300 {
            width: 300px;
        }

        .w-400 {
            width: 400px;
        }
        .w-500 {
            width: 500px;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }

        .footer {
            margin-top: 40px;
        }

        .signature {
            position: absolute;
            bottom: 255px;
            left: 15px;
            right: 15px;
            display: flex;
            justify-content: space-between;
        }

        .declaration {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            font-size: 12px;
            line-height: 1.3;
        }

        .content {
            max-height: 580px;
            overflow: hidden;
        }



        body {
            font-family: 'gujarati', sans-serif;
            font-size: 12px;
        }

        @font-face {
            font-family: 'gujarati';
            src: url('{{ asset(' admin/dist/fonts/NotoSansGujarati-VariableFont_wdth, wght.ttf') }}') format('truetype');
        }

        @media print {
            body {
                margin: 0;
            }

            .receipt-box {
                width: 650px;
                height: 870px;
                border: 2px solid #000;
            }

            button {
                display: none;
            }
        }

        .header-top {
            float: left;
        }

        .small {
            font-size: 12px;
            line-height: 3px;
        }

        .header-center {
            width: 50%;
            margin-left: 149px;
        }

        .alltitle {
            font-size: 13px;
        }

        span.linesmall {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 160px;
            margin-left: 9px;
            margin-right: 9px;
        }

        span.linesmallest {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 115px;
            margin-left: 9px;
            margin-right: 9px;
        }

        span.linemedium {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 270px;
            margin-left: 9px;
            margin-right: 9px;
        }

        .ruppesbox {
            border: 1px solid #000;
            width: 28%;
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 23px;
            border-radius: 12px;
            margin-top: 29px;
        }

        .sansthatag {
            float: right;
            margin-top: -30px;
        }

        h2.bahedhri {
            text-align: center;
            font-size: 15px;
        }

        .bottom-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .org-name {
            text-align: right;
        }
    </style>

</head>

<body>

    <button onclick="window.print()">🖨️ Print</button>

    <div class="receipt-box">
        <div class="header">
            <div class="header-top">
                <div class="small">નોંધણિ નંબર એ / 21 વલસાડ</div><br />
                <div class="small"><b>પાન નં. AAATH 1348 E</b></div>
            </div>
            <div class="header-center">
                <div class="small">નોંધણિ નંબર એ / 21 વલસાડ</div><br />
                <div class="small">પાન નં. AAATH 1348 E</div>
            </div>
            <h2>શ્રી હિન્દુ સ્મશાનભૂમિ વ્યવસ્થાપક મંડળ, વલસાડ</h2>
            <div class="small">ઔરંગા નદી પાસ કૈલાશ રોડ, પારડી સાંધપોર, વલસાડ - 396001</div>
        </div>

        <!-- HEADER -->

        <div class="content">
            <div class="row flex">
                <div><strong>રસીદ નં: {{ $donation->receipt_no }}</strong></div>
                <div>તા: {{ $donation->created_at->format('d-m-Y') }}</div>
            </div>
            <div class="row">
                <div class="alltitle">સ્વર્ગવાસી શ્રી/શ્રીમતી
                    <span class="line w-400">{{ $donation->deceased->deathperson_name }}</span>
                </div>
            </div>

            <div class="row">
                <div class="alltitle">સરનામુ:
                    <span class="line w-500">{{ $donation->deceased->address }}</span>
                </div>
            </div>

            <div class="row">
                <div class="alltitle">મૃત્યુ તારીખ
                    <span class="line w-200">{{ $donation->deceased->date_of_death }}</span>વર્ષ<span class="line w-100">{{ $donation->deceased->age }}</span>
                </div>
            </div>

            <div class="row">
                <div class="alltitle">માહિતિ આપનાર નું નામ
                    <span class="line w-400">{{ $donation->deceased->relative_name }}
                </div>
            </div>
            <div class="row">
                <div class="alltitle">સરનામુ:
                    <span class="line w-500">{{ $donation->deceased->relative_address }}
                </div>
            </div>
            <div class="row">
                <div class="alltitle">મૃત્યુનું કારણ
                    <span class="line w-200">{{ $donation->deceased->reason }}</span>મૃત્યુદેહ બીનાવારસી છે ? હા / ના
                </div>
            </div>
            <div class="row">
                <div class="alltitle">મૃત્યુનું સ્થાન

                    <span class="line w-100">{{ $donation->address }}</span>લાકડાની ભાથી/ગેસની ભાથી માં મુકવાનો સમય
                    <span class="line w-100">{{ $donation->deceased->death_time }}</span>
                </div>
            </div>

            <div class="row">
                <div class="alltitle">દાન આપનાર શ્રી / શ્રીમતી <span class="line w-400">{{ $donation->deceased->relative_name }}</div>
            </div>
            <div class="row">
                <div class="alltitle">સરનામુ<span class="line w-400">{{ $donation->deceased->relative_address }}</div>
            </div>
            <div class="row">
                <div class="alltitle">રૂપિયા
                    <span class="line w-100">{{ $donation->amount }}</span>
                    (અંકે રુપિયા:)
                    <span class="line w-300">{{ $donation->amount_in_word }}</span>
                    મળ્યા.
                </div>
            </div>

            <div class="row">
                <div class="alltitle">
                    સંસ્થાને દાન પેટે મળેલ છે. જે માટે સંસ્થા આપની આભારી છે. પ્રભુ સ્વર્ગસ્થના આત્માને શાંતિ આપે તેવી પ્રાર્થના.
                </div>
            </div>
            <div class="row bottom-row">
                <div class="ruppesbox">
                    દાની રકમ : {{ $donation->amount }}
                </div>

                <div class="org-name">
                    <strong>શ્રી હિન્દુ સ્મશાનભૂમિ વ્યવસ્થાપક મંડળ</strong>
                </div>
            </div>


            <!-- SIGNATURE (FIXED POSITION) -->
            <div class="signature">
                <div>દાન આપનારની સહી</div>
                <div>દાન લેનાર ની સહી</div>
                <div>ટ્રસ્ટી સહી</div>
            </div>

            <!-- DECLARATION (FIXED BOTTOM) -->
            <div class="declaration">
    <h2 class="bahedhri">બાંહેધરી પત્ર</h2>

    <p>
        આથી હું નીચે સહી કરનાર ખોટી માહિતી આપનાર કે મરણારની જાણકારી સંબંધિત હું તે મારા દમ પર સોગંદ પૂર્વક જણાવું છું કે મરણારની લાશ કોઈપણ કાયદેસર ગુનાહિત કાર્યમાં સંડોવાયેલ નથી. કે આ રસીદમાં દર્શાવેલ વિગતો સાચી છે. ભવિષ્યમાં ખોટી વિગતો અંગે કોઈપણ વિવાદ ઊભો થાય તો તેની જવાબદારી મારી રહેશે. અને તે અંગે સંસ્થાને કોઈ જવાબદારી રહેશે નહીં. મરણારના અગ્નિસંસ્કાર માટે જરૂરી પ્રક્રિયા માટે ઉપયુક્ત માહિતી આપનારની સંપૂર્ણ જવાબદારી રહેશે. આથી મરણારના અગ્નિ સંસ્કાર માટે ઉપયુક્ત વિધિ માટે સ્મશાનભૂમિ વ્યવસ્થાપક મંડળને સત્તા આપેલ છે.
    </p>

    <div style="margin-top:10px;">
        ફોન નં.: <span class="line w-200"></span>
        <span style="float:right;" class="line w-200">સહી</span>
    </div>

    <p style="margin-top:10px; font-size:11px; text-align:center;">
        <strong>નોંધ: મરણની નોંધ નગરપાલિકા/ગ્રામ પંચાયતમાં નોંધાવવી ફરજિયાત છે.</strong>
    </p>

    <p style="font-size:10px; text-align:center;">
        Donation Entitled exemption u/s. 80G(5)(VI) of the Income-tax Act, 1961 and is valid indefinitely unless it is specifically withdrawn.
    </p>
</div>

        </div>

        <!-- Footer -->

</body>

</html>