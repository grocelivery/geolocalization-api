# Geolocalization API

Aplikacja umożliwia przeszukiwanie ogłoszeń na zadanym obszarze. Dzięki połączeniu z zewnętrznym serwisem, umożliwia geokodowanie czyli zamianę adresów na współrzędne geograficzne i odwrotnie (forward i reverse
geocoding). Pozwala na wyszukiwanie punktów charakterystycznym, takich jak pobliskie sklepy

### Instalacja na środowisku deweloperskim

Instalacja zależności composer:
```
composer install
```

Konfiguracja pliku .env
```
 cp .env.example .env
```

Uruchomienie kontenerów docker'owych
```
docker-compose up -d
```

Inicjacja indeksów mongoDB
```
docker container exec geolocalizer-php-fpm php artisan points:init
```

### Po skonfigurowaniu aplikacja powinna być dostępna na:

```
localhost:20003
```

### Aplikacja jest publicznie dostępna na:
http://api.grocelivery.eu/map
