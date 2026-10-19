# Test Plan
## Smart School Management System (Smart SMS)

**Project Name:** Smart SMS
**Author:** Werkyantfu
**Date:** October 2026

---

## 1. Introduction
This document explains how we will test the Smart SMS system to make sure it is safe, fast, and works correctly before the school starts using it.

## 2. Testing Goals
- Make sure all features (Student Registration, Finance, Grading) work without errors.
- Check that parents cannot see other students' data.
- Ensure the system is easy to use for teachers and staff.

## 3. Testing Types
We will use three types of testing:

1. **Unit Testing:** Testing small parts of the code (like a single Laravel function) to ensure they work correctly.
2. **Integration Testing:** Testing if the Frontend (Vue.js) and Backend (Laravel) talk to each other properly.
3. **User Acceptance Testing (UAT):** The school staff (Registrar, Accountants, Teachers) will test the system to see if it meets their daily needs.

## 4. Test Environment
- **Computer:** Ubuntu 24.04 LTS
- **Browsers:** Google Chrome and Mozilla Firefox
- **Database:** MySQL (Local Server)

## 5. Who is Responsible?
- **Developer (Werkyantfu):** Will do the Unit and Integration testing.
- **School Staff:** Will do the UAT testing before the final launch.

## 6. What Happens if a Bug is Found?
If a tester finds an error, they will use the **Bug Report Template** to describe the problem. The developer will fix it, and the tester will check it again.