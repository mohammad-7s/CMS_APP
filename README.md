# CMS_APP

A simple Content Management System built with **Laravel 12** and **Tailwind CSS**.  
It supports managing articles, categories, comments, and contact messages, with a WYSIWYG editor (TinyMCE) and image uploads.

---

## 🔎 Overview

Main features:

- **Articles CRUD:** create, read, update, and delete articles (with image upload + WYSIWYG editor)  
- **Categories management:** many-to-many relationship between articles and categories  
- **Publish/unpublish articles**  
- **Comments management:** add, approve, delete comments + ability to disable comments for a specific article  
- **Contact form:** save contact messages in the database and display them in the admin panel  
- **Simple role system:** `admin`, `editor`, `user`  
- **Admin dashboard:** protected by middleware

---

## 📋 Requirements

- PHP >= 8.1  
- Composer  
- MySQL / MariaDB  
- Node.js & npm  
- XAMPP / Laragon / any environment that supports Apache + MySQL  
- (Optional) TinyMCE Cloud API key or self-hosted TinyMCE

---

## ⚙️ Local setup (step by step)

1. **Clone the repository:**
   ```bash
   git clone https://github.com/mohammad-7s/CMS_APP.git
   cd CMS_APP
