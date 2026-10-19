# User Stories
## Smart School Management System (Smart SMS)

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Version:** 1.0
**Date:** October 2026

---

**(Format):** 
*As a* [ተጠቃሚ], *I want to* [ተግባር], *so that* [ጥቅም].



## 1. Student Information System (SIS)

**US-01: Register New Student (አዲስ ተማሪ መመዝገብ)**
- **As a** Registrar (ሬጅስትራር)
- **I want to** register a new KG or Grade student with their photo and guardian details.
- **So that** their profile is officially stored in the system.
- **Acceptance Criteria:** Form validates inputs, auto-generates a unique Student ID.

**US-02: Promote Students (ተማሪዎችን ማሳደግ)**
- **As a** Registrar
- **I want to** bulk-promote all Grade 1 students to Grade 2 at the end of the year.
- **So that** I don't have to edit each student's record manually.
- **Acceptance Criteria:** Select class → Click "Promote" → System updates all students to next grade.

---

## 2. Finance & Fee Management

**US-03: Create Invoice (ደረሰኝ መፍጠር)**
- **As an** Accountant (አካውንታንት)
- **I want to** generate a fee invoice for a specific student or class.
- **So that** parents know how much they need to pay for the term.
- **Acceptance Criteria:** Select student → Select term → Generate PDF Invoice.

**US-04: Record Payment (ክፍያ መመዝገብ)**
- **As an** Accountant
- **I want to** record a payment made via Cash, Bank, or Telebirr.
- **So that** the student's outstanding balance updates automatically.
- **Acceptance Criteria:** Enter amount → Save → Balance is reduced → Receipt generated.

---

## 3. Learning Management System (LMS)

**US-05: Enter Grades (ውጤት ማስገባት)**
- **As a** Teacher (አስተማሪ)
- **I want to** input marks for my subject for a specific exam.
- **So that** report cards can be generated for the students.
- **Acceptance Criteria:** Select Class → Select Subject → Enter marks for all students → Save.

**US-06: Upload Materials (ትምህርት ማስቀመጥ)**
- **As a** Teacher
- **I want to** upload PDF notes and assignments.
- **So that** students can download them from their portal.
- **Acceptance Criteria:** Upload file → File appears in the student's dashboard.

---

## 4. Parent & Student Portal

**US-07: View Report Card (የውጤት ካርድ ማየት)**
- **As a** Parent (ወላጅ)
- **I want to** view my child's report card online.
- **So that** I don't need to physically visit the school to get results.
- **Acceptance Criteria:** Parent logs in → Clicks on child's name → Views/Downloads PDF Report Card.

**US-08: Check Attendance (የክፍል መገኘት ማየት)**
- **As a** Parent
- **I want to** see if my child was marked absent today.
- **So that** I can follow up on their whereabouts.
- **Acceptance Criteria:** Dashboard shows daily attendance status.

---

## 5. HR & Payroll

**US-09: Process Payroll (ደመወዝ ማውጣት)**
- **As an** HR Manager (የሰው ኃይል ኃላፊ)
- **I want to** generate monthly payslips for teachers.
- **So that** salaries are calculated accurately with tax deductions.
- **Acceptance Criteria:** Select Month → Generate Payroll → Download Payslip PDF.

---

## 6. Communication

**US-10: Send Fee Reminder (የክፍያ ማሳሰቢያ መላክ)**
- **As an** Admin
- **I want to** send bulk SMS to parents who have unpaid fees.
- **So that** the school collects outstanding balances faster.
- **Acceptance Criteria:** Filter unpaid invoices → Click "Send SMS" → Parents receive alerts.