<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

# Automated ETL & Supply Chain Data Reconciliation for SAP and iCRM+

## 📌 About
A web-based automated ETL (Extract, Transform, Load) and Data Reconciliation system designed to optimize supply chain data integrity. This application synchronizes, cleanses, and validates inventory and logistics records between SAP and iCRM+, helping teams eliminate manual spreadsheet auditing and prevent stock discrepancies between ERP and CRM systems.

## 👥 Multi-Role Management
This system is tailored specifically for two primary user roles to streamline warehouse operations:
* **Warehouse Admin:** Responsible for uploading or triggering daily stock data synchronization, viewing real-time mismatch alerts, and logging inventory adjustments.
* **Manager:** Accesses a comprehensive supply chain dashboard, monitors data trends, tracks unresolved discrepancies, and approves final logistics reconciliation reports.

## 🚀 Key Features
* **Automated ETL Pipeline:** Seamlessly extracts data from SAP and iCRM+, transforms and standardizes inconsistent data formats, and loads them into a unified staging database.
* **Smart Reconciliation Engine:** Automatically cross-references warehouse records to instantly flag quantity mismatches, missing item codes, or status differences.
* **Real-Time Reporting:** Generates downloadable, audit-ready reconciliation reports (Excel/PDF) for supply chain management.

## 🛠️ Tech Stack
* **Framework:** Laravel 11
* **Language:** PHP
* **Database:** MySQL

## 💻 Installation & Setup
1. Clone this repository:
```bash
   git clone [https://github.com/des1susanti/etl-sap-icrm-supply-chain.git](https://github.com/des1susanti/etl-sap-icrm-supply-chain.git)