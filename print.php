<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }
        #firma
        {
            margin: 0 auto;
            display: block;
        }
        #Approved
        {
            text-align: right;
        }
        #Approved snap
        {
            font-size: 10pt;
        }
        #akt, #akt2
        {
            display: grid;
            grid-template-columns: 200px 200px;
            width: 20%;
            margin: 0 auto;
            height: 40px;
        }
        #akt2{
            grid-template-columns: 100px 200px;
        }
        #akt input, #akt h2
        {
            font-size: 16pt;
        }
        #akt div, #akt2 div
        {
            margin: auto 0;
        }
        #akt2 p{
            text-align: right;
            margin-right: 10px;
        }
        #comision
        {
            margin-left: 50px;
        }
        #head_comision, #part_comision
        {
            display: grid;
            grid-template-columns: 150px 300px;
        }
        #head_comision div:last-child, #part_comision div:last-child
        {
            margin-top: 15px;
        }
        #head_comision div:last-child p, #part_comision div:last-child p
        {
            width: 200px;
            text-align: center;
            font-size: 10px;
        }
        #sklad_comision
        {
            margin: 10px 0 0 0;
            padding: 0;
        }
        @media print {
            body * {
                display: none;
            }
            #content, #content * {
                display: block;
            }
            input{
                border: none;
            }
            #akt, #akt2
            {
            display: grid;
            grid-template-columns: 200px 100px;
            width: 50%;
            margin: 0 auto;
            height: 40px;
            }
            #akt2{
            grid-template-columns: 100px 200px;
            }
            #head_comision, #part_comision
            {
                display: grid;
                grid-template-columns: 150px 300px;
            }
            #head_comision input, #part_comision input
            {
                border-bottom: 1px solid black;
            }
        }
        @media (max-width: 600px) {
            * {
                font-size: 11pt;
            }
            #firma {
                width: 100%;
                font-size: 14pt;
            }
            #Approved {
                font-size: 11pt;
                padding: 0 5px;
            }
            #Approved snap {
                font-size: 9pt;
            }
            #akt, #akt2 {
                display: block;
                width: 100%;
                grid-template-columns: none;
                height: auto;
            }
            #akt2 {
                grid-template-columns: none;
            }
            #akt input, #akt h2 {
                font-size: 13pt;
                width: 100%;
            }
            #akt div, #akt2 div {
                margin: 5px 0;
            }
            #akt2 p {
                text-align: left;
                margin-right: 0;
            }
            #comision {
                margin-left: 0;
            }
            #head_comision, #part_comision {
                display: block;
                grid-template-columns: none;
            }
            #head_comision div, #part_comision div {
                margin-top: 10px;
            }
            #head_comision div:last-child p, #part_comision div:last-child p {
                width: 100%;
                font-size: 9px;
            }
            #sklad_comision {
                margin: 10px 0 0 0;
                padding: 0;
            }
            #print {
                width: 100%;
                font-size: 14pt;
                padding: 10px 0;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div id='content'>
        <input type="text" name="" id="firma" value='ТОВ фірма "Грона"'>
        <pre id='Approved'>
        “Затверджую”
________________________________________
<snap>(підпис, посада, прізвище, ініціали)</snap>
“___”_________20__ р
        </pre>
        <div id='akt'><div><h2>Акт дефектації №</h2></div><div><input type='number'></div></div>
        <div id="akt2"><div><p>від</p></div><div><input type='date'></div></div>
        <p id='sklad_comision'>Комісія в складі:</p>
        <div id='comision'>
            <div id='head_comision'>
                <div>
                    <p>Голова комісії:</p>
                </div>
                <div>
                    <input type="text">
                    <p>(посада, прізвище, ініціали)</p>
                </div>
            </div>
            <div id='part_comision'>
                <div>
                    <p>Члени комісії:</p>
                </div>
                <div>
                    <input type="text">
                    <p>(посада, прізвище, ініціали)</p>
                    <input type="text">
                    <p>(посада, прізвище, ініціали)</p>
                    <input type="text">
                    <p>(посада, прізвище, ініціали)</p>
                </div>
            </div>
        </div>
    </div>
    <button id = 'print'>print</button>
<script>
    let content = document.getElementById('print');
    content.addEventListener('click', function(){
        print()
    });
</script>
</body>
</html>