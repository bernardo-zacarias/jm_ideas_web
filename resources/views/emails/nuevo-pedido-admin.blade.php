<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #dc2626 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .alert {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .customer-info {
            background: #dbeafe;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .order-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        .item {
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 0;
        }
        .item:last-child {
            border-bottom: none;
        }
        .total {
            background: #10b981;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #dc2626;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔔 Nuevo Pedido Recibido</h1>
        <p>Pedido #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</p>
    </div>

    <div class="content">
        <div class="alert">
            <p style="margin: 0; font-weight: bold;">⚡ Acción Requerida</p>
            <p style="margin: 5px 0 0 0;">Se ha recibido un nuevo pedido que requiere tu atención.</p>
        </div>

        <div class="customer-info">
            <h3 style="margin-top: 0;">Información del Cliente</h3>
            @if($pedido->nombre_cliente)
                <!-- Cliente Guest -->
                <p><strong>Nombre:</strong> {{ $pedido->nombre_cliente }}</p>
                <p><strong>Email:</strong> {{ $pedido->email_cliente }}</p>
                <p><strong>Teléfono:</strong> {{ $pedido->telefono_cliente }}</p>
                <p><strong>Dirección:</strong> {{ $pedido->direccion_cliente }}</p>
                <p><strong>Comuna:</strong> {{ $pedido->comuna_cliente }}</p>
                <p style="margin-top: 10px; padding: 8px; background: #dbeafe; border-radius: 4px;">
                    <strong>Tipo:</strong> <span style="color: #0369a1;">Compra sin Registro (Guest)</span>
                </p>
            @elseif($usuario)
                <!-- Cliente Registrado -->
                <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
                <p><strong>Email:</strong> {{ $usuario->email }}</p>
                <p><strong>Teléfono:</strong> {{ $usuario->telefono ?? 'No proporcionado' }}</p>
                @if($usuario->comuna || $usuario->ciudad)
                    <p><strong>Ubicación:</strong> {{ $usuario->comuna }}, {{ $usuario->ciudad }}</p>
                @endif
                <p style="margin-top: 10px; padding: 8px; background: #dcfce7; border-radius: 4px;">
                    <strong>Tipo:</strong> <span style="color: #166534;">Usuario Registrado</span>
                </p>
            @else
                <p>No hay información disponible del cliente</p>
            @endif
        </div>

        <div class="order-details">
            <h3 style="margin-top: 0;">Detalles del Pedido</h3>
            <p><strong>Pedido ID:</strong> #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
            @if($pedido->transbank_authorization_code)
                <p><strong>Método de Pago:</strong> Webpay (Código: {{ $pedido->transbank_authorization_code }})</p>
            @endif
            
            <h4>Productos Solicitados:</h4>
            @foreach($items as $item)
                <div class="item">
                    <p style="margin: 0; font-weight: bold;">
                        {{ $item->producto->nombre ?? $item->cotizacion->nombre ?? 'Producto' }}
                    </p>
                    <p style="margin: 5px 0; font-size: 14px; color: #6b7280;">
                        Cantidad: {{ $item->cantidad }}
                        @if($item->ancho > 0 || $item->alto > 0)
                            | Medidas: {{ $item->ancho }}m x {{ $item->alto }}m
                        @endif
                    </p>
                    @if($item->requiere_diseno)
                        <p style="margin: 5px 0; color: #dc2626; font-weight: bold;">
                            ⚠️ REQUIERE DISEÑO
                        </p>
                    @endif
                    @if($item->ruta_archivo)
                        <p style="margin: 5px 0; color: #10b981;">
                            ✓ Archivo adjunto proporcionado
                        </p>
                    @endif
                    <p style="margin: 5px 0; font-weight: bold; color: #667eea;">
                        ${{ number_format($item->costo_final, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="total">
            TOTAL: ${{ number_format($pedido->total, 0, ',', '.') }}
        </div>

        @if($pedido->notas_cliente)
            <div style="background: #f3f4f6; padding: 15px; border-radius: 8px; margin: 20px 0;">
                <p style="margin: 0; font-weight: bold;">Notas del Cliente:</p>
                <p style="margin: 5px 0 0 0;">{{ $pedido->notas_cliente }}</p>
            </div>
        @endif

        <p style="text-align: center;">
            <a href="{{ route('admin.dashboard') }}" class="button">
                Ver en Panel Admin
            </a>
        </p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} MM Impresiones - Panel de Administración</p>
        <p>Este email fue enviado automáticamente por el sistema.</p>
    </div>
</body>
</html>
