<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nieuwe UFO Melding</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .alert-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .detail-item {
            margin: 10px 0;
            padding: 8px;
            background: #f9fafb;
            border-left: 4px solid #dc2626;
        }
        .description-box {
            background: #ffffff;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 15px 0;
        }
        .footer {
            border-top: 1px solid #e5e7eb;
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 24px;">
                🛸 Nieuwe UFO-melding ontvangen!
            </h1>
        </div>
        
        <p style="font-size: 16px; margin-bottom: 20px;">
            Er is een nieuwe UFO-melding ingediend met nummer <strong>#{{ $report->id }}</strong>.
        </p>
        
        <div class="alert-box">
            <h3 style="margin-top: 0; color: #dc2626; font-size: 18px;">
                🚨 Melding Details:
            </h3>
            
            <div class="detail-item">
                <strong>Melder:</strong> {{ $report->reporter_display_name }}
            </div>
            
            @if(!$report->user_id && $report->reporter_email)
                <div class="detail-item">
                    <strong>Email:</strong> {{ $report->reporter_email }}
                </div>
            @endif
            
            <div class="detail-item">
                <strong>Datum/Tijd:</strong> {{ $report->incident_datetime->format('d-m-Y H:i') }}
            </div>
            
            <div class="detail-item">
                <strong>Locatie:</strong> {{ $report->location }}
            </div>
            
            <div class="detail-item">
                <strong>Categorie:</strong> {{ ucfirst($report->category) }}
            </div>
            
            @if($report->photo_path)
                <div class="detail-item">
                    <strong>Foto:</strong> ✅ Ja, toegevoegd
                </div>
            @else
                <div class="detail-item">
                    <strong>Foto:</strong> ❌ Geen foto toegevoegd
                </div>
            @endif
            
            <div style="margin: 15px 0;">
                <strong>Beschrijving:</strong>
                <div class="description-box">
                    {{ $report->description }}
                </div>
            </div>
        </div>
        
        <div style="margin: 25px 0; text-align: center;">
            <a href="{{ config('app.url') }}/admin" class="btn">
                🔍 Bekijk in Admin Panel
            </a>
        </div>
        
        <div style="background: #eff6ff; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <h4 style="margin-top: 0; color: #1d4ed8;">📊 Quick Stats:</h4>
            <p style="margin: 5px 0;">
                <strong>Status:</strong> {{ ucfirst($report->status) }}<br>
                <strong>Ingediend op:</strong> {{ $report->created_at->format('d-m-Y H:i') }}<br>
                <strong>Type melder:</strong> {{ $report->user_id ? 'Geregistreerde gebruiker' : 'Gast' }}
            </p>
        </div>
        
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <h4 style="margin-top: 0; color: #166534;">⚡ Acties vereist:</h4>
            <ul style="margin: 5px 0; padding-left: 20px;">
                <li>Beoordeel de melding in het admin panel</li>
                <li>Classificeer de waarneming</li>
                <li>Stuur eventueel follow-up vragen</li>
                <li>Update de status van de melding</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>
                <strong>UFO Meldpunt Nederland - Admin Notificatie Systeem</strong><br>
                Dit is een automatisch gegenereerde email voor administratoren.<br>
                <em>Voor een veiligere samenleving, ook in de ruimte.</em>
            </p>
            <p style="margin-top: 15px;">
                📧 <a href="mailto:admin@ufo-meldpunt.nl">admin@ufo-meldpunt.nl</a> | 
                🌐 <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
            </p>
        </div>
    </div>
</body>
</html>