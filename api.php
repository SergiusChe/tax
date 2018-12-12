<?php
	class API
	{
		protected $method = '';
		protected $data = '';	

		public function __construct()
		{
			if (isset($_GET['token']))				//авторизоваться можно как через куки, так и передавая токен в строке GET-запроса
				$token = $_GET['token'];
			elseif (isset($_COOKIE['token']))
				$token = $_COOKIE['token'];				
			if ((isset($token)) && ($token === CNFG::$adminToken))   //успешная авторизация
			{
				header("Access-Control-Allow-Orgin: *");
				header("Access-Control-Allow-Methods: GET");
				header("Content-Type: application/json; charset=utf-8");
				$this->method = $_SERVER['REQUEST_METHOD'];
				$routes = preg_split("|[/\?]+|",substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['SCRIPT_NAME'],'/') + 1)); //разбираем URI
				if (isset($routes[1])) //выделяем маршрут - путь за первым слэшем после имени скрипта
				{
					$route = $routes[1]; 
					switch ($this->method)
					{
						case 'GET':
							$this->data = $this->processGet($route);
							break;
						case 'DELETE':
							$this->data = $this->processDelete();
							break;
						case 'POST':
							$this->data = $this->processPost();
							break;
						case 'PUT':
							$this->data = $this->processPost();
							break;
						default:
							$this->data = 'Invalid Method';
							break;
					}
				}
				else $this->data = 'Not Implemented';
			}
			else
			{		
				throw new Exception('Not Authorized');
			}		
		}

		public function processAPI()
		{
			return json_encode($this->data, JSON_UNESCAPED_UNICODE);
		}
		
		protected function processGet($route)
		{
			global $queries;//массив с SQL-запросами
			switch ($route)
			{
				case 'init':				//инициализация тестовыми данными
					$query = Model::$queries[$route];
					$mdl = new Model();
					if($mdl->run($query))
						return 'Initiated';
					else
						return 'Not Initiated';
				case 'drivers.nor':			//вывод водиителей без единого заказа
					$query = Model::$queries[$route];
					$mdl = new Model();
					$rows = $mdl->run($query)
						->fetchAll();
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				case 'address.nor':			//вывод адресов отправления со статусом заказа не равным 'DONE'
					$query = Model::$queries[$route];
					$mdl = new Model();
					$rows = $mdl->run($query)
						->fetchAll();
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				case 'drivers.cent':			//вывод водителей с числом заказов более 100, имеющих статус 'DONE'
					$query = Model::$queries['drivers.num'];
					$params = array(':orders' => 100);
					$mdl = new Model();
					$rows = $mdl->run($query, $params)
						->fetchAll();
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				case 'drivers.dec':			//вывод водителей с числом заказов более 10, имеющих статус 'DONE'
					$query = Model::$queries['drivers.num'];
					$params = array(':orders' => 10);						
					$mdl = new Model();
					$rows = $mdl->run($query, $params)
						->fetchAll();
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				case 'drivers.all':			//вывод всех водителей в порядке убывания числа заказов
					$query = Model::$queries[$route];
					$mdl = new Model();
					$rows = $mdl->run($query)
						->fetchAll(); 
					foreach ($rows as &$row)					
						if ($row['num'] == '') $row['num'] = 0;	//после внешнего объединения таблиц число заказов для водителей без заказов равно NULL, приводим к 0
					unset($row);
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				case 'cars.numdr':			//вывод машин с числом использующих водителей больше 1 и меньше 4
					$query = Model::$queries[$route];
					$params = array(':from' => 1,
							':to' => 4						
					);
					$mdl = new Model();
					$rows = $mdl->run($query, $params)
						->fetchAll();
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				case 'employ':				//вывод всех сотрудников
					$query = Model::$queries[$route];
					$mdl = new Model();
					$rows = $mdl->run($query)
						->fetchAll();
					if(!isset($rows[0])) return 'Not Found';
					else return $rows;
				default:
					return 'Not Implemented';
			}		
		}
		
		protected function processDelete()
		{
			return 'Not Implemented';
		}

		protected function processPost()
		{
			return 'Not Implemented';
		}

		protected function processPut()
		{
			return 'Not Implemented';
		}
	}
?>
