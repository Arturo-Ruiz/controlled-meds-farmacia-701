<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Mensual</title>
    <style>
        @page {
            margin: 20mm 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #2d3748;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #07c !important;
        }

        .header img {
            width: 85px;
            height: auto;
            margin-bottom: 8px;
        }

        .header h1 {
            font-size: 15pt;
            margin: 1px 0;
            font-weight: bold;
            color: #1a202c;
        }

        .header p {
            font-size: 8.5pt;
            margin: 1px 0;
            color: #4a5568;
        }

        .info-section {
            background-color: #f7fafc;
            border-left: 3px solid #07c !important;
            padding: 10px 12px;
            margin: 18px 0;
            font-size: 6.5pt;
            line-height: 1.5;
        }

        .info-section p {
            margin: 0;
        }

        .info-section strong {
            color: #2d3748;
        }

        .report-title {
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
            margin: 18px 0;
            padding: 10px;
            background-color: #07c !important;
            color: white;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 8pt;
        }

        th {
            background-color: #4a5568;
            color: white;
            padding: 9px 5px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #2d3748;
            font-size: 8.5pt;
        }

        td {
            padding: 7px 5px;
            border: 1px solid #cbd5e0;
            text-align: center;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody tr:nth-child(even) {
            background-color: #f7fafc;
        }

        .text-left {
            text-align: left;
            padding-left: 8px;
        }

        tfoot tr {
            background-color: #e2e8f0;
            font-weight: bold;
            border-top: 2px solid #4a5568;
        }

        tfoot td {
            padding: 9px 5px;
            font-size: 8.5pt;
        }

        .footer {
            margin-top: 35px;
            padding-top: 12px;
            border-top: 1px solid #cbd5e0;
            font-size: 7.5pt;
            text-align: center;
            color: #718096;
        }

        .footer p {
            margin: 4px 0;
        }

        .img-signature {
            width: 180px !important;
            height: auto !important;
            margin-bottom: 0px !important;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo Farmacia 701">
        <h1>FARMACIA 701, C.A.</h1>
        <p><strong>RIF:</strong> J-30831331-9</p>
        <p>Av. 17 de diciembre C/C Calle Madrid, Local # 28, Frente a la clínica Santa Ana | Teléfono: (0285) 654-3624</p>
    </div>

    <!-- Información Legal -->
    <div class="info-section">
        <p>
            <strong>Establecimiento Farmacéutico:</strong> FARMACIA 701, C.A. | <strong>Fecha:</strong> {{ now()->format('d/m/Y H:i:s') }}
        </p>
        <p style="margin-top: 6px;">
            Con el Permiso de Funcionamiento Registrado bajo el <strong>N° 194-BOL</strong>.
        </p>
        <p>
            Movimiento de las Existencias de {{ strtoupper($medicamentType->name) }} de Récipe Violetas
        </p>
        <p>
            (Art. 27 y 28 Ley Orgánica Sobre Sustancias Estupefacientes y Psicotrópicas)
        </p>
        <p style="margin-top: 6px;">
            <strong>Durante el mes:</strong> {{ strtoupper($monthName) }} {{ $year }}
        </p>
    </div>

    <!-- Título del Reporte -->
    <div class="report-title">
        REPORTE MENSUAL DE MOVIMIENTO DE MEDICAMENTOS<br>
        {{ strtoupper($medicamentType->name) }} - {{ strtoupper($monthName) }} {{ $year }}
    </div>

    <!-- Tabla de Datos -->
    <table>
        <thead>
            <tr>
                <th style="width: 20%;">NOMBRE DEL<br>PRODUCTO</th>
                <th style="width: 15%;">DROGUERÍA</th>
                <th style="width: 13%;">N° DE<br>FACTURAS</th>
                <th style="width: 13%;">EXISTENCIA<br>ANTERIOR</th>
                <th style="width: 13%;">ENTRADAS</th>
                <th style="width: 13%;">SALIDAS</th>
                <th style="width: 13%;">EXISTENCIA<br>ACTUAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reportData as $row)
            <tr>
                <td class="text-left"><strong>{{ $row['product_name'] }}</strong></td>
                <td class="text-left" style="font-size: 7.5pt;">{{ $row['drugstores'] }}</td>
                <td style="font-size: 7.5pt;">{{ $row['invoice_numbers'] }}</td>
                <td>{{ number_format($row['previous_stock'], 0) }}</td>
                <td>{{ number_format($row['entries'], 0) }}</td>
                <td>{{ number_format($row['dispatches'], 0) }}</td>
                <td><strong>{{ number_format($row['current_stock'], 0) }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 25px; color: #718096;">
                    No hay datos disponibles para el período seleccionado
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-left"><strong>TOTALES GENERALES</strong></td>
                <td><strong>{{ number_format(collect($reportData)->sum('previous_stock'), 0) }}</strong></td>
                <td><strong>{{ number_format(collect($reportData)->sum('entries'), 0) }}</strong></td>
                <td><strong>{{ number_format(collect($reportData)->sum('dispatches'), 0) }}</strong></td>
                <td><strong>{{ number_format(collect($reportData)->sum('current_stock'), 0) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="header" style="margin-top: 10px;">
        <img class="img-signature" src="{{ public_path('img/signature.png') }}" alt="Firma Dr.Tania Biutti">
        <h1>Dra. Tania Biutti</h1>
        <p><strong>Ci:</strong> 5.554.831 | M.P.PS : 6615</p> 
        <p><strong>Colfar: 466</strong></p> 
        <p>Inprefar: 0612450</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Reporte generado el:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
        <p style="margin-top: 8px;">Este documento es válido únicamente con firma y sello autorizado</p>
    </div>
</body>

</html>