<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Mutualcoop || Tu usuario fue aprobado</title>
    </head>
    <body>
        <img src="{{asset('img/recursos/logo.png')}}" style="
        width: 100%;
        height: 10rem;
        object-fit: contain;" alt="Mutualcoop">
        <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
            <tr>
                <td style="background-color: #ecf0f1">
                    <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                        <h2 style="text-align: center; color: #0F1626;margin: 20px 0;">¡Bienvenido a Mutualcoop!</h2>
                        <p style="margin: 2px;padding-top: 2rem;text-align: center;font-family: sans-serif;font-size: 17px;min-height: 70px;background-color: #f8f8f8;padding: 1rem 1rem;margin-bottom: 2.5rem;">Tu usuario está dado de alta, ya podés acceder al contenido ingresando como usuario:<br />el correo electrónico o tu ID ({{$data->id_suscriptor}})<br /><br />Cualquier duda o consulta puede escribirnos a <b>info@mutualcoop.org.ar</b><br />¡Muchas gracias!</p>
                        <div style="width: 100%; text-align: center">
                            <a style="font-family: sans-serif;text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color: #0F1626;"target="_blank" href="https://mutualcoop.org.ar/ingresar">Ir a Mutualcoop</a>
                        </div>
                        <p style="color: #ffffff;font-size: 1.1rem;text-align:center;margin:30px 0 0;padding: 1rem;background-color: #0F1626;font-family: sans-serif;">© Derecho Cooperativo y Mutual. Todos los Derechos Reservados. | Desarrollado por Digitalo</p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>