# Stakeholder Register
## Smart SMS Project

**Project Name:** Smart School Management System (Smart SMS)
**Date:** October 2026

---

## 1. Primary Stakeholders (ዋና ተሳታፊዎች)
*እነዚህ በስርዓቱ ላይ ቀጥተኛ ተጽዕኖ ያላቸው እና በየቀኑ ስርዓቱን የሚጠቀሙ ናቸው።*

| Name / Role | Category | Interest | Influence | Key Needs / Expectations |
|-------------|----------|----------|-----------|--------------------------|
| **School Director** | Sponsor | High | High | Approves budget, wants overall system efficiency and ROI. |
| **Students** | End-User | High | Low | Want to view schedules, grades, and download assignments. |
| **Parents** | End-User / Client | High | Medium | Want to track child's attendance, grades, and pay fees easily. |
| **Teachers** | End-User | High | Medium | Need to enter grades, take attendance, and upload materials. |
| **Registrar** | Admin User | High | Medium | Needs to register students (KG-12), update profiles, manage sections. |
| **Accountant** | Admin User | High | Medium | Needs to generate invoices, record payments (Telebirr), and track fees. |

---

## 2. Secondary Stakeholders (ተጨማሪ ተሳታፊዎች)
*እነዚህ ለስርዓቱ ውጤት አስተዋጽኦ የሚያደርጉ ነገር ግን በየቀኑ ቀጥታ የማይጠቀሙት ናቸው።*

| Name / Role | Category | Interest | Influence | Key Needs / Expectations |
|-------------|----------|----------|-----------|--------------------------|
| **HR Manager** | Admin User | Medium | Medium | Staff records, leave management, payroll processing. |
| **Developer (Werkyantfu)**| Project Team | High | High | Writing clean code, meeting requirements, testing. |
| **IT Support** | Technical | High | Low | Server maintenance, backups, and system security. |

---

## 3. External Stakeholders (የውጭ ተሳታፊዎች)
*እነዚህ ከትምህርት ቤቱ ውጭ ያሉ እና ስርዓቱ ጋር በቴክኖሎጂ (API) የሚገናኙ ናቸው።*

| Name / Role | Category | Interest | Influence | Key Needs / Expectations |
|-------------|----------|----------|-----------|--------------------------|
| **Telebirr / CBE** | Payment Gateway | Low | Medium | API integration for online fee payments. |
| **Ethio Telecom** | SMS Provider | Low | Medium | API for sending SMS notifications to parents. |
| **Ministry of Education**| Regulatory | Low | High | Compliance with school data reporting and curriculum standards. |

---

## 4. RACI Matrix (Responsibility Assignment)
* **R** = Responsible (ሰሪ), **A** = Accountable (ተጠያቂ), **C** = Consulted (የሚመከር), **I** = Informed (የሚወለው)

| Activity | Director | Proj. Manager | Developer | Registrar | Teachers | Parents |
|----------|----------|---------------|-----------|-----------|----------|---------|
| System Design | A | R | C | I | I | I |
| Budget Approval | A/R | C | I | I | I | I |
| Student Registration | I | I | R | A | I | I |
| Grade Entry | I | I | R | I | A | I |
| Fee Payment | I | I | R | I | I | A |
| UAT Testing | A | R | C | C | C | C |