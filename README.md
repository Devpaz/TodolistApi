# Instalación de Proyecto Laravel 11 con Docker

## Requisitos

- **Docker**: Instala desde [aquí](https://www.docker.com/get-started).
- **Docker Compose**: Instálalo desde [aquí](https://docs.docker.com/compose/install/).

## Pasos de Instalación

1. **Clona el repositorio**

    ```bash
    git clone git@github.com:Devpaz/TodolistApi.git
    cd <TodolistApi>
    ```

2. **Construir y levantar contenedores**

    ```bash
    docker-compose up --build -d
    ```


3. **Instalar dependencias de Laravel**

    ```bash
    composer install
    ```

4. **Configurar el archivo `.env`**

    ```bash
    cp .env.example .env
    ```

5. **Generar la clave de la aplicación**

    ```bash
    php artisan key:generate
    ```

6. **Ejecutar migraciones** 

    ```bash
    php artisan migrate
    ```
7. **Ejecutar migraciones** 

    ```bash
    php artisan migrate db:seed
    ```

8. **Acceder al proyecto**

    Abre [http://localhost](http://localhost) en tu navegador.

## Comandos Útiles

- **Ver logs**

    ```bash
    docker-compose logs -f
    ```

- **Detener contenedores**

    ```bash
    docker-compose down
    ```

- **Reiniciar contenedores**

    ```bash
    docker-compose restart
    ```

¡Listo! Ahora puedes empezar a trabajar en tu proyecto Laravel con Docker.
