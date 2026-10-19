# UI Wireframes
## Smart School Management System (Smart SMS)

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Date:** October 2026

---

## 1. Introduction
This document provides basic layout sketches (wireframes) for the main pages of the Smart SMS system. It helps developers and stakeholders understand what the user interface will look like before coding begins.

---

## 2. Login Page (የመግቢያ ገጽ)

```text
+-------------------------------------------------------+
|                    [ SMART SMS LOGO ]                 |
|                                                       |
|                   Welcome Back!                       |
|                                                       |
|         Email:    [_________________________]         |
|         Password: [_________________________]         |
|                                                       |
|         [ Login Button ]                              |
|                                                       |
|         Forgot Password?                              |
+-------------------------------------------------------+
```

---

## 3. Admin Dashboard (የአስተዳዳሪ ዳሽቦርድ)

```text
+-------------------------------------------------------------+
|  [Logo] Smart SMS           [🔔 Notifications]  [Admin User]|
+-------------------------------------------------------------+
| Sidebar Menu   |  Dashboard Overview                         |
| - Dashboard    |  +-------------------+ +------------------+ |
| - Students     |  | Total Students:   | | Total Fees:      | |
| - Finance      |  | 1,250             | | 500,000 ETB      | |
| - Teachers     |  +-------------------+ +------------------+ |
| - Reports      |                                             |
|                |  Recent Activity (Chart)                    |
|                |  [=============================]            |
|                |                                             |
+-------------------------------------------------------------+
```

---

## 4. Student Registration Form (የተማሪ መመዝገቢያ ገጽ)

```text
+-------------------------------------------------------------+
|  < Back to Students          Add New Student                |
+-------------------------------------------------------------+
|  Student Photo:              Personal Info:                 |
|  [ Upload Image ]            First Name: [_____________]    |
|                              Last Name:  [_____________]    |
|                              Date of Birth: [ MM/DD/YYYY ]   |
|                              Gender: ( ) Male  ( ) Female   |
|                                                             |
|  Guardian Info:              Academic Info:                 |
|  Guardian Name: [_________]  Class: [ Grade 1  v ]          |
|  Phone Number:  [_________]                                 |
|                                                             |
|                                     [ Cancel ] [ Save ]     |
+-------------------------------------------------------------+
```

---

## 5. Student List View (የተማሪዎች ዝርዝር ገጽ)

```text
+-------------------------------------------------------------+
|  Students List                              [ + Add Student ]|
+-------------------------------------------------------------+
|  Search: [________________]         Filter by Class: [ All v]|
+-------------------------------------------------------------+
|  ID         | Name            | Class   | Phone     | Action |
|-------------|-----------------|---------|-----------|--------|
|  SMS-0001   | Abebe Kebede    | Grade 1 | 0911...   | [Edit] |
|  SMS-0002   | Sara Ahmed      | Grade 2 | 0922...   | [Edit] |
|  SMS-0003   | John Doe        | Grade 1 | 0933...   | [Edit] |
+-------------------------------------------------------------+
|  Showing 1-10 of 1,250 students          [ < 1 2 3 ... > ] |
+-------------------------------------------------------------+
```

---

## 6. Teacher Grade Entry (የአስተማሪ ውጤት ማስገቢያ ገጽ)

```text
+-------------------------------------------------------------+
|  Enter Grades - Grade 10 A - Mathematics - Midterm Exam     |
+-------------------------------------------------------------+
|  Student Name       | Score (out of 100) | Remark           |
|---------------------|--------------------|------------------|
|  Abebe Kebede       | [  85  ]           | Excellent        |
|  Sara Ahmed         | [  92  ]           | Excellent        |
|  John Doe           | [  45  ]           | Needs Improvement|
+-------------------------------------------------------------+
|                                       [ Cancel ] [ Submit ] |
+-------------------------------------------------------------+
```

---

## 7. Parent Portal - View Child's Grades (የወላጅ ገጽ)

```text
+-------------------------------------------------------------+
|  Welcome, Mr. Kebede                                        |
|  Child: Abebe Kebede (Grade 10 A)                           |
+-------------------------------------------------------------+
|  Subject            | Midterm | Final | Total | Rank       |
|---------------------|---------|-------|-------|------------|
|  Mathematics        |   85    |  90   |  88   | 2nd        |
|  English            |   78    |  82   |  80   | 5th        |
|  Physics            |   90    |  95   |  93   | 1st        |
+-------------------------------------------------------------+
|  Overall Average: 87%                                       |
|  [ Download Report Card PDF ]                               |
+-------------------------------------------------------------+
```

---

## 8. Summary
These wireframes provide a clear visual guide for the frontend developers using Vue.js and Tailwind CSS. They ensure the layout is clean, responsive, and user-friendly for all actors (Admin, Registrar, Teacher, Parent).