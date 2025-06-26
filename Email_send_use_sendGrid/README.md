# 📧 SendGrid Email Integration in Core PHP

This guide walks you through how to send beautifully styled HTML emails (with attachments) using SendGrid's API in **Core PHP**, including setup, verification, and advanced tips.

---

## 📦 Prerequisites

- ✅ PHP 7.2+
- ✅ Composer
- ✅ A [SendGrid Account](https://sendgrid.com)
- ✅ Verified Sender Identity (Gmail or domain-based)
- ✅ SendGrid API Key

---

## 🚀 Step-by-Step Setup

### 1️⃣ Install SendGrid SDK via Composer

```bash
composer require sendgrid/sendgrid
[
2️ Create a SendGrid API Key
Go to: https://app.sendgrid.com/settings/api_keys

Click "Create API Key"

Name it (e.g. PHP App)

Choose Full Access or Restricted > Mail Send

Copy and save the API key


3️⃣ Verify Sender Identity
✅ Option A: Personal Email (e.g., Gmail)
Go to: Sender Authentication

Under Single Sender Verification, click "Create New Sender"

Fill out your Gmail or personal email info

Click verification link sent to your inbox

✅ Option B: Domain Email (Recommended)
Select Domain Authentication

Add DNS records provided by SendGrid (SPF, DKIM)

Verify domain (e.g., sliteindia.com)

Use yourname@sliteindia.com as your from email


Create SendGrid Email Script (PHP Core) ### send-email.php



]