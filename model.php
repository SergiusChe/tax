<?php
	class Model
	{
		protected $pdo = null;
		public static $queries = Array(
			'init' => "SET FOREIGN_KEY_CHECKS = 0; 

				CREATE TABLE IF NOT EXISTS Drivers (
				id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
				name VARCHAR(32),
				position VARCHAR(32),
				PRIMARY KEY(id));

				TRUNCATE TABLE Drivers;

				INSERT INTO Drivers (name, position)
				VALUES ('Иванов Иван Иванович', 'Водитель 2-ой категории');
				INSERT INTO Drivers (name, position)
				VALUES ('Петров Петр Петрович', 'Водитель 1-ой категории');
				INSERT INTO Drivers (name, position)
				VALUES ('Александров Иван Петрович', 'Водитель 3-ой категории');
				INSERT INTO Drivers (name, position)
				VALUES ('Сидоров Петр Иванович', 'Водитель 2-ой категории');
				INSERT INTO Drivers (name, position)
				VALUES ('Козлов Валентин Алексеевич', 'Водитель 3-ой категории');


				CREATE TABLE IF NOT EXISTS Cars (
				id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
				name VARCHAR(32),
				color VARCHAR(32),
				number VARCHAR(32),
				PRIMARY KEY(id));

				TRUNCATE TABLE Cars;

				INSERT INTO Cars  (name, color, number)
				VALUES ('Volvo 940', 'Красный', 'SV2396');
				INSERT INTO Cars  (name, color, number)
				VALUES ('JEEP Grand Cherokee', 'Белый', 'XX0001');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Audi 100', 'Белый', 'SD5993');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Opel Frontera', 'Черный', 'GY4369');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Toyota 4Runner', 'Черный', 'LT4032');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Toyota Hilux Surf', 'Серебристый', 'ЕТ3254');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Dodge Chalenger', 'Оранжевый', 'LT4032');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Mersedes-Benz 230SL', 'Небесный', 'GU8313');
				INSERT INTO Cars  (name, color, number)
				VALUES ('ВАЗ-2101', 'Зеленый', 'GW1298');
				INSERT INTO Cars  (name, color, number)
				VALUES ('Чайка', 'Черный', 'JY4981');



				CREATE TABLE IF NOT EXISTS Operators (
				id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
				name VARCHAR(32),
				position VARCHAR(32),
				PRIMARY KEY(id));

				TRUNCATE TABLE Operators;

				INSERT INTO Operators (name, position)
				VALUES ('Брусникина Клара Ивановна', 'Оператор');
				INSERT INTO Operators (name, position)
				VALUES ('Черникина Клавдия Порфирьевна', 'Младший оператор');



				CREATE TABLE IF NOT EXISTS Orders (
				id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
				id_driver INT(6) UNSIGNED NOT NULL,
				id_car INT(6) UNSIGNED NOT NULL,
				id_operator INT(6) UNSIGNED NOT NULL,
				address_from VARCHAR(32),
				address_to VARCHAR(32),
				time DATETIME,
				status VARCHAR(32),
				PRIMARY KEY(id),
				FOREIGN KEY (id_driver) REFERENCES Drivers(id)
					ON UPDATE CASCADE
					ON DELETE RESTRICT,
				FOREIGN KEY (id_car) REFERENCES Cars(id)
					ON UPDATE CASCADE
					ON DELETE RESTRICT,
				FOREIGN KEY (id_operator) REFERENCES Operators(id)
					ON UPDATE CASCADE
					ON DELETE RESTRICT
				);


				TRUNCATE TABLE Orders;

				SET FOREIGN_KEY_CHECKS = 1;

				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '1', '1', 'Главный проспект, 15', 'Гороховая, 11', (NOW() - INTERVAL 30 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '2', '2', 'Гороховая, 11', 'Воздвиженская, 121', (NOW() - INTERVAL 29 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '3', '2', 'Гончарный, 29', 'Воздвиженская, 121', (NOW() - INTERVAL 28 HOUR), 'CANCELLED');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '4', '2', 'Петровка, 38', 'Гороховая, 11', (NOW() - INTERVAL 27 HOUR), 'CANCELLED');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '5', '2', '2-ая Застава, 20', 'Главный проспект, 15', (NOW() - INTERVAL 26 HOUR), 'CANCELLED');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '6', '1', 'Варшавская, 33', 'Воздвиженская, 121', (NOW() - INTERVAL 25 HOUR), 'CANCELLED');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '7', '1', 'Алексеевская, 1', 'Петровка, 38', (NOW() - INTERVAL 24 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '8', '1', 'Андреевская, 17', 'Петровка, 38', (NOW() - INTERVAL 23 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '9', '2', 'Бабаевская , 1', 'Тульская, 1', (NOW() - INTERVAL 22 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '10', '1', 'Тульская, 1', 'Петровка, 38', (NOW() - INTERVAL 21 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '6', '2', 'Татарская, 55', 'Садовая, 18', (NOW() - INTERVAL 20 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '4', '1', 'Садовая, 18', 'Беговая, 185', (NOW() - INTERVAL 19 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '3', '2', 'Беговая, 185', 'Волынская, 155', (NOW() - INTERVAL 18 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '2', '1', 'Волынская, 155', 'Беговая, 185', (NOW() - INTERVAL 17 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('1', '1', '2', 'Волхонка, 13', 'Донская, 58', (NOW() - INTERVAL 16 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '9', '1', 'Варварка, 90', 'Гончарная, 8', (NOW() - INTERVAL 15 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '10', '1', 'Гончарная, 8', 'Гороховая, 11', (NOW() - INTERVAL 14 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '9', '2', 'Донская, 58', 'Мещерская, 16', (NOW() - INTERVAL 13 HOUR), 'CANCELLED');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '8', '1', 'Мещерская, 16', 'Дворцовая, 11', (NOW() - INTERVAL 12 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '9', '2', 'Дворцовая, 11', 'Гороховая, 11', (NOW() - INTERVAL 11 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '10', '1', 'Елоховская, 9', 'Живописная, 59', (NOW() - INTERVAL 10 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('2', '10', '1', 'Живописная, 59', 'Ельницкая, 66', (NOW() - INTERVAL 9 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '9', '2', 'Ельницкая, 66', 'Гороховая, 11', (NOW() - INTERVAL 8 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '10', '1', 'Еланская, 32', 'Извилистая, 49', (NOW() - INTERVAL 7 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '9', '2', 'Извилистая, 49', 'Ильинка, 69', (NOW() - INTERVAL 6 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '9', '2', 'Ильинка, 69', 'Гороховая, 11', (NOW() - INTERVAL 5 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '9', '2', 'Тернистая, 3', 'Кривая, 5', (NOW() - INTERVAL 4 HOUR), 'DONE');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '10', '1', 'Кривая, 5', 'Косая, 155', (NOW() - INTERVAL 3 HOUR), 'IN PROCESS');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '9', '2', 'Косая, 155', 'Правильная, 19', (NOW() - INTERVAL 2 HOUR), 'IN PROCESS');
				INSERT INTO Orders (id_driver, id_car, id_operator, address_from, address_to, time, status)
				VALUES ('4', '9', '1', 'Правильная, 19', 'Гороховая, 11', (NOW() - INTERVAL 1 HOUR), 'IN PROCESS');",

			'drivers.nor' => "SELECT Drivers.id, Drivers.name, Drivers.position
					FROM Drivers
					WHERE Drivers.id NOT IN (
						SELECT id_driver
						FROM Orders 
						GROUP BY id_driver)
					ORDER BY Drivers.id;",
			
			'address.nor'=> "SELECT Orders.address_from, Operators.name AS Operator, Orders.status
					FROM Orders 
					INNER JOIN Operators 
					ON Orders.id_operator = Operators.id 
					WHERE Orders.status <> 'DONE';",

			'drivers.num'=> "SELECT Drivers.id, Drivers.name, o.num
					FROM Drivers 
					LEFT JOIN (
						SELECT id_driver, status, COUNT(id) AS num
						FROM Orders 
						GROUP BY id_driver, status) o 
					ON Drivers.id = o.id_driver
					WHERE o.num > :orders AND o.status = 'DONE'
					ORDER BY num DESC;",		

			'drivers.all'=> "SELECT Drivers.id, Drivers.name, Drivers.position, o.num
					FROM Drivers
					LEFT JOIN (
						SELECT id_driver, COUNT(id) AS num
						FROM Orders 
						GROUP BY id_driver, status
						HAVING status = 'DONE') o 
					ON Drivers.id = o.id_driver
					ORDER BY num DESC;",

			'cars.numdr'=> "SELECT Cars.id, Cars.name, Cars.color, Cars.number, b.num_drivers
					FROM Cars
					INNER JOIN (
						SELECT a.id_car, COUNT(a.id_car) as num_drivers
						FROM (
							SELECT id_car, id_driver
							FROM Orders
							GROUP BY id_car, id_driver) a
						GROUP BY a.id_car) b
					ON Cars.id = b.id_car
					WHERE b.num_drivers > :from AND b.num_drivers < :to;",

			'employ'=> "SELECT * FROM Drivers
					UNION ALL
					SELECT * FROM Operators;");		
			
		public function __construct()
		{
			$dsn = "mysql:host=" . CNFG::$host . ";dbname=" . CNFG::$db . ";charset=" . CNFG::$charset;
			$opt = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			$this->pdo = new PDO($dsn, CNFG::$user, CNFG::$pass, $opt);
		}
		
		public function run($sql, $params = [])
		{
			$query = $this->pdo->prepare($sql);
			if (array_key_exists(0, $params))
			{
				$i = 1;
				foreach ($params as $value)
					$query->bindValue($i++, $value, $this->type($value));
			}
			else
			{
				foreach ($params as $key => $value)
					$query->bindValue($key, $value, $this->type($value));
			}
			$query->execute();
			return $query;
		}
 
		protected static function type($value)
		{
			if (is_int($value))
				$type = PDO::PARAM_INT;
			elseif (is_string($value) || is_float($value))
				$type = PDO::PARAM_STR;
			elseif (is_bool($value))
				$type = PDO::PARAM_BOOL;
			elseif (is_null($value))
				$type = PDO::PARAM_NULL;
			else
				$type = false;
			return $type;
		}		
	}
?>
