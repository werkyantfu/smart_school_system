# Entity-Relationship (ER) Diagram
## Smart SMS Database Design

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Date:** October 2026

---

## 1. Database Overview
This document shows the main tables in the Smart SMS database and how they connect to each other.

## 2. ER Diagram

```mermaid
erDiagram
    USERS ||--o{ STUDENTS : "manages (Parent/Student)"
    USERS ||--o{ TEACHERS : "is a"
    
    CLASSES ||--o{ STUDENTS : "enrolls"
    CLASSES ||--o{ SUBJECTS : "has"
    
    STUDENTS ||--o{ INVOICES : "receives"
    STUDENTS ||--o{ MARKS : "earns"
    STUDENTS ||--o{ ATTENDANCE : "has"
    
    INVOICES ||--o{ PAYMENTS : "is paid via"
    
    TEACHERS ||--o{ SUBJECTS : "teaches"
    SUBJECTS ||--o{ MARKS : "contains"

    USERS {
        bigint id PK
        string name
        string email
        string password
        enum role "admin, teacher, parent, student"
    }

    STUDENTS {
        bigint id PK
        bigint user_id FK
        string student_id_number "e.g., SMS-2026-0001"
        string first_name
        string last_name
        date dob
        enum gender "M, F"
        int class_id FK
        string guardian_phone
        enum status "active, graduated, transferred"
    }

    CLASSES {
        int id PK
        string name "e.g., Grade 1, KG"
        int level
    }

    INVOICES {
        bigint id PK
        bigint student_id FK
        decimal total_amount
        date due_date
        enum status "paid, unpaid, partial"
    }

    PAYMENTS {
        bigint id PK
        bigint invoice_id FK
        decimal amount
        enum method "cash, bank, telebirr"
        date payment_date
        string receipt_number
    }

    MARKS {
        bigint id PK
        bigint student_id FK
        int subject_id FK
        decimal score
        string exam_type "quiz, midterm, final"
    }

## 3. Table Descriptions
- **USERS:** Stores login details for Admins, Teachers, and Parents.
- **STUDENTS:** Stores student information. Linked to USERS.
- **CLASSES:** List of classes (KG, Grade 1, ... Grade 12).
- **INVOICES:** Fee bills generated for students.
- **PAYMENTS:** Records of payments made by students.
- **MARKS:** Exam scores for students.