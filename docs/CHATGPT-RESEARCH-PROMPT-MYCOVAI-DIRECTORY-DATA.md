# ChatGPT Research Prompt: MyCovai Directory Data (Coimbatore)

**Use this in ChatGPT (Research mode) to gather directory data for MyCovai.in**

---

Copy everything below this line:

---

I need you to research and gather real, verifiable directory data for **Coimbatore (Covai)**, Tamil Nadu, India. This data will seed the **MyCovai.in** local business directory website. For each category, provide actual businesses/entities with their details. Use government sources, official listings, Google Maps, Wikipedia, and trusted local sources where possible.

**Target site:** MyCovai.in — Coimbatore's local directory (schools, banks, hospitals, restaurants, IT companies, parks, etc.)

**CRITICAL: Output format**
For each category, provide a **structured list** (table or CSV-style) with the **exact column names** shown. Use pipe (|) or comma separators. Empty optional fields can be blank. All addresses must be in **Coimbatore, Tamil Nadu**.

---

**COIMBATORE LOCALITIES** (use these for locality/address fields):
RS Puram, Gandhipuram, Peelamedu, Saibaba Colony, Race Course, Avinashi Road, Sivanandapuram, Sungam, Vadavalli, Kovaipudur, Saravanampatti, Vilankurichi, Thudiyalur, Kuniyamuthur, Ondipudur, Pollachi Road, Brookefields, Singanallur, Ukkadam, Town Hall

---

## 1. SCHOOLS — Table: `covai_schools`
Columns: slno | schoolname | address | contact | landmark | locality | verified | about | services | careers_url
- Include: CBSE, ICSE, state board schools, international schools
- At least 15–20 schools with real names, addresses, phone numbers

---

## 2. BANKS — Table: `covai_banks`
Columns: slno | bankname | address | contact | landmark | website
- SBI, HDFC, ICICI, Axis, Canara, Indian Bank branches in Coimbatore
- At least 20 bank branches

---

## 3. HOSPITALS — Table: `covai_hospitals`
Columns: slno | hospitalname | address | contact | landmark | locality | verified | about | services | careers_url
- KMCH, PSG Hospitals, GKNM, Kovai Medical, etc.
- At least 15 hospitals/clinics

---

## 4. RESTAURANTS — Table: `covai_restaurants`
Columns: id | name | address | locality | cuisine | cost_for_two | rating | availability | reviews | imagelocation
- Popular restaurants in RS Puram, Gandhipuram, Race Course, Peelamedu
- At least 20 restaurants with cuisine type, approximate cost for two

---

## 5. ATMs — Table: `covai_atms`
Columns: slno | bankname | address | contact | landmark
- Bank ATMs across Coimbatore localities
- At least 15–20 ATMs

---

## 6. PARKS — Table: `covai_parks`
Columns: slno | parkname | location | area | features | timings
- VOC Park, parks in RS Puram, Gandhipuram, etc.
- At least 10 parks

---

## 7. INDUSTRIES — Table: `covai_industries`
Columns: slno | industry_name | address | contact | industry_type | locality | verified | about | services | careers_url
- Textile mills, engineering, pump manufacturers, foundries (Coimbatore manufacturing)
- At least 15 industries

---

## 8. IT COMPANIES — Table: `covai_it_companies`
Columns: slno | company_name | address | contact | industry_type | verified | about | services | careers_url
- Software companies, IT parks, BPOs in Saravanampatti, Peelamedu IT corridor
- At least 15 IT companies

---

## 9. GOVERNMENT OFFICES — Table: `covai_gov_offices`
Columns: slno | office_name | address | contact | landmark
- Collectorate, RTO, Passport Office, Municipal Corporation, Police Commissionerate
- At least 10 government offices

---

## 10. IT PARKS — Table: `covai_it_parks`
Columns: id | name | locality | address | phone | website | inauguration_year | owner | built_up_area | total_area | image | amenity_sez | amenity_parking | amenity_cafeteria | amenity_shuttle | lat | lng | companies | location | updated_at
- TIDEL Park Coimbatore, KGISL Tech Park, etc.
- At least 5–8 IT parks

---

**Deliverable:** For each category, output a clearly labelled section with data in table or CSV format matching the column names. I will use this to generate MySQL INSERT statements for the MyCovai database. Prioritize accuracy—fewer verified entries are better than many guessed ones.

---

**Note:** Table names use `covai_` prefix for MyCovai.in. All data must be for **Coimbatore only**—no Chennai or OMR references.
