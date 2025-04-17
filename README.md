## 🛠️ Tecnologie utilizzate

Questo progetto è stato sviluppato utilizzando le seguenti tecnologie:

- **HTML**, **CSS**, **JavaScript**
- **jQuery**
- **Laravel** (framework PHP)
- **MySQL** (database relazionale)
- **Docker** (per l'ambiente di sviluppo containerizzato)

---

### 🚀 Avvia il progetto con Docker

Assicurati di essere nella **root del progetto**, poi esegui:

```bash
docker-compose up -d
```

Per visionare **phpmyadmin** visita http://localhost:8888

### Inizializza il database con i seguenti comandi

Usa questo per creare le tabelle

```bash
php artisan migrate
```

Usa questo per popolare le tabelle

```bash
php artisan db:seed
```

### Vedere il diagramma ER del database

Per consultare il diagramma **Entity-Relationship (E-R)** del database, apri il seguente file: `/database/TecWeb.drawio.html`
