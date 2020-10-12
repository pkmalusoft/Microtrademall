<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table>
			<tr>
				<th>Name</th><td>{{ $data['username'] }}</td>
				<th>Email</th><td>{{ $data['email'] }}</td>
				<th>Message</th><td>{{ $data['message'] }}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>