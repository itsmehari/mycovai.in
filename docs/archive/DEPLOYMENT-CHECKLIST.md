# 🚀 Deployment Checklist - MyOMR Job Portal

**Date:** October 29, 2025  
**Status:** Ready for Deployment

---

## 📋 Pre-Deployment Checklist

### **Files to Upload:**

✅ **All files in `/omr-local-job-listings/` folder:**
```
/omr-local-job-listings/
├── index.php                          ✅
├── post-job-covai.php                   ✅
├── job-detail-covai.php                 ✅
├── employer-login-covai.php             ✅
├── employer-logout-covai.php            ✅
├── my-posted-jobs-covai.php            ✅
├── application-submitted-covai.php     ✅
├── job-posted-success-covai.php         ✅
├── process-job-covai.php               ✅
├── process-application-covai.php        ✅
├── generate-sitemap.php               ✅
├── robots.txt                         ✅
├── admin/
│   ├── index.php                      ✅
│   ├── manage-jobs-covai.php            ✅
│   └── view-all-applications-covai.php  ✅
├── includes/
│   ├── job-functions-covai.php          ✅
│   ├── employer-auth.php             ✅
│   └── seo-helper.php                 ✅
└── assets/
    ├── job-listings-omr.css          ✅
    ├── job-search-omr.js             ✅
    └── job-analytics-events.js       ✅
```

---

## 📤 Step 1: Upload Files

### **Using FTP/cPanel File Manager:**

1. ✅ **Navigate to:** `/public_html/omr-local-job-listings/`
2. ✅ **Create folder** if it doesn't exist: `omr-local-job-listings`
3. ✅ **Upload all files** maintaining folder structure:
   - Upload all PHP files
   - Upload all CSS files
   - Upload all JS files
   - Upload `robots.txt`
   - Maintain folder structure (admin/, includes/, assets/)

### **Important:**
- ✅ Keep exact folder structure
- ✅ Ensure file permissions are correct (644 for files, 755 for folders)
- ✅ Verify all includes paths work (relative paths)

---

## 🗄️ Step 2: Database Setup

### **Already Completed:**
- ✅ Database tables created via `CREATE-JOBS-DATABASE.sql`
- ✅ Sample data inserted
- ✅ Tables verified: employers, job_postings, job_applications, job_categories

### **Verify:**
- [ ] Check `core/omr-connect.php` has correct database credentials
- [ ] Test database connection from live server

---

## 🔧 Step 3: Configuration

### **File Paths Check:**

✅ **All includes use relative paths:**
- `../components/main-nav.php` ✅
- `../components/footer.php` ✅
- `../components/analytics.php` ✅
- `../core/omr-connect.php` ✅

✅ **Assets use relative paths:**
- `assets/job-listings-omr.css` ✅
- `assets/job-search-omr.js` ✅

### **Verify:**
- [ ] All includes load correctly
- [ ] CSS loads correctly
- [ ] JavaScript loads correctly
- [ ] Images load correctly
- [ ] Navigation links work

---

## 🎯 Step 4: Generate Sitemap

### **After Upload:**

1. Visit: `https://myomr.in/omr-local-job-listings/generate-sitemap.php`
2. Verify sitemap.xml is created
3. Check sitemap contains all approved jobs

### **Location:**
- Sitemap: `https://myomr.in/omr-local-job-listings/sitemap.xml`
- Robots.txt: `https://myomr.in/omr-local-job-listings/robots.txt`

---

## ✅ Step 5: Quick Verification

### **Test These URLs:**

- [ ] `https://myomr.in/omr-local-job-listings/` (Main page loads)
- [ ] `https://myomr.in/omr-local-job-listings/post-job-covai.php` (Form loads)
- [ ] `https://myomr.in/omr-local-job-listings/employer-login-covai.php` (Login loads)
- [ ] Check browser console for JavaScript errors
- [ ] Check page source for proper HTML structure

---

## 🔒 Step 6: Security Check

### **Verify:**
- [ ] Admin panel not accessible without login
- [ ] CSRF tokens working
- [ ] Forms validate correctly
- [ ] SQL injection prevention working
- [ ] XSS protection working

---

## 📊 Step 7: Analytics Verification

### **Test:**
- [ ] Google Analytics tracking (check Real-Time in GA4)
- [ ] Page views registering
- [ ] Events firing (after user testing)

---

## ✅ Deployment Complete!

Once all steps are verified, proceed to **HUMAN TESTING**.

---

**Last Updated:** October 29, 2025

