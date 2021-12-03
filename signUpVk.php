<?php
		

		//function signUpVk(){

		$client_id = '8010297'; // ID приложения
		$client_secret = 'zDX9rF880v28UfVNCSQG'; // Защищённый ключ
		$redirect_uri = 'http://localhost/signUpVk.php'; // Адрес сайта

		$url = 'http://oauth.vk.com/authorize';

		$params = array(
			'client_id'     => $client_id,
			'redirect_uri'  => $redirect_uri,
			'response_type' => 'code',
			'v'             => '5.131', // (обязательный параметр) версия API, которую Вы используете https://vk.com/dev/versions
			'scope'         => 'photos,offline',	
		);

		echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';

		if (isset($_GET['code'])) {
			$result = false;
			$params = array(
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'code' => $_GET['code'],
				'redirect_uri' => $redirect_uri
			);

			$token = json_decode(@file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params)."&v=5.131"), true);

		
		
			// Сохраняем токен в сессии
			$_SESSION['token'] = $token;

			$_SESSION['vk'] = "authorized";





			if (isset($token['access_token'])) {
				
				$params = array(
					'uids'         => $token['user_id'],
					'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
					'access_token' => $token['access_token']
				);

							
				$userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . http_build_query($params)."&v=5.131"), true);
			
				echo $userInfo["response"][0]["first_name"];
				echo '<br>';
				echo $userInfo["response"][0]["id"];

				$_SESSION['login']=$userInfo["response"][0]["first_name"];

				$link=mysqli_connect("localhost", "root", "", "db");

				$query = mysqli_query($link, "SELECT * FROM users WHERE id_vk='".mysqli_real_escape_string($link, $userInfo["response"][0]["id"])."'");


				if(mysqli_num_rows($query) == 0)
					{	
						
						mysqli_query($link,"INSERT INTO users SET login='".$userInfo["response"][0]["first_name"]."', password='".$userInfo["response"][0]["id"]."', id_vk='".$userInfo["response"][0]["id"]."'");
						header("Location: /");
					} else {
						header("Location: /");
					}

			

			
			
			}
			
			
			
		//}
		// if (isset($_SESSION['token'])) {
		// 	$country = 'Moscow';
		// 	$name = 'Маша';
		// 	$url = $url = "https://api.vk.com/method/users.search?city_id=1&q={$name}&count=1000&access_token={$_SESSION['token']}";
		// 	var_dump($url);
		// 	//$res = file_get_contents($url);
		// 	//$users_data = json_decode($res,true);
		// 	//$users_count = array_shift($users_data['response']);
		// 	//$users_list = $users_data['response'];
		// }
		
		}

		function logOut (){

			$client_id = '8010297'; // ID приложения
			$client_secret = 'zDX9rF880v28UfVNCSQG'; // Защищённый ключ
			$redirect_uri = 'http://localhost/logout.php'; // Адрес сайта

			$url = 'http://api.vk.com/oauth/logout';

			$params = array(
				'client_id'     => $client_id,
				'redirect_uri'  => $redirect_uri,
				'response_type' => 'code',
				'v'             => '5.131', // (обязательный параметр) версия API, которую Вы используете https://vk.com/dev/versions
				'scope'         => 'photos,offline',	
			);
	
			echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Выход через ВКонтакте</a></p>';

			
		}
	?>