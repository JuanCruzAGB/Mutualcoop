<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>{{$data->nombre}} quiere contactar a alguien</title>
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
						<h2 style="text-align: center; color: #0F1626;margin: 20px 0;">{{ $data->nombre }} quiere contactar a alguien</h2>
						<ul style="font-size: 15px;  margin: 10px 0">
							<li style="list-style: none;"><strong>Se ha contactado:</strong> {{ $data->nombre }} desde tu sitio web.</li>
							<li style="list-style: none;"><strong>Email:</strong> {{ $data->correo }}</li>
							<li style="list-style: none;"><strong>Telefono:</strong>  {{ $data->telefono }}</li>
						</ul>
						<p style="margin: 2px;padding-top: 2rem;text-align: center;font-family: sans-serif;font-size: 17px;min-height: 70px;background-color: #f8f8f8;padding: 1rem 1rem;margin-bottom: 2.5rem;">{{ $data->mensaje }}</p>
						<div style="width: 100%; text-align: center">
							<a style="font-family: sans-serif;text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color: #0F1626;"target="_blank" href="https://mutualcoop.org.ar">Ir a Mutualcoop</a>
						</div>
						<p style="color: #ffffff;font-size: 1.1rem;text-align:center;margin:30px 0 0;padding: 1rem;background-color: #0F1626;font-family: sans-serif;">© Derecho Cooperativo y Mutual. Todos los Derechos Reservados. | Desarrollado por Digitalo</p>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>