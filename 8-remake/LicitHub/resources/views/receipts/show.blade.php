<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo de Assinatura</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header h2 { margin: 5px 0 0; font-size: 14px; color: #555; }
        .details { margin: 20px 0; }
        .footer { margin-top: 30px; padding-top: 10px; border-top: 1px solid #eee; font-size: 10px; text-align: center; color: #777; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f5f5f5; }
        .total { text-align: right; font-weight: bold; margin-top: 10px; }
        .info-item { margin-bottom: 5px; }
        .info-label { font-weight: bold; display: inline-block; width: 120px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <h2>Recibo de Assinatura #{{ $subscription->id }}</h2>
    </div>
    
    <div class="details">
        <div class="info-item">
            <span class="info-label">Data:</span> {{ $date }}
        </div>
        <div class="info-item">
            <span class="info-label">Cliente:</span> {{ $user->name }}
        </div>
        <div class="info-item">
            <span class="info-label">Email:</span> {{ $user->email }}
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Assinatura {{ $plan->name }}</td>
                    <td>Plano {{ $plan->description }}</td>
                    <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="total">
            Total: R$ {{ number_format($plan->price, 2, ',', '.') }}
        </div>
    </div>
    
    <div class="footer">
        <p>Obrigado por sua assinatura!</p>
        <p>{{ config('app.name') }} - {{ config('app.url') }}</p>
    </div>
</body>
</html>