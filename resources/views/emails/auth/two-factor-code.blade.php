<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Verificação</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        
        <div style="text-align: center; margin-bottom: 30px; max-width: 320px; margin-left: auto; margin-right: auto;">
            <h1 style="color: #58B6FF; margin-bottom: 10px; font-size: 24px; line-height: 1.2; display: inline-block;">💙{{ config('app.name') }}</h1>
            <h2 style="color: #2c3e50; margin-bottom: 10px; font-size: 20px; line-height: 1.2; display: inline-block;">Código de Verificação</h2>
        </div>
        
        <p style="font-size: 16px; margin-bottom: 20px;">Olá {{ $user->nome }}!</p>
        
        <p style="font-size: 16px; margin-bottom: 25px;">
            Você solicitou acesso ao <strong>{{ config('app.name') }}</strong>. 
            Use o código abaixo para verificar sua identidade:
        </p>
        
        <div style="background-color: #f8f9fa; border: 2px solid #58B6FF; border-radius: 8px; padding: 25px; text-align: center; margin: 25px 0;">
            <p style="margin: 0; font-size: 14px; color: #6c757d; display: inline-block; width: 100%; text-align: center;">Seu código de verificação é:</p>
            <p style="font-size: 36px; font-weight: bold; color: #58B6FF; letter-spacing: 8px; margin: 10px 0; display: inline-block; width: 100%; text-align: center;">{{ $user->two_factor_code }}</p>
            <p style="margin: 0; font-size: 12px; color: #6c757d; display: inline-block; width: 100%; text-align: center;">Este código é válido por 10 minutos</p>
        </div>
        
        <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; font-size: 14px;"><strong>⚠️ Importante:</strong> Se você não solicitou este código, ignore este email.</p>
        </div>
        
        <p style="font-size: 14px; margin-top: 20px;">
            Atenciosamente,<br>
            <strong>Equipe {{ config('app.name') }}</strong>
        </p>
        
        <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #e9ecef;">
            <p style="font-size: 12px; color: #adb5bd; display: inline-block; width: 100%; text-align: center; margin: 0;">
                Este é um email automático. Não responda a esta mensagem.<br>
                © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
            </p>
        </div>
    </div>
</body>
</html>