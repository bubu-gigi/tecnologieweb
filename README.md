## 🛠️ Tecnologie utilizzate

Questo progetto è stato sviluppato utilizzando le seguenti tecnologie:

- **HTML**, **CSS**, **JavaScript**
- **jQuery**
- **Laravel** (framework PHP)
- **MySQL** (database relazionale)
- **Docker** (per l'ambiente di sviluppo containerizzato)

---

### Installa le dipendenze 

```bash
composer install
```

### 🚀 Avvia il progetto con Docker

Assicurati di essere nella **root del progetto**, poi esegui:

```bash
docker-compose up -d
```

Per visionare **phpmyadmin** visita http://localhost:8888

### Inizializza il database con i seguenti comandi

Usa questo comando per creare le tabelle

```bash
php artisan migrate
```

Usa questo comando per popolare le tabelle

```bash
php artisan db:seed
```

### Server

Usa questo comando per lanciare il server laravel

```bash
php artisan serve
```

Quando siamo in fase di sviluppo visitare `http://127.0.0.1:8000` sul browser.

Usa questo comando per lanciare il server vite

```bash
npm run dev
```

Questo ci consentirà di agganciare tutti i file sulla cartella `resources` al nostro server laravel

### Vedere il diagramma ER del database

Per consultare il diagramma **Entity-Relationship (E-R)** del database, apri il seguente file: `/database/DiagrammaER.drawio.html`
