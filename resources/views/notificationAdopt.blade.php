<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Novo Formulario de Adoção</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#006400; padding:20px; text-align:center; color:#ffffff;">
                            <h1 style="margin:0; font-size:22px;">Novo Formulario Submetido</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:30px; color:#333333;">
                            <p style="font-size:16px; margin-top:0;">Caro Administrador,</p>

                            <p style="font-size:15px; line-height:1.6;">
                                Informamos que foi submetido um <strong>novo formulário de adoção</strong>.
                            </p>

                            <p style="font-size:15px; line-height:1.6;">
                                Para mais detalhes, aceda à Área Reservada e consulte a secção
                                <strong>“Pedidos de Adoção”</strong>.
                            </p>

                            <!-- Button -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ url('/admin/animal/adoption-requests') }}"
                                   style="background:#006400; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:6px; font-size:14px; display:inline-block;">
                                    Ver Pedidos de Adoção
                                </a>
                            </div>

                            <p style="font-size:14px; color:#777;">
                                Caso não reconheça esta ação, por favor ignore este email.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#888;">
                            © {{ date('Y') }} - Todos os direitos reservados
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>