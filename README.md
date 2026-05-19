# 🚗 DriveHub Project | Team Submission Guide

This project is a collaborative effort where each team member is assigned a specific table from the database schema to implement. This guide ensures that all contributions are consistent and easy to merge.

## 📋 Member Responsibilities
Each member is assigned **one table** and must provide the following:
1.  **SQL Script**: Table creation (`CREATE TABLE`) and at least 5 sample records (`INSERT INTO`).
2.  **Add Page**: A form to input data into your assigned table.
3.  **Display Page**: A table view to see all records from your assigned table.

---

## 📂 Required Folder Structure
To maintain organization, please place your files in the following directory structure:

```text
drivehub/
├── components/          # Shared components (e.g., navbar.php)
├── css/                 # Stylesheets (e.g., forms.css, tables.css)
├── pages/               # Main pages categorical folders
│   ├── fleet/           # Car, Category pages
│   ├── people/          # Customer, Employee, User pages
│   ├── transactions/    # Reservation, Rental, Payment pages
│   └── management/      # Maintenance, Insurance, Review pages
├── utils/               # Shared logic (e.g., db.php)
└── drivehub.sql         # Consolidated SQL file (update this with your table)
```

---

## 📦 Submission Checklist (ZIP Requirements)
When submitting your work, please include the following files in your ZIP:

### 1. Assigned Table Files
- `pages/[category]/add_[table].php`
- `pages/[category]/display_[table].php`

### 2. Core System Files (Updates Only)
If you made changes to these shared files to integrate your table, include them:
- `index.php`
- `pages/dashboard.php`
- `pages/login.php`
- `pages/logout.php`
- `pages/edit_profile.php`

### 3. Shared Resources
- `components/` (all files)
- `css/` (all files)
- `utils/` (all files)

### 4. Database
- `drivehub.sql` (Include your table structure and sample data)

---

## 🛠️ Mandatory Technical Rules
Please follow these coding standards to ensure security and consistency:

1.  **Prepared Statements**: Always use `mysqli::prepare()` and `bind_param()` for all SQL queries.
2.  **Server-Side Redirects**: Use `header("Location: ...")` for navigation. **Do not** use `window.location.href` in JavaScript.
3.  **External Styling**: Do not use inline CSS. Put all styles in the appropriate file within the `css/` folder.
4.  **Relative Paths**:
    - If your page is in a subfolder (e.g., `pages/fleet/`), use `../../` to access `utils/` or `css/`.
    - Example: `include('../../utils/db.php');`
 

---

## 🚦 Verification Before Pushing
- [ ] Run `php -l [filename]` on your files to check for syntax errors.
- [ ] Ensure your `db.php` uses `localhost` or `127.0.0.1` as the host.
- [ ] Test the "Add" and "Display" flow for your table.
