# 🎯 MyOMR Job Portal - Final Implementation Plan

## Dedicated `/omr-local-job-listings/` Folder

---

## 📁 Folder Structure

```
/omr-local-job-listings/
  ├── index.php                                      # Main job listings page
  ├── post-job-covai.php                              # Post new job form
  ├── job-detail-covai.php                            # Individual job view
  ├── apply-job-omr.php                             # Application form
  ├── employer-register-covai.php                     # Employer signup
  ├── employer-login-covai.php                        # Employer login
  ├── my-posted-jobs-covai.php                       # Employer dashboard
  ├── view-applications-covai.php                     # View applications
  ├── edit-job-covai.php                              # Edit job posting
  ├── process-job-covai.php                           # Backend: handle job posting
  ├── process-application-covai.php                   # Backend: handle applications
  ├── process-employer-omr.php                      # Backend: handle employer registration
  ├── admin/
  │   ├── index.php                                 # Admin dashboard
  │   ├── manage-job-listings-omr.php               # Approve/reject jobs
  │   ├── verify-employers-covai.php                  # Verify employers
  │   ├── job-analytics-omr.php                     # Analytics
  │   └── view-all-applications-covai.php            # All applications
  ├── includes/
  │   ├── job-functions-covai.php                     # Helper functions
  │   └── job-nav-omr.php                          # Navigation bar
  └── assets/
      ├── job-listings-omr.css                      # Styles
      └── job-search-omr.js                         # JavaScript
```

---

## 📝 File Naming Convention

### **Pattern:**

```
[action]-[location].php
or
[feature]-[location].php
```

### **Rules:**

1. ✅ Kebab-case (lowercase with hyphens)
2. ✅ Include "omr" in name
3. ✅ Descriptive, SEO-friendly
4. ✅ Start with action verb (post, apply, view, edit)
5. ✅ Keep names concise but clear

### **Examples:**

```
✅ index.php                          (Main listings page)
✅ post-job-covai.php                   (Post a job)
✅ job-detail-covai.php                 (View job details)
✅ apply-job-omr.php                  (Apply for job)
✅ employer-register-covai.php          (Employer signup)
✅ my-posted-jobs-covai.php            (Employer dashboard)
✅ process-job-covai.php                (Backend processor)
```

---

## 🗄️ Database (No Changes)

Still using the same database structure from `CREATE-JOBS-DATABASE.sql`:

- `employers` table
- `job_postings` table
- `job_applications` table
- `job_categories` table

---

## 🔗 Integration with Existing Site

### **Update Index Page:**

Change line 316 in `index.php`:

```php
<a href="/omr-local-job-listings/index.php" class="btn btn-success btn-block py-3">
  <i class="fas fa-briefcase mr-2"></i>Post Job Vacancy in OMR
</a>
```

### **Update Navigation:**

Add to `components/main-nav.php`:

```php
<li><a href="/omr-local-job-listings/index.php">Job Portal</a></li>
```

### **Update sitemap.xml:**

Add job portal URLs

---

## 📊 File Creation Checklist

### **Phase 1: Core Pages (Main Functionality)**

- [ ] `/omr-local-job-listings/index.php` - Job listings page
- [ ] `/omr-local-job-listings/post-job-covai.php` - Post job form
- [ ] `/omr-local-job-listings/job-detail-covai.php` - Job detail view
- [ ] `/omr-local-job-listings/apply-job-omr.php` - Application form

### **Phase 2: Backend Processing**

- [ ] `/omr-local-job-listings/process-job-covai.php` - Handle job posting
- [ ] `/omr-local-job-listings/process-application-covai.php` - Handle applications
- [ ] `/omr-local-job-listings/includes/job-functions-covai.php` - Helper functions

### **Phase 3: Employer Features**

- [ ] `/omr-local-job-listings/employer-register-covai.php` - Registration
- [ ] `/omr-local-job-listings/employer-login-covai.php` - Login
- [ ] `/omr-local-job-listings/my-posted-jobs-covai.php` - Dashboard
- [ ] `/omr-local-job-listings/view-applications-covai.php` - View apps
- [ ] `/omr-local-job-listings/edit-job-covai.php` - Edit posting

### **Phase 4: Admin Panel**

- [ ] `/omr-local-job-listings/admin/index.php` - Admin dashboard
- [ ] `/omr-local-job-listings/admin/manage-job-listings-omr.php` - Manage jobs
- [ ] `/omr-local-job-listings/admin/verify-employers-covai.php` - Verify employers

### **Phase 5: Assets**

- [ ] `/omr-local-job-listings/assets/job-listings-omr.css` - Styles
- [ ] `/omr-local-job-listings/includes/job-nav-omr.php` - Navigation

---

## 🎯 Implementation Order

### **Step 1: Create Basic Structure**

1. Create folder: `/omr-local-job-listings/`
2. Create subfolders: `admin/`, `includes/`, `assets/`
3. Set up navigation

### **Step 2: Build Core Pages**

1. `index.php` - Display job listings from database
2. `post-job-covai.php` - Job posting form
3. `job-detail-covai.php` - Individual job view
4. `apply-job-omr.php` - Application form

### **Step 3: Add Backend**

1. `process-job-covai.php` - Save jobs to database
2. `process-application-covai.php` - Save applications
3. `job-functions-covai.php` - Helper functions

### **Step 4: Employer Features**

1. Employer registration
2. Employer login/session
3. Dashboard to manage jobs
4. View applications

### **Step 5: Admin Features**

1. Admin dashboard
2. Approve/reject jobs
3. Verify employers

### **Step 6: Polish**

1. CSS styling
2. JavaScript functionality
3. Mobile responsiveness
4. Testing

---

## ✅ Benefits of Separate Folder

### **1. Organization:**

- ✅ All job portal files in one place
- ✅ Easy to maintain
- ✅ Clear separation from other features

### **2. SEO:**

- ✅ Clean URL: `/omr-local-job-listings/`
- ✅ Better for Google indexing
- ✅ Clearer site structure

### **3. Scalability:**

- ✅ Easy to expand job features
- ✅ Can add subdirectories for reports, analytics, etc.
- ✅ Future-proof structure

### **4. User Experience:**

- ✅ Users know they're in job section
- ✅ Consistent navigation
- ✅ Clear purpose

---

## 🚀 Quick Start

### **1. Run Database Script:**

```bash
Run: CREATE-JOBS-DATABASE.sql in phpMyAdmin
```

### **2. Create Files:**

```bash
Start with: index.php in /omr-local-job-listings/
```

### **3. Test:**

```bash
Visit: https://myomr.in/omr-local-job-listings/
```

---

**Status:** ✅ Folder created, ready for implementation
**Folder:** `/omr-local-job-listings/`
**Naming:** Kebab-case with "omr" suffix
**Integration:** Update index.php to link to new folder
