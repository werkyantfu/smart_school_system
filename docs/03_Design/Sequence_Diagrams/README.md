# Sequence Diagrams
## Smart School Management System (Smart SMS)

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Date:** October 2026

---

## 1. Introduction
This document shows the step-by-step flow of data between the User (Browser), the Frontend (Vue.js), the Backend (Laravel API), and the Database (MySQL). It helps developers understand exactly how the system works behind the scenes.

---

## 2. Sequence Diagram 1: User Login

This diagram shows the process when a user (like a Teacher or Registrar) logs into the system.

```mermaid
sequenceDiagram
    autonumber
    actor User as User (Browser)
    participant Vue as Vue.js (Frontend)
    participant API as Laravel (Backend API)
    participant DB as MySQL (Database)

    User->>Vue: Enter Email and Password
    Vue->>API: POST /api/login (JSON Data)
    API->>DB: Find user by email
    DB-->>API: Return user data
    API->>API: Verify Password (Hash Check)
    
    alt Password is Correct
        API-->>Vue: 200 OK + Login Token
        Vue->>Vue: Save Token
        Vue-->>User: Redirect to Dashboard
    else Password is Wrong
        API-->>Vue: 401 Unauthorized
        Vue-->>User: Show "Invalid Email or Password"
    end
    3. Sequence Diagram 2: Student Registration
This diagram shows the process when a Registrar adds a new student to the system.



    4. Sequence Diagram 3: Fee Payment

This diagram shows the process when an Accountant records a student's fee payment.

sequenceDiagram
    autonumber
    actor Accountant as Accountant
    participant Vue as Vue.js
    participant API as Laravel API
    participant DB as MySQL

    Accountant->>Vue: Enter Payment Details (Amount, Method)
    Vue->>API: POST /api/payments
    API->>DB: INSERT INTO payments (...)
    DB-->>API: Payment recorded
    
    API->>DB: UPDATE invoice status to 'paid'
    DB-->>API: Invoice updated
    
    API->>API: Generate Receipt PDF
    API-->>Vue: 200 OK + Receipt URL
    Vue-->>Accountant: Show "Payment Successful! Download Receipt."

    5. Summary
These diagrams show how the system connects the user, the frontend, the backend, and the database. This helps developers build the code correctly without mistakes.

