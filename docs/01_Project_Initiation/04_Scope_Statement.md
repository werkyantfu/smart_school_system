# Scope Statement
## Smart School Management System (Smart SMS)

**Project Name:** Smart SMS
**Date:** October 2026

---

## 1. Project Scope (In-Scope)
The following features and modules are **included** in the current development lifecycle (Phase 1 to Phase 5):

### 1.1 Student Information System (SIS)
- Registration for KG to Grade 12.
- Student profile management (photos, DOB, guardian info).
- Auto-generation of unique student IDs.
- Bulk promotion of students.

### 1.2 Finance Module
- Setup of fee structures per grade.
- Invoice generation per term.
- Payment recording (Cash, Bank, Telebirr, CBE Birr).
- Financial reporting (daily revenue, outstanding balances).

### 1.3 Learning Management System (LMS)
- Teacher grade entry.
- PDF Report Card generation.
- Assignment uploads.

### 1.4 Communication
- SMS alerts for fee reminders and absences.
- Email notifications.

### 1.5 Core Operations
- Inventory tracking (basic).
- Transport route management.
- Admin Dashboard with real-time analytics.

---

## 2. Out of Scope (What will NOT be built)
To prevent project delays and budget overruns, the following are **excluded** from the current version:

1. **School Public Website:** The system is for internal management only; a separate marketing website is not included.
2. **Advanced Library Management:** Tracking individual book borrowing dates and fines is out of scope for now (only basic inventory is included).
3. **Native Mobile Apps (iOS/Android):** The system will be a responsive web app that works on mobile browsers, but not a downloadable app from the App Store.
4. **Biometric Attendance (Fingerprint/Face ID):** Attendance will be managed manually by teachers via the web interface.
5. **Custom SMS Gateway Setup:** We will integrate with an existing provider (e.g., Ethio Telecom) but will not build a custom telecom infrastructure.

---

## 3. Assumptions
- The school has a stable internet connection to access the web application.
- The school will provide the initial data (student lists, staff lists) via Excel for migration.
- Parents have access to mobile phones for SMS and portal login.

---

## 4. Deliverables
By the end of the project, the following will be handed over:
1. Fully functional Web Application (Source Code).
2. MySQL Database backup file.
3. User Manuals (Admin, Teacher, Parent).
4. Deployment Guide.
5. 3 Days of Staff Training.