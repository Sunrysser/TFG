# 🍽️ Restaurant Web App — Full-Stack Project (TFG DAW)

**Author:** Ahmed Mohamed Ahmed  
**Email:** [web.ahmed.m@gmail.com](mailto:web.ahmed.m@gmail.com)  
**GitHub:** [Sunrysser](https://github.com/Sunrysser)  
**Technologies:** PHP • MySQL • JavaScript • AJAX • HTML5 • CSS3 • MVC Architecture  

---

## 📖 Overview

This project is a **full-stack web application for restaurants**, created as my **final project (TFG)** for the *Grado Superior en Desarrollo de Aplicaciones Web (DAW)*.

The goal was to build a **generic, reusable restaurant platform** that allows customers to:
- Browse menus and information  
- Place delivery orders  
- Make table reservations online  
and gives restaurant administrators tools to manage products, orders, and clients efficiently.

The project is designed to be **easily adaptable** for different restaurants, focusing on **usability, responsiveness, and performance**.

---

## 🚀 Features

### 👨‍🍳 User Side
- View restaurant info, menu, and images  
- Place orders (choose delivery & payment method)  
- Make reservations (date, time, customer details)  
- Track order or reservation status in real time  
- Responsive design (mobile & desktop)

### 🧑‍💼 Admin Side
- Add, edit, delete, or view menu items  
- Manage order and reservation status  
- View client histories and order logs  
- Real-time data updates via AJAX requests  

---

## 🧠 Technical Highlights
- **MVC Architecture** — separation of concerns for maintainable structure  
- **PHP OOP** — modular and scalable backend  
- **AJAX + JavaScript** — dynamic front-end interaction  
- **SQL Database** — fully normalized to 3rd normal form  
- **Form validation** using Regular Expressions and DOM manipulation  
- **Responsive UI** with “Hero Image” and “Split-Screen” layouts  

---

## 🗄️ Database Design

The database schema includes entities for:
- Users  
- Products  
- Orders  
- Reservations  

It ensures referential integrity and optimized queries using JOINs and sub-queries.

**Example query:**
```sql
SELECT u.nombre, u.tlf, u.direccion, p.estado, p.fechaYHora
FROM usuario u
JOIN pedido p ON u.id = p.idU
WHERE p.id = $idPed;
```

---

## 🧰 Tools & Stack

| Layer | Technologies |
|-------|---------------|
| Frontend | HTML5, CSS3 (Flexbox), JavaScript |
| Backend | PHP 8, MySQL, Apache |
| Libraries | AJAX, Composer |
| Version Control | Git & GitHub |
| Deployment | Localhost (XAMPP) or online Apache host |

---

## 🎨 UI Design

The design follows modern patterns such as **Hero Image Layout** and **Split Screen Design**.  
Different color palettes are used for user and admin sections to clearly separate roles.  
All interfaces are responsive, adapting to mobile and desktop screens.

**Admin Section:**  
- Light background, sidebar navigation, list-based data views.  

**User Section:**  
- Dark theme with large hero image and dynamic layout.  

---

## ⚙️ Implementation Notes
- Full CRUD operations (Create, Read, Update, Delete)  
- Event listeners for interactive UI  
- AJAX requests for dynamic data loading  
- Session and Cookie management for user state  
- Exception handling with `try...catch`  
- JSON usage (Composer dependencies)

---

## 🔮 Future Updates
- Custom order personalization options  
- Live chat between client and restaurant  
- Multi-restaurant version  
- Enhanced analytics dashboard for admins  

---

## 🧑‍💻 How to Run Locally
1. Clone the repository  
   ```bash
   git clone https://github.com/Sunrysser/TFG.git
   ```
2. Copy the project to your Apache `htdocs` directory.  
3. Import the SQL database file into MySQL.  
4. Update the database connection in the PHP config file.  
5. Open in your browser:  
   ```
   http://localhost/TFG/
   ```

---

## 🌐 Deployment
You can deploy the app on any PHP-compatible hosting service such as:  
- [InfinityFree](https://infinityfree.net)  
- [000WebHost](https://www.000webhost.com)  
- [AwardSpace](https://www.awardspace.com)

➡️ **Live Demo:** (coming soon)

---

## 📸 Screenshots

---

## 👏 Credits
Developed by **Ahmed Mohamed Ahmed** as part of the  
**Grado Superior en Desarrollo de Aplicaciones Web (DAW)**  
https://drive.google.com/file/d/1-k0c2oJKPvDVTqG0CT8BESlOzKx99hHc/view?usp=sharing
Ceuta, Spain — 2022  

---
