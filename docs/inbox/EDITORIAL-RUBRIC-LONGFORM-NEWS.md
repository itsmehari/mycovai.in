# Editorial Rubric: Long-Form News (2000+ Words)

**Purpose:** Define standards for upgrading existing news items and all future articles to robust editorial quality.  
**Applies to:** `articles` table, all `/local-news/` detail pages.  
**Last updated:** 2026-03-19

---

## 1. Quality Gates

| Gate | Requirement |
|------|-------------|
| **Word count** | Minimum 2,000 words (body only; excludes meta, nav, ads) |
| **Structure** | At least 5 H2 sections; H3 subheadings where appropriate |
| **Tone** | Neutral, authoritative, analytical (editorial/newsroom style) |
| **Evidence** | All claims supported by facts, data, or attributed sources |
| **Balance** | Multiple viewpoints where applicable; no one-sided advocacy |
| **Attribution** | Sources cited for statistics, quotes, and policy statements |

---

## 2. Editorial Style Rules

### 2.1 Tone & Voice

- **News article, not report:** Write like The Hindu—a detailed news story with narrative flow. Avoid rigid "analysis" framing. Lead with the news; weave context into the narrative.
- **Neutral:** Avoid loaded adjectives, sensationalism, or partisan framing.
- **Authoritative:** Write as a senior editor: confident, precise, context-aware.
- **Narrative over structure:** Flowing paragraphs; quotes integrated naturally—not just “what happened.”
- **No promotional language:** No “exciting,” “amazing,” or PR-style superlatives. Use factual descriptors.

### 2.2 What to Avoid

- Unsupported claims (e.g., “will transform the city” without evidence).
- Single-source narratives without acknowledging other perspectives.
- Undated or vague references (“recently,” “soon”) when specifics exist.
- Marketing or sponsor-influenced phrasing.

### 2.3 What to Include

- **Context:** Why this matters to Coimbatore / Kongu region.
- **Timeline:** Clear dates and phases where relevant.
- **Stakeholders:** Who benefits, who is affected, who decides.
- **Data:** Budgets, timelines, geography, population, official figures.
- **Attribution:** “According to…,” “Officials said…,” “Data from….”

---

## 3. Structure: Hindu-Style News Article

Write as a detailed news story, not a structured report. News lead first; narrative body with natural subheadings; quotes woven in; background in flow; optional FAQ. Avoid rigid report sections.

| # | Section | Purpose | Approx. words |
|---|---------|---------|---------------|
| 1 | **Editor’s context lead** | Set the scene; state significance; establish authority | 150–250 |
| 2 | **What happened (verified facts)** | Core news: who, what, when, where; no speculation | 300–450 |
| 3 | **Stakeholder perspectives** | Quotes, positions, and reactions from officials, residents, experts | 250–400 |
| 4 | **Data, policy, and infrastructure context** | Background, policy links, technical/legal details | 300–450 |
| 5 | **Local impact analysis** | Short- and medium-term effects on residents, economy, governance | 300–450 |
| 6 | **What to watch next** | Follow-ups, deadlines, upcoming decisions | 150–250 |
| 7 | **FAQ or reader utility** | 3–5 Q&As for residents (optional but recommended) | 150–250 |

**Total target:** 2,000–2,500 words minimum.

---

## 4. HTML Structure Template

Use semantic HTML. Example outline:

```html
<section class="article-content">
  <p class="lead"><!-- Editor's context lead (1–2 paragraphs) --></p>

  <h2>What Happened</h2>
  <p><!-- Verified facts --></p>

  <h2>Stakeholder Perspectives</h2>
  <p><!-- Quotes and positions --></p>
  <blockquote cite="..."><!-- Attributable quote --></blockquote>

  <h2>Policy and Infrastructure Context</h2>
  <p><!-- Background, data, policy links --></p>

  <h2>Local Impact</h2>
  <h3>Short-term effects</h3>
  <p><!-- ... --></p>
  <h3>Medium-term outlook</h3>
  <p><!-- ... --></p>

  <h2>What to Watch Next</h2>
  <p><!-- Follow-ups, deadlines --></p>

  <h2>Frequently Asked Questions</h2>
  <h3>Question 1?</h3>
  <p>Answer...</p>
  <h3>Question 2?</h3>
  <p>Answer...</p>
</section>
```

---

## 5. Pre-Publish Checklist

- [ ] Word count ≥ 2,000 (strip HTML, count words in body only).
- [ ] All H2 sections present; logical flow.
- [ ] No unsupported claims; all figures attributed.
- [ ] Neutral tone; no promotional or loaded language.
- [ ] Dates and timeline accurate.
- [ ] Summary field 120–160 characters for cards and meta.
- [ ] Internal links to related articles where relevant.

---

## 6. Cross-References

- [news-publication-workflow.md](../workflows-pipelines/news-publication-workflow.md) — Publication pipeline
- [ARTICLES-EDITORIAL-AUDIT-INVENTORY.md](./ARTICLES-EDITORIAL-AUDIT-INVENTORY.md) — Current article inventory
- [PERUMBAKKAM-ARTICLE-PLAN.md](../content-projects/PERUMBAKKAM-ARTICLE-PLAN.md) — Example editorial plan
