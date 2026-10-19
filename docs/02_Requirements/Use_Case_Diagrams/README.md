# Use Case Diagrams
## Smart School Management System (Smart SMS)

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Date:** October 2026

---

## 1. Introduction
This document shows the main users (Actors) of the Smart SMS system and the actions they can perform (Use Cases).

---

## 2. Main Actors (Users)
- **Admin / Director:** Manages the entire system, views reports, and approves budgets.
- **Registrar:** Registers new students and manages student profiles.
- **Accountant:** Manages fee invoices, records payments, and tracks finances.
- **Teacher:** Enters grades, uploads assignments, and tracks student attendance.
- **Parent / Student:** Views grades, attendance, and pays school fees online.

---

## 3. Use Case Diagram (Visual Overview)

```mermaid
usecaseDiagram
    actor Admin as "Admin/Director"
    actor Registrar as "Registrar"
    actor Accountant as "Accountant"
    actor Teacher as "Teacher"
    actor Parent as "Parent/Student"

    package "Smart SMS System" {
        usecase UC1 as "Login / Authentication"
        usecase UC2 as "Manage Students (SIS)"
        usecase UC3 as "Manage Fees & Invoices"
        usecase UC4 as "Enter Grades (LMS)"
        usecase UC5 as "View Reports/Analytics"
        usecase UC6 as "View Child's Progress"
        usecase UC7 as "Pay Fees Online"
    }

    Admin --> UC1
    Admin --> UC5
    
    Registrar --> UC1
    Registrar --> UC2
    
    Accountant --> UC1
    Accountant --> UC3
    
    Teacher --> UC1
    Teacher --> UC4
    
    Parent --> UC1
    Parent --> UC6
    Parent --> UC7
    ---

## 4. Use Case Descriptions

### 4.1 Student Registration (UC2)
- **Actor:** Registrar
- **Description:** The Registrar enters a new student's details, uploads a photo, and adds guardian information. The system automatically generates a unique Student ID.
- **Precondition:** The Registrar must be logged into the system.
- **Postcondition:** The student's data is successfully saved in the database.

### 4.2 Fee Payment (UC3 & UC7)
- **Actor:** Accountant or Parent
- **Description:** A parent pays school fees via Telebirr. The Accountant records the payment in the system and generates a printable receipt.
- **Precondition:** A fee invoice must be generated for the student.
- **Postcondition:** The student's outstanding balance is reduced, and a receipt is issued.

### 4.3 Grade Entry (UC4)
- **Actor:** Teacher
- **Description:** The Teacher enters exam marks into the system. The system calculates the final grade and updates the report card so parents can view the results.
- **Precondition:** The exam period must be completed.
- **Postcondition:** Marks are saved in the database, and the report card is ready to be viewed.

---

## 5. Summary
This diagram clearly shows how many users the system supports and what each user is allowed to do. It ensures the development team builds the right features for the right people.