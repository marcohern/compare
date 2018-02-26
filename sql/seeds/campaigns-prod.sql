
INSERT INTO campaigns(id, store_id, name, code, category, url, urltpl, executor, created, updated) VALUES
-- KTRONIX
(1, 1, 'K-Tronix Videojuegos PS4', 'KTR-PS4-GAMES', 'PS4-GAMES'
	, 'http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4'
	, 'http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4?p=[p1]'
	, 'KtronixVgPs4Executor', NOW(), NULL),

-- ALKOSTO
(2, 2, 'Alkosto Videojuegos PS4', 'ALK-PS4-GAMES', 'PS4-GAMES'
	, 'http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4'
	, 'http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4?p=[p1]'
	, 'AlkostoVgPs4Executor', NOW(), NULL),

-- ALKOMPRAR
(3, 3, 'Alkosto Videojuegos PS4', 'AKO-PS4-GAMES', 'PS4-GAMES'
	, 'http://www.alkomprar.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4'
	, 'http://www.alkomprar.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4?p=[p1]'
	, 'AlkomprarVgPs4Executor', NOW(), NULL),

-- FALABELLA
(4, 4, 'Falabella Videojuegos PS4', 'FLB-PS4-GAMES', 'PS4-GAMES'
	, 'https://www.falabella.com.co/falabella-co/category/cat3020960/PS4'
	, 'https://www.falabella.com.co/rest/model/falabella/rest/browse/BrowseActor/get-product-record-list?[json]'
	, 'FalabellaVgPs4Executor', NOW(), NULL);

