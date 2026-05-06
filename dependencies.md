# Project Dependency Map

This document outlines the CSS and PHP component dependencies for each module in the DriveHub application.

## Core Dependencies
All pages within the application depend on the following core components:

| Dependency Type | Path | Purpose |
| :--- | :--- | :--- |
| **Database** | `utils/db.php` | Connection to the `drivehub` database. |
| **Navigation** | `components/navbar.php` | Main site navigation bar. |
| **Base Styles** | `css/base.css` | Global styles, typography, and container layouts. |

---

## Module-Specific Dependencies

### 🛠️ Entry Modules (`add_*.php`)
These pages contain forms for data entry.

- **CSS Dependencies**: `css/base.css`, `css/forms.css`
- **Component Dependencies**: `components/navbar.php`, `utils/db.php`
- **Modules**:
  - `fleet/add_car.php`, `fleet/add_carcategory.php`
  - `people/add_customer.php`, `people/add_employee.php`, `people/add_user.php`
  - `transactions/add_reservation.php`, `transactions/add_rental.php`, `transactions/add_payment.php`
  - `management/add_maintenancerecord.php`, `management/add_insurance.php`, `management/add_review.php`

### 📊 View Modules (`display_*.php`)
These pages display data in tables.

- **CSS Dependencies**: `css/base.css`, `css/tables.css`
- **Component Dependencies**: `components/navbar.php`, `utils/db.php`
- **Modules**:
  - `fleet/display_car.php`, `fleet/display_carcategory.php`
  - `people/display_customer.php`, `people/display_employee.php`, `people/display_user.php`
  - `transactions/display_reservation.php`, `transactions/display_rental.php`, `transactions/display_payment.php`
  - `management/display_maintenancerecord.php`, `management/display_insurance.php`, `management/display_review.php`

### 🏠 System Pages
Pages with unique layouts and functional requirements.

| Page | CSS Dependencies | Component Dependencies |
| :--- | :--- | :--- |
| **`index.php`** | `base.css`, `hero.css` | `navbar.php` |
| **`dashboard.php`** | `base.css`, `dashboard.css` | `navbar.php` |
| **`login.php`** | `base.css`, `login.css` | `db.php` |
| **`edit_profile.php`** | `base.css`, `forms.css` | `navbar.php`, `db.php` |
