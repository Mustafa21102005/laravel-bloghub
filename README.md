# Laravel BlogHub 📝

A clean and elegant blog platform built with Laravel, featuring rich post management (create, edit, delete), AJAX-powered "Load More" pagination, visibility toggling for posts (active/inactive), and Bootstrap 5 styling. Designed to offer a smooth writing and reading experience.

---

## 🚀 Features

- 📝 Create, edit, and delete blog posts
- 📷 Image uploads with public storage handling
- 🔄 AJAX-based "Load More" button for seamless pagination
- 👻 Show/Hide inactive (soft-hidden) posts
- 📄 Blade templating with Bootstrap 5.3.3
- 🌐 Mobile-responsive design
- 📥 Session-based flash messages
- 🧩 Modular components and partial views

---

## 🛠️ Tech Stack

| Technology | Description |
|------------|-------------|
| Laravel    | Backend framework (v10+) |
| Blade      | Templating engine |
| Bootstrap  | Frontend styling (v5.3.3) |
| jQuery     | For AJAX requests |
| MySQL      | Relational database |
| CKEditor   | Optional rich-text editing |

---

## 🚀 Installation Guide

### 1. After Opening the project in Your Preferred Text Editor
   - Open the project folder in a text editor or IDE of your choice (e.g., VS Code, PhpStorm).

### 2. Rename `.env.example` to `.env`
   - In the project root, rename the `.env.example` file to `.env`.
   - Insert your **database connection information** and other environment-specific configurations in the `.env` file.

### 3. Install PHP Dependencies
   - Open your terminal and navigate to the project directory.
   - Run the following command to install PHP dependencies:
     ```
     composer install
     ```

### 4. Generate Application Key
   - Next, generate the application key by running:
     ```
     php artisan key:generate
     ```

### 5. Install Node.js Dependencies
   - Install Node.js dependencies by running the following command:
     ```
     npm install
     ```

### 6. Compile Frontend Assets
   - Compile and build the frontend assets by running:
     ```bash
     npm run dev
     ```

### 7. Run Database Migrations and Seeders
   - To set up the database schema and seed your database with initial data, run the following command:
     ```
     php artisan migrate --seed
     ```

### 8. Run the Project
   - Finally, you can start the development server by running:
     ```
     php artisan serve
     ```
   - Your application will be live at `http://127.0.0.1:8000`.

### 🎉 You're Ready to Go!
Now you can start using the project! 🎉

---

## 📧 Author

**Mustafa Azmi Khalil**

Full-stack developer passionate about building beautiful and user-friendly interfaces.  

📬 [Email Me](mailto:mustafa.azmi.khalil@gmail.com)

- 💻 [GitHub](https://github.com/Mustafa21102005)
- 📷 [Instagram](https://www.instagram.com/rexl.05)
- 💬 [WhatsApp](https://wa.me/966545117570)
- 👾 [Reddit](https://www.reddit.com/user/mustafa_azmi)

Feel free to star ⭐ this repo if you find it useful!
