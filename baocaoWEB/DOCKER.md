# Docker setup

1. Copy Docker env:

```powershell
Copy-Item .env.docker.example .env
```

2. Start containers:

```powershell
docker compose up --build -d
```

3. Install app state:

```powershell
docker compose exec app php artisan migrate
```

4. Open app:

```text
http://127.0.0.1:8000
```

5. Vite dev server:

```text
http://127.0.0.1:5173
```

Useful commands:

```powershell
docker compose logs -f
docker compose exec app php artisan test
docker compose down
```
