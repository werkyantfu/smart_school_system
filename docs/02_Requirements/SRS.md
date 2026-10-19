# Software Requirements Specification (SRS)
## Smart School Management System (KG – Grade 12)

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Version:** 1.0
**Date:** October 2026

---

## 1. Introduction

### 1.1 Purpose
This SRS defines the functional and non-functional requirements for the Smart School Management System. It serves as a contract between the stakeholders (school administration) and the development team, ensuring that the final product meets the business needs of the school.

### 1.2 Scope
The software will manage all administrative and academic operations for a private school from Kindergarten (KG) to Grade 12. It will replace manual, paper-based systems with a centralized digital platform.

### 1.3 User Classes & Characteristics
- **Admin / Director:** Full access. Views analytics, financial reports, and manages staff.
- **Registrar:** Manages student admissions, profiles, and class assignments.
- **Accountant:** Manages fee structures, generates invoices, and records payments.
- **Teacher:** Enters grades, manages assignments, and tracks attendance.
- **Parent:** Views their child's grades, attendance, and fee status.
- **Student:** Views schedules, assignments, and personal grades.

---

## 2. Functional Requirements

### 2.1 Student Information System (SIS)
- **FR-SIS-01:** The system shall allow the Registrar to register new students (KG–Grade 12) with a unique ID, photo, and guardian details.
- **FR-SIS-02:** The system shall auto-generate a unique Student ID (e.g., `SMS-2026-0001`).
- **FR-SIS-03:** The system shall allow bulk promotion of students from one grade to the next at the end of the academic year.
- **FR-SIS-04:** The system shall maintain a complete academic history for each student.
- **FR-SIS-05:** The system shall allow the Registrar to mark a Grade 12 student as "Graduated".

### 2.2 Finance & Fee Management
- **FR-FIN-01:** The Accountant shall be able to define fee structures per grade (e.g., Tuition, Transport, Lab).
- **FR-FIN-02:** The system shall automatically generate invoices per term/semester.
- **FR-FIN-03:** The system shall allow recording payments via Cash, Bank Transfer, CBE Birr, and Telebirr.
- **FR-FIN-04:** The system shall automatically update the student's balance after a payment is recorded.
- **FR-FIN-05:** The system shall generate printable PDF receipts for every payment.

### 2.3 Learning Management System (LMS)
- **FR-LMS-01:** Teachers shall be able to input marks for quizzes, assignments, and final exams.
- **FR-LMS-02:** The system shall automatically calculate the final grade and class rank.
- **FR-LMS-03:** The system shall generate student report cards in PDF format.
- **FR-LMS-04:** Teachers shall be able to upload learning materials (PDFs, videos) for students to download.

### 2.4 HR & Payroll
- **FR-HR-01:** The system shall store staff profiles, including qualifications and contracts.
- **FR-HR-02:** The system shall calculate monthly payroll, including Ethiopian income tax and pension deductions.
- **FR-HR-03:** The system shall generate printable payslips for staff.

### 2.5 Communication
- **FR-COM-01:** The system shall send automated SMS/Email alerts to parents for fee reminders and student absences.
- **FR-COM-02:** The Admin shall be able to post announcements visible to all parents and teachers on their dashboards.

---

## 3. Non-Functional Requirements

- **NFR-PERF-01 (Performance):** The system shall load pages in less than 2 seconds on a standard internet connection.
- **NFR-SEC-01 (Security):** All passwords must be hashed using bcrypt. The system must enforce role-based access control (RBAC) so parents cannot access admin panels.
- **NFR-SCALE-01 (Scalability):** The system must support up to 3,000 students and 200 staff members without performance degradation.
- **NFR-UX-01 (Usability):** The User Interface must be responsive (mobile-friendly) and available in both English and Amharic.
- **NFR-REL-01 (Reliability):** The system shall have an uptime of 99% during school working days.
- **NFR-BACKUP-01 (Backup):** The system shall automatically back up the MySQL database daily at midnight.

---

## 4. System Constraints

- The backend must be built with **Laravel 13 (PHP 8.5)**.
- The frontend must be built with **Vue.js 3 (Composition API)**.
- The database must be **MySQL 8.4**.
- The system must be compatible with modern browsers (Chrome, Firefox, Edge).

---

## 5. Approval

**Prepared By:** Werkyantfu
**Signature:** ___________________
**Date:** October 2026