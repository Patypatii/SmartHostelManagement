# 📘 Smart Hostel Management System — README
---
## 🏡 Project Overview

The Smart Hostel Management System is a web-based platform built using Laravel PHP that simplifies the process of finding, booking, managing, and paying for hostel rooms.
The system provides an end-to-end digital experience for students while offering powerful management tools for administrators and staff.

The project supports multiple user roles — Admin, Student, and Staff — each with specific privileges and dashboards tailored to their needs.

This project was developed as a group assignment for Advanced Database / Web Application Development, emphasizing real-world system analysis, authentication, access control, and database-driven workflows.

## 🎯 Project Objectives

Digitize hostel and room management using an online platform.

Provide students with an easy way to search, view, book, and pay for rooms.

Allow administrators to manage rooms, hostels, payments, and users efficiently.

Ensure secure authentication, authorization, and role-based access control.

Promote transparency, reduce paperwork, and increase accessibility.

### 👥 User Roles & Features
**👨‍🎓 1. Student**

Students are the primary users of the system.
Key features for students:

Register and log in securely

View available hostels and room types

Search and filter rooms by price, location, or availability

Book a room and receive booking confirmations

Make online/offline payments

View booking history and payment status

Update personal profile information

**🧑‍💼 2. Staff**

Staff members assist with hostel operations.
Roles & responsibilities include:

Approve or decline booking requests

Verify payment transactions

Manage room availability

Handle student inquiries

Update hostel information

**👨‍💻 3. Admin**

Admins have full system control.
Admin capabilities:

Manage user accounts (students + staff)

Add, update, or delete hostels and rooms

Set room prices, capacity, and availability

View system data and activity logs

Generate reports (bookings, payments, occupancy)

Manage system settings & roles
---

## 🏛️ System Features Summary
✔ User Authentication & Authorization

Laravel Breeze / Jetstream / Auth scaffolding

Role-based access control (RBAC)

✔ Hostel & Room Management

Create/update hostels

Define room types & prices

Track availability

Room capacity management

✔ Booking System

Real-time availability

Booking requests and approvals

Cancellation functions

✔ Payment Handling

Support for online payment integration (Mpesa, PayPal, etc. — optional)

Manual/verified payment entries

Invoice & receipt generation

✔ Notification System

Email notifications (confirmation, approval)

Dashboard alerts

✔ Reporting & Analytics

Booking trends

Occupancy rates

Payment summaries

---

## 🏗️ Technology Stack
Category	Tools
Framework	Laravel PHP
Languages	PHP, HTML, CSS, JavaScript
Database	MySQL / MariaDB
UI	Blade Templates / Bootstrap / Tailwind
Authentication	Laravel Auth / Sanctum
Version Control	Git & GitHub

---

### ⚙️ Installation & Setup

Clone the repository:

git clone https://github.com/patypattii/smart-hostel.git
cd smart-hostel


Install dependencies:

composer install
npm install && npm run dev


Create the environment file:

cp .env.example .env


Configure database settings in .env.

Run migrations:

php artisan migrate


Start the local development server:

php artisan serve
---

## 🧪 Testing the System

Use seeded default accounts if provided

Test booking workflow

Test role-based access restrictions

Test payment procedures
---

## 🛡️ Security Considerations

CSRF protection enabled by Laravel

Password hashing

Validation on all forms

Restricted routes based on user role
---

## 📄 Team Members

Include your group members here:

Member 1 – Registration Number, Name

Member 2 – Registration Number, Name

Member 3 – Registration Number, Name

Member 4 – Registration Number, Name

(If you want, I can format this as a professional group list.)

## 🏁 Conclusion

The Smart Hostel Management System offers a modern, efficient solution for managing hostel allocations and student accommodation.
It reduces administrative workload, enhances student experience, and ensures secure and scalable hostel operations.
