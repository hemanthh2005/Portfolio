# Portfolio — Hemanth Kumar H Y

**Live demo (frontend):** https://hemanthh2005.github.io/Portfolio/

> This repository contains a static frontend (hosted on GitHub Pages) and a small PHP + MySQL backend provided **for local evaluation only** (GitHub Pages cannot run PHP).  
> The frontend demonstrates HTML/CSS/JS and XML+XSLT. The `php/` and `sql/` folders let your teacher test backend functionality locally.

---

## Repo structure
/ (root)
├─ index.html
├─ css/
├─ js/
├─ xml/
├─ images/
├─ php/
│ ├─ db_connect.php
│ ├─ save_message.php
│ └─ view_messages.php
├─ sql/
│ └─ schema.sql
└─ README.md

markdown
Copy code

---

## What to check (grading checklist)
- Frontend: profile, skills, projects (XML+XSLT), resume download, contact UI.
- Backend (local): import `sql/schema.sql`, run `php/save_message.php` to store messages, verify with `php/view_messages.php`.
- GitHub: public repo, commits with clear messages, README explaining how to run backend.

---

## How to run the backend locally (step-by-step for teacher)

### 1. Install XAMPP / MAMP / LAMP
- Windows: XAMPP (https://www.apachefriends.org)  
- macOS: MAMP or XAMPP  
- Linux: LAMP stack (apache2 + mysql + php)

### 2. Start services
- Open XAMPP/MAMP control panel → Start **Apache** and **MySQL**.

### 3. Copy project to web root
- Windows (XAMPP): copy repository folder to `C:\xampp\htdocs\Portfolio\`  
- macOS (MAMP): copy to `/Applications/MAMP/htdocs/Portfolio/`  
- Linux (/var/www/html/Portfolio) (ensure correct permissions)

### 4. Import database
- Open `http://localhost/phpmyadmin/`  
- Create or select a database user if required (XAMPP default user: `root`, password empty)  
- Click **Import** → Choose `sql/schema.sql` → Run

### 5. Configure DB credentials (if needed)
- Edit `php/db_connect.php` and update `$user` / `$pass` if your local MySQL credentials differ.

### 6. Open site locally and test
- Open `http://localhost/Portfolio/index.html` (or corresponding path)
- Go to Contact → fill and submit the form (the form action should be `php/save_message.php` for local testing)
- Check success/failure (the `save_message.php` returns JSON). If using normal form submit, you may see raw JSON response.

### 7. View saved messages
- Open `http://localhost/Portfolio/php/view_messages.php` to view messages saved in the database.

---

## Quick troubleshooting
- **Blank page / PHP code shown** → You are opening file directly in browser (file://). Serve the site through Apache (`http://localhost/...`) so PHP runs.
- **DB connection error** → Check `php/db_connect.php` credentials and that MySQL is running.
- **Form does nothing on GitHub Pages** → GitHub Pages is static and can't run PHP. Use Formspree or run backend locally as above.

---

## Security & notes (for graders)
- `view_messages.php` is an unauthenticated viewer for ease of local evaluation only. **Do not deploy it to a public server** without adding authentication.
- `db_connect.php` uses local credentials and should never be committed with real production passwords.
- The PHP code uses prepared statements for inserts to prevent SQL injection.

---

## Optional additions I can provide
- `db_config.sample.php` (example config file)
- Password-protected `view_messages.php` (HTTP Basic Auth)
- A small script to seed example messages into the DB
- Instructions to test backend using `curl` or Postman

---

If you want, I can now:
- Generate a ZIP containing `php/` and `sql/` ready to upload, **or**
- Produce `db_config.sample.php` and a password-protected `view_messages.php`, **or**
- Give exact `git` commands to add these files to your GitHub repo.
