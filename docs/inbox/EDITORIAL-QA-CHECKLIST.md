# Editorial QA Checklist (Long-Form News)

**Use for:** Each upgraded article before publishing.

## Editorial QA

- [ ] **Word count** ≥ 2,000 (strip HTML, count body text only)
- [ ] **Tone** Neutral, authoritative, analytical; no promotional language
- [ ] **Claims** All facts, figures, and policy statements attributed or verifiable
- [ ] **Balance** Multiple viewpoints included where applicable
- [ ] **Dates** Timeline consistent; no vague "recently" or "soon" when specifics exist
- [ ] **Structure** Required H2 sections present:
  - Editor's context lead
  - What happened (verified facts)
  - Stakeholder perspectives
  - Data/policy/infrastructure context
  - Local impact analysis
  - What to watch next
  - FAQ or reader utility (optional)

## Technical QA

- [ ] **URL** Article loads at `/local-news/{slug}`
- [ ] **Meta** Title, description, OG, Twitter render correctly
- [ ] **Schema** NewsArticle JSON-LD valid (use [Schema Validator](https://validator.schema.org/))
- [ ] **Listing** Summary displays correctly on coimbatore-news.php
- [ ] **Images** Hero image path valid if set

## Tools

- Word count: `php dev-tools/qa-editorial-article.php path/to/article.html`
- Schema: Inspect page source for `application/ld+json`
