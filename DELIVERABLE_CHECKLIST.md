# DELIVERABLE_CHECKLIST

This document lists all implemented features and checks required before delivering the project.

---

## 1. Project Setup & Environment

- [x] Laravel project boots successfully
- [x] `.env.example` exists and documented in README
- [x] Application key generated (`php artisan key:generate`)
- [x] Database connection configured and tested
- [x] All migrations run successfully (`php artisan migrate`)
- [x] Seeders execute without errors (`php artisan db:seed`)
- [x] Storage symlink created (`php artisan storage:link`)

---

## 2. Authentication & Authorization

- [x] Laravel authentication implemented
- [x] Admin login works correctly
- [x] Routes protected via middleware
- [x] Role-based access implemented:
  - [x] `admin` – full access
  - [x] `editor` – manage articles only
  - [x] `user` – public access only
- [x] Non-admin users cannot access admin dashboard

---

## 3. Articles Management

- [x] Create article
- [x] Edit article
- [x] Delete article
- [x] Image upload supported
- [x] Old image replaced on update
- [x] Articles linked to categories (Many-to-Many)
- [x] Publish / Unpublish functionality
- [x] Search by title
- [x] Filter by category
- [x] Pagination implemented
- [x] Article slug auto-generated
- [x] Article author assigned automatically

---

## 4. WYSIWYG Editor (TinyMCE)

- [x] TinyMCE integrated
- [x] Content saved correctly in database
- [x] Old content restored on validation errors
- [x] Editor works for Create and Edit forms
- [x] No blocking warnings during typing
- [x] HTMLPurifier
- [x] Configuration isolated in reusable component

---

## 5. Categories Management

- [x] Create category
- [x] Edit category
- [x] Delete category
- [x] Assign categories to articles
- [x] Filter articles by category
- [x] Category relationships defined using Eloquent

---

## 6. Comments Management

- [x] Users can add comments on articles
- [x] Comments stored in database
- [x] Admin can view all comments
- [x] Admin can approve comments
- [x] Admin can delete comments
- [x] Approved comments only shown publicly
- [x] Comments can be disabled per article

---

## 7. Contact Messages

- [x] Contact form implemented
- [x] Messages stored in database
- [x] Admin can view contact messages
- [x] Messages can be marked as "Reviewed"
- [x] Proper validation applied

---

## 8. Front-End Features

- [x] Home page displays latest articles
- [x] Search functionality works
- [x] Category filtering works
- [x] Pagination on articles listing
- [x] Article detail page shows:
  - [x] Title
  - [x] Image
  - [x] Content
  - [x] Author
  - [x] Date
- [x] Related articles displayed
- [x] Responsive layout (Tailwind CSS)

---

## 9. Admin Panel UI/UX

- [x] Organized dashboard layout
- [x] Clear navigation menu
- [x] Separate admin views
- [x] Validation errors displayed clearly
- [x] Flash success/error messages
- [x] Consistent design across admin pages

---

## 10. Validation & Security

- [x] Server-side validation for all forms
- [x] Image upload validation (type + size)
- [x] CSRF protection enabled
- [x] Unauthorized access prevented
- [x] Mass assignment protected via `$fillable`

---

## 11. Code Quality & Structure

- [x] Controllers separated by responsibility (Admin / Frontend)
- [x] Models use Eloquent relationships
- [x] Clean naming conventions
- [x] No duplicated logic
- [x] Views structured and reusable
- [x] Business logic not mixed with views

---

## 12. Documentation & Submission

- [x] README.md included
- [x] Setup instructions documented
- [x] Test credentials provided
- [x] Migrations included
- [x] Seeders included
- [x] GitHub repository clean and organized

---

## 13. Final Manual Checks (Before Delivery)

- [ ] Run `php artisan migrate --seed` on a fresh database
- [ ] Login as admin and test all CRUD operations
- [ ] Login as editor and verify restricted access
- [ ] Upload image and verify storage path
- [ ] Add comment and approve it
- [ ] Submit contact form and mark message as reviewed
- [ ] Check console for JS errors
- [ ] Ensure no `dd()` or debug code remains

---

## 14. Submission Information

- Repository: https://github.com/mohammad-7s/CMS_APP
- Framework: Laravel 12
- Styling: Tailwind CSS
- Editor: TinyMCE
- Database: MySQL

---

## 15. Notes for Reviewers

This project was developed as a technical assessment to demonstrate:
- Clean Laravel architecture
- CRUD completeness
- Validation and security awareness
- Practical admin dashboard implementation
- Frontend-backend integration

Thank you for reviewing this submission.
