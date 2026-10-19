# API Endpoints
## Smart SMS Backend

**Base URL:** `http://localhost:8000/api`

| Method | Endpoint | Description | Auth Role | Payload Example |
|--------|----------|-------------|-----------|-----------------|
| **POST** | `/login` | User login | Public | `{ "email": "...", "password": "..." }` |
| **POST** | `/logout` | User logout | Any Auth | None |
| **GET** | `/students` | List all students | Admin, Registrar | None |
| **POST** | `/students` | Create new student | Admin, Registrar | `{ "first_name": "Abebe", "last_name": "Kebede", "class_id": 1 }` |
| **GET** | `/students/{id}` | Get single student | Admin, Teacher, Parent | None |
| **PUT** | `/students/{id}` | Update student data | Admin, Registrar | `{ "guardian_phone": "0911..." }` |
| **POST** | `/invoices` | Generate invoice | Accountant | `{ "student_id": 1, "amount": 5000 }` |
| **POST** | `/payments` | Record payment | Accountant | `{ "invoice_id": 1, "amount": 5000, "method": "telebirr" }` |
| **POST** | `/marks` | Enter student marks | Teacher | `{ "student_id": 1, "subject_id": 2, "score": 85 }` |
| **GET** | `/report-cards/{id}` | Generate report card | Parent, Admin | None (Returns PDF) |

### Sample JSON Response: `GET /students`

```json
{
  "data": [
    {
      "id": 1,
      "student_id_number": "SMS-2026-0001",
      "first_name": "Gebremeskel",
      "last_name": "Tewachew",
      "class": {
        "id": 1,
        "name": "Grade 1"
      },
      "status": "active"
    }
  ]
}